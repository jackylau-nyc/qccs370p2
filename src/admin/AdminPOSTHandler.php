<?php
namespace admin; 
use utility\Validator;
use Exception;
require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__."/CompanyService.php";

class AdminPOSTHandler{
    private const ACTIONS = array("add-room", "add-rooms", "add-hotel"); 
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
        echo "Success!";
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

    private static function  selectAction($action){
        try{ 
            switch ($action) {
                case "add-room":  
                    self::addRoom();  
                    break;
                case "add-rooms":
                    self::addRooms();  
                    break;
                case "add-hotel":
                    self::addHotel(); 
                    break;
                }
            } 
            catch(Exception $e){
                error_log($e->getTraceAsString());
                echo $e->getMessage(); 
                die();
            }    
    } 

    private static function validateActionParams($args,$reqParams){
        $fields  =  self::$validator->varCheck($args,$reqParams);
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        } else {
            return $fields;
        }
    }

    private static function addRoom(){
        $reqParams = array("class", "price");
        $fields  =  self::validateActionParams(self::$args,$reqParams);
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }
        self::$compSvc->addRoom(self::$args["x_cord"], self::$args["y_cord"], $fields["class"], $fields["price"]); 
    }

    private static function addRooms(){
        $reqParams = array("class", "price", "amount");
        $fields  =  self::validateActionParams(self::$args,$reqParams);
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }
        self::$compSvc->addRooms(self::$args["x_cord"], self::$args["y_cord"], 
                                 $fields["class"], $fields["price"],$fields["amount"]); 
    }

    private static function addHotel(){
        $reqParams = array("company_name");
        $fields  =  self::validateActionParams(self::$args,$reqParams);
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }
        $result = self::$compSvc->addHotel($fields["company_name"], $fields["x_cord"], self::$args["y_cord"]); 
        if (!$result){
            throw new Exception('Error Bad Request: Hotel Already Exists!');
        }
    }

}