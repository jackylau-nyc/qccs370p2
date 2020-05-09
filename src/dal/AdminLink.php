<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class AdminLink extends BaseLink {
    /**
     * The  administrator  can add  a  new  franchise  to  the  hotel  chain  (=  new  hotellocation.
     * @param hotelXCord -> x coordinate of hotel to be added.  
     * @param hotelYCord -> y coordinate of hotel to be added. 
     */
    function addHotel($companyName, $hotelXCord, $hotelYCord){
        $sql = "INSERT 
                INTO hotel (x_cord, y_cord, company)
                VALUES (?,?,?)";
        $params = array ($hotelXCord, $hotelYCord, $companyName);
        $result = $this->query($sql, $params);
        return (is_null($result))? false : true;
    }
    
    /**
     * Spec: The administrator can view all the customer reservations in the hotel chain.
     * Fetch reservation data from ALL hotels that belong to a specified company. (Past, Future, Present)
     */
    function getAllReservations($companyName){
        $sql = "SELECT rc_junc.customer_username, hotel.x_cord, hotel.y_cord, rc_junc.reservation_id, hotel.company, res.res_start, res.res_end  
                FROM hotel
                INNER JOIN hotel AS hot
                    ON  hot.company = ?
                    AND hot.x_cord = hotel.x_cord
                    AND hot.y_cord = hotel.y_cord
                INNER JOIN room AS rm 
                    ON rm.x_cord = hotel.x_cord
                    AND rm.y_cord = hotel.y_cord
                INNER JOIN room_has_reservation AS rm_junc
                    ON rm_junc.x_cord = hotel.x_cord
                    AND rm_junc.y_cord = hotel.x_cord
                    AND rm_junc.room_num = rm.room_num
                INNER JOIN reservation_has_customer AS rc_junc
                    ON rc_junc.reservation_id = rm_junc.res_id
                INNER JOIN reservation AS res
                    ON res.res_id = rc_junc.reservation_id;";
        $params = array ($companyName);
        $result = $this->query($sql, $params);
        return (is_null($result))? false : $result;
    }
   
    /**
    * Fetch all upcoming reservations active for a given company based around a specified date.
    */
    function getAllUpcomingReservations($companyName, $date){
        $sql = "SELECT rc_junc.customer_username, hotel.x_cord, hotel.y_cord, rc_junc.reservation_id, hotel.company, res.res_start, res.res_end  
                FROM   hotel
                INNER JOIN hotel AS hot
                    ON  hot.company = ?
                    AND hot.x_cord = hotel.x_cord
                    AND hot.y_cord = hotel.y_cord
                INNER JOIN room AS rm 
                    ON  rm.x_cord = hotel.x_cord
                    AND rm.y_cord = hotel.y_cord
                INNER JOIN room_has_reservation AS rm_junc
                    ON  rm_junc.x_cord = hotel.x_cord
                    AND rm_junc.y_cord = hotel.x_cord
                    AND rm_junc.room_num = rm.room_num
                INNER JOIN reservation_has_customer AS rc_junc
                    ON  rc_junc.reservation_id = rm_junc.res_id
                INNER JOIN reservation AS res
                    ON  res.res_id = rc_junc.reservation_id
                    AND (res.res_start >= ?;";
        $params = array ($companyName, $date);
        $result = $this->query($sql, $params);
        return (is_null($result))? false : $result;
    }
    
    /**
    * Fetch all "Checked-In" reservations active for a given company for a specified date. 
    * Active here is defined as a reservation's start date being on or before the specified date, 
    * And the reservation's end date being on or after the specified date.
    */
    function getAllActiveReservations($companyName, $date){
        $sql = "SELECT rc_junc.customer_username, hotel.x_cord, hotel.y_cord, rc_junc.reservation_id, hotel.company, res.res_start, res.res_end  
                FROM   hotel
                INNER JOIN hotel AS hot
                    ON  hot.company = ?
                    AND hot.x_cord = hotel.x_cord
                    AND hot.y_cord = hotel.y_cord
                INNER JOIN room AS rm 
                    ON  rm.x_cord = hotel.x_cord
                    AND rm.y_cord = hotel.y_cord
                INNER JOIN room_has_reservation AS rm_junc
                    ON  rm_junc.x_cord = hotel.x_cord
                    AND rm_junc.y_cord = hotel.x_cord
                    AND rm_junc.room_num = rm.room_num
                INNER JOIN reservation_has_customer AS rc_junc
                    ON  rc_junc.reservation_id = rm_junc.res_id
                INNER JOIN reservation AS res
                    ON  res.res_id = rc_junc.reservation_id
                    AND (res.res_start <= ? AND res.res_end >= ?);";
        $params = array ($companyName, $date, $date);
        $result = $this->query($sql, $params);
        return (is_null($result))? false : $result;

    }

    /**
    * Fetch all reservations that are either currently checking in, or are pending.price
    * Pending here is defined as having the reservation start date be after the specified date.
    */
    function getAllValidReservations($companyName, $date){
        $sql = "SELECT rc_junc.customer_username, hotel.x_cord, hotel.y_cord, rc_junc.reservation_id, hotel.company, res.res_start, res.res_end  
                FROM hotel
                INNER JOIN hotel AS hot
                    ON  hot.company = ?
                    AND hot.x_cord = hotel.x_cord
                    AND hot.y_cord = hotel.y_cord
                INNER JOIN room AS rm 
                    ON rm.x_cord = hotel.x_cord
                    AND rm.y_cord = hotel.y_cord
                INNER JOIN room_has_reservation AS rm_junc
                    ON rm_junc.x_cord = hotel.x_cord
                    AND rm_junc.y_cord = hotel.x_cord
                    AND rm_junc.room_num = rm.room_num
                INNER JOIN reservation_has_customer AS rc_junc
                    ON rc_junc.reservation_id = rm_junc.res_id
                INNER JOIN reservation AS res
                    ON res.res_id = rc_junc.reservation_id
                    AND ((res.res_start <=  ? AND res.res_end >=  ? ) 
                        OR (res.res_start >=  ?  AND res.res_end >=  ?))";
        $params = array ($companyName, $date, $date,$date,$date);
        $result = $this->query($sql, $params);
        return (is_null($result))? false : $result;

    }
    /****************************************************************************************************
     ***************************************** Room Manipulation ****************************************
     ****************************************************************************************************/

     /**
     * Add ONE rooms to a given hotel for a given class
     * @param hotelXCord -> x coordinate of the hotel 
     * @param hotelYCord -> y coordinate of the hotel 
     * @param class -> classification of room. For example, cheap, deluxe etc. 
     * @param price -> price of each room in the specified class. 
     * @return boolean true if query executed successfully, false otherwise.  
     */
    function addRoom($hotelXCord, $hotelYCord, $class, $price){
        $stmnts[] = "set  @room = -1;";
        $params[] = []; 
        $stmnts[] = "SELECT 
                       @room := (SELECT room.room_num 
                       FROM     room 
                       WHERE    room.x_cord = ? and room.y_cord = ?
                       ORDER BY room_num desc
                       LIMIT    1);";
        $params[] = [$hotelXCord, $hotelYCord];
        $stmnts[] = "set @room = @room + '1';";
        $params[] = []; 
        $stmnts[] = "INSERT 
                     INTO   room (room_num, x_cord, y_cord, class, price)
                     VALUES (@room, ?,?,?,?);";
        $params[] = [$hotelXCord, $hotelYCord, $class, $price]; 
        $result   =  $this->transaction($stmnts, $params, $amount);
        return (is_null($result)) ? false : true;
    }

    /**
     * Add n rooms to a given hotel for a given class
     * @param hotelXCord -> x coordinate of the hotel 
     * @param hotelYCord -> y coordinate of the hotel 
     * @param class -> classification of room. For example, cheap, deluxe etc. 
     * @param price -> price of each room in the specified class. 
     * @param amount -> amount of rooms to insert. 
     * @return boolean true if query executed successfully, false otherwise.  
     */
    function addRooms($hotelXCord, $hotelYCord, $class, $price, $amount){ 
        $stmnts[] = "set  @room = -1;";
        $params[] = []; 
        $stmnts[] = "SELECT 
                     @room := (SELECT room.room_num 
                       FROM     room 
                       WHERE    room.x_cord = ? and room.y_cord = ?
                       ORDER BY room_num desc
                       LIMIT    1);";
        $params[] = [$hotelXCord, $hotelYCord];
        $stmnts[] = "set @room = @room + '1';";
        $params[] = []; 
        $stmnts[] = "INSERT 
                     INTO     room (room_num, x_cord, y_cord, class, price)
                     VALUES   (@room, ?,?,?,?);";
        $params[] = [$hotelXCord, $hotelYCord, $class, $price]; 
        $result   =  $this->multiTransaction($stmnts, $params, $amount);
        return (is_null($result)) ? false : true;
    }
}
