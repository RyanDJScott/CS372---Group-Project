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

function fileChecker(event)
{
    var filePathInput = event.currentTarget.value;

    var filePathMsg = document.getElementById("profilePictureError");

    var validInput = true;

    if(filePathInput != "")
    {
    var allowedExtensions = filePathInput.search(/((.jpg)|(.jpeg)|(.gif)|(.png))$/);
        if(allowedExtensions == -1)
        {
            validInput = false;
            filePathMsg.innerHTML = "This is not a valid file type";
        }
    }
    if(filePathInput == "")
    {
        filePathMsg.innerHTML = "Please select a file";
        validInput = false;
    }
    if(filePathInput.length > 30)
    {
        filePathMsg.innerHTML = "This file path is too long";
    }
    if(validInput == true)
    {
        filePathMsg.innerHTML = "";
    }
}

function radioChecker(event)
{
    console.log(document.getElementsByName("userType"));
    var managerID = document.getElementById("managerId");
    if(document.getElementById("userTypeEmployee").checked == true)
    {//block managerID
        console.log("employee true");
        managerID.disabled = true;
        managerID.readOnly = true;
        managerID.value = "";
    }
    if(document.getElementById("userTypeEmployee").checked == false)
    {
        managerID.disabled = false;
        managerID.readOnly = false;   
    }
}

function managerIdChecker(event)
{
    var managerId = event.currentTarget.value;

    var managerIdMsg = document.getElementById("ManagerIdError");

    var validInput = true; 
}

function firstNameChecker(event)
{
    console.log("entered the function");
    //get first name from the document
    var firstNameInput = event.currentTarget.value;
    console.log(firstNameInput);

    var firstNameMsg = document.getElementById("firstNameError"); 

    var validInput = true;

    if(firstNameInput == "")
    {
        console.log("triggered empty")
        firstNameMsg.innerHTML = "You have not entered a first name";
        validInput = false;
    }
    if(firstNameInput.length > 20)
    {
        console.log("Triggered too many chars");
        firstNameMsg.innerHTML = "This name is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        console.log("valid input")
        firstNameMsg.innerHTML = "";
    }
}

function lastNameChecker(event)
{
    //get first name from the document
    var lastNameInput = event.currentTarget.value;

    var lastNameMsg = document.getElementById("lastNameError"); 

    var validInput = true;

    if(lastNameInput == "")
    {
        lastNameMsg.innerHTML = "You have not entered a last name";
        validInput = false;
    }
    if(lastNameInput.length > 20)
    {
        lastNameMsg.innerHTML = "This name is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        lastNameMsg.innerHTML = "";
    }   
}

function emailChecker(event)
{
    var emailInput = event.currentTarget.value;

    var emailMsg = document.getElementById("emailError");

    var validInput = true;

    if(emailInput == "")
    {
        emailMsg.innerHTML = "You have not entered an email";
        validInput = false;
    }
    if(emailInput.length > 50)
    {
        emailMsg.innerHTML = "This email is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        emailMsg.innerHTML = "";
    }
}

function passwordChecker(event)
{
    var passwordInput = event.currentTarget.value;

    var passwordMsg = document.getElementById("passwordError");

    var validInput = true;

    if(passwordInput == "")
    {
        passwordMsg.innerHTML = "You have not entered a password";
        validInput = false;
    }
    if(passwordInput.length > 20)
    {
        passwordMsg.innerHTML = "Please enter a valid password";
        validInput = false; 
    }
    if(validInput == true)
    {
        passwordMsg.innerHTML = "";
    }
}

