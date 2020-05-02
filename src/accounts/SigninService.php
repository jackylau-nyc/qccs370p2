<?php 

namespace accounts; 

require_once __DIR__."/../database/db-connection.php";

class SigninService{
    private $username; 
    private $passwd; 
    private $conn; 

    function __construct($username, $password){
        $this->username = $username; 
        $this->passwd   = $password; 
        $this->conn     = new DBLink(); 
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
            echo "Invalid username or password.";
        }
    }
}
