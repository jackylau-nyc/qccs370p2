<?php 

require_once "../database/db-connection.php";

class SigninService{
    private $username; 
    private $passwd; 

    function __construct($username, $password){
        $this->username = $username; 
        $this->passwd   = $password; 
    }

    function attemptCustomerSignin(){    
        $conn = new DBLink(); 
        $hashedPasswd   = $conn->getCustomerPassword($this->username);
        return  $this->validPassword($this->passwd, $hashedPasswd)? true :false;
    }

    function attemptAdminSignin(){    
        $conn = new DBLink(); 
        $hashedPasswd   = $conn->getAdminPassword($this->$username);
        return validPassword($this->passwd, $hashedPasswd)? true :false; 
    }

    private function validPassword($passwd, $hashedPasswd){
        return !(is_null($hashedPasswd)) && password_verify($passwd,$hashedPasswd);
    }

}
