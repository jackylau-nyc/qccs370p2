<?php
namespace accounts; 
use utility\Validator;

require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__ ."/RegisterService.php";
require_once __DIR__ ."/SigninService.php";

class AccountController{
     
    private static $reqParams = array("username", "password");
    private static $accountService;
    private static $validator;

    static function adminSignin($args){
        self::$validator = new Validator($args, self::$reqParams);
        $fields = self::$validator->getSafeData(); 
        self::$accountService = new SigninService($fields["username"], $fields["password"]);
        $result = self::$accountService->signServce->attemptAdminSignin();
        self::processResult($result);
    } 

    static function customerSignin($args){ 
        self::$validator = new Validator($args, self::$reqParams);
        $fields = self::$validator->getSafeData(); 
        self::$accountService = new SigninService($fields["username"], $fields["password"]);
        $result = self::$accountService->attemptCustomerSignin();
        self::processResult($result);
    }

    function signupAction($args){
        self::$validator = new Validator($args, self::$reqParams);
        $fields = self::$validator->getSafeData(); 
        self::$accountService = new RegisterService($fields["username"], $fields["password"]);
        $result = self::$accountService->attemptRegistration();
        self::processResult($result);
    }

    private static function checkData(){
        if(!$this->$validator.isValid()){
            echo "Invalid Username or Password !";
            exit; 
        }
        return true;
    }

    private static function processResult($success){
        if ($success){
            // to-do: redirect to appropriate view.   
            echo "Success!";
        }else{
            echo "Failure!";
        }
    } 

}