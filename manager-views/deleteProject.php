<?php
    //Include DB login creds
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

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

            //Set error flag
            $error = false;

            //Start a cascading delete for this project
            //Delete the project from the projects table
            $deleteProject = "DELETE FROM Projects WHERE PID = '$projectID'";

            //Execute the query
            $projectResult = $db->query($deleteProject);

            //If the project was successfully deleted, delete the project members
            if ($projectResult == true)
            {
                //Delete all of the members from this project in ProjectTeams
                $deleteMembers = "DELETE FROM ProjectTeams WHERE PID = '$projectID'";

                //Execute query
                $memberResult = $db->query($deleteMembers);

                //If the team members were deleted, delete the tasks
                if ($memberResult == true)
                {
                    //Delete all of the tasks associated with this PID
                    $deleteTasks = "DELETE FROM Tasks WHERE PID = '$projectID'";

                    //Execute the query
                    $taskResult = $db->query($deleteTasks);

                    //Set error flag if something happened
                    if ($taskResult == false)
                        $error = true;
                } else {
                    $error = true;
                }

            } else {
                $error = true;
            }
            //Close the db connection
            $db->close();
            
            //Redirect back to the manager page with success/failure flag
            if ($error == false) 
                header("Location: manager-landing.php?success=1");
            else if ($error == true)
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