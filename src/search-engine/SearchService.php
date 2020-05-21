<?php 

namespace search;  
use dal\SearchLink;
require_once __DIR__."/../dal/SearchLink.php";

class SearchService{
    private $conn;

    function __construct(){
        $this->conn = new  SearchLink(); 
    }
    
    private static function findRoomsGT($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    private static function findRoomsLT($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }

    private static function findRoomsLE($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    private static function findRoomsGE($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    private static function findRoomsEQ($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    private static function findRoomsBetween($minPrice, $maxPrice, $date){
        $response = $this->conn->findRoomsGT($minPrice, $maxPrice,$date); 
        return json_encode($response);
    }

    private static function findHotelsByCompany($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }




}