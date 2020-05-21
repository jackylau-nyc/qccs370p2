<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class SearchLink extends BaseLink {

    function getroom($price,$type,$hotel){
        
        $sql = "SELECT  *
                FROM  room inner join hotel on room.x_cord= hotel.x_cord and room.y_cord= hotel.y_cord and room.class = '$type' and hotel.company='$hotel'
                and   room.price between $price";   
        $result = $this->query($sql,array());
        
        return (is_null($result))? false : $result;
    }
        
    /**
     * Search based on a company name. 
     * Return all hotels that belong to a particular company.
     */
    function findHotelsByCompany($term){
        $sql = "SELECT * from hotel  
                WHERE hotel.company LIKE CONCAT('%', ?, '%');";
        $params = array ($term);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;     
    }

    function findRoomsGT($price, $date){
        $sql = "SELECT class, count(class) as size, x_cord ,y_cord, price
                FROM  room 
                WHERE room.room_num 
                    NOT IN ( SELECT room.room_num 
                             FROM room 
                             INNER JOIN room_has_reservation
                                ON room.x_cord  = room_has_reservation.x_cord  
                                AND room.y_cord = room_has_reservation.y_cord
                                AND room_has_reservation.room_num =  room.room_num 
                             INNER JOIN reservation
                                ON  reservation.res_id = room_has_reservation.res_id
                                AND  ? 
                                BETWEEN  reservation.res_start AND reservation.res_end)
                AND room.price > ?
                GROUP BY room.class";
        $params = array ($date, $price);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }


    function findRoomsLT($price, $date){
        $sql = "SELECT class, count(class) as size, x_cord ,y_cord, price
                FROM  room 
                WHERE room.room_num 
                    NOT IN ( SELECT room.room_num 
                             FROM room 
                             INNER JOIN room_has_reservation
                                ON room.x_cord = room_has_reservation.x_cord  
                                AND room.y_cord = room_has_reservation.y_cord
                                AND room_has_reservation.room_num =  room.room_num 
                             INNER JOIN reservation
                                ON  reservation.res_id = room_has_reservation.res_id
                                AND  ?  
                                BETWEEN  reservation.res_start AND reservation.res_end)
                AND room.price < ?
                GROUP BY room.class";
        $params = array ($date, $price);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    function findRoomsLE($price, $date){
        $sql = "SELECT class, count(class) as size, x_cord ,y_cord, price
                FROM  room 
                WHERE room.room_num 
                    NOT IN ( SELECT room.room_num 
                             FROM room 
                             INNER JOIN room_has_reservation
                                ON room.x_cord = room_has_reservation.x_cord  
                                AND room.y_cord = room_has_reservation.y_cord
                                AND room_has_reservation.room_num =  room.room_num 
                             INNER JOIN reservation
                                ON  reservation.res_id = room_has_reservation.res_id
                                AND  ?  
                                BETWEEN  reservation.res_start AND reservation.res_end)
                AND room.price <= ?
                GROUP BY room.class";
        $params = array ($date, $price);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;                
    }

    
    function findRoomsGE($price, $date){
        $sql = "SELECT class, count(class) as size, x_cord ,y_cord, price
                FROM  room 
                WHERE room.room_num 
                    NOT IN ( SELECT room.room_num 
                             FROM room 
                             INNER JOIN room_has_reservation
                                ON room.x_cord = room_has_reservation.x_cord  
                                AND room.y_cord = room_has_reservation.y_cord
                                AND room_has_reservation.room_num =  room.room_num 
                             INNER JOIN reservation
                                ON  reservation.res_id = room_has_reservation.res_id
                                AND  '2020-01-01'  
                                BETWEEN  reservation.res_start AND reservation.res_end)
                AND room.price <= ?
                GROUP BY room.class";
        $params = array ($date, $price);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    function findRoomsEQ($price, $date){
        $sql = "SELECT class, count(class) as size, x_cord ,y_cord, price
                FROM  room 
                WHERE room.room_num 
                    NOT IN ( SELECT room.room_num 
                             FROM room 
                             INNER JOIN room_has_reservation
                                ON room.x_cord = room_has_reservation.x_cord  
                                AND room.y_cord = room_has_reservation.y_cord
                                AND room_has_reservation.room_num =  room.room_num 
                             INNER JOIN reservation
                                ON  reservation.res_id = room_has_reservation.res_id
                                AND  '2020-01-01'  
                                BETWEEN  reservation.res_start AND reservation.res_end)
                AND room.price = ?
                GROUP BY room.class";
        $params = array ($date, $price);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }

    function findRoomsBetween($minPrice, $maxPrice,  $date){
        $sql = "SELECT class, count(class) as size, x_cord ,y_cord, price
                FROM  room 
                WHERE room.room_num 
                    NOT IN ( SELECT room.room_num 
                             FROM room 
                             INNER JOIN room_has_reservation
                                ON room.x_cord = room_has_reservation.x_cord  
                                AND room.y_cord = room_has_reservation.y_cord
                                AND room_has_reservation.room_num =  room.room_num 
                             INNER JOIN reservation
                                ON  reservation.res_id = room_has_reservation.res_id
                                AND  '2020-01-01'  
                                BETWEEN  reservation.res_start AND reservation.res_end)
                AND (room.price > ? AND room.price < ?)
                GROUP BY room.class";
        $params = array ($date, $price);
        $result = $this->query($sql, $params);        
        return (is_null($result))? false : $result;
    }
}