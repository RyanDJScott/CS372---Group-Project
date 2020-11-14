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
            
        
    }
?>