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

var task1Listener = document.getElementsByName("projectMember1Task1");
task1Listener[0].addEventListener("blur", task1Checker, false);

var task2Listener = document.getElementsByName("projectMember1Task2");
task2Listener[0].addEventListener("blur", task2Checker, false);

var task3Listener = document.getElementsByName("projectMember2Task1");
task3Listener[0].addEventListener("blur", task3Checker, false);

var task4Listener = document.getElementsByName("projectMember2Task2");
task4Listener[0].addEventListener("blur", task4Checker, false);

var task5Listener = document.getElementsByName("projectMember3Task1");
task5Listener[0].addEventListener("blur", task5Checker, false);

var task6Listener = document.getElementsByName("projectMember3Task2");
task6Listener[0].addEventListener("blur", task6Checker, false);

var task7Listener = document.getElementsByName("projectMember4Task1");
task7Listener[0].addEventListener("blur", task7Checker, false);

var task8Listener = document.getElementsByName("projectMember4Task2");
task8Listener[0].addEventListener("blur", task8Checker, false);

var deadline1Listener = document.getElementsByName("projectMember1DeadlineTask1");
deadline1Listener[0].addEventListener("change", deadline1Checker, false);

var deadline2Listener = document.getElementsByName("projectMember1DeadlineTask2");
deadline2Listener[0].addEventListener("change", deadline2Checker, false);

var deadline1Listener = document.getElementsByName("projectMember2DeadlineTask1");
deadline3Listener[0].addEventListener("change", deadline1Checker, false);

var deadline2Listener = document.getElementsByName("projectMember2DeadlineTask2");
deadline4Listener[0].addEventListener("change", deadline2Checker, false);

var deadline1Listener = document.getElementsByName("projectMember3DeadlineTask1");
deadline5Listener[0].addEventListener("change", deadline1Checker, false);

var deadline2Listener = document.getElementsByName("projectMember3DeadlineTask2");
deadline6Listener[0].addEventListener("change", deadline2Checker, false);

var deadline1Listener = document.getElementsByName("projectMember4DeadlineTask1");
deadline7Listener[0].addEventListener("change", deadline1Checker, false);

var deadline2Listener = document.getElementsByName("projectMember4DeadlineTask2");
deadline8Listener[0].addEventListener("change", deadline2Checker, false);