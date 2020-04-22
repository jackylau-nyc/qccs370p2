<?php
    require 'db-credentials.php';

    function openConnection() {
        $connection = new mysqli($dbHost, $dbUser, $dbPass,$dbInstance, $port);
        if ($connection->connect_error) {
            echo "code red"; 
            die('Connect Error (' . $connection->connect_errno . ') '. $connection->connect_error);
        }
        return $connection;
    }
    
    function closeConnection($conn) {
        $conn -> close();
    }

    function testConnection($conn){
        // to-do
    }
    
    function printConnectionProperties($conn){
        echo "<pre>" . print_r( $conn, true ). "</pre>"; 
    }

?>
   
