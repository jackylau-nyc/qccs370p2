<?php

require_once "./utility/validator.php ";
require_once "./RegisterService.php ";
require_once "./SigninService.php";

class AccountController{
     
    private $reqParams = array("username", "password");
    private $signinService;
    
    function adminSignin(){
        $fields = $validator.getSafeData(); 
        $this->signServce = new SigninService($fields["username"], $fields["password"]);
        $this->signServce->attemptAdminSignin();
    } 

    function customerSignin(){

        $fields = $validator.getSafeData(); 
        $this->signServce = new SigninService($fields["username"], $fields["password"]);
        $this->signServce->attemptAdminSignin();
 
        if ($success){
            // to-do: redirect to appropriate view.   
            echo "Success!";
        }else{
            echo "Failure!";
        }
    }

    function signupAction(){


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
        $validator = new Validator($_POST, $this->reqParams);
        if(!$this->$validator.isValid()){
            echo "Invalid Username or Password !";
            exit; 
        }
        return true;
    }

}