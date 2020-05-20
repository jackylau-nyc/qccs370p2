<?php
namespace customer; 
use utility\Validator;
use Exception;
require_once __DIR__."/CustGETHandler.php";
require_once __DIR__ ."/../utility/validator.php";

class CustController {
    // Every request must specify these fields. 
    private static $reqGETParams  = array("action");
    private static $validator;

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
        CustGETHandler::init($qVars);
    }


    private static function errMSG($method, $e){
        error_log($e->getTraceAsString());
        echo "Error: Unable to Process $method Request";
        exit;
    }

}