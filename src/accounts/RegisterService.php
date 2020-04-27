<?php 
require_once "../database/db-connection.php";
class RegisterService{
    private $username; 
    private $passwd; 
    private $conn; 

    function __construct($username, $password){
        $this->username = $username; 
        $this->passwd   = $password; 
        $this->conn     = new DBLink(); 
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
