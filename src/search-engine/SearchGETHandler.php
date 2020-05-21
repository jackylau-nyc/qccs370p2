<?php 

namespace search; 
use utility\Validator;

use Exception;
require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__."/SearchService.php";

class SearchGETHandler{

    // Array of valid actions 
    private const ACTIONS = array("find-rooms-gt", "find-rooms-lt", "find-rooms-le",  
                                  "find-rooms-ge", "find-rooms-eq", "find-rooms-bet", 
                                  "find-by-company"); 
    private static $validator = null; 
    private static $searchSvc = null; 
    private static $args      = null;  
    
    public static function init($req){
        $action = $req["action"];
        self::validateRequest($action);
        self::$searchSvc = new ResService();
        self::$args      = $req;
        self::$validator = new Validator();
        self::selectAction($action);
    }       

    private static function  selectAction($action){
        try{ 
            switch ($action) {
                case "find-rooms-gt":  
                    echo self::findRoomsGT();  
                    break;
                case "find-rooms-lt":
                    echo self::findRoomsLT();  
                    break;
                case "find-rooms-le":
                    echo self::findRoomsLE();  
                    break;
                case "find-rooms-ge":
                    echo self::findRoomsGE();  
                    break;
                case "find-rooms-eq":
                    echo self::findRoomsEQ();  
                    break; 
                case "find-rooms-bet":
                    echo self::findRoomsBetween();  
                    break;
                case "find-by-company":
                    echo self::findHotelsByCompany();  
                    break;                    
            }
        } 

        catch(Exception $e){
            error_log($e->getTraceAsString());
            echo $e->getMessage(); 
            die();
        }    
    } 

    private static function findRoomsGT(){

    }
    private static function findRoomsLT(){

    }

    private static function findRoomsLE(){

    }
    private static function findRoomsGE(){

    }
    private static function findRoomsEQ(){

    }
    private static function findRoomsBetween(){

    }
    private static function findHotelsByCompany(){

    }


    private static function validateRequest($action){
        try{
            if (!in_array($action, self::ACTIONS)){
                throw new Exception('Invalid Action Specified. Action:'.$action); 
            }
        } catch(Exception $e){
            error_log($e->getMessage());
            error_log($e->getTraceAsString());
            echo "Error: Invalid Request. Missing action or unsupported action specified.";
            die(); 
        }    
    }
}