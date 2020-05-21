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
        self::$searchSvc = new SearchService();
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
        return self::$searchSvc->findRoomsGT(self::$args["price"],self::$args["date"]);
    }
    private static function findRoomsLT(){
        return self::$searchSvc->findRoomsLT(self::$args["price"],self::$args["date"]);
    }
    private static function findRoomsLE(){
        return self::$searchSvc->findRoomsLE(self::$args["price"],self::$args["date"]);
    }
    private static function findRoomsGE(){
        return self::$searchSvc->findRoomsGE(self::$args["price"],self::$args["date"]);
    }
    private static function findRoomsEQ(){
        return self::$searchSvc->findRoomsEQ(self::$args["price"],self::$args["date"]);
    }
    private static function findRoomsBetween(){
        return self::$searchSvc->findRoomsGT(self::$args["minPrice"], self::$args["maxPrice"], self::$args["date"]);
    }
    private static function findHotelsByCompany(){
        return self::$searchSvc->findHotelsByCompany(self::$args["term"]);
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