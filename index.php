<?php 
	//Include the db connect variables
	require_once('assets/dbLgn.php');

	//Start a session
	session_start();

    //Check if the user is logged in, if so send them to their landing page based on emp/manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0) {
        if ($_SESSION["MID"] != NULL)
            header("Location: manager-views/manager-landing.php");
        else 
            header("Location: employee-views/employee-landing.php");
    } else {
        //Grab the information from the fields, set error message variable
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $errorMsg = $usrError = $pwdError = "";
		
		//If the form was submitted from the login page, do the following
		if ($_SERVER["REQUEST_METHOD"] === 'POST') {
			//Validate the information from the fields
			if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
				$usrError = "Please provide a valid username";
			} else if (strlen($password) < 8 || !preg_match("/[A-Z]+/", $password) || !preg_match("/\W+/", $password)) {
				$pwdError = "Please provide a valid password";
			} else {
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

					//Fill session variables
					$_SESSION["UID"] = $row["UID"];
					$_SESSION["MID"] = $row["managerID"];

					//Send the user to their landing page
					if ($_SESSION["MID"] != NULL)
						header("Location: manager-views/manager-landing.php");
					else
						header("Location: employee-views/employee-landing.php");
				} else {
					$errorMsg = "Invalid Login";
				}
				
				//Close the connection
				$db->close();
			}
		}
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/helper.css">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="domain-container">
			<div class="login-container">
				<div class="login-pic js-tilt" data-tilt>
					<img src="assets/images/Logo.png" alt="Company Logo">
				</div>

				<form class="login-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<span class="login-form-title">
						Member Login
					</span>
					<p class="login-error"><?=$errorMsg?></p>

					<div class="login-input-container">
						<input class="login-input" type="text" name="email" placeholder="Email">
						<p class="login-error"><?=$usrError?></p>
					</div>

					<div class="login-input-container">
						<input class="login-input" type="password" name="pass" placeholder="Password">
						<p class="login-error"><?=$pwdError?></p> 
					</div>
					
					<div class="container-login-form-button">
						<button class="login-form-button" type="submit">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-136">
						<a class="txt1">
							Created by Devonian Software Development Ltd.
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>