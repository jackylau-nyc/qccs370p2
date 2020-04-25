<?php
    require 'db-credentials.php';

    class DBLink {

        private function openConnection() {
            $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DATABASE, DB_PORT);
             if ($connection->connect_error) { 
                die('Connect Error (' . $connection->connect_errno . ') '. $connection->connect_error);
            }
            return $connection;            
        }

        private function query($sql){
            $connection = $this->openConnection();
            $result = mysqli_query($connection, $sql);
           
            if(!$this->validResult($result)){
                echo "No record found!";
                exit;    
            }
            $results = array();
            while ($row = mysqli_fetch_assoc($result)){
                $results[] = $row;
            }
            $connection -> close(); 
            return $results;      
        }

        private function validResult($result){
            return (mysqli_num_rows($result) == 0) ? false : true;  
        }
        
        function printConnectionProperties(){
            $connection = $this->openConnection();
            echo "<pre>" . print_r( $connection, true ). "</pre>"; 
            $connection -> close();
        }


    }
    
    

?>

 