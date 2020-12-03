# CS372---Group-Project - Devonian Software Development Project Manager
Development of a web application for a hypothetical small software development company

# Live Website URL
http://www2.cs.uregina.ca/~scott23r


# Description
This software serves as an organizational tool for the managers and employees at Devonian Software Development to help manage their tasks within the projects the company has undertaken. In order to better facilitate cooperative work over large distances (due to the current COVID-19 pandemic), this software allows managers to include employees in projects, set them tasks (with deadlines for each task), and describe the overall project details to the team members. Managers are also able to create new employees and managers in the software (as they are hired by the company), edit/update project information, and delete projects or employees from the site.  Employees are able to use this software to see which projects they are currently working on and the details of that project (including tasks, deadlines, and other project members), search for the other employees are at Devonian Software Development, and post information about themselves in their profile so that other employees can get to know them better and see what coding skills they possess.
Software Usage Guide

# Login
The login page is the portal to the project. Access is only granted to those who already have an account made by a pre-existing manager. Employees (or other wayward internet users) cannot sign up freely for a membership to this web application.

# Manager Landing Page
Upon logging in, the landing page will show a list of projects. For managers, it’s a comprehensive list of all on-going projects (ordered by closest deadline first). Managers are also able to directly edit or delete projects from this page. Please use the delete button with caution; the project information will be permanently lost once the delete button is used. 

# Edit Project
When a manager is editing a project, any field that has invalid data will be flagged with a JavaScript error message. Submission of the data will be blocked until the manager enters a valid set of data within the appropriate data fields. The rules for submission are as follows:

Project Title, Project Description, Start Date, and End Date must not be left blank. 
The start date must be before the end date.
The project manager field must not be blank. An AJAX implementation of fetching manager names has been added to this field; simply start typing the name of a manager and a text bubble will appear with all viable candidates matching that name. Click the name you wish to enter, and it will be inserted into the text field. This search will never contain employee names.
A project may contain no members, which can be added at a later date.
A project may contain members with no tasks/deadlines. They may be added at a later date. An AJAX implementation of fetching employee names has been added to each project member field; simply start typing the name of an employee and a text bubble will appear with all viable candidates matching that name. Click the name you wish to enter, and it will be inserted into the text field. This search will never contain manager names.
A project that contains members and tasks must also be accompanied with a deadline, and vice-versa. Each deadline must be within the given project time frame.


# Employee Landing Page
For employees, only the projects the employee is directly involved in (as a team member) will appear on the landing page. They will not have the ability to edit or delete projects; they can only view the project information. As you can see, the landing page navigation bar is simpler for employees, as they have limited capabilities within the web application.

# Create New User
Managers have the ability to create new users. A manager need only supply the user's first name, last name, email, and password (and manager ID if they are adding a manager) to successfully add a user to the system. All other fields may be left blank, as the user can edit those fields at a later date with up-to-date information. JavaScript validation has been added to ensure all input fields contain valid data:

The profile picture may be left blank. If not, it must be a .jpg, .jpeg, .gif, or .png file and less than 2 MB in size. If the file exists in the DB, the file upload will be blocked.
If a manager is being created, it must be accompanied by a manager ID. If an employee is being created, this field will be blanked out and disabled from user input.
The first name and last name must not be blank or exceed 20 characters.
The email must be a valid email address.
The password must be between 8 - 20 characters long, contain one capital letter, and 1 non-word character.
Skills must be between 0 and 10 characters long.

# Create New Project
Managers can also create new projects as needed. Any field that has invalid data will be flagged with a JavaScript error message. Submission of the data will be blocked until the manager enters a valid set of data within the appropriate data fields. The rules for successfully submitting a new project to the database are as follows:

Project Title, Project Description, Start Date, and End Date may not be left blank. 
The start date must be before the end date.
A project may contain no members, which can be added at a later date.
A project may contain members with no tasks/deadlines. They may be added at a later date.They may be added at a later date. An AJAX implementation of fetching employee names has been added to each project member field; simply start typing the name of an employee and a text bubble will appear with all viable candidates matching that name. Click the name you wish to enter, and it will be inserted into the text field. This search will never contain manager names.
A project that contains members and tasks must also be accompanied with a deadline, and vice-versa. Each deadline must be within the given project time frame.


# Edit Profile
All users have the option to edit their profile such that their information is up-to-date. In addition to the validation rules listed for creating a new user, the following validation rules also apply:

The bio field must not be longer than 200 characters. A character counter has been implemented to help you stay within the limits.
The new password and confirm password fields (if you are changing your password) must conform to a proper password. In addition, both fields must contain identical passwords.




The Search employees page allows users to search the company database based on skill; simply type the name of the coding language you wish to search for and each employee that possesses that coding skill will be dynamically loaded on the page. Delete the text from this field to reset the search page back to all employees.

# Tech Stack/Framework
This web application was created using the following coding languages and frameworks:

HTML/CSS - User Interface 
JavaScript - Form validation
PHP - Backend security, data manipulation, and database communication.
mySQL - Database creation
AJAX - Dynamic search page and dynamic field input for create/edit project.

Note: We advise that javaScript be enabled while using this web application. The application has been coded such that all validation will be performed in PHP; however helpful dynamic features will be lost when javaScript is disabled.

# Authors and Acknowledgement
This project was created by: Ryan Scott, Nathan Slaney and Leanne Chung.

# Project Status
This web application is updated to version 1.0.
