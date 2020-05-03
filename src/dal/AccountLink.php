<?php 

namespace dal;
require_once __DIR__."/BaseLink.php";


class AccountLink extends BaseLink {
    
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

}
