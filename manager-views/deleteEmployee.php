<?php
    //Check if the get method was called
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //Connect to the database
        $db = new mysqli('localhost', $serverName, $serverPW, $serverName);
            
		//Check if the connection failed
		if ($db->connect_error) {
			die ("Connection failed: ".$db->connect_error);
        }
            
        //Grab user ID from GET method
        $userID = $_GET["UID"];

        //Build delete query
        $deleteQuery = "DELETE FROM Users WHERE UID = '$userID'";

        //Execute query
        $result = $db->query($deleteQuery);

        //Close DB connection
        $db->close();

        //If successful, redirect to the employee page with message
        if ($result == true)
            header("Location: manager-all-employees.php?success=1");
        else
            header("Location: manager-all-employees.php?success=2");
    }
?>