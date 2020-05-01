<?php

require_once "./utility/validator.php ";
require_once "./RegisterService.php ";
require_once "./SigninService.php";

class AccountController{
     
    private $reqParams = array("username", "password");
    
    
    function signinAction(){
        $validator = new Validator($_POST, $this->reqParams);
   
        if(!$this->$validator.isValid()){
            echo "Invalid Username or Password !";
            exit; 
        }
        $fields = $validator.getSafeData(); 
        $signServce = new SigninService($fields["username"], $fields["password"]);
        if($fields["intent"] == "customer"){
            $success = $signServce->attemptCustomerSignin() ;  
        } else {
            $success = $signServce->attemptAdminSignin();
        }
        if ($success){
            // to-do: redirect to appropriate view.   
            echo "Success!";
        }else{
            echo "Failure!";
        }
    }

    function signupAction(){
        $validator = new Validator($_POST, $reqParams);
   
        if(!$this->$validator.isValid()){
            echo "Invalid Username or Password !";
            exit; 
        }
        $fields = $validator.getSafeData(); 
        $signServce = new SigninService($fields["username"], $fields["password"]);
        if($fields["intent"] == "customer"){
            $success = $signServce->attemptCustomerSignin() ;  
        } else {
            $success = $signServce->attemptAdminSignin();
        }
        if ($success){
            // to-do: redirect to appropriate view.   
            echo "Success!";
        }else{
            echo "Failure!";
        }

    }
    function checkData(){
        
    }

}