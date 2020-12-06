/*
functions for checking form validation for creating and editing users
*/

function fileChecker(event)
{
    var filePathInput = event.currentTarget.value;

    fileChecker2(filePathInput);
}

function fileChecker2(filePathInput)
{
    var filePathMsg = document.getElementById("profilePictureError");

    var validInput = true;

    if(filePathInput != "")
    {
    var allowedExtensions = (filePathInput.toLowerCase()).search(/((.jpg)|(.jpeg)|(.gif)|(.png))$/);
        if(allowedExtensions == -1)
        {
            validInput = false;
            filePathMsg.innerHTML = "This is not a valid file type";
        }
    }
    if(filePathInput.length > 80)
    {
        filePathMsg.innerHTML = "This file path is too long";
    }
    if(validInput == true)
    {
        filePathMsg.innerHTML = "";
    }
    return validInput;
}

function radioChecker(event)
{
    //not sure if this wrapper is needed
    radioChecker2();
}

function radioChecker2()
{
    var managerID = document.getElementById("managerId");
    var validInput = true;
    if((document.getElementById("userTypeEmployee").checked == true) && (document.getElementById("userTypeManager").checked == false))
    {//block managerID
        managerID.disabled = true;
        managerID.readOnly = true;
        managerID.value = "";
        validInput = true;
        //get managerID message and remove errors from there
        var managerIdMsg = document.getElementById("managerIdError");
        managerIdMsg.innerHTML = "";
    }
    if((document.getElementById("userTypeEmployee").checked == false) && (document.getElementById("userTypeManager").checked == true))
    {
        managerID.disabled = false;
        managerID.readOnly = false;   
        validInput = true; //still valid
    }
    var radioMsg = document.getElementById("radioError");
    if((document.getElementById("userTypeEmployee").checked == false) && (document.getElementById("userTypeManager").checked == false))
    {//neither of them are checked
        radioMsg.innerHTML = "Please select a user type";
        validInput = false; //not valid
    }
    if((document.getElementById("userTypeEmployee").checked == true) && (document.getElementById("userTypeManager").checked == true))
    {
        radioMsg.innerHTML = "Please select just one user type";
        validInput = false;
        //should be impossible
    }
    if(validInput == true)
    {
        radioMsg.innerHTML = "";
    }
    return validInput;
}

function managerIdChecker(event)
{
    var managerId = event.currentTarget.value;

    managerIdChecker2(managerId);
}

function managerIdChecker2(managerID)
{
    var managerIdMsg = document.getElementById("managerIdError");

    var validInput = true; 

    if(document.getElementById("userTypeEmployee").checked == true)
    {
        if(managerID != "")
        {
            validInput = false;
            managerIdMsg.innerHTML = "This is an employee, no manager ID needed";
        }
    }
    if((document.getElementById("userTypeEmployee").checked == false) && (document.getElementById("userTypeManager").checked == true))
    {//if employee is not checked and manager is
        if((managerID == "") && (radioChecker2() == true))
        {
            validInput = false;
            managerIdMsg.innerHTML = "Manager ID needed";
        }
    }
    if(validInput == true)
    {
        managerIdMsg.innerHTML = ""
    }

    return validInput;
}

function firstNameChecker(event)
{
    //get first name from the document
    var firstNameInput = event.currentTarget.value;
    firstNameChecker2(firstNameInput);
}

function firstNameChecker2(firstNameInput)
{

    var firstNameMsg = document.getElementById("firstNameError"); 

    var validInput = true;

    if(firstNameInput == "")
    {
        firstNameMsg.innerHTML = "You have not entered a first name";
        validInput = false;
    }
    if(firstNameInput.length > 20)
    {
        firstNameMsg.innerHTML = "This name is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        firstNameMsg.innerHTML = "";
    }
    return validInput;
}

function lastNameChecker(event)
{
    //get first name from the document
    var lastNameInput = event.currentTarget.value;

    lastNameChecker2(lastNameInput);
}

function lastNameChecker2(lastNameInput)
{
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
    return validInput;
}

function emailChecker(event)
{
    var emailInput = event.currentTarget.value;

    emailChecker2(emailInput);
}

function emailChecker2(emailInput)
{
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
    //use an expression to validate the email
    if (!(/^\w+[\w.]*@\w+[.]{1}[a-z]{2,3}$/.test(emailInput)))
    {
        emailMsg.innerHTML = "This is not a valid email";
        validInput = false;
    }
    if(validInput == true)
    {
        emailMsg.innerHTML = "";
    }
    return validInput;
}

function passwordChecker(event)
{
    var passwordInput = event.currentTarget.value;

    passwordChecker2(passwordInput);
}

