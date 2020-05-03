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
        return (is_null($result))? false : true;
    }

    function findAllRooms(){

    }
    function findRoomsLT(){

    }
    function findRoomsGT(){

    }
    function findRoomsEQ(){
        
    }
    
}