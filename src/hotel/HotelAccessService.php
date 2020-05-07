<?php 

namespace hotel; 
use dal\HotelLink;

require_once __DIR__."/../dal/HotelLink.php";

/** 
 * This class is responsible for: 
 * 1. Communicating with the data access layer.
 * 2. Cleaning up any data and preparing it for transmission. 
 *  
*/

class HotelAccessService{
    private $conn;
    
    function __construct(){
        $this->conn = new  HotelLink(); 
    }
    
    function getCompany($hotelXCord, $hotelYCord){
        return json_encode( $this->conn->getCompany($hotelXCord, $hotelYCord));
    }

    function getAllRooms($hotelXCord, $hotelYCord){
        $res = $this->conn->getAllRooms($hotelXCord, $hotelYCord);
        if (!$res){
            return false;     
        }
        return json_encode($res);
    }

    function getAvailableRooms($hotelXCord, $hotelYCord, $date){
        $res = $this->conn->getAvailClassCount($hotelXCord, $hotelYCord, $date);
         if(!$res){
             return false; 
         }
         return json_encode($res);
    }

    function getRoomClasses($hotelXCord,$hotelYCord){
        $res = $this->conn->getRoomClasses($hotelXCord, $hotelYCord);
         if(!$res){
             return false; 
         }
         return json_encode($res);
    }

    function getRoomClassCounts($hotelXCord,$hotelYCord){
        $res = $this->conn->getClassCounts($hotelXCord, $hotelYCord);
         if(!$res){
             return false; 
         }
         return json_encode($res);
    }
    




}