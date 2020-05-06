<?php 

namespace hotel; 
use utility\Validator;
require_once __DIR__."/HotelAccessService.php";

class HotelController {
     private static $reqParams = array("xcord", "ycord");
     private static $accessSvc;
     private static $validator; 
     private static $fields;

     static function getAvailableRooms($req){
        self::init($req);  
        $res = self::$accessSvc->getAllRooms(self::$fields["xcord"],self::$fields["ycord"]);
        if(!$res){
            echo "Failure";
            return;
        } 
        echo $res; 
    }


    static function init($req){
        parse_str($req->QUERY_STRING, $qVars);
        self::$validator = new Validator($qVars, self::$reqParams);  
        self::$fields    = self::$validator->getSafeData(); 
        self::$accessSvc = new HotelAccessService(); 
    }


}