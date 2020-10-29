<?php 
    //start a session
    session_start();

    //Unset all session variables
    $_SESSION = array();
    
    //Destroy all session variables
    session_destroy();

    //Send the user back to the home page
    header("Location: index.php");

    //Exit the logout script
    exit();
?>