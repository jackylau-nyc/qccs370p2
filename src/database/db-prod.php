<?php
    namespace database; 
    define ('DB_HOST',  ENV['DB_HOST'] );
    define ('DB_PORT',  ENV['DB_PORT'] ); 
    define ('DB_USER',  ENV['DB_USER'] );
    define ('DB_PASS',  ENV['DB_PASS'] );
    define ('DATABASE', ENV['DATABASE'] );
    define ('DSN', 'mysql:host='.DB_HOST.';'
                   .'port='.DB_PORT.';'
                   .'dbname='.DATABASE.';'
                   .'charset=utf8');