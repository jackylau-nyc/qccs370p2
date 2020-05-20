<?php
namespace reservation; 
use utility\Validator;
use Exception;

require_once __DIR__."/ResPOSTHandler.php";
require_once __DIR__."/ResGETHandler.php";
require_once __DIR__."/../utility/validator.php";

class ResController {
    // Every request must specify these fields. 
    private const  REQ_POST_PARAMS = array("action");                       
    private const  REQ_GET_PARAMS  = array("action");
    private static $validator;

    public static function postRequestHandler($req){
        self::validateMinParams($req, self::REQ_POST_PARAMS);
        ResPOSTHandler::init($req);
    }

    public static function requestHandler($req){            
        parse_str($req->QUERY_STRING, $qVars);
        self::validateMinParams($qVars, REQ_GET_PARAMS);
        ResGETHandler::init($qVars);
    }

    private static function validateMinParams($req, $validArr, $errMsg=""){
        try{
            self::$validator = new Validator($req,$validArr);
            $fields = self::$validator->getSafeData();
            if (!$fields){
                throw new Exception('Invalid Request: Illegal or Missing Parameters!'); 
            }
        } catch(Exception $e){
            self::errMSG($errMsg, $e);
            exit(); 
        }
    }
    private static function errMSG($method, $e){
        error_log($e->getTraceAsString());
        echo "Error: Unable to Process Request ";
        exit;
    }

}