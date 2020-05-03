<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class HotelLink extends BaseLink {

    function findCompany($hotelXCord, $hotelYCord){
        $sql = "SELECT  hotel.company
                FROM    hotel
                WHERE   hotel.x_cord = ? AND hotel.y_cord = ?";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    function getAllRooms($hotelXCord, $hotelYCord){
        $sql = "SELECT* 
                FROM    room
                WHERE   room.x_cord = ? AND room.y_cord = ?";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    function getClassCount(){
        $sql = "SELECT class, count(class)
                FROM   room 
                WHERE  room.x_cord  = ? AND room.y_cord = ?
                GROUP BY class";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    function getAvailClassCount(){

    }

    function findRoomsGT(){

    }
    function findRoomsEQ(){
        
    }
    
}
