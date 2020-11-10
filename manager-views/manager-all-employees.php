<!DOCTYPE html>
<html lang="en">
<head>
	<title>All Employees</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/helper.css">
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
                        <form align="right" name="form1" method="post" action="logout.php">
                            <input class="logout-button" name="submit2" type="submit" id="submit2" value="Logout" >
                        </form>
                    </li>
                    <li><a href="manager-all-employees.html">See All Employees</a></li>
                    <li><a href="manager-edit-profile.html">Edit Profile</a></li>
                    <li><a href="manager-edit-project.html">Edit Project</a></li>
                    <li><a href="manager-create-new-project.html">Create New Project</a></li>
                    <li><a href="manager-create-new-user.html">Create New User</a></li>
                    <li><a href="manager-landing.html">Home</a></li>
                </ul>
            </nav>

			<div class="manager-all-employees-card-container">
                <header>
                    <div class="search-bar-container">
                        <form class="search-bar" action="manager-search-results.html">
                            <input type="text" placeholder="Search.." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
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
    
                    <table>
                        <thead>
                            <tr>
                                <th>User Type</th> 
                                <th>First Name</th> 
                                <th>Last Name</th> 
                                <th>Email</th>
                                <th>Skills</th>
                            </tr>
                        </thead>

                        <!-- <?php
                            $db = mysqli_connect("localhost", "root", "", "cs-372-database");

                            if ($connection-> connect_error) {
                                die("Connection failed:".$db-> connect_error);
                            }

                            $sql = "SELECT userType, firstName, lastName, email, contract, skills from Employee";
                            $result = $db-> query($sql);

                            if($result-> num_rows > 0) {
                                while ($row = $result-> fetch_assoc()) {
                                    echo "<tr><td>". $row["userType"] ."
                                         </td><td>". $row["firstName"] ."
                                         </td><td>". $row["lastName"] ."
                                         </td><td>". $row["email"] ."
                                         </td><td>". $row["skills"] ."
                                         </td><td>"<button class="delete-button"><i class="fa fa-trash"></i></button>"
                                         </td></tr>";
                                }

                                echo "</table>"; 
                            } else {
                                echo "0 results"; 
                            }

                            // include some logic to delete row/project upon selecting trash can

                            $db-> close();
                        ?> -->
                        
                            <tr>
                                <td>Manager</td>
                                <td>Jean</td>
                                <td>Picard</td>
                                <td>picard@starfleet.com</td>
                                <td>
                                    <ul>
                                        <li>Go</li>
                                        <li>NodeJS</li>
                                      </ul>  
                                </td>
                                <td>
                                    <button class="delete-button"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>Manager</td>
                                <td>William</td>
                                <td>Ryker</td>
                                <td>ryker@starfleet.com</td>
                                <td>
                                    <ul>
                                        <li>Swift</li>
                                        <li>Kotlin</li>
                                        <li>NodeJS</li>
                                      </ul>  
                                </td>
                                <td>
                                    <button class="delete-button"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Manager</td>
                                <td>Data</td>
                                <td>N/A</td>
                                <td>data@starfleet.com</td>
                                <td>
                                    <ul>
                                        <li>C++</li>
                                        <li>C</li>
                                        <li>Machine Code</li>
                                        <li>NodeJS</li>
                                      </ul>  
                                </td>
                                <td>
                                    <button class="delete-button"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Employee</td>
                                <td>Geordi</td>
                                <td>La Forge</td>
                                <td>geordi@starfleet.com</td>
                                <td>
                                    <ul>
                                        <li>ARM</li>
                                      </ul>  
                                </td>
                                <td>
                                    <button class="delete-button"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                    </table>
            
            </article>
				
			</div>
		</div>
	</div>

</body>
</html>