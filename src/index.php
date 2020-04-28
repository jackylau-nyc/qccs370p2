<?php

include 'Router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/hotel' :
        require __DIR__ . '/views/hotel.php';
        break;
    case '/reservations' :
        require __DIR__ . '/views/reservation.php';
        break;
    case '/admin' :
        require __DIR__ . '/views/admin.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}