function passwordChecker2(passwordInput)
{
    var passwordMsg = document.getElementById("passwordError");

    var validInput = true;

    if(passwordInput == "")//determines if the password is empty
    {
        passwordMsg.innerHTML = "You have not entered a password \n";
        validInput = false;
    }
    if((passwordInput.length < 8) && (passwordInput.length > 0))//makes sure password is at least 8 characters
    {
        passwordMsg.innerHTML = "Password needs to be at least 8 characters \n";
        validInput = false;
    }
    if(passwordInput.length >= 20)//password maximum length is 20 characters
    {
        passwordMsg.innerHTML = "Password needs to be fewer than 20 characters \n";
        validInput = false; 
    }
    //expression to make sure password has a special character
    if((/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(passwordInput)) == false && (passwordInput.length >= 8) && (passwordInput.length <= 20))
    {
        passwordMsg.innerHTML = "Password needs a special character \n";
        validInput = false;
    }
    //make sure password has an uppercase
    if((/[A-Z]/.test(passwordInput)) == false && (passwordInput.length >= 8) && (passwordInput.length <= 20))
    {
        passwordMsg.innerHTML = "Password needs an upper case letter \n";
        validInput = false;
    }
    if(validInput == true)//if the input is valid then reset the error message
    {
        passwordMsg.innerHTML = "";
    }
    return validInput;//return the value of the function   
}

function skill1Checker(event)
{
    var skillInput = event.currentTarget.value;

    skill1Checker2(skillInput);
}

function skill1Checker2(skill1Input)
{
    var skillMsg = document.getElementById("skill1Error");

    var validInput = true;

    if(skill1Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
    return validInput;
}

function skill2Checker(event)
{
    var skillInput = event.currentTarget.value;

    skill2Checker2(skillInput);
}

function skill2Checker2(skill2Input)
{
    var skillMsg = document.getElementById("skill2Error");

    var validInput = true;

    if(skill2Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
    return validInput;
}

function skill3Checker(event)
{
    var skillInput = event.currentTarget.value;

    skill3Checker2(skillInput);
}

function skill3Checker2(skill3Input)
{
    var skillMsg = document.getElementById("skill3Error");

    var validInput = true;

    if(skill3Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
    return validInput;
}

function skill4Checker(event)
{
    var skillInput = event.currentTarget.value;

    skill4Checker2(skillInput);
}

function skill4Checker2(skill4Input)
{
    var skillMsg = document.getElementById("skill4Error");

    var validInput = true;

    if(skill4Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
    return validInput;
}

function skill5Checker(event)
{
    var skillInput = event.currentTarget.value;

    skill5Checker2(skillInput);
}

function skill5Checker2(skill5Input)
{
    var skillMsg = document.getElementById("skill5Error");

    var validInput = true;

    if(skill5Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
    return validInput;
}

//prevent default here
function submitChecker(event)
{
    /*
    Checks:
        - picture
        - user type
        - managerID
        - first name
        - last name
        - email
        - password
        - skills (5)
    */

    var profilePicture = document.getElementsByName("profilePicture");
    if ((fileChecker2(profilePicture[0].value)) == false)
    {
        event.preventDefault();
    }

    //if neither checkbox is selected
    if ((document.getElementById("userTypeEmployee").checked == false) && (document.getElementById("userTypeManager").checked == false))
    {
        radioChecker2();
        event.preventDefault();
    }

    //check manager ID
    var managerID = document.getElementById("managerId");
    if((managerIdChecker2(managerId.value)) == false)
    {
        event.preventDefault();
    }

    var firstName = document.getElementsByName("firstName");
    if((firstNameChecker2(firstName[0].value)) == false)
    {
        event.preventDefault();
    }

    var lastName = document.getElementsByName("lastName");
    if((lastNameChecker2(lastName[0].value)) == false)
    {
        event.preventDefault();
    }

    var email = document.getElementsByName("email");
    if((emailChecker2(email[0].value)) == false)
    {
        event.preventDefault();
    }

    var password = document.getElementsByName("password");
    if((passwordChecker2(password[0].value)) == false)
    {
        event.preventDefault();
    }

    var skill1 = document.getElementsByName("skill1");
    if((skill1Checker2(skill1[0].value)) == false)
    {
        event.preventDefault();
    }

    var skill2 = document.getElementsByName("skill2");
    if((skill2Checker2(skill2[0].value)) == false)
    {
        event.preventDefault();
    }
    
    var skill3 = document.getElementsByName("skill3");
    if((skill3Checker2(skill3[0].value)) == false)
    {
        event.preventDefault();
    }

    var skill4 = document.getElementsByName("skill4");
    if((skill4Checker2(skill4[0].value)) == false)
    {
        event.preventDefault();
    }

    var skill5 = document.getElementsByName("skill5");
    if((skill5Checker2(skill5[0].value)) == false)
    {
        event.preventDefault();
    }
}