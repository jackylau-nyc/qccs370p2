<?php 
namespace map; 
use database\DBLink;

require_once __DIR__."/../database/db-connection.php";

class MapAccessService{

    private $conn; 

    function __construct(){
        $this->conn     = new DBLink(); 
    }
    
    function getHotels(){    
        $result = $this->conn->getHotels();
        return  json_encode($result);
    }
}

