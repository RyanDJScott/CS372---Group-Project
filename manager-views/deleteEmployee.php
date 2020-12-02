<?php
    //Include DB login creds
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Check if the get method was called
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Connect to the database
        $db = new mysqli('localhost', $serverName, $serverPW, $serverName);
            
		//Check if the connection failed
		if ($db->connect_error) {
			die ("Connection failed: ".$db->connect_error);
        }
            
        //Grab user ID from GET method
        $userID = $_POST["UID"];

        //Delete this user from the Users table
        $deleteQuery1 = "DELETE FROM Users WHERE UID = '$userID'";
    
        //Execute query
        $result1 = $db->query($deleteQuery1);

        //If first query succeeded
        if ($result1 == true)
        {  
            //Delete this User's coding proficencies
            $deleteQuery2 = "DELETE FROM CPs WHERE UID = '$userID'";

            //Execute Query
            $result2 = $db->query($deleteQuery2);

            //If the second query succeeded
            if ($result2 == true)
            {
                //Delete all the tasks this user is associated with
                $deleteQuery3 = "DELETE FROM Tasks WHERE UID = '$userID'";

                //Execute the query
                $result3 = $db->query($deleteQuery3);

                if ($result3 == true)
                {
                    //Delete this user out of all project teams
                    $deleteQuery4 = "DELETE FROM ProjectTeams WHERE UID = '$userID'";

                    //Execute the query
                    $result4 = $db->query($deleteQuery4);

                    if ($result4 == true)
                    {
                        //Send them back to the page with a success message
                        header("Location: manager-all-employees.php?success=1");
                    } else {
                        //Send them back to the page with an error message
                        header("Location: manager-all-employees.php?success=5");
                    }
                } else {
                    //Send them back to the page with an error message
                    header("Location: manager-all-employees.php?success=4");
                }
            } else {
                //Send them back to the page with an error message
                header("Location: manager-all-employees.php?success=3");
            } 
        } else {
            //Send them back to the page with an error message
            header("Location: manager-all-employees.php?success=2");
        }

        //Close the DB
        $db->close();
    }
?>