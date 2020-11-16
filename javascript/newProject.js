//validation functions for new project page

function titleChecker(event)
{
    console.log("titleChecker entered")
    //not empty, not too big
    
    //get input
    var titleInput = event.currentTarget.value;

    titleChecker2(titleInput);
}

function titleChecker2(title)
{
    //error message location
    var titleMsg = document.getElementById("projectTitleError");

    var validInput = true;

    if(title == "")
    {
        titleMsg.innerHTML = "Title cannot be empty";
        validInput = false;
    }
    if(title.length > 50)
    {
        titleMsg.innerHTML = "Title is too long";
        validInput = false;
    }
    if(validInput == true)
    {
        titleMsg.innerHTML = "";
    }
    return validInput;
}

function descriptionChecker(event)
{
    console.log("descriptionChecker entered")
    //not empty, not too big
    var descriptionInput = event.currentTarget.value;

    descriptionChecker2(descriptionInput);

}

function descriptionChecker2(desc)
{
    var descMsg = document.getElementById("projectDescriptionError");

    var validInput = true;
    
    if(desc.length == "")
    {
        descMsg.innerHTML = "Enter a description";
        validInput= false;
    }
    if(validInput == true)
    {
        descMsg.innerHTML = "";
    }
    return validInput;
}

function startDateChecker(event)
{
    console.log("startDateChecker entered")
    //validate that not empty
    var startDate = event.currentTarget.value;

    startDateChecker2(startDate);
}

function startDateChecker2(startDate)
{
    var startDateMsg = document.getElementById("startDateError");

    var validInput = true;

    if(startDate.length == "")
    {
        startDateMsg.innerHTML = "Please enter a start date";
        validInput = false;
    }
    if(validInput == true)
    {
        startDateMsg.innerHTML = "";
    }

    var endDate = document.getElementsByName("endDate");
    if(validInput == true)
    {
        endDate[0].disabled = false;
    }
    if(validInput == false)
    {
        endDate[0].disabled = true;
    }

    return validInput;
}

function endDateChecker(event)
{
    console.log("endDateChecker entered")
    //not empty
    //not too big
    var endDate = event.currentTarget.value;

    endDateChecker2(endDate);
    
}

function endDateChecker2(endDate)
{
    var validInput = true;
    
    var endDateMsg = document.getElementById("endDateError");

    if(endDate.length == "")
    {
        endDateMsg.innerHTML = "Please enter an end date";
        validInput = false;
    }

    //get startDate
    var startDate = document.getElementsByName("startDate");
    var startDateInput = startDate[0].value;
    console.log("startDate input:" + startDate);

    if(startDateInput > endDate)
    {
        endDateMsg.innerHTML = "End date has to be after the start date";
        validInput = false;
    }
    return validInput;
}

/*
**********************************************
    Member Checkers 
**********************************************
*/

function member1Checker(event)
{
    var member1 = event.currentTarget.value;
    member1Checker2(member1);
}

function member2Checker(event)
{
    var member2 = event.currentTarget.value;
    member2Checker2(member2);
}

function member3Checker(event)
{
    var member3 = event.currentTarget.value;
    member3Checker2(member3);
}

function member4Checker(event)
{
    var member4 = event.currentTarget.value;
    member4Checker2(member4);
}

function member1Checker2(member)
{
    var memberMsg = document.getElementById("projectMember1Error");

    var validInput = true;

    if(member.length > 50)
    {
        memberMsg.innerHTML = "This name is too long";
        validInput = false;
    }

    //get tasks
    var task1 = document.getElementsByName("projectMember1Task1");
    var task2 = document.getElementsByName("projectMember1Task2");
    var dead1 = document.getElementsByName("projectMember1DeadlineTask1")
    var dead2 = document.getElementsByName("projectMember1DeadlineTask2");
    if(validInput == true)
    {
        task1[0].disabled = false;
        task2[0].disabled = false;
        dead1[0].disabled = false;
        dead2[0].disabled = false;
        memberMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        task1[0].disabled = true;
        task2[0].disabled = true;
        dead1[0].disabled = true;
        dead2[0].disabled = true;
    }
    return validInput
}


function member2Checker2(member)
{
    var memberMsg = document.getElementById("projectMember2Error");

    var validInput = true;

    if(member.length > 50)
    {
        memberMsg.innerHTML = "This name is too long";
        validInput = false;
    }

    //get tasks
    var task1 = document.getElementsByName("projectMember2Task1");
    var task2 = document.getElementsByName("projectMember2Task2");
    var dead1 = document.getElementsByName("projectMember2DeadlineTask1")
    var dead2 = document.getElementsByName("projectMember2DeadlineTask2");
    if(validInput == true)
    {
        task1[0].disabled = false;
        task2[0].disabled = false;
        dead1[0].disabled = false;
        dead2[0].disabled = false;
        memberMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        task1[0].disabled = true;
        task2[0].disabled = true;
        dead1[0].disabled = true;
        dead2[0].disabled = true;
    }
    return validInput
}


function member3Checker2(member)
{
    var memberMsg = document.getElementById("projectMember3Error");

    var validInput = true;

    if(member.length > 50)
    {
        memberMsg.innerHTML = "This name is too long";
        validInput = false;
    }

    //get tasks
    var task1 = document.getElementsByName("projectMember3Task1");
    var task2 = document.getElementsByName("projectMember3Task2");
    var dead1 = document.getElementsByName("projectMember3DeadlineTask1")
    var dead2 = document.getElementsByName("projectMember3DeadlineTask2");
    if(validInput == true)
    {
        task1[0].disabled = false;
        task2[0].disabled = false;
        dead1[0].disabled = false;
        dead2[0].disabled = false;
        memberMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        task1[0].disabled = true;
        task2[0].disabled = true;
        dead1[0].disabled = true;
        dead2[0].disabled = true;
    }
    return validInput
}


