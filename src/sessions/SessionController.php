<?php 
    
namespace sessions; 

class SessionController{

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