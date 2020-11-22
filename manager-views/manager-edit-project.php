<?php
    //Get login creds for the DB
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Connect the db, and test the connection
    $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

    //Check if the connection failed
    if ($db->connect_error) {
        die ("Connection failed: ".$db->connect_error);
    }

    //Check to see if the user is logged in as a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0)
    {
        if (isset($_SESSION["MID"]) && $_SESSION["MID"] != NULL)
        {
            //User sent here by the GET method; grab the PID from the URL
            $PID = $_GET["PID"];

            if ($_GET["success"] == 1)
                $errorMsg = "Your project was successfully updated!";

            //Using the PID; grab all of the information necessary to fill the fields
            $projectQuery = "SELECT Title, Description, StartDate, EndDate FROM Projects WHERE PID = '$PID'";
            $teamQuery = "SELECT Users.UID, Users.managerID, Users.FirstName, Users.LastName FROM ProjectTeams LEFT JOIN Users ON (ProjectTeams.UID = Users.UID) WHERE ProjectTeams.PID = '$PID'";
            
            //Execute the Project query
            $projectResults = $db->query($projectQuery);

            //Fill variables with the information if results were retrieved
            if ($projectResults->num_rows > 0)
            {
                $projectRow = $projectResults->fetch_assoc();

                $title = $projectRow["Title"];
                $description = $projectRow["Description"];
                $startdate = $projectRow["StartDate"];
                $enddate = $projectRow["EndDate"];

                //Execute the query to get the team members, fill the team member aray
                $teamFN = array();
                $teamLN = array();
                $teamUIDS = array();

                //Execute the Teams query
                $teamResults = $db->query($teamQuery);

                //Iterate over the results, there may be 0-4 team members (don't throw an error)
                if ($teamResults->num_rows > 0)
                {
                    //Fill the team member array, without the manager
                    while ($teamRows = $teamResults->fetch_assoc())
                    {
                        if ($teamRows["managerID"] == NULL)
                        {
                            //Don't populate the array with the manager; they're technically not a working member
                            $teamFN[] = $teamRows["FirstName"];
                            $teamLN[] = $teamRows["LastName"];
                            $teamUIDS[] = $teamRows["UID"];
                        } else if ($teamRows["managerID"] != NULL) {
                            //Still need to save the manager ID for the update; we don't want to change that
                            $managerUID = $teamRows["UID"];
                        }
                    }

                    //If the array isn't full (4 entries), fill with NULL spots
                    if (sizeof($teamUIDS) <  4)
                    {
                        for ($j = sizeof($teamUIDS); $j < 4; $j++)
                            $teamUIDS[] = NULL;                                                
                    }

                    //Using the UIDs, find the tasks for each user, populate the array
                    $userTasks = array();
                    $userDeadlines = array();

                    for ($i = 0; $i < sizeof($teamUIDS); $i++)
                    {
                        //Build query for specific user and PID
                        $taskQuery = "SELECT TDescription, Deadline FROM Tasks WHERE UID = '$teamUIDS[$i]' AND PID = '$PID'";

                        //Execute query, set number of rows for checking
                        $taskResults = $db->query($taskQuery);
                        $taskResultRows = $taskResults->num_rows;

                        //Check if results came back
                        //Case 1: User has 2 tasks; fill in both
                        //Case 2: User has 1 task; fill in one, blank the other
                        //Case 3: User has no tasks; blank both
                        if ($taskResultRows == 2)
                        {
                            while ($taskRows = $taskResults->fetch_assoc())
                            {
                                $userTasks[] = $taskRows["TDescription"];
                                $userDeadlines[] = $taskRows["Deadline"];
                            }
                        } else if ($taskResultRows == 1) {
                            $taskRows = $taskResults->fetch_assoc();
                            $userTasks[] = $taskRows["TDescription"];
                            $userTasks[] = "";
                            $userDeadlines[] = $taskRows["Deadline"];
                            $userDeadlines[] = "";
                        } else if ($taskResultRows == 0) {
                           $userTasks[] = "";
                            $userTasks[] = "";
                            $userDeadlines[] = "";
                            $userDeadlines[] = "";
                        }
                    }

                    //If the tasks/deadlines arrays aren't at 8 each; fill the cells with NULL
                    if (sizeof($userTasks) < 8)
                    {
                        for ($z = sizeof($userTasks); $z < 8; $z++)
                            $userTasks[$z] == NULL;
                    }

                    if (sizeof($userDeadlines) < 8)
                    {
                        for ($x = sizeof($userDeadlines); $x < 8; $x++)
                            $userDeadlines[$x] = NULL;
                    }
                
                } else {
                    $errorMsg = "There was a problem retrieving the project information from the database.";
                }
            }

            //If the submit button is pressed, validate all of the data and update the database
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $PID = $_GET["PID"];

                //Set an error message variable
                $errorMsg = "";

                //Grab all of the information from the fields for Projects table
                $projectTitle = $_POST["projectTitle"];
                $projectDescription = $_POST["projectDescription"];
                $startDate = $_POST["startDate"];
                $endDate = $_POST["endDate"];

                //Create an array of project members
                $projectMembers = array();
                $memberUIDS = array();
                $projectMembers[] = trim($_POST["projectMember1"]);
                $projectMembers[] = trim($_POST["projectMember2"]);
                $projectMembers[] = trim($_POST["projectMember3"]);
                $projectMembers[] = trim($_POST["projectMember4"]);

                //Create an array of tasks
                $tasks = array();
                $tasks[] = trim($_POST["projectMember1Task1"]);
                $tasks[] = trim($_POST["projectMember1Task2"]);
                $tasks[] = trim($_POST["projectMember2Task1"]);
                $tasks[] = trim($_POST["projectMember2Task2"]);
                $tasks[] = trim($_POST["projectMember3Task1"]);
                $tasks[] = trim($_POST["projectMember3Task2"]);
                $tasks[] = trim($_POST["projectMember4Task1"]);
                $tasks[] = trim($_POST["projectMember4Task2"]);

                //Create an array of deadlines
                $deadlines = array();
                $deadlines[] = trim($_POST["projectMember1DeadlineTask1"]);
                $deadlines[] = trim($_POST["projectMember1DeadlineTask2"]);
                $deadlines[] = trim($_POST["projectMember2DeadlineTask1"]);
                $deadlines[] = trim($_POST["projectMember2DeadlineTask2"]);
                $deadlines[] = trim($_POST["projectMember3DeadlineTask1"]);
                $deadlines[] = trim($_POST["projectMember3DeadlineTask2"]);
                $deadlines[] = trim($_POST["projectMember4DeadlineTask1"]);
                $deadlines[] = trim($_POST["projectMember4DeadlineTask2"]);
                
                //Validate the Projects information
                if (($projectTitle != "" && strlen($projectTitle) <= 50) && $projectDescription != "" && $startDate != "" && $endDate != "")
                {
                    //Set error flag to false
                    $errorFlag = false;

                    //Validate project members array by checking if this member exists in the db
                    for ($i = 0; $i < 4; $i++)
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

                        //Validate the tasks/deadlines by checking if they're either an empty pair or a non-empty pair
                        for ($j = 0; $j < sizeof($tasks); $j++)
                        {
                            //If you find a task/deadline combo that is empty/full, throw an error
                            if (($tasks[$j] != "" && $deadlines[$j] == "") || ($tasks[$j] == "" && $deadlines[$j] != ""))
                            {
                                $tdError = true;
                                break;
                            }
                        }

                        
                        //Validation complete; update/insert this data into the database
                        if ($tdError == FALSE)
                        {
                            //Ensure date/times from the picker are in mySql format
                            $startDateUpdate = date("Y-m-d", strtotime($startDate));
                            $endDateUpdate = date("Y-m-d", strtotime($endDate));
                            
                            //Build update query for projects
                            $projectUpdate = "UPDATE Projects SET Title = '$projectTitle', Description = '$projectDescription', StartDate = '$startDateUpdate', EndDate = '$endDateUpdate' WHERE PID = '$PID'";
                
                            //Execute query
                            $projectUpdateResults = $db->query($projectUpdate);

                            //If it worked, insert the project team members
                            if ($projectUpdateResults == true)
                            { 
                                //Set an error flag for member inserts
                                $memberUpdateError = false;

                                //Set a update flag for each member to see what happened, so we can work accordingly for the tasks/deadlines
                                $memberUpdateStatus = array();

                                //Update project members and their respective into the database based on four cases 
                                for ($k = 0; $k < 4; $k++)
                                {
                                    //Case 1: both fields empty; do nothing
                                    if (empty($teamUIDS[$k]) == true && empty($memberUIDS[$k]) == true) {
                                        $memberUpdateStatus[] = "SKIP";
                                        continue;
                                    }
                                    //Case 2: both fields are full; perform update
                                    else if (empty($teamUIDS[$k]) == false && empty($memberUIDS[$k]) == false) {
                                        $updateMember = "UPDATE ProjectTeams SET UID = '$memberUIDS[$k]' WHERE UID = '$teamUIDS[$k]' AND PID = '$PID'";
                                        $memberUpdateStatus[] = "USWITCH";
                                    }
                                    //Case 3: first field is full, second field is empty; perform delete
                                    else if (empty($teamUIDS[$k]) == false && empty($memberUIDS[$k]) == true) {
                                        $updateMember = "DELETE FROM ProjectTeams WHERE UID = '$teamUIDS[$k]' AND PID = '$PID'";
                                        $memberUpdateStatus[] = "DELETE";
                                    }
                                    //Case 4: first field is empty, second field is full; perform insert
                                    else if (empty($teamUIDS[$k]) == true && empty($memberUIDS[$k]) == false) {
                                        $updateMember = "INSERT INTO ProjectTeams (UID, PID) VALUES ('$memberUIDS[$k]', '$PID')";
                                        $memberUpdateStatus[] = "INSERT";
                                    }

                                    //Execute query
                                    $memberUpdateResults = $db->query($updateMember);

                                    //If query fails, set an error flag
                                    if ($memberUpdateResults == false)
                                        $memberUpdateError == true;
                                }
            
                     
                                //If the team members are all updated, update the tasks in the db
                                if ($memberUpdateError == false)
                                {
                                    //Set a counter to 0
                                    $counter = 0;
                                    $insertCounter = 0;

                                    //Set an error flag to false
                                    $taskError = false;

                                    //For each member in the member array, update the tasks based on status 
                                    for ($l = 0; $l < 4; $l++)
                                    {
                                        if ($memberUpdateStatus[$l] == "SKIP") {
                                            $counter += 2;
                                            continue;
                                        } else if ($memberUpdateStatus[$l] == "USWITCH") {
                                            //Delete the two tasks that were previously there out of the DB
                                            $tdDelete = "DELETE FROM Tasks WHERE UID = '$teamUIDS[$l]' AND PID = '$PID'";

                                            //Execute a delete query for the user
                                            $tdDResult = $db->query($tdDelete);

                                            if ($tdDResult == false)
                                                    $taskError = true;

                                            for ($m = 0; $m < 2; $m++)
                                            {
                                                //Execute an insert query for the user
                                                //Check if the user has been assigned a task. If not, skip to the next one.
                                                if (empty($tasks[$counter]) == false && empty($deadlines[$counter]) == false)
                                                {
                                                    //Ensure the deadline is in the correct format before inserting
                                                    $deadlineInsert = date("Y-m-d", strtotime($deadlines[$counter]));
                                                        
                                                    //Build up task query
                                                    //Need this current users UID, the same PID, and the two tasks they may have been assigned
                                                    $taskQuery = "INSERT INTO Tasks (UID, PID, TDescription, Deadline) 
                                                                    VALUES ('$memberUIDS[$l]', '$PID', '".$db->real_escape_string($tasks[$counter])."', 
                                                                        '".$db->real_escape_string($deadlineInsert)."')";

                                                    $insertCounter++;

                                                    $taskResult = $db->query($taskQuery);

                                                    if ($taskResult == false)
                                                        $taskError = true;
                                                }

                                                $counter++;
                                            }                                            
                                        } else if ($memberUpdateStatus[$l] == "DELETE") {
                                            //Delete the two tasks that were previously there out of the DB
                                            $tdDelete = "DELETE FROM Tasks WHERE UID = '$teamUIDS[$l]' AND PID = '$PID'";

                                            $tdDResult = $db->query($tdDelete);

                                            if ($tdDResult == false)
                                                $taskError = true;

                                            $counter += 2;  
                                        } else if ($memberUpdateStatus[$l] == "INSERT") {
                                            //Insert the tasks into the tasks table
                                            for ($m = 0; $m < 2; $m++)
                                            {
                                                //Check if the user has been assigned a task. If not, skip to the next one.
                                                if (empty($tasks[$counter]) == false && empty($deadlines[$counter]) == false)
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
                                    }

                                    if ($taskError == true)
                                    {
                                        $errorMsg = "There was an error updating your user tasks into the database. Please try again.";

                                        //Close the database
                                        $db->close();
                                    } else {
                                        //Project successfully created, close DB
                                        $db->close();

                                        //Redirect to the same page with updates
                                        header("Location: manager-edit-project.php?PID=".$PID."&success=1");
                                    }
                                } else {
                                    $errorMsg = "There was an error updating your team members into the database. Please try again.";

                                    //Close the database
                                    $db->close();
                                }
                            } else {
                                $errorMsg = "There was an error updating the project into the database. Please try again.";
                            }

                        } else {
                            $errorMsg = "Please ensure each task has a set deadline and a dedicated user.";
                        }
                    } else {
                        $errorMsg = "Please ensure you have correctly typed in all of your members names into the fields below.";
                    }
                } else {
                    $errorMsg = "Please ensure that your project information (i.e. title, description, start/end dates) are valid.";
                }
                //Close the DB
                $db->close();
            }
        } else {
            //Employee trying to access manager page, redirect
            header("Location: ../employee-landing.php");
        }
    } else {
        //User is not logged in; redirect to the login page
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Project</title>
    <script type="text/javascript" src="projectValidation.js"></script>
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

			<div class="manager-create-new-project-card-container">

                <header>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <h2>Edit Project</h2>
                                    <p class="generic-php-error"><?=$errorMsg?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>
                
                <article>
                    <form action="manager-edit-project.php?PID=<?=$PID?>" method="POST">
                        <div>
                            <table id="createUserTable">
                                <tbody>
                                    <tr>
                                        <td>Project Title: </td><td> <input type="text" name="projectTitle" class="text-input" value="<?php echo $title;?>" /></td>
                                        <td>Description: </td><td> <textarea name="projectDescription" id="projectDescription" cols="30" rows="10"><?php echo $description;?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <table>
                                <tr>
                                    <td>Start Date: </td><td> <input type="date" name="startDate" value="<?php echo $startdate;?>" /></td>
                                    <td>End Date: </td><td> <input type="date" name="endDate" value="<?php echo $enddate;?>" /></td>
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
                                        <td><input type="text" name="projectMember1" class="text-input" value="<?php echo $teamFN[0];?> <?php echo $teamLN[0];?>"/></td>
                                        <td><input type="text" name="projectMember1Task1" class="text-input" value="<?php echo $userTasks[0];?>" /></td>
                                        <td><input type="date" name="projectMember1DeadlineTask1" value="<?php echo $userDeadlines[0];?>" /></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember1"></td>
                                        <td><input type="text" name="projectMember1Task2" class="text-input" value="<?php echo $userTasks[1];?>" /></td>
                                        <td><input type="date" name="projectMember1DeadlineTask2" value="<?php echo $userDeadlines[1];?>" /></td>
                                    </tr>       

                                    <tr>
                                        <td><input type="text" name="projectMember2" class="text-input" value="<?php echo $teamFN[1];?> <?php echo $teamLN[1];?>" /></td>
                                        <td><input type="text" name="projectMember2Task1" class="text-input" value="<?php echo $userTasks[2];?>" /></td>
                                        <td><input type="date" name="projectMember2DeadlineTask1" value="<?php echo $userDeadlines[2];?>" /></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember2"></td>
                                        <td><input type="text" name="projectMember2Task2" class="text-input" value="<?php echo $userTasks[3];?>" /></td>
                                        <td><input type="date" name="projectMember2DeadlineTask2" value="<?php echo $userDeadlines[3];?>" /></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="projectMember3" class="text-input" value="<?php echo $teamFN[2];?> <?php echo $teamLN[2];?>" /></td>
                                        <td><input type="text" name="projectMember3Task1" class="text-input" value="<?php echo $userTasks[4];?>" /></td>
                                        <td><input type="date" name="projectMember3DeadlineTask1" value="<?php echo $userDeadlines[4];?>" /></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember3"></td>
                                        <td><input type="text" name="projectMember3Task2" class="text-input" value="<?php echo $userTasks[5];?>" /></td>
                                        <td><input type="date" name="projectMember3DeadlineTask2" value="<?php echo $userDeadlines[5];?>" /></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="projectMember4" class="text-input" value="<?php echo $teamFN[3];?> <?php echo $teamLN[3];?>" /></td>
                                        <td><input type="text" name="projectMember4Task1" class="text-input" value="<?php echo $userTasks[6];?>" /></td>
                                        <td><input type="date" name="projectMember4DeadlineTask1" value="<?php echo $userDeadlines[6];?>" /></td>
                                    </tr>

                                    <tr>
                                        <td id="suggestMember4"></td>
                                        <td><input type="text" name="projectMember4Task2" class="text-input" value="<?php echo $userTasks[7];?>" /></td>
                                        <td><input type="date" name="projectMember4DeadlineTask2" value="<?php echo $userDeadlines[7];?>" /></td>
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
    <script type="text/javascript" src="newProject.js"></script>
</body>
<script type="text/javascript" src="projectValidationR.js"></script>
</html>