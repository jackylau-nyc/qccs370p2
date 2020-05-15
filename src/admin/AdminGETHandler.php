<?php 
namespace admin; 
use utility\Validator;
use Exception;
require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__."/CompanyService.php";

class AdminGETHandler{
    
    // Array of valid actions 
    private const ACTIONS = array("get-all-res", "get-upcoming-res", "get-active-res"); 
    private static $validator = null; 
    private static $compSvc   = null; 
    private static $args      = null;  
    
    public static function init($req){
        $action = $req["action"];
        self::validateRequest($action);
        self::$compSvc   = new CompanyService();
        self::$args      = $req;
        self::$validator = new Validator();
        self::selectAction($action);
    }       

    private static function  selectAction($action){
        
        try{ 
            switch ($action) {
                case "get-all-res":  
                    echo self::getAllReservations();  
                    break;
                case "get-upcoming-res":
                    echo self::getUpcomingReservations();  
                    break;
                case "get-active-res":
                    echo self::getActiveReservations();  
                    break;
                }
            } 
            catch(Exception $e){
                error_log($e->getTraceAsString());
                echo $e->getMessage(); 
                die();
            }    
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


    private static function getAllReservations(){
        return self::$compSvc->getAllReservations(self::$args["company"]);
    }

    private static function getUpcomingReservations(){
        self::dataAvail(self::$args);
        return self::$compSvc->getAllUpcomingReservations(self::$args["company"], self::$args["date"]);
    }

    private static function getActiveReservations(){
        self::dataAvail(self::$args);
        return self::$compSvc->getAllActiveReservations(self::$args["company"], self::$args["date"]);
    }

    private static function dataAvail($arr){
        if(!key_exists("date", $arr)){
            throw new Exception('Invalid Request: Missing Date Field!'); 
        }
    }
}