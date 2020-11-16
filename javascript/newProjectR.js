//event listeners for creating a new project

console.log("JavaScript Event Listeners Active")

var titleListener = document.getElementsByName("projectTitle");
titleListener[0].addEventListener("blur", titleChecker, false);

var descriptionListener = document.getElementsByName("projectDescription");
descriptionListener[0].addEventListener("blur", descriptionChecker, false);

var startDateListener = document.getElementsByName("startDate");
startDateListener[0].addEventListener("change", startDateChecker, false);

var endDateListener = document.getElementsByName("endDate");
endDateListener[0].addEventListener("change", endDateChecker, false);

var member1Listener = document.getElementsByName("projectMember1");
member1Listener[0].addEventListener("blur", member1Checker, false);

var member2Listener = document.getElementsByName("projectMember2");
member2Listener[0].addEventListener("blur", member2Checker, false);

var member3Listener = document.getElementsByName("projectMember3");
member3Listener[0].addEventListener("blur", member3Checker, false);

var member4Listener = document.getElementsByName("projectMember4");
member4Listener[0].addEventListener("blur", member4Checker, false);