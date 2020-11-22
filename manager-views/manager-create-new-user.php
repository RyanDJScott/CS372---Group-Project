<?php
    //Get db connect variables
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Check session variables for log in credentials
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0) {
        if (isset($_SESSION["MID"]) && $_SESSION["MID"] != NULL) {
            //See if this is a reload with success; print a message if so
            if ($_GET["success"] == 1)
                $errorMsg = "User was successfully added to the database!";

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                //Get all of the information out of the fields
                //Image file name, if present
                $target_dir = "../assets/images/";
                $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $uploadError = "";

                //Radio button selection, set managerID based on this selection
                $employeeType = $_POST["userType"];
                $managerID = $_POST["managerId"];

                //Firstname, Lastname, Email, Password, set pictureURL
                $firstName = trim($_POST["firstName"]);
                $lastName = trim($_POST["lastName"]);
                $email = trim($_POST["email"]);
                $password = trim($_POST["password"]);
                
                if ($target_file == "../assets/images/")
                    $pictureURL = "../assets/images/emptypic.png";
                else
                    $pictureURL = $target_file;

                //Skills, put in array
                $skills = array();
                $skills[0] = trim($_POST["skill1"]);
                $skills[1] = trim($_POST["skill2"]);
                $skills[2] = trim($_POST["skill3"]);
                $skills[3] = trim($_POST["skill4"]);
                $skills[4] = trim($_POST["skill5"]);
                
                //Set an error message variable
                $errorMsg = "";

                //Check the validity of the user inputs; set an error message if invalid
                if ( (($employeeType == "userTypeManager" && $managerID != "") || ($employeeType == "userTypeEmployee" && $managerID == "")) &&
                    ($firstName != NULL && strlen($firstName) <= 20) && 
                    ($lastName != NULL && strlen($lastName) <= 20) &&
                    ((filter_var($email, FILTER_VALIDATE_EMAIL))) && 
                    ($password != NULL && (strlen($password) > 8 && preg_match("/[A-Z]+/", $password) && preg_match("/\W+/", $password))))
                    {
                        //Set boolean flag for checking skills
                        $skillsValid = true;

                        //Check the validity of the skills; set an error message if invalid
                        for ($i = 0; $i < 5; $i++)
                        {
                            if ($skills[$i] != NULL && strlen($skills[$i]) > 11) {
                                $skillsValid = false;
                            }
                        }

                        if ($skillsValid == true) {
                            //Connect to the DB and insert all the values
                            $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

                            //Check if the connection failed
				            if ($db->connect_error) {
					            die ("Connection failed: ".$db->connect_error);
                            }
                             
                            //Upload the image if there is an actual image to upload
                            if ($pictureURL != "../assets/images/emptypic.png") {
                                // Check if image file is a actual image or fake image
                                if(isset($_POST["submit"])) {
                                    $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
                                        if($check !== false) {
                                            $uploadOk = 1;
                                        } else {
                                            $uploadError = "File is not an image.";
                                            $uploadOk = 0;
                                        }
                                    }
                                
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $uploadError = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                
                                // Check file size
                                if ($_FILES["profilePicture"]["size"] > 500000) {
                                    $uploadError = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }
                                
                                // Allow certain file formats
                                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                                    $uploadError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                
                                // Check if $uploadOk is 1, attempt to upload the file. Set flag to 0 if fails.
                                if ($uploadOK = 1) {
                                    if (!(move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file))) {
                                        $uploadOk = 0;
                                    }
                                }
                            }

                            //If the upload worked, or was skipped, continue with the rest of the insertions.
                            if ($uploadOk == 1) {

                                if (is_null($managerID)) {
                                    //Insert the new user into the DB, upload the avatar if they have one
                                    $insertUserQuery = "INSERT INTO Users (FirstName, LastName, Email, Password, PictureURL)
                                    VALUES ('".$db->real_escape_string($firstName).
                                    "', '".$db->real_escape_string($lastName).
                                    "', '".$db->real_escape_string($email).
                                    "', '".$db->real_escape_string($password).
                                    "', '".$db->real_escape_string($pictureURL).
                                    "')";
                                } else {
                                    //Insert the new user into the DB, upload the avatar if they have one
                                    $insertUserQuery = "INSERT INTO Users (FirstName, LastName, Email, Password, PictureURL, managerID)
                                    VALUES ('".$db->real_escape_string($firstName).
                                    "', '".$db->real_escape_string($lastName).
                                    "', '".$db->real_escape_string($email).
                                    "', '".$db->real_escape_string($password).
                                    "', '".$db->real_escape_string($pictureURL).
                                    "', ".$db->real_escape_string($managerID).")";
                                }

                                $insertResults = $db->query($insertUserQuery);

                                //If the insert worked; get the UID of the user for inserting skills
                                if ($insertResults == true) {
                                    $getUIDQuery = "SELECT UID FROM Users WHERE Email = '".$db->real_escape_string($email)."'";

                                    $getUID = $db->query($getUIDQuery);

                                    if ($getUID->num_rows > 0) {
                                        $rows = $getUID->fetch_assoc();

                                        $UID = $rows["UID"];

                                        //Insert the skills
                                        for ($i = 0; $i < 5; $i++)
                                        {
                                            if ($skills[$i] != NULL) {
                                                $insertSkillQuery = "INSERT INTO CPs (UID, CodingLang) 
                                                                    VALUES (".$db->real_escape_string($UID).", '".$db->real_escape_string($skills[$i])."')";

                                                $skillResults = $db->query($insertSkillQuery);

                                                //If there is an error inserting the data, get the error message and break
                                                if ($skillResults = false) {
                                                    $errorMsg = "There was an error inserting a skill. Please try again.";
                                                    break;
                                                }
                                            }
                                        }

                                        //All insertions were performed correctly, close db
                                        $db->close();
                                        header("Location: manager-create-new-user.php?success=1");

                                    } else {
                                        $errorMsg = "There was an error fetching user information from the database. Please try again.";
                                    }
                                } else {
                                    $errorMsg = "There was an error inserting the user into the database. Please try again.";
                                }
                            } else {
                                $errorMsg = "There was an issue uploading your profile picture. Please try again.";
                            }
                        } else {
                            $errorMsg = "Please enter valid input into the skill fields.";
                        }
                    } else 
                        $errorMsg = "Please provide valid input into the fields below.";    
            }
        } else {
            //employee trying to get into manager page; redirect to employee landing
            header("Location: ../employee-views/employee-landing.php");
        }
    } else {
        //User is not logged in, return them to the login page
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create New User</title>
    <script type="text/javascript" src="../javascript/createUserValidation.js"></script>
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
                    <li><a href="manager-all-employees.php">See All Employees</a></li>
                    <li><a href="manager-edit-profile.php">Edit Profile</a></li>
                    <li><a href="manager-create-new-project.php">Create New Project</a></li>
                    <li><a href="manager-create-new-user.php">Create New User</a></li>
                    <li><a href="manager-landing.php">Home</a></li>
                </ul>

                
            </nav>

			<div class="create-new-user-card-container">
                <header>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <h2>Create New User</h2>
                                    <p class="generic-php-error"><?=$errorMsg?></p>
                                    <p class="generic-php-error"><?=$uploadError?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>
                
                <article>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" id="submitForm">
                        <div>
                            <table id="createUserTable">
                                <tbody>
                                    <tr>
                                        <td>Profile Picture: </td><td> <input type="file" name="profilePicture" class="custom-file-input" /></td>
                                    </tr> 

                                    <tr>
                                        <td></td><td id="profilePictureError" class="generic-php-error"></td>
                                    </tr>
        
                                    <tr>
                                        <td>
                                            <label id="userType">User Type:</label>
                                        </td>
                                        
                                        <td>
                                            <input type="radio" id="userTypeManager" name="userType" value="userTypeManager">
                                            <label for="userTypeManager">&nbsp;Manager</label>&nbsp;&nbsp;
                                            <input type="radio" id="userTypeEmployee" name="userType" value="userTypeEmployee">
                                            <label for="userTypeEmployee">&nbsp;Employee</label>
                                        </td>
                                        
                                        <td>Manager ID: </td><td> <input type="text" name="managerId" size="20" class="text-input" id="managerId" disabled="disabled" /></td>
                                    </tr>

                                    <tr>
                                        <td></td><td id="radioError" class="generic-php-error"></td>
                                        <td></td><td id="managerIdError" class="generic-php-error"></td>
                                    </tr>
        
                                    <tr>
                                        <td>First Name: </td><td> <input type="text" name="firstName" size="30" class="text-input" /></td>
                                        <td>Last Name: </td><td> <input type="text" name="lastName" size="30" class="text-input"/></td>
                                    </tr>

                                    <tr>
                                        <td></td><td id="firstNameError" class="generic-php-error"></td>
                                        <td></td><td id="lastNameError" class="generic-php-error"></td>
                                    </tr>
        
                                    <tr>
                                        <td>Email: </td><td> <input type="text" name="email" size="30" class="text-input"/></td>
                                        <td>Password: </td><td> <input type="password" name="password" size="30" class="text-input"/></td>
                                    </tr>

                                    <tr>
                                        <td></td><td id="emailError" class="generic-php-error"></td>
                                        <td></td><td id="passwordError" class="generic-php-error"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="skills-container" style="margin-top: -22px";>
                            <table>
                                <tr>
                                    <td>Skills: </td><td> <input type="text" name="skill1" size="30" class="text-input"/></td>
                                    <td></td><td> <input type="text" name="skill2" size="30" class="text-input"/></td><br>
                                </tr>

                                <tr>
                                    <td></td><td id="skill1Error" class="generic-php-error"></td>
                                    <td></td><td id="skill2Error" class="generic-php-error"></td>
                                </tr>
                        
                                <tr>
                                    <td></td><td> <input type="text" name="skill3" size="30" class="text-input"/></td>
                                    <td></td><td> <input type="text" name="skill4" size="30" class="text-input"/></td>
                                </tr>

                                <tr>
                                    <td></td><td id="skill3Error" class="generic-php-error"></td>
                                    <td></td><td id="skill4Error" class="generic-php-error"></td>
                                </tr>

                                <tr>
                                    <td></td><td> <input type="text" name="skill5" size="30" class="text-input"/></td>
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
<script type="text/javascript" src="../javascript/createUserValidationR.js"></script>
</html>