<?php
namespace admin; 
use utility\Validator;
use Exception;
require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__."/CompanyService.php";

class AdminPOSTHandler{
    private const ACTIONS = array("add-room", "add-rooms", "create-hotel"); 
    private static $validator = null; 
    private static $compSvc   = null; 
    private static $args      = null; 

    public static function init($req){
        try{
            if (! key_exists($req["action"], self::ACTIONS)){
                throw new Exception('Invalid Action Specified'); 
            }
        } catch(Exception $e){
            error_log($e->getTraceAsString());
        }    
        self::$compSvc = new CompanyService();
        self::$args    = $req;
        try{ 
        switch ($req["action"]) {
            case "add-room":  
                self::addRoom();  
                break;
            case "add-rooms":
                self::addRooms();  
                break;
            case "create-hotel":
                self::createHotel(); 
                break;
            }
        } catch(Exception $e){
            error_log($e->getTraceAsString());
            echo $e->getMessage(); 
        }    
    }       

    private static function addRoom(){
        $reqParams = array("class", "price");
        echo var_dump(self::$args["content"]);
        $fields    = json_decode(self::$args["content"]);
        self::$validator = new Validator($fields,$reqParams);
        $fields  =  self::$validator->getSafeData();
        echo json_last_error();
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }
        self::$compSvc->addRoom(self::$args["x_cord"], self::$args["y_cord"], $fields["class"], $fields["price"]); 
    }
    private static function addRooms(){
        $reqParams = array("class", "price", "amount");
        $fields    = json_decode(self::$args["content"]);
        self::$validator = new Validator($fields,$reqParams);
        $fields  =  self::$validator->getSafeData();
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }
        self::$compSvc->addRooms(self::$args["x_cord"], self::$args["y_cord"], 
                                 $fields["class"], $fields["price"],$fields["amount"]); 
    }
    private static function createHotel(){
        $reqParams = array("company-name");
        $fields    = json_decode(self::$args["content"]);
        self::$validator = new Validator($fields,$reqParams);
        $fields  =  self::$validator->getSafeData();
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }
        self::$compSvc->addHotel($fields["company-name"], self::$args["y_cord"], 
                                 $fields["class"], $fields["price"],$fields["amount"]); 

    }
}