<?php

include '../src/router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

switch ($request) {

    case '/':
        require './index.php';
        break;
    case '' :
        require './index.php';
        break;
    case '/hotel' :
        require __DIR__ . '/views/hotel.php';
        break;
    case '/search-engine' :
            require '../resources/views/search-engine.php';
            break;
    case '/reservations' :
        require __DIR__ . '/views/reservation.php';
        break;
    case '/admin' :
        require __DIR__ . '/views/admin.php';
        break;
    default:
        http_response_code(404);
        require '../resources/views/404.php';
        break;
}