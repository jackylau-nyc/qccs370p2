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
     * Fetch reservation data from ALL hotels that belong to a specified company. 
     */
    function getAllReservations($hotelXCord, $hotelYCord){

    }
    
    /**
     * The administrator can also viewall the customers who are currently checked intohotels in the chain.
     * Fetch active reservation data from ALL hotels that belong to a specified company.
     * @param hotelXCord -> x coordinate of the hotel 
     * @param hotelYCord -> y coordinate of the hotel
     * @return array  
     */
    function getAllActiveReservations($hotelXCord, $hotelYCord, $date){

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
