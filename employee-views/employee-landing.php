<?php
    //Get the db login creds
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Check to see if the user is logged in 
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0 && $_SESSION["MID"] == NULL)
    {
        //Connect the db, and test the connection
        $db = new mysqli('localhost', $serverName, $serverPW, $serverName);

        //Check if the connection failed
        if ($db->connect_error) {
            die ("Connection failed: ".$db->connect_error);
        } 

        //Grab the session variables for use
        $UID = $_SESSION["UID"];

        //Grab user picture from session variables
        $userInfo = "SELECT FirstName, LastName, PictureURL FROM Users WHERE UID = '$UID'";

        $infoResult = $db->query($userInfo);

        while ($rows = $infoResult->fetch_assoc())
        {
            $pictureURL = $rows["PictureURL"];
            $FirstName = $rows["FirstName"];
            $LastName = $rows["LastName"];
        }

    } else {
        //User is not logged in, redirect to login page
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Employee Home</title>
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
                            
                            </label>
                        </form>
                    </li>
                    <li><a href="employee-all-employees.php">Search Employees</a></li>
                    <li><a href="employee-edit-profile.php">Edit Profile</a></li>
                    <li><a href="employee-landing.php">Home</a></li>
                </ul>
            </nav>

            <div class="card-container">
                <header>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="<?=$pictureURL?>" alt="<?php htmlspecialchars($FirstName);?> <?php echo htmlspecialchars($LastName);?>" width="80px" height="80px"> 
                                </td>
                                <td>
                                    <h2><?php echo htmlspecialchars($FirstName);?> <?php echo htmlspecialchars($LastName);?></h2> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>           
            </div>
            
            <!-- card to display per project on landing page, replicate for projects needed -->
            <?php
                //Build the query to find all the PID's this employee is involved in.
                $findPID = "SELECT PID FROM ProjectTeams WHERE UID = '$UID'";

                //Execute the query
                $pidResults = $db->query($findPID);

                if ($pidResults->num_rows > 0)
                {
                    while ($pidRows = $pidResults->fetch_assoc())
                    {
                        //Execute the query to find all projects and their team members by PID
                        $firstQuery = "SELECT Projects.PID, Title, Description, StartDate, EndDate
                                        FROM Projects 
                                        WHERE Projects.PID = '".$pidRows["PID"]."'
                                        ORDER BY EndDate ASC";
    
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
                                <td class="project-title"><?php echo htmlspecialchars($projectRows["Title"]);?></td>
                                <td><?php echo htmlspecialchars($projectRows["Description"]);?></td>
                                <td><?php echo htmlspecialchars($projectRows["StartDate"]);?></td>
                                <td><?php echo htmlspecialchars($projectRows["EndDate"]);?></td>
                            </tr>
                    </table>

                    <table>
                        <thead>
                            <tr>
                                <th class="project-manager-title">Project Manager :
                                    <?php 
                                    $findManager = "SELECT Users.FirstName, Users.LastName 
                                                    FROM ProjectTeams LEFT JOIN Users ON (ProjectTeams.UID = Users.UID) 
                                                    WHERE ProjectTeams.PID = '$currentPID' AND Users.managerID IS NOT NULL";

                                    $managerQuery = $db->query($findManager);

                                    if ($managerQuery->num_rows > 0)
                                        $managerResult = $managerQuery->fetch_assoc();
                                    ?>
                                
                                    <td><?php echo htmlspecialchars($managerResult["FirstName"]);?> <?php echo htmlspecialchars($managerResult["LastName"]);?></td>
                                </th>
                            </tr>
                        </thead>
                    </table>
                                <?php
                                }
                                //Get all of the non-manager members for this project
                                $projectMembers = "SELECT Users.UID, Users.managerID, Users.FirstName, Users.LastName 
                                                    FROM Users INNER JOIN ProjectTeams ON (Users.UID = ProjectTeams.UID)
                                                    WHERE ProjectTeams.PID = '$currentPID' AND managerID IS NULL
                                                    ORDER BY FirstName ASC";

                                $memberResults = $db->query($projectMembers);

                                if ($memberResults->num_rows > 0)
                                {
                                ?>
                                <table id="members-landing-card">
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
                                    while ($memberRows = $memberResults->fetch_assoc())
                                    {

                                ?>
                                <td><?php echo htmlspecialchars($memberRows["FirstName"]);?> <?php echo htmlspecialchars($memberRows["LastName"]);?></td>
                                <?php
                                        //For each user in the project, if they have tasks, print them ordered by deadline
                                        $tasksQuery = "SELECT TDescription, Deadline 
                                        FROM Tasks 
                                        WHERE UID = '".$memberRows["UID"]."' AND PID = '$currentPID'
                                        ORDER BY Deadline ASC";

                                        //Execute query
                                        $taskResults = $db->query($tasksQuery);

                                        if ($taskResults->num_rows > 0)
                                        {
                                            while ($taskRows = $taskResults->fetch_assoc())
                                            {
                                ?>
                                <td><?php echo htmlspecialchars($taskRows["TDescription"]);?></td>
                                <td><?php echo htmlspecialchars($taskRows["Deadline"]);?></td>
                                <?php 
                                            }
                                        }
                                ?>
                                </tr>                            
                                <?php
                                    }       
                                }
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
                                }
                            } else {
                                echo("<p class=\"generic-php-error\">You are not currently involved in any projects!</p>");
                            }
                        //If loop has ran to completion with no errors, close the Db
                        $db->close();
                        ?>
        </div>
	</div>
</body>
</html>