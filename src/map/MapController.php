<?php 

namespace map; 

require_once __DIR__."/MapAccessService.php";

class MapController{
    private static $mapAccSvc; 

    static function getHotels(){
        self::$mapAccSvc  = new MapAccessService(); 
        echo  self::$mapAccSvc->getHotels();
    } 
}