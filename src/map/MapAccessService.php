<?php 
namespace map; 
use dal\MapLink;

require_once __DIR__."/../dal/MapLink.php";

class MapAccessService{

    private $conn; 

    function __construct(){
        $this->conn     = new MapLink(); 
    }
    
    function getHotels(){    
        $result = $this->conn->getHotels();
        return  json_encode($result);
    }
}

