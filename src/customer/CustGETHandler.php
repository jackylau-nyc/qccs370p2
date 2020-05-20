<?php 
namespace customer; 
use utility\Validator;
use reservation\ResService;
use Exception;
require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__."/../reservations/ResService.php";

class CustGETHandler{

    // Array of valid actions 
    private const ACTIONS = array("get-reservations", "cancel-reservation"); 
    private static $validator = null; 
    private static $resSvc    = null; 
    private static $args      = null;  
    
    public static function init($req){
        $action = $req["action"];
        self::validateRequest($action);
        self::$resSvc    = new ResService();
        self::$args      = $req;
        self::$validator = new Validator();
        self::selectAction($action);
    }       

    private static function  selectAction($action){
        try{ 
            switch ($action) {
                case "get-reservations":  
                    echo self::getReservations();  
                    break;
                case "cancel-reservation":
                    echo self::cancelReservation();  
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


    private static function getReservations(){
        return self::$resSvc->getCustomerReservation(self::$args["username"], self::$args["date"]);
    }

    private static function cancelReservation(){
        return self::$resSvc->cancelReservation(self::$args["res"]);
    }


}