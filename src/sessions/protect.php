<?php 

if ( isset( $_SESSION['username'] ) ) {
    // To-Do add authentication 
} else {
    // Redirect them to the login page
    header(__DIR__."/");
}