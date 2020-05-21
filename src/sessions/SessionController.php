<?php 
    
namespace sessions; 

class SessionController{

    static function getUser(){
        if(self::checkSessionVar("username")){
            echo json_encode($_SESSION["username"]);
        } else{
            echo json_encode("Error: No user signed in ");
          }
    }
    
    static function getAdminCompany(){
        if(self::checkSessionVar("company")){
            echo json_encode($_SESSION["company"]);
        } else{
            echo json_encode("Error: No admin signed in ");
          }
    }

    static function getAdmin(){
        if(self::checkSessionVar("admin")){
            echo json_encode($_SESSION["admin"]);
        } else{
            echo json_encode("Error: No admin signed in ");
          }
    }

    static function getGlob(){
        if(self::checkSessionVar("glob")){
            echo json_encode($_SESSION["glob"]);
        } else{
            echo json_encode("Error: No global date assigned");
          }
    }

    static function protect(){
        $state = self::checkSessionVar("username"); 
        if($state){
            return true;
        } else{
            self::msg();
            return  false; 
        }
    }

    static function adminProtect(){
        $state = self::checkSessionVar("admin"); 
        if($state){
            return true;
        } else{
            self::msg();
            return  false; 
        }  
    }

    private static function checkSessionVar($var){
        return (isset($_SESSION["$var"]))? true:false;
    }
    
    private static function msg(){
        echo "Access Denied: Please sign !";
    }
}