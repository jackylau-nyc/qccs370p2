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

   /****************************************************************************************************
    *********************************************** Core ***********************************************
    ****************************************************************************************************/

    static function adminSignin($args){
        self::$validator = new Validator($args, self::$reqParams);
        $fields = self::$validator->getSafeData(); 
        self::$accountService = new SigninService($fields["username"], $fields["password"]);
        $result = self::$accountService->attemptAdminSignin();
        $company = self::$accountService->getAdminCompany($fields["username"]);
        self::adminResult($result, $fields["username"], $company);
    } 

    static function customerSignin($args){ 
        self::$validator = new Validator($args, self::$reqParams);
        $fields = self::$validator->getSafeData(); 
        self::$accountService = new SigninService($fields["username"], $fields["password"]);
        $result = self::$accountService->attemptCustomerSignin();
        self::customerResult($result,$fields["username"]);
    }

    static function signupAction($args){
        self::$validator = new Validator($args, self::$reqParams);
        $fields = self::$validator->getSafeData(); 
        self::$accountService = new RegisterService($fields["username"], $fields["password"]);
        $result = self::$accountService->attemptRegistration();
        self::customerResult($result, $fields["username"]);
    }
    
    static function logout(){
        session_destroy();
        $url = $_SERVER['SERVER_NAME'] . '/index.php';
        $url = '/index.php';
        header( "refresh:2;url=$url" ); 
    }
 

    /****************************************************************************************************
     **************************************** Results & Sessions ****************************************
     ****************************************************************************************************/
    private static function customerResult($result, $username){
        if ($result){
            $_SESSION["username"] = $username;
        }
    }
    private static function adminResult($result, $username, $company){
        if ($result){
            $_SESSION["admin"]   = $username;
            $_SESSION["company"] = $company;
        }
    }
 /****************************************************************************************************
  ********************************************** Helper **********************************************
  ****************************************************************************************************/
    private static function checkData(){
        if(!$this->$validator.isValid()){
            echo "Invalid Username or Password !";
            exit; 
        }
        return true;
    }
}