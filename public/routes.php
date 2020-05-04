<?php
// to-do replace with spl auto-loading later 
use routing\Request;
use routing\Router;
use accounts\AccountController;
use map\MapController; 
require_once __DIR__ ."/../src/routing/Request.php";
require_once __DIR__ ."/../src/routing/Router.php";
require_once __DIR__ ."/../src/accounts/AccountController.php";
require_once __DIR__ ."/../src/accounts/AccountController.php";
require_once __DIR__ ."/../src/map/MapController.php";

$request = $_SERVER['REQUEST_URI'];

$router = new Router(new Request);

/****************************************************************************************************
 **************************************** Route <-> Mappings ****************************************
 ****************************************************************************************************/


$router->get('/', function() {
    require __DIR__.'./index.php;';
});

$router->get('', function() {
    require __DIR__.'./index.php;';
});

$router->get('/hotel', function() {
    require __DIR__.'./hotel.php;';
});
    
   
$router->get('/reservations', function() {
    require __DIR__.'./reservations.php;';
});

  
$router->get('/search', function() {
    require __DIR__.'./search.php;';
});        


$router->get('/admin', function() {
    require __DIR__.'./index.php;';
});

$router->post('/signin', function($req){
    AccountController::customerSignIn($req->getBody());
});

$router->get('/map', function($req){
    MapController::getHotels();
});

// $router->post(null, function($req){
// http_response_code(404);
//     require __DIR__ . '/../resources/views/404.php';  
// });
        
  


  




