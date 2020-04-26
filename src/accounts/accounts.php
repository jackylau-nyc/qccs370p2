<?php


    
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




?>