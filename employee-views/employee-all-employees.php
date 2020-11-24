<?php 
    //Grab database credentials
    require_once("../assets/dbLgn.php");

    //Start a session
    session_start();

    //Check if the user is logged in as a manager
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0 && $_SESSION["MID"] == NULL)
    {
        //Connect to the database
            $db = new mysqli('localhost', $serverName, $serverPW, $serverName);
            
			//Check if the connection failed
			if ($db->connect_error) {
				die ("Connection failed: ".$db->connect_error);
			} 
    } else {
        //User is not logged in, redirect to login page
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>All Employees</title>
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

			<div class="search-card-container">

                <header>
                    <div class="search-bar-container">
                        <form class="search-bar">
                            <input type="text" placeholder="Search.." name="search" id="employeeSearch">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
    
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <h2>Employees</h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>
                
                <article>
    
                <table id="searchEmployees">
                        <thead>
                            <tr>
                                <th>User Type</th> 
                                <th>First Name</th> 
                                <th>Last Name</th> 
                                <th>Short Biography</th>
                                <th>Email</th>
                                <th>Skills</th>
                            </tr>
                        </thead> 
                        <?php 
                                //Build up query for finding all employees on the website
                                $query = "SELECT UID, managerID, FirstName, LastName, ProfileBio, Email
                                            FROM Users 
                                            ORDER BY Users.UID";

                                //Execute the query
                                $queryResults = $db->query($query);

                                //Iterate over results from DB
                                if ($queryResults->num_rows > 0)
                                {
                                    while ($empRows = $queryResults->fetch_assoc())
                                    {
                                        //Set employee type based on the managerID
                                        if ($empRows["managerID"] != NULL)
                                            $empType = "Manager";
                                        else
                                            $empType = "Employee";        
                            ?>
                            <tr name="employeeCard">
                                <td><?=$empType?></td>
                                <td><?=$empRows["FirstName"]?></td>
                                <td><?=$empRows["LastName"]?></td>
                                <td><?=$empRows["ProfileBio"]?></td>
                                <td><?=$empRows["Email"]?></td>
                                <td>
                                    <ul>
                                    <?php
                                        //Find all the CP's of this user
                                        $cpQuery = "SELECT CodingLang 
                                                    FROM CPs WHERE UID = ".$empRows["UID"]."
                                                    ORDER BY CPID";

                                        //Execute query
                                        $cpResults = $db->query($cpQuery);

                                        if ($cpResults->num_rows > 0)
                                        {
                                            while ($cpRows = $cpResults->fetch_assoc())
                                            {
                                    ?>
                                        <li><?=$cpRows["CodingLang"]?></li>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </ul>  
                                </td>
                            </tr>
                            <?php
                                } 

                                } else {
                                    //Error in DB or no employees
                                    echo("<p class=\"generic-php-error\">There was an error in retrieving the employees.</p>");
                                }

                                //Done iterating over results, close db connection
                                $db->close();
                            ?>
                    </table>

                </article>
			
			</div>
		</div>
	</div>
<script type="text/javascript" src="searchEmployee.js"></script>
</body>
</html>