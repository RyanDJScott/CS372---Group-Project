<?php
    //Get the database credentials
    require_once("../assets/dbLgn.php");

    //Connect to the database
    $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

	//Check if the connection failed
	if ($db->connect_error) {
		die ("Connection failed: ".$db->connect_error);
	}

    //Get the variable from the GET method
    $codingLang = strtolower($_GET["CodingLang"]);

    //Build query to get all information necessary
    $query = "SELECT Users.UID, Users.FirstName, Users.LastName, Users.ProfileBio, Users.Email, Users.managerId, CPs.CodingLang
            FROM Users INNER JOIN CPs ON (Users.UID = CPs.UID)
            WHERE CPs.CodingLang LIKE '$codingLang%' ORDER BY UID";

    //Execute query, create empty JSON array
    $result = $db->query($query);
    $jsonArray = array();

    //If results are returned, fill the JSON array with them
    if ($result->num_rows > 0)
    {
        while ($rows = $result->fetch_assoc())
        {
            $jsonArray[] = $rows;
        }
    }

    //Encode JSON array
    print(json_encode($jsonArray));

    //Close DB
    $db->close();
?>