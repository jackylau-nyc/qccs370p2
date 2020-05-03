<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class MapLink extends BaseLink {
    
function getHotels(){
        $sql = "SELECT  company, x_cord, y_cord
        FROM    hotel";
        $result = $this->query($sql, []);        
        return (is_null($result))? false : $result;
    }

}