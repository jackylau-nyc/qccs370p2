<?php 

namespace search;  
use dal\SearchLink;
require_once __DIR__."/../dal/SearchLink.php";

class SearchService{
    private $conn;

    function __construct(){
        $this->conn = new  SearchLink(); 
    }
    
    function findRoomsGT($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    function findRoomsLT($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }

    function findRoomsLE($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    function findRoomsGE($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    function findRoomsEQ($price, $date){
        $response = $this->conn->findRoomsGT($price, $date); 
        return json_encode($response);
    }
    function findRoomsBetween($minPrice, $maxPrice, $date){
        $response = $this->conn->findRoomsGT($minPrice, $maxPrice,$date); 
        return json_encode($response);
    }

    function findHotelsByCompany($term){
        $response = $this->conn->findHotelsByCompany($term); 
        return json_encode($response);
    }




}