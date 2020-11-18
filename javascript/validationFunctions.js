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
    return validInput;
}

function radioChecker(event)
{
    //not sure if this wrapper is needed
    radioChecker2();
}

function radioChecker2()
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

    managerIdChecker2(managerID);
}

function managerIdChecker2(managerId)
{
    var managerIdMsg = document.getElementById("ManagerIdError");

    var validInput = true; 

    if(document.getElementById("userTypeEmployee").checked == true)
    {
        if(managerID != "")
        {
            validInput = false;
            managerIdMsg.innerHTML = "This is an employee, no manager ID needed";
        }
    }
    if(document.getElementById("userTypeEmployee").checked == false)
    {
        if(managerID == "")
        {
            validInput = false;
            managerIdMsg.innerHTML = "Manager ID needed";
        }
    }
    return validInput;
}

function firstNameChecker(event)
{
    console.log("entered the function");
    //get first name from the document
    var firstNameInput = event.currentTarget.value;
    firstNameChecker2(firstNameInput);
}

function firstNameChecker2(firstNameInput)
{
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
    return validInput;
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

    if(skill1Input == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skill1Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
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

    if(skill2Input == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skill2Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
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

    if(skill3Input == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skill3Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
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

    if(skill4Input == "")
    {
        skillMsg.innerHTML = "This skill is empty";
        validInput = false;
    }
    if(skill4Input.length > 10)
    {
        skillMsg.innerHTML = "This skill is too long";
    }
    if(validInput == true)
    {
        skillMsg.innerHTML = "";
    }
    return validInput;
}

