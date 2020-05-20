<?php 
    
namespace sessions; 

class SessionController{

    static function protect(){
        if (!self::checkSessionVar("username")){
            self::handleAccess();
        };
    }

    static function adminProtect(){
        if (!self::checkSessionVar("admin")){
            self::handleAccess();
        };
    }

    private static function checkSessionVar($var){
        return (!empty($_SESSION["$var"]))? true:false;
    }
    
    private static function handleAccess(){
        echo "Access Denied: Please sign !";
        echo "You will be redirected in 5 seconds";
        $url = '/index.php';
        header( "refresh:5;url=$url" );
    }
}