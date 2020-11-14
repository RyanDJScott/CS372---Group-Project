/* 
These functions use event listeners and get data from the input forms, they check to make sure the information is to our
desired specification.
Most of this code is taken from 215 
Pages for which this affects:
- index.php
    -> email & password
- manager-landing.php
    -> delete project confirmation
- manager-edit-profile.php
    -> file, name, email, skills
- manager-edit-project.php
    -> project title, description, start & end date, project members 
- manager-create-new-user.php
    -> file, user type, name, email, skills
- manager-create-new-project.php
    -> project title, description, start & end date, project members 
- employee-edit-profile.php
    -> file, name, email, skills


parent = document.getelementbyname();
parent.appendChild(new_child);
use this to get a new tag for DOM manip
then if it works use the same process to get rid of the error message
*/

/* 
1. email
- checks the email for entry on login and employee creation
*/ 
function emailChecker(event)
{
    //get email value from form input
    var emailInput = document.getElementByName("email").value;

    //get error message area for DOM manipulation
    //how to access in form versus in table?
    //seperate functions are possible, but lack reusbaility, helpppp
    var emailMsg = document.getElementsByName("").value;
    
    //reset this to be blank
    emailMsg.innerHTML = "";

    //email regular expression
    var emailReg = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    //use variable to determine if form should be submitted
    //defaults to true, but any invalid input will change to false
    var validInput = true; 

    //check if empty and add to error message
    if(emailInput == NULL || emailInput == "")
    {
        emailMsg.innerHTML = "You have not provided an email address!";
        validInput = false;
    }

    //check if too long and add to the error message
    //database requires emails to be less than 50 characters
    if(emailInput.length > 50)
    {
        emailMsg.innerHTML = "\n Your email address is too long. ";
        validInput = false;
    }

    //use regular expression variable to test if input conforms
    if(!emailReg.test(emailInput))
    {
        emailMsg.innerHTML = "\n Your email address is not valid. ";
        validInput = false;
    }

    //if valid input is false, prevent submition
    if(validInput == false)
    {
        event.preventDefault();
    }
}

/*
2. password
- checks password on login and employee
*/
function passwordChecker(event)
{
    //get password input from page
    var passwordInput = document.getElementByName("pass");

    //get the area to put the error
    var passwordMsg = document.getElementByName("");
    passwordMsg.innerHTML = ""; //reset if anything currently there

    //will prevent form submission if needed
    var validInput = true;

    //is regular expression needed for password?
    /*
    potential code if so:
    var passwordReg = /^(\S*)?\d+(\S*)?$/;

    if (!passwordReg.test(passwordInput))
    {
        passwordMsg.innerHTML += "Please enter a valid email";
        validInput = false;
    }
    */

    //check if password is empty
    if(passwordInput == "" || passwordInput == NULL)
    {
        passwordMsg.innerHTML += "Please enter a password"
        validInput = false;
    }

    //check if password is too long
    if(passwordInput.length > 20) //database specifies 20 characters
    {
        passwordMsg.innerHTML += "\n this password is too long";
        validInput = false;
    }

    if(validInput == false)
    {
        event.preventDefault(); 
    }

}

/* 
3. file upload
VARCHAR(30) for URL
*/
function pictureChecker(event)
{
    var filePath = document.getElementByName("profilePicture").value;

    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i; 

    var fileMsgParent = document.getElementByName("profilePicture");

    var validInput = true;

    if(!allowedExtensions.exec(filePath))
    {
        var badExtension = "This is an invalid filetype";
        //this should append it as a new <p> just after the sile upload input button
        fileMsgParent.appendChild(badExtension);
        validInput = false;
    }
    if(filePath == "" || filePath == NULL)
    {
        var noFilePath  = "You have no uploaded a file";
        fileMsgParent.appendChild(noFilePath);
        validInput = false;
    }
    if(validInput == true)
    {
        //no errors found, reset old errors
        while(fileMsgParent.hasChildNodes() == true)
        {
            fileMsgParent.removeChild();
        }
    }
}

/*
4. Name
*/
function firstNameChecker(event)
{
    //get first name from the document
    var firstNameInput = document.getElementByName("firstName").value;

    var firstNameMsgParent = document.getElementByName("firstName"); 

    var validInput = true;

    if(firstNameInput == "" || firstNameInput == NULL)
    {
        var noFirstName = "You have not entered a first name";
        firstNameMsgParent.appendChild(noFirstName);
        validInput = false;
    }
    if(firstNameInput.length > 20)
    {
        var firstNameLength = "This name is too long";
        firstNameMsgParent.appendChild(firstNameLength);
        validInput = false;
    }
    if(validInput == true)
    {
        while(fileMsgParent.hasChildNodes() == true)
        {
            fileMsgParent.removeChild();
        }
    }
}

/*
5. skill
*/

/*
6. project title
*/

/*
7. description
*/
function descriptionChecker(event)
{
    //var descriptionInput = document.getElementByName("");
}

/*
8. dates
*/

/*
9. project members
*/

/*
10. user type
*/

/*
11. project delete confirmation
*/

/*
event listeners
Some notes:
- current index.html file does not have IDs, just classes, so event listeners
  are janky and won't work on older browsers (before IE8)
- some event listeners will use "name" attribute instead of class, just using 
  what was avaialble, if there's any changes needed, let me know, I'll explain
  everything I can with inline documentation as well
*/

//for index.html
//not sure how this will work if multiple pages are linked to this
//and more than one inputs with the name "email" are being accessed at once
document.getElementByName("email").addEventListener("change", emailChecker);
document.getElementByName("pass").addEventListener("change", passwordChecker);
//

//manager-create-new-user
document.getElementByName("firstName").addEventListener("change", firstNameChecker);
document.getElementByName("lastName").addEventListener("change", lastNameChecker);