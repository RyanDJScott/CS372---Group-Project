<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search Results</title>
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
                    <li><a href="manager-all-employees.php">See All Employees</a></li>
                    <li><a href="manager-edit-profile.php">Edit Profile</a></li>
                    <li><a href="manager-create-new-project.php">Create New Project</a></li>
                    <li><a href="manager-create-new-user.php">Create New User</a></li>
                    <li><a href="manager-landing.php">Home</a></li>
                </ul>
            </nav>

			<div class="search-card-container">
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
                                    <h2>Search results for  "NodeJS"</h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </header>
                
                <article>
    
                    <table id="search-result-table">
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
                            <tr>
                                <td>Manager</td>
                                <td>Jean</td>
                                <td>Picard</td>
                                <td>I'm Captain Jean Lus Picard of the USS Enterprise. Tea.Earl grey. Hot.</td>
                                <td>picard@starfleet.com</td>
                                <td>
                                    <ul>
                                        <li>Go</li>
                                        <li>NodeJS</li>
                                      </ul>  
                                </td>
                                <td>
                                    <button class="edit-delete-button"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>Manager</td>
                                <td>William</td>
                                <td>Ryker</td>
                                <td>I simp over aliens and play trombone in my free time.</td>
                                <td>ryker@starfleet.com</td>
                                <td>
                                    <ul>
                                        <li>Swift</li>
                                        <li>Kotlin</li>
                                        <li>NodeJS</li>
                                      </ul>  
                                </td>
                                <td>
                                    <button class="edit-delete-button"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Manager</td>
                                <td>Data</td>
                                <td>N/A</td>
                                <td>Spot has been giving me trouble lately. It would be nice to understand him...</td>
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
                                    <button class="edit-delete-button"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                    </table>
            
            </article>
				
			</div>
		</div>
	</div>

</body>
</html>