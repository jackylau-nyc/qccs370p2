<?php 

namespace accounts; 
use dal\AccountLink;

require_once __DIR__."/../dal/AccountLink.php";

class RegisterService{

    private $username; 
    private $passwd; 
    private $conn; 

    function __construct($username, $password){
        if(is_null($username) || is_null($password)){
            echo "Error: Username or Password can't be empty!";
            exit();
        }
        $this->username = $username; 
        $this->passwd   = $password; 
        $this->conn     = new AccountLink(); 
    }

    function attemptRegistration(){    
        if($this->accountExists()){
            echo "Error: An account with that username already exists!";
            return false; 
        }
        $hashedPasswd = password_hash($this->passwd, PASSWORD_DEFAULT);
        $success = $this->conn->createAccount($this->username, $hashedPasswd); 
  
        if($success){
            echo "Success: Account successfuly created!";
        } else {
            echo "Unhandled Exception while account creation";
        }
        return $success; 
    }

    private function accountExists(){
        return $this->conn->findAccount($this->username);
    }
}
