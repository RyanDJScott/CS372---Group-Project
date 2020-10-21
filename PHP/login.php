<? php 
    //Include the db connect variables
    include 'PHP/dbLgn.php';

    //Grab the information from the fields, set error message variable
    $email = $_POST[email];
    $password = $_POST[pass];
    $errorMsg = "";

    //Connect to the DB
    $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

    //Check if the connection failed
    if ($db->connect_error) {
        die ("Connection failed: ".$db->connect_error);
    } 

    //Query the db for the login credentials
    $query = "SELECT UID, managerID FROM Users WHERE Email = '$email' AND Password = '$password'";

    //Execute the query
    $results = $db->query($query);

    if ($results->num_rows > 0) {
        //Get the results as an associative array
        $row = $results->fetch_assoc();

        //Start a session
        session_start();

        //Fill session variables
        $_SESSION[UID] = $row[UID];
        $_SESSION[MID] = $row[managerID];

        //Send the user to their landing page
        if ($_SESSION[MID] != NULL)
            header(Location: manager-views/manager-landing.php);
        else
            header(Location: employee-landing.php);
    } else {
        $errorMsg = "Your username/password combination is incorrect. Please try again!";
        header(Location: index.php);
    }
?>