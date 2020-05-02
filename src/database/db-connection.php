<?php
    namespace database;
    use PDO; 
    // if(file_exists('db-credentials.php')){
    //     require_once 'db-credentials.php';
    // } else {
    //     require_once 'db-prod.php';
    // }
    require_once __DIR__.'/db-credentials.php';    
class DBLink {

    private function openConnection() {
        try{
            $connection = new PDO(DSN, DB_USER, DB_PASS);
          
        } catch(PDOException $e){
            $connection = null; 
            print "Error!: " . $e->getMessage();
            die();
        }
        return $connection;            
    }

    private function query($sql, $params){
        $connection = $this->openConnection();
        $result     = $connection->prepare($sql);
        $connection = null;
        $result->execute($params);

        if(!$this->validResult($result)){
            return null;    
        }
        $results = $result->fetchALL(PDO::FETCH_ASSOC);
        $result  = null; 
        return  $results;  
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
    function findAccount($username){
        $sql = "SELECT 1
                FROM  customer 
                WHERE username=?";
        $result = $this->query($sql, array($username));
        return (is_null($result))? false : true;
    }

    function createAccount($username, $passwd){
        $sql = "INSERT 
                INTO customer (username, passwd)
                VALUES (?, ?)";
        $params = array($username, $passwd);
        $result = $this->query($sql, $params);
        return (is_null($result))? false: true ;
    }

    function createCompany($companyName){
        $sql = "INSERT 
                INTO company (company_name)
                VALUES (?)";
        $result = $this->query($sql, array($companyName));
        return (is_null($result))? false : true;
    }

    function addHotel($companyName, $hotelXCord, $hotelYCord){
        $sql = "INSERT 
                INTO hotel (x_cord, y_cord, company)
                VALUES (?,?,?)";
        $params = array ($hotelXCord, $hotelYCord, $companyName);
        $result = $this->query($sql, $params);
        return (is_null($result))? false : true;
    }
    function findCompany($hotelXCord, $hotelYCord){
        $sql = "SELECT  hotel.company
                FROM    hotel
                WHERE   hotel.x_cord = ? AND hotel.y_cord = ?";
        $params = array ($hotelXCord, $hotelYCord);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : true;
    }


    function getroom($price,$type,$hotel){

        
        $sql = "SELECT  *
                FROM  room inner join hotel on room.x_cord= hotel.x_cord and room.y_cord= hotel.y_cord and room.class = '$type' and hotel.company='$hotel'
                and room.price between $price";   
        $result = $this->query($sql,array());
        
        return (is_null($result))? false : $result;
        
       
 
    }

    
    // to-do
    function addRoom(){ // Add 1 room to a given hotel 

    }
    function addRooms(){ // Add n rooms to a given hotel for a given class  

    }
    function findAllRooms(){

    }
    function findRoomsLT(){

    }
    function findRoomsGT(){

    }
    function findRoomsEQ(){
        
    }
    function getHotels(){

    }
    function createRes(){

    }
    function findActiveRes(){

    }
    function cancelRes(){
        
    }
  
} // class
