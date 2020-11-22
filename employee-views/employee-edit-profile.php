<?php
    //Include the db connect variables
	require_once('../assets/dbLgn.php');

    //Start a session
    session_start();

    //Connect to the DB
	$db = new mysqli('localhost', $serverName, $serverPW, $serverName);

	//Check if the connection failed
	if ($db->connect_error) {
		die ("Connection failed: ".$db->connect_error);
    } 

    //Check to see if the user is logged in/a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0 && $_SESSION["MID"] == NULL)
    {
        //Grab session variables
        $userID = $_SESSION["UID"];

        //Set an error variable based on GET information
        if ($_GET["success"] == 1)
            $errorMsg = "There was an error updating your profile.";
        else if ($_GET["success"] == 2)
            $errorMsg = "Your profile was successfully updated!";
        else
            $errorMsg = "";
            
        //Query DB to grab profile information
        $query = "SELECT FirstName, LastName, Email, PictureURL, ProfileBio 
                    FROM Users WHERE UID = '$userID'";

        //Execute the query
        $results = $db->query($query);

        //If the query returned results (which it should!)
        if ($results->num_rows > 0)
        {
            //Get results in associative array
            $rows = $results->fetch_assoc();

            //Set variables from DB into display variables
            $firstName = $rows["FirstName"];
            $lastName = $rows["LastName"];
            $Email = $rows["Email"];
            $ProfileBio = $rows["ProfileBio"];
            $pictureURL = $rows["PictureURL"];

            //Code to fill in the skills of the employee
            //Set skill array and counter
            global $skill, $skillIDs, $counter;
            $skill = array();
            $skillIDs = array();
            $counter = 0;

            //Get the skills of this employee
            $skillsQuery = "SELECT CPID, CodingLang FROM CPs WHERE UID = '$userID' ORDER BY CPID";

            //Execute query
            $skillsResults = $db->query($skillsQuery);

            if ($skillsResults->num_rows > 0) {
                while ($rows = $skillsResults->fetch_assoc()) {
                    $skill[$counter] = $rows["CodingLang"];
                    $skillIDs[$counter] = $rows["CPID"];
                    $counter++;
                }

                //Fill the array up to 5 if it didn't happen
                //Needed for updating the info
                if (sizeof($skill) != 5)
                {
                    for ($i = $counter; $i < 5; $i++)
                    {
                        $skill[$i] = NULL;
                        $skillIDs[$i] = NULL;
                    }
                }
            }
        } else {
            $errorMsg = "The database did not return results. Please try again!";
        }
    } else {
        //User is not logged in; redirect
        header("Location: ../index.php");
    }

    //Update the information on the page with that is present in the fields
    if ($_SERVER["REQUEST_METHOD"] === 'POST')
    {
        //Process all information for the image
        $target_dir = "../assets/images/";
        $target_file = $target_dir.basename($_FILES["profilePicture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        //Get all of the personal information in the fields
        $fnField = $_POST["firstName"];
        $lnField = $_POST["lastName"];
        $emailField = $_POST["email"];
        $profileField = $_POST["employeeBio"];
        $imageField = $target_file;
        $inputError = "";

        //Check validity of inputs based on DB definitions
        if (strlen($fnField) <= 20 && strlen($lnField) <= 20 && filter_var($emailField, FILTER_VALIDATE_EMAIL)) 
        {
            if ($imageField == "../assets/images/") {
                //Update fields excluding picture URL
                $updateQuery = "UPDATE Users SET FirstName = '".$db->real_escape_string($fnField).
                        "', LastName = '".$db->real_escape_string($lnField).
                        "', Email = '".$db->real_escape_string($emailField).
                        "', ProfileBio = '".$db->real_escape_string($profileField).
                        "' WHERE UID = '$userID'";
            } else {
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
                    if($check !== false) {
                    $uploadOk = 1;
                    } else 
                        $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file))
                    $uploadOk = 0;

                // Check file size
                if ($_FILES["profilePicture"]["size"] > 500000)
                    $uploadOk = 0;

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
                    $uploadOk = 0;

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 1) {
                    move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file);
                        
                    //Update fields with picture file URL
                    $updateQuery = "UPDATE Users SET FirstName = '".$db->real_escape_string($fnField).
                                "', LastName = '".$db->real_escape_string($lnField).
                                "', Email = '".$db->real_escape_string($emailField).
                                "', ProfileBio = '".$db->real_escape_string($profileField).
                                "', PictureURL = '".$db->real_escape_string($imageField).
                                "' WHERE UID = '$userID'";  
                }
            }

            $updateResult = $db->query($updateQuery);

            if ($updateResult === TRUE)
            {
                //Update the skills
                $skillFields = array();

                //Get skill fields
                $skillFields[0] = $_POST["skill1"];
                $skillFields[1] = $_POST["skill2"];
                $skillFields[2] = $_POST["skill3"];
                $skillFields[3] = $_POST["skill4"];
                $skillFields[4] = $_POST["skill5"];
                $skillsError = "";

                //Validate skills
                if (strlen($skillFields[0]) <= 11 && strlen($skillFields[1]) <= 11 && strlen($skillFields[2]) <= 11 && strlen($skillFields[3]) <= 11 && strlen($skillFields[4]) <= 11) {
                    //Loop through each post variable and execute based on 4 cases
                    //Case 1: field was full, field is still full, perform update
                    //Case 2: field was full, field is now empty, delete CP
                    //Case 3: field was empty, field is now full, insert data
                    //Case 4: field was empty, field is still empty, do nothing
                    for ($j = 0; $j < 5; $j++)
                    {
                        //Initialize query variable to be empty
                        $updateSkillQuery = "";

                        //C4; no need to do checks if the fields are both empty
                        if (empty($skill[$j]) == true && empty($skillFields[$j]) == true)
                            continue;
                        //C1: update
                        else if (empty($skill[$j]) == false && empty($skillFields[$j]) == false)
                            $updateSkillQuery = "UPDATE CPs SET CodingLang = '".$db->real_escape_string($skillFields[$j])."' WHERE CPID = '$skillIDs[$j]'";
                        //C2: delete
                        else if (empty($skill[$j]) == false && empty($skillFields[$j]) == true)
                            $updateSkillQuery = "DELETE FROM CPs WHERE CPID = '".$db->real_escape_string($skillIDs[$j])."'";
                        //C3: insert
                        else  if (empty($skill[$j]) == true && empty($skillFields[$j]) == false)
                            $updateSkillQuery = "INSERT INTO CPs (UID, CodingLang) VALUES ('$userID', '".$db->real_escape_string($skillFields[$j])."')";
                        
                        //Based on cases, perform query
                        $updateSkillResults = $db->query($updateSkillQuery);

                        //If an error occurs in the database, stop and reload page with error message
                        if ($updateSkillResults === FALSE)
                            header("Location: employee-edit-profile.php?success=1");
                    }
                    
                    //Close the DB connection, send user back to profile-edit page with success condition
                    $db->close();
                    header("Location: employee-edit-profile.php?success=2");
                } else {
                    $skillsError = "Please type a specific coding language into the skills field.";
                }
            } else {
                //Error occured in the database, stop and reload page with error message
                header("Location: employee-edit-profile.php?success=1");
            }
        } else {
            //Issue with incorrect inputs.
            $inputError = "Please provide valid input for the fields on this page.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Profile</title>
    <script type="text/javascript" src="../javascript/editUserValidation.js"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/helper.css">
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="domain-container">

            <nav>
                <ul>
                    <li>
                        <form align="right" name="form1" method="post" action="../logout.php">
                            <input class="logout-button" name="submit2" type="submit" id="submit2" value="Logout" >
                        </form>
                    </li>
                    <li><a href="employee-all-employees.php">See All Employees</a></li>
                    <li><a href="employee-edit-profile.php">Edit Profile</a></li>
                    <li><a href="employee-landing.php">Home</a></li>
                </ul>
            </nav>

			<div class="edit-profile-card-container">

                <header>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="<?=$pictureURL?>" alt="<?=$firstName?>" width="100px" height="100px">
                                </td>
                                <td>
                                    <h2>Edit Profile</h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>
                
                <article>
                    <p class="generic-php-error"><?=$errorMsg?></p>
                    <p class="generic-php-error"><?=$inputError?></p>
                    <p class="generic-php-error"><?=$skillsError?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" id="submitForm">
                        <div>
                            <table>
                                <tr>
                                    <td>Profile Picture: </td><td> <input type="file" name="profilePicture" id="profilePicture" class="custom-file-input" enctype="multipart/form-data"/><p class="generic-php-error"><?=$uploadError?></p></td><td>Bio: </td><td> <textarea name="employeeBio" id="employeeBio" cols="30" rows="10"><?php echo $ProfileBio; ?></textarea></td>
                                </tr> 

                                <tr>
                                    <td></td><td id="profilePictureError" class="generic-php-error"></td>
                                </tr>
                            </table>
                        </div>

                        <div>
                            <table id="createUserTable">
                                <tbody>
                                    <tr>
                                        <td>First Name: </td><td> <input type="text" name="firstName" size="30" class="text-input" value="<?php echo $firstName; ?>"/></td>
                                        <td>Last Name: </td><td> <input type="text" name="lastName" size="30" class="text-input" value="<?php echo $lastName; ?>"/></td>
                                    </tr>

                                    <tr>
                                        <td></td><td id="firstNameError" class="generic-php-error"></td>
                                        <td></td><td id="lastNameError" class="generic-php-error"></td>
                                    </tr>
        
                                    <tr>
                                        <td>Email: </td><td> <input type="text" name="email" size="30" class="text-input" value="<?php echo $Email; ?>"/></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td><td id="emailError" class="generic-php-error"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="skills-container" style="margin-top: -22px">
                            <table>
                                <tr>
                                    <td>Skills: </td><td> <input type="text" name="skill1" size="30" class="text-input" value="<?php echo $skill[0]; ?>"/></td>
                                    <td></td><td> <input type="text" name="skill2" size="30" class="text-input" value="<?php echo $skill[1]; ?>"/></td><br>
                                </tr>

                                <tr>
                                    <td></td><td id="skill1Error" class="generic-php-error"></td>
                                    <td></td><td id="skill2Error" class="generic-php-error"></td>
                                </tr>
                        
                                <tr>
                                    <td></td><td> <input type="text" name="skill3" size="30" class="text-input" value="<?php echo $skill[2]; ?>"/></td>
                                    <td></td><td> <input type="text" name="skill4" size="30" class="text-input" value="<?php echo $skill[3]; ?>"/></td>
                                </tr>

                                <tr>
                                    <td></td><td id="skill3Error" class="generic-php-error"></td>
                                    <td></td><td id="skill4Error" class="generic-php-error"></td>
                                </tr>

                                <tr>
                                    <td></td><td> <input type="text" name="skill5" size="30" class="text-input" value="<?php echo $skill[4]; ?>"/></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td></td><td id="skill5Error" class="generic-php-error"></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="submit-button-container">
                            <p>
                                <button type="submit" name="submit" id="submit" class="submit-button" style="float: right;">Submit</button> 
                            </p>
                        </div>
                    </form>
                </article>	
			</div>
		</div>
	</div>

</body>
<script type="text/javascript" src="../javascript/editUserValidationR.js"></script>
</html>