<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create New User</title>
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
                    <li><a href="manager-edit-project.php">Edit Project</a></li>
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
                                    <td>Profile Picture: </td><td> <input type="file" name="profilePicture" class="custom-file-input" /></td>
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
                                    
                                    <td>Manager ID: </td><td> <input type="text" name="managerId" size="20" class="text-input"/></td>
                                </tr>
    
                                <tr>
                                    <td>First Name: </td><td> <input type="text" name="firstName" size="30" class="text-input"/></td>
                                    <td>Last Name: </td><td> <input type="text" name="lastName" size="30" class="text-input"/></td>
                                </tr>
    
                                <tr>
                                    <td>Email: </td><td> <input type="text" name="email" size="30" class="text-input"/></td>
                                    <td>Password: </td><td> <input type="text" name="password" size="30" class="text-input"/></td>
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
                                <td></td><td> <input type="text" name="skill3" size="30" class="text-input"/></td>
                                <td></td><td> <input type="text" name="skill4" size="30" class="text-input"/></td>
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