<?php
// to-do replace with spl auto-loading later 
use routing\Request;
use routing\Router;
use accounts\AccountController;
require_once __DIR__ ."/../src/routing/Request.php";
require_once __DIR__ ."/../src/routing/Router.php";
require_once __DIR__ ."/../src/accounts/AccountController.php";

$request = $_SERVER['REQUEST_URI'];

$router = new Router(new Request);

/****************************************************************************************************
 **************************************** Route <-> Mappings ****************************************
 ****************************************************************************************************/

 switch ($request) {
    case '/' :
        $router->get('/', function() {
            require __DIR__.'./index.php;';
        });
    case '' :
        require __DIR__.'./index.php';
        break;
    case '/hotel' :
        $router->get('/hotel', function() {
    
        });
        break;
    case '/reservations' :
        $router->get('/reservations', function() {
            require __DIR__.'./reservations.php;';
        });
        break;
    case '/search' :
        $router->get('/search', function() {
            require __DIR__.'./search.php;';
        });        
        break;
    case '/admin' :
        $router->get('/admin', function() {
            require __DIR__.'./index.php;';
        });
        break;
    case '/signin' :
        $router->post('/signin', function($req){

            AccountController::customerSignIn($req->getBody());});
        break;
    default:
        $router->post(null, function($req){
            http_response_code(404);
            require __DIR__ . '/../resources/views/404.php';  
        });
        break;
    }







  




