<?php
include "components/session.php";	
// to-do replace with spl auto-loading later 
use routing\Request;
use routing\Router;
use accounts\AccountController;
use map\MapController; 
use hotel\HotelController;
use admin\AdminController;
use sessions\SessionController;  
use reservation\ResController;
use customer\CustController; 
use search\SearchController; 
require_once __DIR__ ."/../src/routing/Request.php";
require_once __DIR__ ."/../src/routing/Router.php";
require_once __DIR__ ."/../src/accounts/AccountController.php";
require_once __DIR__ ."/../src/accounts/AccountController.php";
require_once __DIR__ ."/../src/map/MapController.php";
require_once __DIR__ ."/../src/hotel/HotelController.php";
require_once __DIR__ ."/../src/admin/AdminController.php";
require_once __DIR__ ."/../src/reservations/ResController.php";
require_once __DIR__ ."/../src/sessions/SessionController.php";
require_once __DIR__ ."/../src/customer/CustController.php";
require_once __DIR__ ."/../src/search-engine/SearchController.php";

$router = new Router(new Request);
$uri  = $_SERVER["REQUEST_URI"];

/****************************************************************************************************
 **************************************** Route <-> Mappings ****************************************
 ****************************************************************************************************/

 if(preg_match( "/\?/",$uri)){ // for urls with query strings.  [any uri strings that contains '?'] 

    if( isQStr("hotel", $uri)){
        $router->get("$uri", function($req) {
            HotelController::requestHandler($req);
        });
    }

    if( isQStr("admin", $uri)){
        $router->get("$uri", function($req) {
            AdminController::requestHandler($req);
        });
    }   

    
    if( isQStr("customer", $uri)){
        $router->get("$uri", function($req) {
            CustController::requestHandler($req);
        });
    } 
    
    if( isQStr("search", $uri)){
        $router->get("$uri", function($req) {
            SearchController::requestHandler($req);
        });
    } 
    

 } else{ // everything else.

   /****************************************************************************************************
    **************************************** Free Site Mappings ****************************************
    ****************************************************************************************************/
  
    $router->get('/', function() {  
        require __DIR__.'/index.php;';
    });

    $router->get('', function() {
        require __DIR__.'/index.php;';
    });

    $router->get("/hotel", function() {
        require __DIR__."/hotel.php";
    });

    $router->get('/cust-reservation', function() {
        if (SessionController::protect()) { 
            include __DIR__.'/reservation.php';
        } 
    });

    $router->get('/search', function() {
        require __DIR__.'/search.php;';
    });    

    $router->get('/map', function($req){
        MapController::getHotels();
    });
    
   /****************************************************************************************************
    ******************************************* POST Mappings ******************************************
    ****************************************************************************************************/

    $router->post('/reservation', function($req) {
        ResController::postRequestHandler($req->getBody());
    });

    $router->post("/admin", function($req) {
        AdminController::postRequestHandler($req->getBody());
    });
    $router->post('/signin', function($req){
        AccountController::customerSignIn($req->getBody());
    });

    $router->post('/signup', function($req){
        AccountController::signupAction($req->getbody());
    });

    $router->post('/admin-signin', function($req){
        AccountController::adminSignIn($req->getBody());
    });
     
    $router->post('/logout', function($req){
        AccountController::logout();
    });
    

    
 }


// Returns true for strings that contain a question mark preceded by the string itself. 

function isQStr($str, $tgt){
    return preg_match( "/$str\?/",$tgt);
}


