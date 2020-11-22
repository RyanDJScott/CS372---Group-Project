//event listeners for editUserValidation functions

var fileListener = document.getElementsByName("profilePicture"); 
fileListener[0].addEventListener("change", fileChecker, false); 

var toListen = document.getElementsByName("firstName");
toListen[0].addEventListener("blur", firstNameChecker, false);

var lastNameListener = document.getElementsByName("lastName");
lastNameListener[0].addEventListener("blur", lastNameChecker, false);

var emailListener = document.getElementsByName("email");
emailListener[0].addEventListener("blur", emailChecker, false);

var passwordListener = document.getElementsByName("password");
passwordListener[0].addEventListener("blur", passwordChecker, false);

var skill1Listener = document.getElementsByName("skill1");
skill1Listener[0].addEventListener("blur", skill1Checker, false); 

var skill2Listener = document.getElementsByName("skill2");
skill2Listener[0].addEventListener("blur", skill2Checker, false);

var skill3Listener = document.getElementsByName("skill3");
skill3Listener[0].addEventListener("blur", skill3Checker, false);

var skill4Listener = document.getElementsByName("skill4");
skill4Listener[0].addEventListener("blur", skill4Checker, false);

var submitListener = document.getElementById("submitForm");
submitListener.addEventListener("submit",submitChecker, false);