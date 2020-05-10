<?php 
namespace admin; 
use utility\Validator;
use Exception;
require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__."/CompanyService.php";

class AdminGETHandler{
    
    // Array of valid actions 
    private const  GET_ACTIONS    = array("get-res", "get-avail-res");  
    
    public static function init($req){
        echo var_dump($req);
    }       

    private static function anon(){
        switch (self::$action) {
            case "get-res":
                self::getReservation(); 
                break;
            case "get-avail-res": 
                self::getAvailReservation();
                break;
        }
    }
    private static function getReservation(){

    }
    private static function getAvailReservation(){

    }
}