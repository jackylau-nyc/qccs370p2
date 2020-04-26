<?php

require_once 'db-credentials.php';

class DBLink {

    private function openConnection() {
        try{
            $connection = new PDO(DSN, DB_USER, DB_PASS);
        } catch(PDOException $e){
            $connection = null; 
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $connection;            
    }

    private function query($sql, $params){

        $connection = $this->openConnection();
        $result     = $connection->prepare($sql);
        $result->execute($params);
        
        if(!$this->validResult($result)){
            echo "No record found!";
            return null;    
        }
        return  $result->fetchALL(PDO::FETCH_ASSOC);  
    }

    private function validResult($result){
        return ($result->rowCount() > 0);  
    }

    /****************************************************************************************************
     ********************************************** Queries *********************************************
     ****************************************************************************************************/


    function getCustomerPassword($username){
        $sql = "SELECT passwd 
                FROM   customer 
                WHERE  username=?";
        $result = $this->query($sql, array($username));
        return (is_null($result)) ? null : $result[0]["passwd"];
    }

    function getAdminPassword($username){
        $sql = "SELECT passwd 
                FROM   admin
                WHERE  username=?";
        $result = $this->query($sql, array($username));
        return (is_null($result))? null : $result[0]["passwd"];
    }
        
} // class
    
