<?php
    //Start a session
    session_start();

    //Check if the user is logged in as a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0) {
        if (isset($_SESSION["MID"]) && $_SESSION["MID"] != NULL) {
            //Sent by the GET method; grab project ID
            $projectID = $_GET["PID"];

            //Redirect to the edit profile page with this PID
            header("Location: manager-edit-project.php?PID=".$projectID."");
        } else {
            //Employee trying to get into manager pages, redirect to home page
            header("Location: ../employee-views/employee-landing.php");
        }
    } else {
        //User is not logged in, redirect to login page
        header("Location: ../index.php");
    }



?>