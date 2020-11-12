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
                                    <td>Project Title: </td><td> <input type="text" name="projectTitle" class="text-input"/></td>
                                    <td>Description: </td><td> <textarea name="projectDescription" id="projectDescription" cols="30" rows="10"></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <table>
                            <tr>
                                <td>Start Date: </td><td> <input type="date" name="startDate"/></td>
                                <td>End Date: </td><td> <input type="date" name="endDate"/></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="skills-container" style="margin-top: 20px";>
                        <table id="members-landing-card">
                            <thead>
                                <tr>
                                    <td class="project-member-input">Project Members</td>
                                    <td class="project-member-input">Task 1</td>
                                    <td class="project-member-input">Deadline</td> 
                                    <td class="project-member-input">Task 2</td>
                                    <td class="project-member-input">Deadline</td>
                                </tr>
                            </thead>
    
                                <tr>
                                    <td><input type="text" name="projectMember1" class="text-input"/></td>
                                    <td><input type="text" name="projectMember1Task1" class="text-input"/></td>
                                    <td><input type="date" name="projectMember1DeadlineTask1"/></td>
                                    <td><input type="text" name="projectMember1Task2" class="text-input"/></td>
                                    <td><input type="date" name="projectMember1DeadlineTask2"/</td>
                                </tr>

                                <tr>
                                    <td><input type="text" name="projectMember2" class="text-input"/></td>
                                    <td><input type="text" name="projectMember2Task1" class="text-input"/></td>
                                    <td><input type="date" name="projectMember2DeadlineTask1"/></td>
                                    <td><input type="text" name="projectMember2Task2" class="text-input"/></td>
                                    <td><input type="date" name="projectMember2DeadlineTask2"/</td>
                                </tr>

                                <tr>
                                    <td><input type="text" name="projectMember3" class="text-input"/></td>
                                    <td><input type="text" name="projectMember3Task1" class="text-input"/></td>
                                    <td><input type="date" name="projectMember3DeadlineTask1"/></td>
                                    <td><input type="text" name="projectMember3Task2" class="text-input"/></td>
                                    <td><input type="date" name="projectMember3DeadlineTask2"/</td>
                                </tr>

                                <tr>
                                    <td><input type="text" name="projectMember4" class="text-input"/></td>
                                    <td><input type="text" name="projectMember4Task1" class="text-input"/></td>
                                    <td><input type="date" name="projectMember4DeadlineTask1"/></td>
                                    <td><input type="text" name="projectMember4Task2" class="text-input"/></td>
                                    <td><input type="date" name="projectMember4DeadlineTask2"/</td>
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