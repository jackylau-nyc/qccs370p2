<?php

namespace search; 
use utility\Validator;
use Exception;

require_once __DIR__."/SearchGETHandler.php";
require_once __DIR__ ."/../utility/validator.php";

class SearchController {
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
        SearchGETHandler::init($qVars);
    }
    private static function errMSG($method, $e){
        error_log($e->getTraceAsString());
        echo "Error: Unable to Process $method Request";
        exit;
    }

}