<?php
    //Get login creds for the DB
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Check to see if the user is logged in as a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0)
    {
        if (isset($_SESSION["MID"]) && $_SESSION["MID"] != NULL)
        {
            //User sent here by the GET method; grab the PID from the URL
            $PID = $_GET["PID"];

            //Connect the db, and test the connection
            $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

            //Check if the connection failed
            if ($db->connect_error) {
                die ("Connection failed: ".$db->connect_error);
            } 

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
                $startDate = $projectRow["StartDate"];
                $endDate = $projectRow["EndDate"];

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
                            $teamFN[] = $teamRows["FirstName"];
                            $teamLN[] = $teamRows["LastName"];
                            $teamUIDS[] = $teamRows["UID"];
                        }
                    }


                    //Using the UIDs, find the tasks for each user, populate the array
                    $userTasks = array();
                    $userDeadlines = array();

                    for ($i = 0; $i < sizeof($teamUIDS); $i++)
                    {
                        //Build query for specific user and PID
                        $taskQuery = "SELECT TDescription, Deadline FROM Tasks WHERE UID = '$teamUIDS[$i]' AND PID = '$PID'";

                        //Execute query
                        $taskResults = $db->query($taskquery);
                        $taskResultRows = $taskResults->num_rows;
                        $errorMsg = $taskResultRows;

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
                }
            } else {
                $errorMsg = "There was a problem retrieving the project information from the database.";
            }

            //Close the DB
            $db->close();
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
                    <!-- add form tag here -->
                    <div>
                        <table id="createUserTable">
                            <tbody>
                                <tr>
                                    <td>Project Title: </td><td> <input type="text" name="projectTitle" class="text-input" value="<?=$title?>" /></td>
                                    <td>Description: </td><td> <textarea name="projectDescription" id="projectDescription" cols="30" rows="10"><?=$description?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <table>
                            <tr>
                                <td>Start Date: </td><td> <input type="date" name="startDate" value="<?=$startDate?>" /></td>
                                <td>End Date: </td><td> <input type="date" name="endDate" value="<?=$endDate?>" /></td>
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
                                    <td><input type="text" name="projectMember1" class="text-input" value="<?=$teamFN[0]?> <?=$teamLN[0]?>"/></td>
                                    <td><input type="text" name="projectMember1Task1" class="text-input" value="<?=$userTasks[0]?>" /></td>
                                    <td><input type="date" name="projectMember1DeadlineTask1" value="<?=$userDeadlines[0]?>" /></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td><input type="text" name="projectMember1Task2" class="text-input" value="<?=$userTasks[1]?>" /></td>
                                    <td><input type="date" name="projectMember1DeadlineTask2" value="<?=$userDeadlines[1]?>" /></td>
                                </tr>       

                                <tr>
                                    <td><input type="text" name="projectMember2" class="text-input" value="<?=$teamFN[1]?> <?=$teamLN[1]?>" /></td>
                                    <td><input type="text" name="projectMember2Task1" class="text-input" value="<?=$userTasks[2]?>" /></td>
                                    <td><input type="date" name="projectMember2DeadlineTask1" value="<?=$userDeadlines[2]?>" /></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td><input type="text" name="projectMember2Task2" class="text-input" value="<?=$userTasks[3]?>" /></td>
                                    <td><input type="date" name="projectMember2DeadlineTask2" value="<?=$userDeadlines[3]?>" /></td>
                                </tr>

                                <tr>
                                    <td><input type="text" name="projectMember3" class="text-input" value="<?=$teamFN[2]?> <?=$teamLN[2]?>" /></td>
                                    <td><input type="text" name="projectMember3Task1" class="text-input" value="<?=$userTasks[4]?>" /></td>
                                    <td><input type="date" name="projectMember3DeadlineTask1" value="<?=$userDeadlines[4]?>" /></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td><input type="text" name="projectMember3Task2" class="text-input" value="<?=$userTasks[5]?>" /></td>
                                    <td><input type="date" name="projectMember3DeadlineTask2" value="<?=$userDeadlines[5]?>" /></td>
                                </tr>

                                <tr>
                                    <td><input type="text" name="projectMember4" class="text-input" value="<?=$teamFN[3]?> <?=$teamLN[3]?>" /></td>
                                    <td><input type="text" name="projectMember4Task1" class="text-input" value="<?=$userTasks[6]?>" /></td>
                                    <td><input type="date" name="projectMember4DeadlineTask1" value="<?=$userDeadlines[6]?>" /></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td><input type="text" name="projectMember4Task2" class="text-input" value="<?=$userTasks[7]?>" /></td>
                                    <td><input type="date" name="projectMember4DeadlineTask2" value="<?=$userDeadlines[7]?>" /></td>
                                </tr>
    
                        </table>
                    </div>
                    
                    <div class="submit-button-container">
                        <p>
                            <input type="button" value="Submit" class="submit-button" style="float: right;"/> 
                        </p>
                    </div>
                    <!-- form tag goes here -->
            </article>
				
			</div>
		</div>
	</div>

</body>
</html>