<?php 
namespace reservation; 
use utility\Validator;
use Exception;
require_once __DIR__ ."/../utility/validator.php";

class ResPOSTHandler{
    
    // Array of valid actions 
    private const ACTIONS = array("create-res", "cancel-res"); 
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
                case "":  
                    echo "";  
                    break;
                case "":
                    echo "";  
                    break;
                case "":
                    echo "";  
                    break;
                }
        } catch(Exception $e){
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
    
    // Add methods here.

}