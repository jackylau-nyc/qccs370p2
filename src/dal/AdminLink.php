<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class AdminLink extends BaseLink {

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

        // to-do
        function addRoom(){ // Add 1 room to a given hotel 

        }
        function addRooms(){ // Add n rooms to a given hotel for a given class 

    }
}

