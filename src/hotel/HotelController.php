<?php 

namespace hotel; 
use utility\Validator;
use Exception;
require_once __DIR__."/HotelAccessService.php";

class HotelController {
    // Every GET request must specify these fields. 
     private static $reqParams = array("xcord", "ycord", "action");
     // Array of valid actions for a query string. 
     private const ACTIONS     = array("hotel-page", "res-page",
                                       "rooms", "room-classes", "room-class-counts", "avail-room-class-counts",             
                                       "company", "avail-room-records");      
    private static $x, $y;          // x and y coordinates that identify a hotel.               
    private static $accessSvc;
    private static $validator;
    private static $action;
    private static $date; 

     /* 
     * Query String Template For Hotel: 
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
            case "hotel-page":  
                self::getHotelPage();  
                break;
            case "res-page":
                self::getResPage();  
                break;
            case "rooms":
                self::getAllRooms(); 
                break;
            case "room-classes":
                self::getRoomClasses(); 
                break;
            case "room-class-counts": 
                self::getRoomClassCounts();
                break;
            case "avail-room-class-counts": 
                self::getAvailRoomClassCounts();
                break;
            case "company":
                self::getCompany();
                break;
            case "avail-room-records":
                self::getAvailableRoomRecords();
                break;
        }
    }

    /**
     * @param req -> Object representation of $_SERVER. 
     */
    private static function init($req){
        parse_str($req->QUERY_STRING, $qVars);
        self::$validator = new Validator($qVars, self::$reqParams);  
        $fields    = self::$validator->getSafeData(); 
        if(! in_array($fields["action"], self::ACTIONS)){
            throw new Exception('Hotel Action: Invalid Action Specified !!!!'); 
        }
        self::$x   = $fields["xcord"];
        self::$y   = $fields["ycord"];
        if(!empty($fields["date"])){
            self::$date   = $fields["date"];
        }
        self::$action = $fields["action"];  
        self::$accessSvc = new HotelAccessService(); 
    }


    /****************************************************************************************************
     ********************************************* Retrieval ********************************************
     ****************************************************************************************************/
    
     /**
     * Action Identifier -> "rooms"
     * Echo json representation of ALL ROOMS (booked & free) present in the specified hotel. 
     */
    private static function getAllRooms(){
        $response = self::$accessSvc->getAllRooms(self::$x, self::$y);
        if(!$response){
            echo "Failure: Unable to fetch rooms. Please try again later.";
            exit;
        } 
        echo $response;
    }
    
    /**
     * Echo json representation of room classifications present in the specified hotel. 
     */
    private static function getRoomClasses(){
        $response = self::$accessSvc->getRoomClasses(self::$x, self::$y);
        echo $response;
    }

    /**
     * Echo json representation of all {classification:size} pairs present in the specified hotel. 
     */
    private static function getRoomClassCounts(){
        $response = self::$accessSvc->getRoomClassCounts(self::$x, self::$y);
        echo $response;
    }
    
    /**
     * Echo json representation of ONLY available {classification:size} pairs present in the specified hotel. 
     */
    private static function getAvailRoomClassCounts(){
        $response = self::$accessSvc->getAvailableRooms(self::$x, self::$y, self::$date);
        echo $response;
    }


    /**
     * Echo  {"company":"company_name"} for a specified hotel. 
     */
    private static function getCompany(){
        $response = self::$accessSvc->getCompany(self::$x, self::$y);
        echo $response;
    }

    /**
     * Echo  Available Room Information 
     */
    private static function getAvailableRoomRecords(){
        $response = self::$accessSvc->getAvailableRoomRecords(self::$x, self::$y, self::$date);
        echo $response;
    }

    
    /****************************************************************************************************
     ****************************************** HTML Rendering ******************************************
     ****************************************************************************************************/

    /**
     *  Action Identifier -> "hotel-page"
     *  Returns a web page that contains the :
     *  1. Hotel's name.
     *  2  Address 
     *  3. Instructions to viewrooms and rates and 
     *  4. Facility to book/cancel a reservation.
     */
    private static function getHotelPage(){
        //$company = self::$accessSvc->getCompany(self::$x, self::$y);
        // to-do add templating engine and view
        echo "Under Construction";
    }

    /**'
     * Action -> "res-page"
     * 1. Customers can book (and cancel) reservations using a hotel’s reservations page.
     * 2. This web page is NOT password protected:  anyone can access it.
     * 3. If rooms in a certain price range are full,customers cannot book reservations for those rooms.
     */
    private static function getResPage(){
        // to-do add templating engine and view
        echo "Under Construction";
    }
}