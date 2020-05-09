<?php
namespace admin; 
use utility\Validator;

class AdminController {

    static function test(){
        echo ("<h1> Admin Page (>.<) I'm hooked up but have nothing useful do right now</h1>");
    }
        // Every request must specify these fields. 
        private static $reqParams = array("xcord", "ycord", "action");
        // Array of valid actions for a query string. 
        private const ACTIONS     = array("add-room", "add-rooms",
                                          "create-hotel", 
                                          "get-res", "get-avail-res");      
       private static $x, $y;          // x and y coordinates that identify a hotel.               
       private static $companySvc;
       private static $validator;
       private static $action;
       private static $date; 
   
        /* 
        * Query String Template For Admin: 
        * xcord= # & ycord= # & action = "action"
        */
        static function requestHandler($req){
           try{
               self::init($req);
           } catch(Exception $e){
               error_log($e->getTraceAsString());
               echo "Error: Unable to Process Request";
               exit;
           }
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
               case "get-res":
                   self::getReservation(); 
                   break;
               case "get-avail-res": 
                   self::getAvailReservation();
                   break;
           }
       }

    private static function init(){}
    private static function getInit(){}
    private static function addRoom(){}
    private static function addRooms(){}
    private static function createHotel(){}
    private static function getReservation(){}
    private static function getAvailReservation(){}



}