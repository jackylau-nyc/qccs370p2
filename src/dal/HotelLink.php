<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class HotelLink extends BaseLink {
    /**
     * @return array if parent company found, false otherwise.
     * array( array("company"=> "Howard Resorts"));  
     */
    function getCompany($hotelXCord, $hotelYCord){
        $sql = "SELECT  hotel.company
                FROM    hotel
                WHERE   hotel.x_cord = ? AND hotel.y_cord = ?";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    /**
     * @return array  containing all rooms that belong to a hotel.
     * array( array("room_num"=> "6", "class"=> "Cheap","price"=> "450"));  
     */
    function getAllRooms($hotelXCord, $hotelYCord){
        $sql = "SELECT  room_num, class, price
                FROM    room
                WHERE   room.x_cord = ? AND room.y_cord = ?";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }


    function findRoomsLT($hotelXCord, $hotelYCord, $price){
        $sql = "SELECT  room_num, class, price
                FROM    room
                WHERE   room.x_cord = ? 
                        AND room.y_cord = ? 
                        AND room.price < ?";
        $params = array ($hotelXCord, $hotelYCord, $price);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;

    }

    function findRoomsGT($hotelXCord, $hotelYCord, $price){
        $sql = "SELECT  room_num, class, price
                FROM    room
                WHERE   room.x_cord = ? 
                        AND room.y_cord = ? 
                        AND room.price > ?";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;

    }
    function findRoomsEQ($hotelXCord, $hotelYCord, $price){
        $sql = "SELECT  room_num, class, price
                FROM    room
                WHERE   room.x_cord = ? 
                        AND room.y_cord = ? 
                        AND room.price = ?";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
        
    }

    /*
     * Returns an arra containing arrays of room classifications and classification counts.  
     * array( array("class"=> "Cheap","size"=> "3"), array("class"=> "Free,"size"=> "3") );  
     */
    function getClassCount($hotelXCord, $hotelYCord){
        $sql = "SELECT class, count(class) as size
                FROM   room 
                WHERE  room.x_cord  = ? AND room.y_cord = ?
                GROUP BY class";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    function getAvailClassCount($hotelXCord, $hotelYCord, $date){
        $sql = "SELECT class, count(class) as availableRooms
                FROM  room 
                WHERE room.room_num NOT IN (           
                     SELECT room.room_num 
                     FROM room 
                     INNER JOIN room_has_reservation
                        ON  room.x_cord = ? 
                        AND room.y_cord = ? 
                        AND room.x_cord = room_has_reservation.x_cord  
                        AND room.y_cord = room_has_reservation.y_cord
                        AND room_has_reservation.room_num =  room.room_num 
                     INNER JOIN reservation
                        ON  reservation.res_id = room_has_reservation.res_id
                        AND  ?  BETWEEN  
                        reservation.res_start AND reservation.res_end)
                GROUP BY room.class";

        $params = array ($hotelXCord, $hotelYCord, $date);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    
}
$var = new HotelLink();
echo var_dump( $var->getAvailClassCount(0,0, '2019-04-07')  );
