//index validation listeners

//listen for a blur of email
var emailListener = document.getElementsByName("email");
emailListener[0].addEventListener("blur", emailChecker, false);

//listen for a blur on password
var passwordListener = document.getElementsByName("pass");
passwordListener[0].addEventListener("blur", passwordChecker, false);

//make sure that others are valid when the form is submitted
var submitListener = document.getElementById("indexSubmitForm");
submitListener.addEventListener("submit", submitChecker, false);