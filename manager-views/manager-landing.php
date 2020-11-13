<?php 
    //Include the db login creds
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Check to see if the user is logged in as a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0) {
        if (isset($_SESSION["MID"]) && $_SESSION["MID"] != NULL)
        {
            //Grab user picture from session variables
            $pictureURL = $_SESSION["PictureURL"];
            $FirstName = $_SESSION["FirstName"];
            $LastName = $_SESSION["LastName"];

            //If you were redirected to this page, check the success variable for message
            if ($_SERVER["REQUEST_METHOD"] == "GET")
            {
                if ($_GET["success"] == 0)
                    $successMsg = "The project could not be deleted from the database. Please try again.";
                else if ($_GET["success"] == 1)
                    $successMsg = "The project was successfully deleted from the database.";
            }
        } else {
            //User is not a manager, redirect to employee landing
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
	<title>Manager Home</title>
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
                            <input class="logout-button" name="submit2" type="submit" id="submit2" value="Logout">
                        </form>
                    </li>
                    <li><a href="manager-all-employees.php">See All Employees</a></li>
                    <li><a href="manager-edit-profile.php">Edit Profile</a></li>
                    <li><a href="manager-create-new-project.php">Create New Project</a></li>
                    <li><a href="manager-create-new-user.php">Create New User</a></li>
                    <li><a href="manager-landing.php">Home</a></li>
                </ul>
            </nav>

			<div class="card-container">
                <header>
                    <div class="search-bar-container">
                        <form class="search-bar" action="manager-search-results.php">
                            <input type="text" placeholder="Search.." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="<?=$pictureURL?>" alt="<?=$FirstName?> <?=$LastName?>" width="80px" height="80px"> 
                                </td>
                                <td>
                                    <h2>Manager - <?=$FirstName?> <?=$LastName?></h2> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="generic-php-error"><?=$successMsg?></p>
                </header>           
            </div>
            
            <!-- card to display per project on landing page, replicate for projects needed -->
            <?php 
                //Set an error message variable
                $errorMsg = "";

                //Connect the db, and test the connection
                $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

                //Check if the connection failed
                if ($db->connect_error) {
                    die ("Connection failed: ".$db->connect_error);
                } 

                //Execute the query to find all projects and their team members
                $firstQuery = "SELECT Projects.PID, Title, Description, StartDate, EndDate, Users.UID, FirstName, LastName 
                            FROM Projects LEFT JOIN ProjectTeams ON Projects.PID = ProjectTeams.PID 
                            INNER JOIN Users ON ProjectTeams.UID = Users.UID 
                            ORDER BY Projects.PID";
                
                //Execute the query
                $firstResults = $db->query($firstQuery);

                //Set current PID flag
                $currentPID = "";

                //Start to iterate over the results
                if ($firstResults->num_rows > 0) {
                    while ($projectRows = $firstResults->fetch_assoc()) {
                        if ($projectRows["PID"] != $currentPID) 
                        {
                            if ($projectRows["PID"] != $currentPID && $currentPID != "")
                            {
            ?>
            </table>
            </article>
            </div>
            <?php
                            }
                            //Set the current PID to this project
                            $currentPID = $projectRows["PID"];
                        
            ?>
            <div class="card-container">
                <article>
                    <table id="project-landing-card">
                        <thead>
                            <tr>
                                <th>Project Title</th> 
                                <th>Description</th> 
                                <th>Start Date</th>
                                <th>End Date</th> 
                            </tr>
                        </thead>

                            <tr>
                                <td class="project-title"><?=$projectRows["Title"]?></td>
                                <td><?=$projectRows["Description"]?></td>
                                <td><?=$projectRows["StartDate"]?></td>
                                <td><?=$projectRows["EndDate"]?></td>
                                <td>
                                    <form action="editProject.php?PID=<?=$currentPID?>" method="GET">
                                        <button type="submit" class="edit-delete-button"><i class="fa fa-edit"></i></button>
                                    </form>
                                    
                                    <form action="deleteProject.php?PID=<?=$currentPID?>" method="GET">
                                        <button type="submit" class="edit-delete-button"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                    </table>

                    <table id="members-landing-card">
                        <thead>
                            <tr>
                                <th>Project Members</th>
                                <th>Task 1</th>
                                <th>Deadline</th> 
                                <th>Task 2</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                            <tr>
                            <?php
                                }

                                //For each user in the project, if they have tasks, print them ordered by deadline
                                $tasksQuery = "SELECT TDescription, Deadline 
                                                FROM Tasks 
                                                WHERE UID = '".$projectRows["UID"]."' AND PID = '$currentPID'
                                                ORDER BY Deadline ASC";

                                //Execute query
                                $taskResults = $db->query($tasksQuery);

                                if ($taskResults->num_rows > 0) 
                                {
                            ?>
                            <td><?=$projectRows["FirstName"]?> <?=$projectRows["LastName"]?></td>
                            <?php 
                                    while ($taskRows = $taskResults->fetch_assoc())
                                    {
                            ?>
                                <td><?=$taskRows["TDescription"]?></td>
                                <td><?=$taskRows["Deadline"]?></td>
                            <?php 
                                    }
                            ?>
                            </tr>
                            <?php
                                } 

                                //Loop back to the next result
                                }
                            ?>      
                    </table>
                </article>
            </div>
            <!-- end of landing card -->
            <?php 
                    } else {
                        //Error in retrieving project details
                        echo("<p class=\"generic-php-error\">There was an error retrieving projects from the database.</p>");
                    }

                //If loop has ran to completion with no errors, close the Db
                $db->close();
            ?>
        </div>
    </div>

</body>
</html>