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

        $stmnts[] = "INSERT INTO reservation_has_customer(customer_username, reserveration_id) 
                     VALUES (@username, @res);";
        $params[] = [];

        $stmnts[] = "INSERT INTO room_has_reservation(res_id, room_num, x_cord, y_cord)
                     VALUES(@res, @room, @x_cord , @y_cord);";
        $params[] = [];

        $this->transaction($stmnts, $params);
    }

    function findActiveRes($username, $date){

    }
    
    
    /**
     * Cancels a specified reservation. 
     * @param resID   reservation ID. 
     */
    function cancelRes($resID){
        
    }

}