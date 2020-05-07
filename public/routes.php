<?php
// to-do replace with spl auto-loading later 
use routing\Request;
use routing\Router;
use accounts\AccountController;
use map\MapController; 
use hotel\HotelController;
use customer\CustomerController;
use admin\AdminController;  
require_once __DIR__ ."/../src/routing/Request.php";
require_once __DIR__ ."/../src/routing/Router.php";
require_once __DIR__ ."/../src/accounts/AccountController.php";
require_once __DIR__ ."/../src/accounts/AccountController.php";
require_once __DIR__ ."/../src/map/MapController.php";
require_once __DIR__ ."/../src/hotel/HotelController.php";
require_once __DIR__ ."/../src/customer/CustomerController.php";
require_once __DIR__ ."/../src/admin/AdminController.php";

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

 } else{ // everything else.

    
    $router->get('/', function() {
        require __DIR__.'/index.php;';
    });

    $router->get('/admin', function() {
        AdminController::test();
    });

    $router->get('/customer', function() {
        CustomerController::test();
    });

    $router->get('', function() {
        require __DIR__.'/index.php;';
    });

    $router->get("/hotel", function() {
        require __DIR__."/hotel.php";
    });

    $router->get('/reservation', function() {
        require __DIR__.'/reservation.php';
    });
      
    $router->post('/admin-signin', function($req){
        AccountController::adminSignIn($req->getBody());
    });
     
    $router->post('/signin', function($req){
        AccountController::customerSignIn($req->getBody());
    });
    
    $router->post('/signup', function($req){
        AccountController::signupAction($req->getbody());
    });

    
    $router->get('/search', function() {
        require __DIR__.'/search.php;';
    });        


    $router->get('/map', function($req){
        MapController::getHotels();
    });

    
 }


// Returns true for strings that contain a question mark preceded by the string itself. 

function isQStr($str, $tgt){
    return preg_match( "/$str\?/",$tgt);
}


