<?php
    //Get the database credentials
    require_once("../assets/dbLgn.php");

    //Connect to the database
    $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

    //Check if the connection failed
    if ($db->connect_error) {
        die ("Connection failed: ".$db->connect_error);
    }

    //Get the variable from the get method
    $memberName = trim(strtolower($_GET["MemberName"]));

    //Build query based on their first name
    $findUser = "SELECT FirstName, LastName FROM Users WHERE FirstName LIKE '".$db->real_escape_string($userName[0])."%' LIMIT 1";
    
    //Execute query, build empty JSON array
    $results = $db->query($findUser);
    $jsonArray = array();

    //If there are results, iterate over them and insert them into the JSON array
    if ($results->num_rows > 0)
    {
        while ($rows = $results->fetch_assoc())
        {
            $jsonArray[] = $rows;
        }
    }

    //Encode the JSON array
    print(json_encode($jsonArray));

    //Close the DB connection
    $db->close();
?>