//editUserValidation
//almost idenitical to create user but without employee type or manager ID

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

//wrapper function for the description
function bioChecker(event)
{
    var bio = event.currentTarget.value;

    bioChecker2(bio);
}

//validation function
function bioChecker2(bio)
{
    //valid input
    var validInput = true;

    //get message 
    var bioMsg = document.getElementById("bioError");

    //only check if more than 200 chars
    if(bio.length > 200)
    {
        bioMsg.innerHTML = "Bio is too long, must be less than 200 characters";
        validInput = false;
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
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(emailInput))
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

//wrapper function to send password to password validation
function password1Checker(event)
{
    var passwordInput = event.currentTarget.value;

    password1Checker2(passwordInput);
}

//password validation for first password, test length and chars, but not matching
function password1Checker2(passwordInput)
{
     //get the location of the password error message
    var passwordMsg = document.getElementById("password1Error");
    //variable validinput is the return value, determines if the input is valid
    var validInput = true;

    if(passwordInput == "")//determines if the password is empty
    {
        passwordMsg.innerHTML += "You have not entered a password \n";
        validInput = false;
    }
    if((passwordInput.length < 8) && (passwordInput.length > 0))//makes sure password is at least 8 characters
    {
        passwordMsg.innerHTML += "Password needs to be at least 8 characters \n";
        validInput = false;
    }
    if(passwordInput.length > 20)//password maximum length is 20 characters
    {
        passwordMsg.innerHTML += "Password needs to be fewer than 20 characters \n";
        validInput = false; 
    }
    //expression to make sure password has a special character
    if((/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(passwordInput)) == false)
    {
        passwordMsg.innerHTML = "Password needs a special character \n";
        validInput = false;
    }
    //make sure password has an uppercase
    if((/[A-Z]/.test(passwordInput)) == false)
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

//wrapper function to send password2 to validation
function password2Checker(event)
{
    var passwordInput = event.currentTarget.value;

    password2Checker2(passwordInput);
}

//password 2 validation for confirmation, checks password1 and if matches
function password2Checker2(passwordInput)
{
     //get the location of the password error message
     var passwordMsg = document.getElementById("password2Error");
     //variable validinput is the return value, determines if the input is valid
     var validInput = true;

     var password1 = document.getElementsByName("password"); //get the first password
     if(password1Checker2(password1[0].value) == false)//check the first passwrod
     {
        passwordMsg.innerHTML += "Please make sure that both passwords are valid \n";
        validInput = false;
     }
     if(password1 != passwordInput)//check if they match 
     {
        passwordMsg.innerHTML += "Please make sure that both passwords match \n";
        validInput = false;
     }
     if(validInput == true)
     {//resest message
         passwordMsg.innerHTML = "";
     }
     return validInput;//return function value
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

    //password checking
    var password1 = document.getElementsByName("password"); //get the first password
    if((password1Checker2(password1[0].value)) == false)
    {
        event.preventDefault();
    }
    var password2 = document.getElementsByName("confirmPassword");
    if((password2Checker2(password2[0].value)) == false)
    {
        event.preventDefault();
    }

    //check the bio
    var bio = document.getElementsByName("bio");\
    if(bioChecker2(bio[0].value) == false)
    {
        preventDefault();
    }
}