<?php 

require "../database/db-connection.php";
// Start the session
session_start();

if(isValidRequest()){

    $username = $_POST["username"];
    $passwd   = $_POST["password"];
    $conn     = openConnection();
    $verified = attemptSignIn($username, $passwd, $conn);
    if ($verified){
        generateSuccessPage();
    }
    else{
        generateErrorPage();
    }
}
    
    function attemptSignIn($conn, $username, $passwd){    

        $hashedPasswd   = getUserPassword($conn, $username);
        if ($hashedPasswd){
               // to-do 
        }
        else if( password_verify($passwd,$passwdHash)){
                // to-do
        } 
        return false; 
    }

    function getUserPassword($conn, $username){
        $query = "SELECT passwd 
                  FROM   customer 
                  WHERE  username='$username'";
        $result = mysqli_query($conn, $query);
        if (!empty($result)) { 
            return mysqli_fetch_assoc($result)["passwd"];
        }
        die ("Query Error: Unable to get player password");
    }
    
    function isValidRequest(){
        if (! filter_has_var(INPUT_POST, 'username')) {
            echo 'You must enter your Username!.';
            return false; 
         }
         else if (! filter_has_var(INPUT_POST, 'password')) {
            echo 'You must enter your Password!.';
            return false; 
         } 
         
        return isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']);
    }

    function generateSuccessPage(){

    }
    function generateErrorPage(){

    }
?>
