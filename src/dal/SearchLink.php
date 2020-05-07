<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class SearchLink extends BaseLink {

    function getroom($price,$type,$hotel){
        
        $sql = "SELECT  *
                FROM  room inner join hotel on room.x_cord= hotel.x_cord and room.y_cord= hotel.y_cord and room.class = '$type' and hotel.company='$hotel'
                and room.price between $price";   
        $result = $this->query($sql,array());
        
        return (is_null($result))? false : $result;
        
    }
    // Moved from hotel link
    
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
}