function member4Checker2(member)
{
    var memberMsg = document.getElementById("projectMember4Error");

    var validInput = true;

    if(member.length > 50)
    {
        memberMsg.innerHTML = "This name is too long";
        validInput = false;
    }

    //get tasks
    var task1 = document.getElementsByName("projectMember4Task1");
    var task2 = document.getElementsByName("projectMember4Task2");
    var dead1 = document.getElementsByName("projectMember4DeadlineTask1")
    var dead2 = document.getElementsByName("projectMember4DeadlineTask2");
    if(validInput == true)
    {
        task1[0].disabled = false;
        task2[0].disabled = false;
        dead1[0].disabled = false;
        dead2[0].disabled = false;
        memberMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        task1[0].disabled = true;
        task2[0].disabled = true;
        dead1[0].disabled = true;
        dead2[0].disabled = true;
    }
    return validInput
}


/*
**********************************************
    Task Checkers 
**********************************************
*/
function task1Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember1DeadlineTask1");
    console.log("Deadline recieved:" + date[0].value);
    task1Checker2(task, date[0].value);   
}

function task2Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember1DeadlineTask2");
    console.log("Deadline recieved:" + date[0].value);
    task2Checker2(task, date[0].value);   
}

function task3Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember2DeadlineTask1");
    console.log("Deadline recieved:" + date[0].value);
    task3Checker2(task, date[0].value);   
}

function task4Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember2DeadlineTask2");
    console.log("Deadline recieved:" + date[0].value);
    task4Checker2(task, date[0].value);   
}

function task5Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember3DeadlineTask1");
    console.log("Deadline recieved:" + date[0].value);
    task5Checker2(task, date[0].value);   
}

function task6Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember3DeadlineTask2");
    console.log("Deadline recieved:" + date[0].value);
    task6Checker2(task, date[0].value);   
}

function task7Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember4DeadlineTask1");
    console.log("Deadline recieved:" + date[0].value);
    task7Checker2(task, date[0].value);   
}

function task8Checker(event)
{
    var task = event.currentTarget.value;
    console.log("Task recieved:" + task);
    var date = document.getElementsByName("projectMember4DeadlineTask2");
    console.log("Deadline recieved:" + date[0].value);
    task8Checker2(task, date[0].value);   
}

function task1Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember1Task1Error");
    var deadMsg = document.getElementById("projectMember1DeadlineTask1Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        console.log("deadline")
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && !deadline)
    {
        console.log("deadline not received")
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && !deadline)
    {
        console.log("both empty")
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        console.log("both not empty")
        validInput = true;
    }
    if(validInput == true)
    {
        console.log("deadline and task okay")
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

function task2Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember1Task2Error");
    var deadMsg = document.getElementById("projectMember1DeadlineTask2Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && deadline == "")
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && deadline == "")
    {
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        validInput = true;
    }
    if(validInput == true)
    {
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

function task3Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember2Task1Error");
    var deadMsg = document.getElementById("projectMember2DeadlineTask1Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && deadline == "")
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && deadline == "")
    {
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        validInput = true;
    }
    if(validInput == true)
    {
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

function task4Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember2Task2Error");
    var deadMsg = document.getElementById("projectMember2DeadlineTask2Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && deadline == "")
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && deadline == "")
    {
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        validInput = true;
    }
    if(validInput == true)
    {
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

function task5Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember3Task1Error");
    var deadMsg = document.getElementById("projectMember3DeadlineTask1Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && deadline == "")
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && deadline == "")
    {
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        validInput = true;
    }
    if(validInput == true)
    {
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

function task6Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember3Task2Error");
    var deadMsg = document.getElementById("projectMember3DeadlineTask2Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && deadline == "")
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && deadline == "")
    {
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        validInput = true;
    }
    if(validInput == true)
    {
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

function task7Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember4Task1Error");
    var deadMsg = document.getElementById("projectMember4DeadlineTask1Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && deadline == "")
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && deadline == "")
    {
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        validInput = true;
    }
    if(validInput == true)
    {
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

function task8Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember4Task2Error");
    var deadMsg = document.getElementById("projectMember4DeadlineTask2Error");

    var validInput = true;

    if (task == "" && deadline != "")
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && deadline == "")
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && deadline == "")
    {
        validInput = true;
    }
    if(task != "" && deadline != "")
    {
        validInput = true;
    }
    if(validInput == true)
    {
        deadMsg.innerHTML = "";
        taskMsg.innerHTML = "";
    }
    return validInput;
}

/*
**********************************************
    deadline Checkers 
**********************************************
*/

function deadline1Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember1Task1");
    task1Checker2(task[0].value, deadline);
}

function deadline2Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember1Task2");
    task2Checker2(task[0].value, deadline);
}

function deadline3Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember2Task1");
    task3Checker2(task[0].value, deadline);
}

function deadline4Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember2Task2");
    task4Checker2(task[0].value, deadline);
}

function deadline5Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember3Task1");
    task5Checker2(task[0].value, deadline);
}

function deadline6Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember3Task2");
    task6Checker2(task[0].value, deadline);
}

function deadline7Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember4Task1");
    task7Checker2(task[0].value, deadline);
}

function deadline8Checker(event)
{
    var deadline = event.currentTarget.value;
    var task = document.getElementsByName("projectMember4Task2");
    task8Checker2(task[0].value, deadline);
}

/*
**********************************************
    submit button
**********************************************
check all before submit
*/
