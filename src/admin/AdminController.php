<?php
namespace admin; 
use utility\Validator;
use Exception;
require_once __DIR__."/AdminPOSTHandler.php";
require_once __DIR__."/AdminGETHandler.php";
require_once __DIR__ ."/../utility/validator.php";

class AdminController {
    // Every request must specify these fields. 
    private static $reqGETParams  = array("company", "action","content");
    private static $reqPOSTParams = array("x_cord","y_cord", "action", "content");                       
    private static $validator;

    public static function postRequestHandler($req){
        try{
            self::$validator = new Validator($req, self::$reqPOSTParams);
            $fields = self::$validator->getSafeData();  
            if (!$fields){
                throw new Exception('Invalid Request: Illegal or Missing Body Fields!'); 
            }
        } catch(Exception $e){
            self::errMSG("POST", $e);
        }        
        AdminPOSTHandler::init($req);
    }

    public static function requestHandler($req){            
        try{
            parse_str($req->QUERY_STRING, $qVars);
            self::$validator = new Validator($qVars,self::$reqGETParams);
            $fields = self::$validator->getSafeData();
            if (!$fields){
                throw new Exception('Invalid Request: Illegal or Missing Parameters!'); 
            }
        } catch(Exception $e){
            self::errMSG("GET", $e);
        }
        AdminGETHandler::init($qVars);
    }


    private static function errMSG($method, $e){
        error_log($e->getTraceAsString());
        echo "Error: Unable to Process $method Request";
        exit;
    }

}