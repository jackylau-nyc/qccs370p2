<?php 
namespace reservation; 
use utility\Validator;
use Exception;

require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__ ."/ResService.php";

class ResPOSTHandler{
    // Array of valid actions 
    private const ACTIONS = array("create-res", "cancel-res"); 
    private static $validator = null; 
    private static $resSvc   = null; 
    private static $args      = null;  
    
    public static function init($req){
        $action = $req["action"];
        self::validateRequest($action);
        self::$resSvc    = new ResService();
        self::$args      = $req;
        self::$validator = new Validator();
        self::selectAction($action);
    }       

   /****************************************************************************************************
    ********************************************* Selection ********************************************
    ****************************************************************************************************/

    private static function  selectAction($action){
        try{ 
            switch ($action) {
                case "create-res":  
                    self::createReservation();  
                    break;
                case "cancel-res":
                    self::cancelReservation();  
                    break;
            }
        } catch(Exception $e){
            error_log($e->getTraceAsString());
            echo $e->getMessage(); 
            die();
        }    
    } 

   /****************************************************************************************************
    ****************************************** Action Methods ******************************************
    ****************************************************************************************************/
  
    private static function createReservation(){
        $reqParams = array("username","x_cord", "y_cord", "room", "startDate", "endDate");
        $fields    =  self::validateActionParams(self::$args,$reqParams);
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }

        self::$resSvc->createReservation($fields["username"], self::$args["x_cord"], $fields["y_cord"], 
                        $fields["room"],$fields["startDate"], $fields["endDate"]); 
    }

    private static function cancelReservation(){
        $reqParams =  array("res");
        $fields    =  self::validateActionParams(self::$args,$reqParams);
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        }
       $result = self::$resSvc->cancelReservation($fields["res"]); 
       if(!$result){
            throw new Exception('Error: Unable to cancel reservation!');
       } else {
           echo "Success!";
       }
    }

   /****************************************************************************************************
    ******************************************** Validation ********************************************
    ****************************************************************************************************/

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

    private static function validateActionParams($args,$reqParams){
        $fields  =  self::$validator->varCheck($args,$reqParams);
        if (!$fields){
            throw new Exception('Invalid Request: Missing Required Fields!'); 
        } else {
            return $fields;
        }
    }

    // Add methods here.

}