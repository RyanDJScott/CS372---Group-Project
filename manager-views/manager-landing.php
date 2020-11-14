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
                                    <img src="../assets/images/emptypic.png" alt="PlaceHolder Pic" width="80px" height="80px"> 
                                </td>
                                <td>
                                    <h2>Manager Name</h2> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>           
            </div>
            
            <!-- card to display per project on landing page, replicate for projects needed -->
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
                                <td class="project-title">Karasuno team website</td>
                                <td>Create team website so players can access stats and calendar for upcoming season.</td>
                                <td>07-02-2020</td>
                                <td>09-05-2020</td>
                                <td>
                                    <button class="edit-delete-button"><i class="fa fa-edit"></i></button>
                                    <button class="edit-delete-button"><i class="fa fa-trash"></i></button>
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
                                <td>Daichi Sawamura</td>
                                <td>Come up with development model for site.</td>
                                <td>07-02-2020</td>
                                <td>Create ERD for player stats and upcoming games. </td>
                                <td>07-05-2020</td>
                            </tr>

                            <tr>
                                <td>Koushi Sugawara</td>
                                <td>Create UI using Angular.</td>
                                <td>07-27-2020</td>
                                <td>Implement database based on Daichi's ERD. </td>
                                <td>07-15-2020</td>
                            </tr>

                            <tr>
                                <td>Shoyo Hinata</td>
                                <td>Find/create good action shots for the site.</td>
                                <td>07-10-2020</td>
                            </tr>
                    </table>
                </article>
            </div>
            <!-- end of landing card -->

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
                                <td class="project-title">Nekoma iOS App</td>
                                <td>Create team app for stats and information reagarding upcoming games.</td>
                                <td>07-02-2020</td>
                                <td>07-05-2020</td>
                                <td>
                                    <button class="edit-delete-button"><i class="fa fa-edit"></i></button>
                                    <button class="edit-delete-button"><i class="fa fa-trash"></i></button>
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
                                <td>Kenma Kozume</td>
                                <td>Implement the app using SwiftUI and reactive programming.</td>
                                <td>07-02-2020</td>
                                <td>Test implementation.</td>
                                <td>07-05-2020</td>
                            </tr>

                            <tr>
                                <td>Kuroo Tetsurou</td>
                                <td>Create mocks of the app on Adobe XD</td>
                                <td>07-27-2020</td>
                                <td>Find and create graphics for the app.</td>
                                <td>07-15-2020</td>
                            </tr>

                    </table>
                </article>
            </div>


        </div>
    </div>

</body>
</html>