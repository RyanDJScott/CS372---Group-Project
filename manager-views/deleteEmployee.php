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

        //Build first delete query
        $deleteQuery1 = "DELETE FROM Users WHERE UID = '$userID'";
    
        //Execute query
        $result1 = $db->query($deleteQuery1);

        //If first query succeeded
        if ($result1 == true)
        {  
            //Build second delete query
            $deleteQuery2 = "DELETE FROM CPs WHERE UID = '$userID'";

            //Execute Query
            $result2 = $db->query($deleteQuery2);

            //Close DB connection
            $db->close();
            
            //Redirect user based on results.
            if ($result2 == true)
                header("Location: manager-all-employees.php?success=1");
            else    
                header("Location: manager-all-employees.php?success=2");
        } else {
            header("Location: manager-all-employees.php?success=2");
        }
    }
?>