function skill1Checker(event)
{
    var skillInput = event.currentTarget.value;

    var skillMsg = document.getElementById("skill1Error");

    var validInput = true;

    if(skillInput == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skillInput.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
}

function skill2Checker(event)
{
    var skillInput = event.currentTarget.value;

    var skillMsg = document.getElementById("skill2Error");

    var validInput = true;

    if(skillInput == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skillInput.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
}

function skill3Checker(event)
{
    var skillInput = event.currentTarget.value;

    var skillMsg = document.getElementById("skill3Error");

    var validInput = true;

    if(skillInput == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skillInput.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
}

function skill4Checker(event)
{
    var skillInput = event.currentTarget.value;

    var skillMsg = document.getElementById("skill4Error");

    var validInput = true;

    if(skillInput == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skillInput.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
}


// /* 
// 1. email
// - checks the email for entry on login and employee creation
// */ 
// function emailChecker(event)
// {
//     //get email value from form input
//     var emailInput = document.getElementByName("email").value;

//     //get error message area for DOM manipulation
//     //how to access in form versus in table?
//     //seperate functions are possible, but lack reusbaility, helpppp
//     var emailMsg = document.getElementsByName("").value;
    
//     //reset this to be blank
//     emailMsg.innerHTML = "";

//     //email regular expression
//     var emailReg = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

//     //use variable to determine if form should be submitted
//     //defaults to true, but any invalid input will change to false
//     var validInput = true; 

//     //check if empty and add to error message
//     if(emailInput == NULL || emailInput == "")
//     {
//         emailMsg.innerHTML = "You have not provided an email address!";
//         validInput = false;
//     }

//     //check if too long and add to the error message
//     //database requires emails to be less than 50 characters
//     if(emailInput.length > 50)
//     {
//         emailMsg.innerHTML = "\n Your email address is too long. ";
//         validInput = false;
//     }

//     //use regular expression variable to test if input conforms
//     if(!emailReg.test(emailInput))
//     {
//         emailMsg.innerHTML = "\n Your email address is not valid. ";
//         validInput = false;
//     }

//     //if valid input is false, prevent submition
//     if(validInput == false)
//     {
//         event.preventDefault();
//     }
// }

// /*
// 2. password
// - checks password on login and employee
// */
// function passwordChecker(event)
// {
//     //get password input from page
//     var passwordInput = document.getElementByName("pass");

//     //get the area to put the error
//     var passwordMsg = document.getElementByName("");
//     passwordMsg.innerHTML = ""; //reset if anything currently there

//     //will prevent form submission if needed
//     var validInput = true;

//     //is regular expression needed for password?
//     /*
//     potential code if so:
//     var passwordReg = /^(\S*)?\d+(\S*)?$/;

//     if (!passwordReg.test(passwordInput))
//     {
//         passwordMsg.innerHTML += "Please enter a valid email";
//         validInput = false;
//     }
//     */

//     //check if password is empty
//     if(passwordInput == "" || passwordInput == NULL)
//     {
//         passwordMsg.innerHTML += "Please enter a password"
//         validInput = false;
//     }

//     //check if password is too long
//     if(passwordInput.length > 20) //database specifies 20 characters
//     {
//         passwordMsg.innerHTML += "\n this password is too long";
//         validInput = false;
//     }

//     if(validInput == false)
//     {
//         event.preventDefault(); 
//     }

// }

// /* 
// 3. file upload
// VARCHAR(30) for URL
// */
// function pictureChecker(event)
// {
//     var filePath = document.getElementByName("profilePicture").value;

//     var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i; 

//     var fileMsgParent = document.getElementByName("profilePicture");

//     var validInput = true;

//     if(!allowedExtensions.exec(filePath))
//     {
//         var badExtension = "This is an invalid filetype";
//         //this should append it as a new <p> just after the sile upload input button
//         fileMsgParent.appendChild(badExtension);
//         validInput = false;
//     }
//     if(filePath == "" || filePath == NULL)
//     {
//         var noFilePath  = "You have no uploaded a file";
//         fileMsgParent.appendChild(noFilePath);
//         validInput = false;
//     }
//     if(validInput == true)
//     {
//         //no errors found, reset old errors
//         while(fileMsgParent.hasChildNodes() == true)
//         {
//             fileMsgParent.removeChild();
//         }
//     }
// }

// /*
// 4. Name
// */
// function firstNameChecker(event)
// {
//     //get first name from the document
//     var firstNameInput = document.getElementByName("firstName").value;

//     var firstNameMsgParent = document.getElementByName("firstName"); 

//     var validInput = true;

//     if(firstNameInput == "" || firstNameInput == NULL)
//     {
//         var noFirstName = "You have not entered a first name";
//         firstNameMsgParent.appendChild(noFirstName);
//         validInput = false;
//     }
//     if(firstNameInput.length > 20)
//     {
//         var firstNameLength = "This name is too long";
//         firstNameMsgParent.appendChild(firstNameLength);
//         validInput = false;
//     }
//     if(validInput == true)
//     {
//         while(fileMsgParent.hasChildNodes() == true)
//         {
//             fileMsgParent.removeChild();
//         }
//     }
// }

// /*
// 5. skill
// */

// /*
// 6. project title
// */

// /*
// 7. description
// */
// function descriptionChecker(event)
// {
//     //var descriptionInput = document.getElementByName("");
// }

// /*
// 8. dates
// */

// /*
// 9. project members
// */

// /*
// 10. user type
// */

// /*
// 11. project delete confirmation
// */

// /*
// event listeners
// Some notes:
// - current index.html file does not have IDs, just classes, so event listeners
//   are janky and won't work on older browsers (before IE8)
// - some event listeners will use "name" attribute instead of class, just using 
//   what was avaialble, if there's any changes needed, let me know, I'll explain
//   everything I can with inline documentation as well
// */

// //for index.html
// //not sure how this will work if multiple pages are linked to this
// //and more than one inputs with the name "email" are being accessed at once
// document.getElementByName("email").addEventListener("change", emailChecker);
// document.getElementByName("pass").addEventListener("change", passwordChecker);
// //

// //manager-create-new-user
// document.getElementByName("firstName").addEventListener("change", firstNameChecker);
// document.getElementByName("lastName").addEventListener("change", lastNameChecker);

