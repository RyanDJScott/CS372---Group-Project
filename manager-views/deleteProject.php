<?php
    //Include DB login creds
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    var_dump($_SESSION);

    //Check if the user is logged in as a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0) {
        if (isset($_SESSION["MID"]) && $_SESSION["MID"] != NULL) {
            //Sent by the POST method; grab project ID
            $projectID = $_POST["PID"];

            //Connect the db, and test the connection
            $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

            //Check if the connection failed
            if ($db->connect_error) {
                die ("Connection failed: ".$db->connect_error);
            } 

            //Delete the project from the projects table; should cascade downwards
            $deleteQuery = "DELETE FROM Projects WHERE PID = '$projectID'";

            //Execute the query
            $result = $db->query($deleteQuery);

            //Close the db connection
            $db->close();
            
            //Redirect back to the manager page with success/failure flag
            if ($result == true) 
                header("Location: manager-landing.php?success=1");
            else 
                header("Location: manager-landing.php?success=2");
        } else {
            //Employee trying to get into manager pages, redirect to home page
            header("Location: ../employee-views/employee-landing.php");
        }
    } else {
        //User is not logged in, redirect to login page
        header("Location: ../index.php");
    }

    //Exit script
    exit();
?>