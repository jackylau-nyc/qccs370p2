<?php 
    
namespace sessions; 

class SessionController{

    static function protect(){
        $state = checkSessionVar("username"); 
        if($state){
            return true;
        } else{
            msg();
            return  false; 
        }
    }

    static function adminProtect(){
        $state = checkSessionVar("admin"); 
        if($state){
            return true;
        } else{
            msg();
            return  false; 
        }  
    }

    private static function checkSessionVar($var){
        return (!empty($_SESSION["$var"]))? true:false;
    }
    
    private static function msg(){
        echo "Access Denied: Please sign !";
    }
}