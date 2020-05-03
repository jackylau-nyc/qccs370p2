<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class SearchLink extends BaseLink {

    function getroom($price,$type,$hotel){
        
        $sql = "SELECT  *
                FROM  room inner join hotel on room.x_cord= hotel.x_cord and room.y_cord= hotel.y_cord and room.class = '$type' and hotel.company='$hotel'
                and room.price between $price";   
        $result = $this->query($sql,array());
        
        return (is_null($result))? false : $result;
        
    }

}