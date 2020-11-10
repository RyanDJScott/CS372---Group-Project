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
                    <li><a href="employee-all-employees.php">See All Employees</a></li>
                    <li><a href="employee-edit-profile.php">Edit Profile</a></li>
                    <li><a href="employee-landing.php">Home</a></li>
                </ul>

                
            </nav>

			<div class="employee-search-card-container">

                <header>
                    <div class="search-bar-container">
                        <form class="search-bar" action="employee-search-results.php">
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
    
                    <table id="example" class="dataTable" >
                        <thead>
                            <tr>
                                <th>User Type</th> 
                                <th>First Name</th>
                                <th>Last Name</th> 
                                <th>Email</th> 
                                <th>Skills</th>
                            </tr>
                        </thead>
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
                            </tr>
                    </table>

                </article>
			
			</div>
		</div>
	</div>

</body>
</html>