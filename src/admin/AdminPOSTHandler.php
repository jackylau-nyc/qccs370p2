<?php
namespace admin; 
use utility\Validator;
use Exception;
require_once __DIR__ ."/../utility/validator.php";
require_once __DIR__."/CompanyService.php";

class AdminPOSTHandler{
    private const  POST_ACTIONS   = array("add-room", "add-rooms", "create-hotel"); 

    public static function init($req){
        echo var_dump($req);
    }       


    private static function  anon(){
        switch (self::$action) {
            case "add-room":  
                self::addRoom();  
                break;
            case "add-rooms":
                self::addRooms();  
                break;
            case "create-hotel":
                self::createHotel(); 
                break;
            }
    }

    private static function addRoom(){

    }
    private static function addRooms(){

    }
    private static function createHotel(){

    }

}