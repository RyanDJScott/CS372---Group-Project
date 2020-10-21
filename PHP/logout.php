<? php 
    //start a session
    session_start();

    //Destroy all session variables
    session_destroy();

    //Send the user back to the home page
    header(Location: index.php);

    //Exit the logout script
    exit();
?>