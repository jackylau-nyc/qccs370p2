<?php
    namespace database; 
    define ('DB_HOST',  getenv('DB_HOST') );
    define ('DB_PORT',  getenv('DB_PORT') ); 
    define ('DB_USER',  getenv('DB_USER') );
    define ('DB_PASS',  getenv('DB_PASS') );
    define ('DATABASE', getenv('DATABASE') );
    define ('DSN', 'mysql:host='.DB_HOST.';'
                   .'port='.DB_PORT.';'
                   .'dbname='.DATABASE.';'
                   .'charset=utf8');