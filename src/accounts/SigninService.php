<?php 

namespace accounts; 
use dal\AccountLink;

require_once __DIR__."/../dal/AccountLink.php";

class SigninService{
    private $username; 
    private $passwd; 
    private $conn; 

    function __construct($username, $password){
        $this->username = $username; 
        $this->passwd   = $password; 
        $this->conn     = new AccountLink(); 
    }

    function attemptCustomerSignin(){    
        $hashedPasswd   = $this->conn->getCustomerPassword($this->username);
        $success = $this->validPassword($this->passwd, $hashedPasswd)? true : false; 
        $this->printResult($success);
        return $success; 
    }

    function attemptAdminSignin(){    
        $hashedPasswd   = $this->conn->getAdminPassword($this->username);

        $success = $this->validPassword($this->passwd, $hashedPasswd)? true :false; 
        $this->printResult($success);
        return $success; 
    }

    private function validPassword($passwd, $hashedPasswd){
        return !(is_null($hashedPasswd)) && password_verify($passwd,$hashedPasswd);
    }   

    private function printResult($success){
        if($success){
            echo "Success: Successfuly Signed In!";
        } else {
            echo "Error: Invalid username or password.";
        }
    }
}
