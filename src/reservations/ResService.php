<?php
namespace reservation; 
use utility\Validator;
use Exception;
use dal\ResLink;
require_once __DIR__."/../dal/ResLink.php";

class ResService{
    private $conn;

    function __construct(){
        $this->conn = new  ResLink(); 
    }
    

    function createReservation($username,$hotelXCord, $hotelYCord, $room, $startDate, $endDate){
        return $this->conn->createRes($username,$hotelXCord, $hotelYCord, $room, $startDate, $endDate);
    }

    function cancelReservation($res){
        return $this->conn->cancelRes($res);
    }

    function getReservation(){

    }

}