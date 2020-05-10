<?php 

namespace admin; 
use dal\AdminLink;

require_once __DIR__."/../dal/AdminLink.php";

/** 
 * This class is responsible for: 
 * 1. Communicating with the data access layer.
 * 2. Cleaning up any data and preparing it for transmission. 
 *  
*/

class HotelAccessService{
    private $conn;
    
    function __construct(){
        $this->conn = new  AdminLink(); 
    }
    
    function addHotel($companyName, $hotelXCord, $hotelYCord){
        if($this->conn->hotelExists($hotelXCord, $hotelYCord)){
            return false;
        }
        $this->conn->addHotel($companyName, $hotelXCord, $hotelYCord);
        return true; 
    }

    function getAllReservations($companyName){
        $res = $this->conn->getAllReservations($companyName);
        return !($res) ? false : json_encode($res);  
    }

    function getAllUpcomingReservations($companyName, $date){
        $res = $this->conn->getAllUpcomingReservations($companyName, $date);
        return !($res) ? false : json_encode($res);  
    }

    function getAllActiveReservations($companyName, $date){
        $res = $this->conn->getAllActiveReservations($companyName, $date);
        return !($res) ? false : json_encode($res);  
    }

    function addRoom($hotelXCord, $hotelYCord, $class, $price){
        $this->conn->addRoom($hotelXCord, $hotelYCord, $class, $price);
        return true; 
    }
    
    function addRooms($hotelXCord, $hotelYCord, $class, $price, $amount){
        $this->conn->addRoom($hotelXCord, $hotelYCord, $class, $price,$amount);
        return true; 
    }
    



}