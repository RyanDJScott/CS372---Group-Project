<?php
    //Get login creds for DB
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Check to see if the user is logged in as a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0)
    {
        if (isset($_SESSION["MID"]) && $_SESSION["MID"] != NULL)
        {
            //If the form is being submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                //Set an error message variable\
                $errorMsg = "";

                //Grab all of the information from the fields for Projects table
                $projectTitle = $_POST["projectTitle"];
                $projectDescription = $_POST["projectDescription"];
                $startDate = $_POST["startDate"];
                $endDate = $_POST["endDate"];

                //Create an array of project memebers
                $projectMembers  = array();
                $memberUIDS = array();
                $projectMembers[] = $_POST["projectMember1"];
                $projectMembers[] = $_POST["projectMember2"];
                $projectMembers[] = $_POST["projectMember3"];
                $projectMembers[] = $_POST["projectMember4"];

                //Create an array of tasks
                $tasks = array();
                $tasks[] = $_POST["projectMember1Task1"];
                $tasks[] = $_POST["projectMember1Task2"];
                $tasks[] = $_POST["projectMember2Task1"];
                $tasks[] = $_POST["projectMember2Task2"];
                $tasks[] = $_POST["projectMember3Task1"];
                $tasks[] = $_POST["projectMember3Task2"];
                $tasks[] = $_POST["projectMember4Task1"];
                $tasks[] = $_POST["projectMember4Task2"];

                //Create an array of deadlines
                $deadlines = array();
                $deadlines[] = $_POST["projectMember1DeadlineTask1"];
                $deadlines[] = $_POST["projectMember1DeadlineTask2"];
                $deadlines[] = $_POST["projectMember2DeadlineTask1"];
                $deadlines[] = $_POST["projectMember2DeadlineTask2"];
                $deadlines[] = $_POST["projectMember3DeadlineTask1"];
                $deadlines[] = $_POST["projectMember3DeadlineTask2"];
                $deadlines[] = $_POST["projectMember4DeadlineTask1"];
                $deadlines[] = $_POST["projectMember4DeadlineTask2"];
                
                //Connect to the DB, check connection
                $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

				//Check if the connection failed
				if ($db->connect_error) {
					die ("Connection failed: ".$db->connect_error);
                } 
                
                //Validate the Projects information
                if (($projectTitle != "" && strlen($projectTitle) <= 50) && ($projectDescription != "" &&  strlen($projectDescription) <= 250) && $startDate != "" && $endDate != "" && ($startDate < $endDate))
                {
                    //Set error flag to false
                    $errorFlag = false;

                    //Add the manager as the first member of the project
                    $memberUIDS[] = $_SESSION["UID"];

                    //Validate project members array by checking if this member exists in the db
                    for ($i = 0; $i < 5; $i++)
                    {
                        if ($projectMembers[$i] != "")
                        {
                            //Break array apart
                            $nameSplit = explode(" ", $projectMembers[$i]);

                            //Build query based on first/last name (ensured by AJAX), but may be tampered with after
                            $memberQuery = "SELECT UID FROM Users WHERE FirstName='".$db->real_escape_string($nameSplit[0])."' AND LastName = '".$db->real_escape_string($nameSplit[1])."'";

                            //Execute query
                            $memberResults = $db->query($memberQuery);

                            //If it comes back empty, stop the loop and set an error flag.
                            //If it has a result; save the result in an array for later insertion.
                            if ($memberResults->num_rows > 0)
                            {
                                $row = $memberResults->fetch_assoc();
                                $memberUIDS[] = $row["UID"];
                            } else {
                                $errorFlag == true;
                                break;
                            }
                        } else {
                            $memberUIDS[] = NULL;
                        }
                    }

                    //If the error flag is still false; continue. Else, stop and print error message
                    if ($errorFlag == false)
                    {
                        //Set task/deadline error flag
                        $tdError = false;

                        //Ensure that each user-task/deadline pair is valid
                        $taskCounter = 0;

                        //Validate the group of user-task-deadline
                        for ($a = 0; $a < sizeof($projectMembers); $a++)
                        {
                            for ($b = 0; $b < 2; $b++)
                            {
                                if ($projectMembers[$a] == "" && ($tasks[$taskCounter] != "" || $deadlines[$taskCounter] != ""))
                                {
                                    $tdError = true;
                                    break;
                                }

                                $taskCounter++;
                            }
                        }
                        //Validate the tasks/deadlines by checking if they're either an empty pair or a non-empty pair, or if they have invalid deadlines
                        for ($j = 0; $j < sizeof($tasks); $j++)
                        {
                            //If you find a task/deadline combo that is empty/full, throw an error
                            //If you find a task/deadline combo that are filled out but have a deadline outside the time frame, throw an error
                            if ((($tasks[$j] != "" && $deadlines[$j] == "") || ($tasks[$j] == "" && $deadlines[$j] != "")) 
                                || (($tasks[$j] != "" && $deadlines[$j] != "") && ($deadlines[$j] < $startDate || $deadlines[$j] > $endDate)))
                            {
                                $tdError = true;
                                break;
                            } 
                        }

                        //Validation complete; insert this data into the database
                        if ($tdError == false)
                        {
                            //Ensure date/times from the picker are in mySql format
                            $startDateInsert = date("Y-m-d", strtotime($startDate));
                            $endDateInsert = date("Y-m-d", strtotime($endDate));
                            
                            //Build insert query for projects
                            $projectInsert = "INSERT INTO Projects (Title, Description, StartDate, EndDate) 
                                                VALUES ('".$db->real_escape_string($projectTitle)."', '".$db->real_escape_string($projectDescription)."', 
                                                '".$db->real_escape_string($startDateInsert)."', '".$db->real_escape_string($endDateInsert)."')";
                            
                            //Execute query
                            $projectResults = $db->query($projectInsert);

                            //If it worked, insert the project team members
                            if ($projectResults == true)
                            {
                                //Get the PID of the inserted project (by title)
                                $getPID = "SELECT PID FROM Projects WHERE Title = '".$db->real_escape_string($projectTitle)."'";

                                //Execute query
                                $getPIDResults = $db->query($getPID);

                                //Grab the result; there has to be one
                                $pidVal = $getPIDResults->fetch_assoc();

                                //Set the PID value for other inserts
                                $PID = $pidVal["PID"];

                                //Set an error flag for member inserts
                                $memberError = false;

                                //Insert project members into the database
                                for ($k = 0; $k < 5; $k++)
                                {
                                    if ($memberUIDS[$k] != NULL)
                                    {
                                        //Build an insert query based on PID/UID 
                                        $insertMember = "INSERT INTO ProjectTeams (PID, UID) VALUES ('$PID', '$memberUIDS[$k]')";

                                        //Execute query
                                        $memberInsertResults = $db->query($insertMember);

                                        //If query fails, set an error flag
                                        if ($memberInsertResults == false)
                                            $memberError == true;
                                    }
                                }

                                //If the team members are all inserted, add their tasks into the db
                                if ($memberError == false)
                                {
                                    //Set a counter to 0
                                    $counter = 0;

                                    //Set an error flag to false
                                    $taskError = false;

                                    //For each member in the member array (except the manager, who is in spot 0), add their tasks
                                    for ($l = 1; $l < 5; $l++)
                                    {
                                        for ($m = 0; $m < 2; $m++)
                                        {
                                            //Check if the user has been assigned a task. If not, skip to the next one.
                                            if ($tasks[$counter] != "" && $deadlines[$counter] != "")
                                            {
                                                //Ensure the deadline is in the correct format before inserting
                                                $deadlineInsert = date("Y-m-d", strtotime($deadlines[$counter]));
                                                
                                                //Build up task query
                                                //Need this current users UID, the same PID, and the two tasks they may have been assigned
                                                $taskQuery = "INSERT INTO Tasks (UID, PID, TDescription, Deadline) 
                                                                VALUES ('$memberUIDS[$l]', '$PID', '".$db->real_escape_string($tasks[$counter])."', 
                                                                '".$db->real_escape_string($deadlineInsert)."')";

                                                $taskResult = $db->query($taskQuery);

                                                if ($taskResult == false)
                                                    $taskError = true;
                                            }
                                            
                                            //Increment the counter
                                            $counter++;
                                        }
                                    }

                                    if ($taskError == true)
                                    {
                                        $errorMsg = "There was an error inserting your user tasks into the database. Please try again.";

                                        //Clean up any potential half-inserted data by deleting this project from the database
                                        //Delete the whole project
                                        $cleanUpQuery1 = "DELETE FROM Projects WHERE PID = '$PID'";
                                        $cleanUpQuery2 = "DELETE FROM ProjectTeams WHERE PID = '$PID'";
                                        $cleanUpQuery3 = "DELETE FROM Tasks WHERE PID = '$PID'";

                                        //Execute the query
                                        $cleanUp1 = $db->query($cleanUpQuery1);
                                        $cleanUp2 = $db->query($cleanUpQuery2);
                                        $cleanUp3 = $db->query($cleanUpQuery3);

                                        //Close the database
                                        $db->close();
                                    } else {
                                        //Project successfully created, close DB
                                        $db->close();

                                        //Navigate to the manager-landing with success
                                        header("Location: manager-landing.php?success=5");
                                    }

                                } else {
                                    $errorMsg = "There was an error inserting your team members into the database. Please try again.";

                                    //Clean up any potential half-inserted data by deleting this project from the database
                                    //Delete the whole project; will cascade down
                                    $cleanUpQuery1 = "DELETE FROM Projects WHERE PID = '$PID'";
                                    $cleanUpQuery2 = "DELETE FROM ProjectTeams WHERE PID = '$PID'";

                                    //Execute the query
                                    $cleanUp1 = $db->query($cleanUpQuery1);
                                    $cleanUp2 = $db->query($cleanUpQuery2);
                                    
                                    //Close the database
                                    $db->close();
                                }
                            } else {
                                $errorMsg = "There was an error inserting the project into the database. Please try again.";
                            }
                        } else {
                            $errorMsg = "Please ensure each task has a set deadline and a dedicated user. The deadlines must be within the given project time frame.";
                        }
                    } else {
                        $errorMsg = "Please ensure you have correctly typed in all of your members names into the fields below.";
                    }
                } else {
                    $errorMsg = "Please ensure that your project information (i.e. title, description, start/end dates) are valid.";
                }
            }
        } else {
            //Employee trying to access manager page, redirect to employee landing
            header("Location: ../employee-views/employee-landing.php");
        }
    } else {
        //User is not logged in, redirect to login page
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create New Project</title>
    <script type="text/javascript" src="../javascript/projectValidation.js"></script>
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
                    <li><a href="manager-all-employees.php">Search Employees</a></li>
                    <li><a href="manager-edit-profile.php">Edit Profile</a></li>
                    <li><a href="manager-create-new-project.php">Create New Project</a></li>
                    <li><a href="manager-create-new-user.php">Create New User</a></li>
                    <li><a href="manager-landing.php">Home</a></li>
                </ul>
            </nav>

			<div class="manager-create-new-project-card-container">
                <header>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <h2>Create New Project</h2>
                                    <p class="generic-php-error"><?=$errorMsg?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>
                
                <article>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="submitForm">
                        <div>
                            <table id="createUserTable">
                                <tbody>
                                    <tr>
                                        <td>Project Title: </td><td> <input type="text" name="projectTitle" class="text-input" value="<?php echo htmlspecialchars($projectTitle); ?>" /></td>
                                    </tr>
                                  
                                    <tr>
                                        <td></td><td id="projectTitleError" class="generic-php-error"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div>
                            <table>
                                <tr>
                                    <td>Description: </td><td> <textarea name="projectDescription" id="projectDescription" cols="30" rows="10"><?php echo htmlspecialchars($projectDescription); ?></textarea></td>
                                </tr>

                                <tr>
                                    <td></td><td id="projectDescriptionError" class="generic-php-error"></td>
                                </tr>
                            </table>
                        </div>

                        <div>
                            <table>
                                <tr>
                                    <td>Start Date: </td><td> <input type="date" name="startDate" value="<?php echo htmlspecialchars($startDate); ?>" /></td>
                                    <td>End Date: </td><td> <input type="date" name="endDate" value="<?php echo htmlspecialchars($endDate); ?>" /></td>
                                </tr>

                                <tr>
                                    <td></td><td id="startDateError" class="generic-php-error"></td>
                                    <td></td><td id="endDateError" class="generic-php-error"></td>
                                </tr>
                            </table>
                        </div>
                      
                        <div class="skills-container" style="margin-top: 20px";>
                            <table id="members-landing-card">
                                <thead>
                                    <tr>
                                        <td class="project-member-input">Project Members</td>
                                        <td class="project-member-input">Task</td>
                                        <td class="project-member-input">Deadline</td> 
                                    </tr>
                                </thead>
        
                                    <tr>
                                        <td><input type="text" name="projectMember1" class="text-input" value="<?php echo htmlspecialchars($projectMembers[0]); ?>"/></td>
                                        <td><input type="text" name="projectMember1Task1" class="text-input" value="<?php echo htmlspecialchars($tasks[0]); ?>" disabled="disabled"/></td>
                                        <td><input type="date" name="projectMember1DeadlineTask1" value="<?php echo htmlspecialchars($deadlines[0]); ?>" disabled="disabled"/></td>
                                    </tr>
                              
                                    <tr>
                                        <td></td>
                                        <td id="projectMember1Task1Error" class="generic-php-error"></td>
                                        <td id="projectMember1DeadlineTask1Error" class="generic-php-error"></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember1"></td>
                                        <td><input type="text" name="projectMember1Task2" class="text-input" value="<?php echo htmlspecialchars($tasks[1]); ?>" disabled="disabled" /></td>
                                        <td><input type="date" name="projectMember1DeadlineTask2" value="<?php echo htmlspecialchars($deadlines[1]); ?>" disabled="disabled" /></td>
                                    </tr>
                  
                                    <tr>
                                        <td id="projectMember1Error" class="generic-php-error"></td>
                                        <td id="projectMember1Task2Error" class="generic-php-error"></td>
                                        <td id="projectMember1DeadlineTask2Error" class="generic-php-error"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="projectMember2" class="text-input" value="<?php echo htmlspecialchars($projectMembers[1]); ?>" /></td>
                                        <td><input type="text" name="projectMember2Task1" class="text-input" value="<?php echo htmlspecialchars($tasks[2]); ?>" disabled="disabled"/></td>
                                        <td><input type="date" name="projectMember2DeadlineTask1" value="<?php echo htmlspecialchars($deadlines[2]); ?>" disabled="disabled"/></td>
                                    </tr>
                  
                                    <tr>
                                        <td></td>
                                        <td id="projectMember2Task1Error" class="generic-php-error"></td>
                                        <td id="projectMember2DeadlineTask1Error" class="generic-php-error"></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember2"></td>
                                        <td><input type="text" name="projectMember2Task2" class="text-input" value="<?php echo htmlspecialchars($tasks[3]); ?>" disabled="disabled"/></td>
                                        <td><input type="date" name="projectMember2DeadlineTask2" value="<?php echo htmlspecialchars($deadlines[3]); ?>" disabled="disabled"/></td>
                                    </tr>
                  
                                    <tr>
                                        <td id="projectMember2Error" class="generic-php-error"></td>
                                        <td id="projectMember2Task2Error" class="generic-php-error"></td>
                                        <td id="projectMember2DeadlineTask2Error" class="generic-php-error"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="projectMember3" class="text-input" value="<?php echo htmlspecialchars($projectMembers[2]); ?>" /></td>
                                        <td><input type="text" name="projectMember3Task1" class="text-input" value="<?php echo htmlspecialchars($tasks[4]); ?>" disabled="disabled" /></td>
                                        <td><input type="date" name="projectMember3DeadlineTask1" value="<?php echo htmlspecialchars($deadlines[4]); ?>" disabled="disabled" /></td>
                                    </tr>
                  
                                    <tr>
                                        <td></td>
                                        <td id="projectMember3Task1Error" class="generic-php-error"></td>
                                        <td id="projectMember3DeadlineTask1Error" class="generic-php-error"></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember3"></td>
                                        <td><input type="text" name="projectMember3Task2" class="text-input" value="<?php echo htmlspecialchars($tasks[5]); ?>" disabled="disabled" /></td>
                                        <td><input type="date" name="projectMember3DeadlineTask2" value="<?php echo htmlspecialchars($deadlines[5]); ?>" disabled="disabled" /></td>
                                    </tr>
                  
                                    <tr>
                                        <td id="projectMember3Error" class="generic-php-error"></td>
                                        <td id="projectMember3Task2Error" class="generic-php-error"></td>
                                        <td id="projectMember3DeadlineTask2Error" class="generic-php-error"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="projectMember4" class="text-input" value="<?php echo htmlspecialchars($projectMembers[3]); ?>" /></td>
                                        <td><input type="text" name="projectMember4Task1" class="text-input" value="<?php echo htmlspecialchars($tasks[6]); ?>" disabled="disabled" /></td>
                                        <td><input type="date" name="projectMember4DeadlineTask1" value="<?php echo htmlspecialchars($deadlines[6]); ?>" disabled="disabled" /></td>
                                    </tr>
                  
                                    <tr>
                                        <td></td>
                                        <td id="projectMember4Task1Error" class="generic-php-error"></td>
                                        <td id="projectMember4DeadlineTask1Error" class="generic-php-error"></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember4"></td>
                                        <td><input type="text" name="projectMember4Task2" class="text-input" value="<?php echo htmlspecialchars($tasks[7]); ?>" disabled="disabled" /></td>
                                        <td><input type="date" name="projectMember4DeadlineTask2" value="<?php echo htmlspecialchars($deadlines[7]); ?>" disabled="disabled" /></td>
                                    </tr>
                  
                                    <tr>
                                        <td id="projectMember4Error" class="php-generic-error"></td>
                                        <td id="projectMember4Task2Error" class="generic-php-error"></td>
                                        <td id="projectMember4DeadlineTask2Error" class="generic-php-error"></td>
                                    </tr>
                            </table>
                        </div>
                        
                            <div class="submit-button-container" style="margin-top: 20px">
                                <p>
                                    <button type="submit" class="submit-button" style="float: right;" name="submitBtn">Create Project</button> 
                                </p>
                            </div>
                    </form>
            </article>
			</div>
		</div>
	</div>
<script type="text/javascript" src="../javascript/projectValidationR.js"></script>
<script type="text/javascript" src="newProject.js"></script>
</body>
</html>