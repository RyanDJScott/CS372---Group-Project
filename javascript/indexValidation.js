//index validation

//wrapper function that gets the email from the event listener
function emailChecker(event)
{
    var emailInput = event.currentTarget.value;
    //sends the email to validation function to get errors
    emailChecker2(emailInput);
}

//validation function for email
function emailChecker2(emailInput)
{
    //get the location of the error message on the page
    var emailMsg = document.getElementById("emailError");

    //variable validinput is the return value, determines if the input is valid
    var validInput = true;

    if(emailInput == "")//checks if email is empty
    {
        emailMsg.innerHTML = "You have not entered an email";
        validInput = false;
    }
    if(emailInput.length > 50)//checks if email is longer than what the database will allow
    {
        emailMsg.innerHTML = "This email is too long";
        validInput = false;
    }
    //use an expression to validate the email
    if ((/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(emailInput)) == false)
    {
        emailMsg.innerHTML = "This is not a valid email";
        validInput = false;
    }
    if(validInput == true)//if the input is valid, reset the error message
    {
        emailMsg.innerHTML = "";
    }
    return validInput;//return the value of the function
}

//password wrapper function
function passwordChecker(event)
{
    //get password from the event
    var passwordInput = event.currentTarget.value;
    //send the password to the valdiation function
    passwordChecker2(passwordInput);
}

//password valdiaiton function
function passwordChecker2(passwordInput)
{
    //get the location of the password error message
    var passwordMsg = document.getElementById("passwordError");
    //variable validinput is the return value, determines if the input is valid
    var validInput = true;

    if(passwordInput == "")//determines if the password is empty
    {
        passwordMsg.innerHTML = "You have not entered a password";
        validInput = false;
    }
    if(passwordInput.length > 20)//password maximum length is 20 characters
    {
        passwordMsg.innerHTML = "Please enter a valid password";
        validInput = false; 
    }
    //expression to make sure password has a special character
    if((/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(passwordInput)) == false)
    {
        passwordMsg.innerHTML = "Please enter a valid password";
        validInput = false;
    }
    //make sure password has an uppercase
    if((/[A-Z]/.test(passwordInput)) == false)
    {
        passwordMsg.innerHTML = "Please enter a valid password";
        validInput = false;
    }
    if(validInput == true)//if the input is valid then reset the error message
    {
        passwordMsg.innerHTML = "";
    }
    return validInput;//return the value of the function
}

//submit validation, called on submit
function submitChecker(event)
{
    //get email input value
    var email = document.getElementsByName("email");
    if((emailChecker2(email[0].value)) == false)//send to email validation function
    {
        //if the input fails validation, prevent the submission of the form
        event.preventDefault();
    }

    //get the password input value
    var pass = document.getElementsByName("pass");
    if((passwordChecker2(pass[0].value)) == false)//send to password validation function
    {
        //if the input fails validation, prevent the submission of the form
        event.preventDefault();
    }
}