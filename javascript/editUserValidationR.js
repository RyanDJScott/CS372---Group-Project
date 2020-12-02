//event listeners for editUserValidation functions

//listener for file input
var fileListener = document.getElementsByName("profilePicture"); 
fileListener[0].addEventListener("change", fileChecker, false); 

//listener for first name
var toListen = document.getElementsByName("firstName");
toListen[0].addEventListener("blur", firstNameChecker, false);

//listener for last name
var lastNameListener = document.getElementsByName("lastName");
lastNameListener[0].addEventListener("blur", lastNameChecker, false);

//listener for email
var emailListener = document.getElementsByName("email");
emailListener[0].addEventListener("blur", emailChecker, false);

//password event lisiteners
var password1Listener = document.getElementsByName("password");
password1Listener[0].addEventListener("blur", password1Checker, false);

var password2Listener = document.getElementsByName("confirmPassword");
password2Listener[0].addEventListener("blur", password2Checker, false);

//skills listeners below
var skill1Listener = document.getElementsByName("skill1");
skill1Listener[0].addEventListener("blur", skill1Checker, false); 

var skill2Listener = document.getElementsByName("skill2");
skill2Listener[0].addEventListener("blur", skill2Checker, false);

var skill3Listener = document.getElementsByName("skill3");
skill3Listener[0].addEventListener("blur", skill3Checker, false);

var skill4Listener = document.getElementsByName("skill4");
skill4Listener[0].addEventListener("blur", skill4Checker, false);

var skill5Listener = document.getElementsByName("skill5");
skill5Listener[0].addEventListener("blur", skill5Checker, false);

var submitListener = document.getElementById("submitForm");
submitListener.addEventListener("submit",submitChecker, false);