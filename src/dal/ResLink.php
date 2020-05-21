<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";

class ResLink extends BaseLink {
    /**
     * Creates a reservation for given customer. 
     * @param username   the customer's username. 
     * @param hotelXCord the x-coordinate of the hotel. 
     * @param hotelYCord the y-coordinate of the hotel.
     * @param room the room number of the room for the given hotel. 
     * @param startDate date, for example: "2019-04-01"
     * @param endDate date, for example: 2019-04-02
     */
    function createRes($username,$hotelXCord, $hotelYCord, $room, $startDate, $endDate){
        $stmnts[] = "SET @res = -1;";
        $params[] = []; 
        
        $stmnts[] ="SET @username = ?;";
        $params[] = [$username];
        
        $stmnts[] ="SET @room   = ?;";
        $params[] = [$room];

        $stmnts[] ="SET @x_cord = ?;";
        $params[] = [$hotelXCord];
        
        $stmnts[] ="SET @y_cord = ?;";
        $params[] = [$hotelXCord];

        $stmnts[] ="SET @start_date = Date(?);";
        $params[] = [$startDate];
        
        $stmnts[] ="SET @end_date = Date(?);";
        $params[] = [$endDate];
        
        $stmnts[] = "INSERT INTO reservation (res_start, res_end) 
                     VALUES (DATE(@start_date), DATE(@end_date));";
        $params[] = [];

        $stmnts[] = "SELECT @res := LAST_INSERT_ID();";
        $params[] = [];

        $stmnts[] = "INSERT INTO reservation_has_customer(customer_username, reservation_id) 
                     VALUES (@username, @res);";
        $params[] = [];

        $stmnts[] = "INSERT INTO room_has_reservation(res_id, room_num, x_cord, y_cord)
                     VALUES(@res, @room, @x_cord , @y_cord);";
        $params[] = [];
    
        return $this->inTransaction($stmnts, $params);
    }

    function findActiveRes($username, $date){

    }
    
    
    /**
     * Cancels a specified reservation. 
     * @param resID   reservation ID. 
     */
    function cancelRes($resID){

        $stmnts[] = "set  @res = ?;";
        $params[] = [$resID]; 

        $stmnts[] = "DELETE FROM reservation_has_customer
                    WHERE reservation_has_customer.reservation_id = @res;";
        $params[] = []; 

        $stmnts[] = "DELETE FROM room_has_reservation
                    WHERE room_has_reservation.res_id= @res;";
        $params[] = []; 

        $stmnts[] = "DELETE FROM reservation  
                     WHERE reservation.res_id = @res;";
        $params[] = []; 
        
        return $this->inTransaction($stmnts, $params);
    }

    /***
     * @param username customer's username; 
     */
    function getCustRes($username, $date){
        $sql = "SELECT rc_junc.customer_username as username, 
                       hotel.x_cord as xcord, hotel.y_cord as ycord, rc_junc.reservation_id as resID, hotel.company 
                       as company, res.res_start as startDate, res.res_end  as endDate, rm.class
                FROM hotel
                INNER JOIN hotel AS hot
                    ON  hot.x_cord = hotel.x_cord
                    AND hot.y_cord = hotel.y_cord
                INNER JOIN room AS rm 
                    ON  rm.x_cord = hotel.x_cord
                    AND rm.y_cord = hotel.y_cord
                INNER JOIN room_has_reservation AS rm_junc
                    ON  rm_junc.x_cord = hotel.x_cord
                    AND rm_junc.y_cord = hotel.y_cord
                    AND rm_junc.room_num = rm.room_num
                INNER JOIN reservation_has_customer AS rc_junc
                    ON rc_junc.reservation_id = rm_junc.res_id 
                    AND rc_junc.customer_username = ?
                INNER JOIN reservation AS res
                ON res.res_id = rc_junc.reservation_id
                AND ( (res.res_start <= ? AND res.res_end >=  ? ) OR (res.res_start >=  ? AND res.res_end >=  ? ))";
    
        $params = array ($username, $date, $date, $date, $date);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }


    function getCustomer($resID){

        $stmnts[] = "set  @res = ?;";
        $params[] = [$resID]; 

        $stmnts[] = "DELETE FROM reservation_has_customer
                    WHERE reservation_has_customer.reservation_id = @res;";
        $params[] = []; 

        $stmnts[] = "DELETE FROM room_has_reservation
                    WHERE room_has_reservation.res_id= @res;";
        $params[] = []; 

        $stmnts[] = "DELETE FROM reservation  
                     WHERE reservation.res_id = @res;";
        $params[] = []; 
        
        return $this->inTransaction($stmnts, $params);
    }
}