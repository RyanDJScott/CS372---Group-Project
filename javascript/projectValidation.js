//validation functions for new project page

function titleChecker(event)
{
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

//wrapper function for the description
function descriptionChecker(event)
{
    //not empty, not too big
    var descriptionInput = event.currentTarget.value;

    //call the inner function
    descriptionChecker2(descriptionInput);

}

//validation function for description
function descriptionChecker2(desc)
{
    //area to add an error for the description
    var descMsg = document.getElementById("projectDescriptionError");

    //variable to validate input
    var validInput = true;
    
    if(desc.length == "")//checks if empty or null
    {
        descMsg.innerHTML = "Enter a description";//triggers that error
        validInput = false;
    }
    if(desc.length >= 250)//if too big
    {
        descMsg.innerHTML = "Description must be less than 250 characters";
        validInput = false;
    }
    if(validInput == true)//resets if fine
    {
        descMsg.innerHTML = "";
    }
    return validInput;//exit function
}

//wrapper function for start date
function startDateChecker(event)
{
    //validate that not empty
    var startDate = event.currentTarget.value;

    //call validation function
    startDateChecker2(startDate);
}

//validation function for startDate
function startDateChecker2(startDate)
{
    //error message location
    var startDateMsg = document.getElementById("startDateError");
    var endDateMsg = document.getElementById("endDateError");

    //valid input
    var validInput = true;

    if(startDate.length == "")//checks if empty
    {
        startDateMsg.innerHTML = "Please enter a start date";
        validInput = false;
    }
    var endDate = document.getElementsByName("endDate");
    if((startDate > endDate[0].value) && (endDate[0].value != ""))//checks to see if the start date is before
    {
        startDateMsg.innerHTML = "Start date has to be before the end date";
        validInput = false;
    }
    if(validInput == true)//if valid then result
    {
        startDateMsg.innerHTML = "";
    }
    if((validInput == true) && (startDate < endDate[0].value) && endDate[0].value != "")
    {
        endDateMsg.innerHTML = ""; //if valid clear the error for endDate as well
    }
    return validInput;//exit the funtion
}

//end date wrapper function
function endDateChecker(event)
{
    //not empty
    //not too big
    var endDate = event.currentTarget.value;

    endDateChecker2(endDate);
}

//end date validation
function endDateChecker2(endDate)
{
    var validInput = true;
    
    //get message
    var endDateMsg = document.getElementById("endDateError");
    var startDateMsg = document.getElementById("startDateError");

    if(endDate.length == "")// check if empty
    {
        endDateMsg.innerHTML = "Please enter an end date";
        validInput = false;
    }

    //get startDate
    var startDate = document.getElementsByName("startDate");
    var startDateInput = startDate[0].value;

    if(startDateInput > endDate)//check that the dates are in the right when
    {
        endDateMsg.innerHTML = "End date has to be after the start date";
        validInput = false;
    }
    if((startDateInput > endDate) && (endDate != ""))
    {
        startDateMsg.innerHTML = "Start date has to be before the end date";
        validInput = false;
    }
    if(validInput == true)
    {
        endDateMsg.innerHTML = "";
    }
    if(validInput == true && startDateInput < endDate && startDateInput != "")
    {
        startDateMsg.innerHTML = "";
    }
    
    return validInput;
}

/*
**********************************************
    Member Checkers 
**********************************************
use the wrapper functions to get the value from the events
send these values to the validation functions
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

    if(validInput == true)
    {
        memberMsg.innerHTML = "";
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

    if(validInput == true)
    {
        memberMsg.innerHTML = "";
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

    if(validInput == true)
    {
        memberMsg.innerHTML = "";
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

    if(validInput == true)
    {
        memberMsg.innerHTML = "";
    }
    return validInput
}


/*
**********************************************
    Task Checkers 
**********************************************
get the task or date from the event
send them from their wrapper functions to check the validity
*/
function task1Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember1DeadlineTask1");
    var member = document.getElementsByName("projectMember1");
    task1Checker2(task, date[0].value);   
}

function task2Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember1DeadlineTask2");
    task2Checker2(task, date[0].value);   
}

function task3Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember2DeadlineTask1");
    task3Checker2(task, date[0].value);   
}

function task4Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember2DeadlineTask2");
    task4Checker2(task, date[0].value);   
}

function task5Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember3DeadlineTask1");
    task5Checker2(task, date[0].value);   
}

function task6Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember3DeadlineTask2");
    task6Checker2(task, date[0].value);   
}

function task7Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember4DeadlineTask1");
    task7Checker2(task, date[0].value);   
}

function task8Checker(event)
{
    var task = event.currentTarget.value;
    var date = document.getElementsByName("projectMember4DeadlineTask2");
    task8Checker2(task, date[0].value);   
}

function task1Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember1Task1Error");
    var deadMsg = document.getElementById("projectMember1DeadlineTask1Error");

    var validInput = true;

    var member = document.getElementsByName("projectMember1");
    if(member1Checker2(member[0].value) == false)
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
    }
    if (task == "" && deadline != "")//make sure that task is not empty if deadline is there
    {
        taskMsg.innerHTML = "Please give a task";
        validInput = false;
    }
    if(task != "" && !deadline)//make sure there is a deadline if the task is available
    {
        deadMsg.innerHTML = "Please give a deadline";
        validInput = false;
    }
    if(task == "" && !deadline)//both are empty is fine
    {
        validInput = true;
    }
    if(task != "" && deadline != "")//both not empty is fine
    {
        validInput = true;
    }
    if(validInput == true)//reset messages
    {
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

    var member = document.getElementsByName("projectMember1");
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
    if(validInput == true && (member[0].value != ""))
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
    }
    return validInput;
}

function task3Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember2Task1Error");
    var deadMsg = document.getElementById("projectMember2DeadlineTask1Error");

    var validInput = true;

    var member = document.getElementsByName("projectMember2");
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
    if(validInput == true && (member[0].value != ""))
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
    }
    return validInput;
}

function task4Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember2Task2Error");
    var deadMsg = document.getElementById("projectMember2DeadlineTask2Error");

    var validInput = true;

    var member = document.getElementsByName("projectMember2");
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
    if(validInput == true && (member[0].value != ""))
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
    }
    return validInput;
}

function task5Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember3Task1Error");
    var deadMsg = document.getElementById("projectMember3DeadlineTask1Error");

    var validInput = true;

    var member = document.getElementsByName("projectMember3");
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
    if(validInput == true && (member[0].value != ""))
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
    }
    return validInput;
}

function task6Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember3Task2Error");
    var deadMsg = document.getElementById("projectMember3DeadlineTask2Error");

    var validInput = true;

    var member = document.getElementsByName("projectMember3");
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
    if(validInput == true && (member[0].value != ""))
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
    }
    return validInput;
}

function task7Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember4Task1Error");
    var deadMsg = document.getElementById("projectMember4DeadlineTask1Error");

    var validInput = true;

    var member = document.getElementsByName("projectMember4");
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
    if(validInput == true && (member[0].value != ""))
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
    }
    return validInput;
}

function task8Checker2(task, deadline)
{
    //get task message
    var taskMsg = document.getElementById("projectMember4Task2Error");
    var deadMsg = document.getElementById("projectMember4DeadlineTask2Error");

    var validInput = true;

    var member = document.getElementsByName("projectMember4");
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
    if(validInput == true && (member[0].value != ""))
    {
        taskMsg.innerHTML = "Please provide a valid member for this task";
        validInput = false;
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

function submitChecker(event)
{
    //call every function if needed
    //if anything fails, cancel
    /*
    need:
    - title
    - desc.
    - start/end
    optional:
    - members
    - task
        - if task, need deadline too
    */
    var title = document.getElementsByName("projectTitle");
    if((titleChecker2(title[0].value)) == false)
    {
        event.preventDefault();
    }

    var desc = document.getElementsByName("projectDescription");
    if((descriptionChecker2(desc[0].value)) == false)
    {
        event.preventDefault();
    }

    var start = document.getElementsByName("startDate");
    if((startDateChecker2(start[0].value)) == false)
    {
        event.preventDefault();
    }

    var end = document.getElementsByName("endDate");
    if((endDateChecker2(end[0].value)) == false)
    {
        event.preventDefault();
    }

    //if members are found, then check them
    //if tasks are found, make sure they have a corresponding group member
    //and a deadline

    var member1 = document.getElementsByName("projectMember1");
    if(member1[0].value != "")
    {
        if(member1Checker2(member1[0].value) == false)
        {
            event.preventDefault();
        }
    }

    var member2 = document.getElementsByName("projectMember2");
    if(member2[0].value != "")
    {
        if(member2Checker2(member2[0].value) == false)
        {
            event.preventDefault();
        }
    }

    var member3 = document.getElementsByName("projectMember3");
    if(member3[0].value != "")
    {
        if(member3Checker2(member3[0].value) == false)
        {
            event.preventDefault();
        }
    }

    var member4 = document.getElementsByName("projectMember4");
    if(member4[0].value != "")
    {
        if(member4Checker2(member4[0].value) == false)
        {
            event.preventDefault();
        }
    }

    var task1 = document.getElementsByName("projectMember1Task1");
    var deadline1 = document.getElementsByName("projectMember1DeadlineTask1");
    if(task1[0].value != "" || deadline1[0].value != "")
    {
        //if either the task or the deadline is present, check validity of both
        //if they are valid, then check to see if the corresponding member is there
        if((task1Checker2(task1[0].value, deadline1[0].value) == false) || (member1[0].value == ""))
        {
            event.preventDefault();
        }
    }

    var task2 = document.getElementsByName("projectMember1Task2");
    var deadline2 = document.getElementsByName("projectMember1DeadlineTask2");
    if(task2[0].value != "" || deadline2[0].value != "")
    {
        if((task2Checker2(task2[0].value, deadline2[0].value) == false) || (member1[0].value == ""))
        {
            event.preventDefault();
        }
    }

    var task3 = document.getElementsByName("projectMember2Task1");
    var deadline3 = document.getElementsByName("projectMember2DeadlineTask1");
    if(task3[0].value != "" || deadline3[0].value != "")
    {
        if((task3Checker2(task3[0].value, deadline3[0].value) == false) || (member2[0].value == ""))
        {
            event.preventDefault();
        }
    }

    var task4 = document.getElementsByName("projectMember2Task2");
    var deadline4 = document.getElementsByName("projectMember2DeadlineTask2");
    if(task4[0].value != "" || deadline4[0].value != "")
    {
        if((task4Checker2(task4[0].value, deadline4[0].value) == false) || (member2[0].value == ""))
        {
            event.preventDefault();
        }
    }

    var task5 = document.getElementsByName("projectMember3Task1");
    var deadline5 = document.getElementsByName("projectMember3DeadlineTask1");
    if(task5[0].value != "" || deadline5[0].value != "")
    {
        if((task5Checker2(task5[0].value, deadline5[0].value) == false) || (member3[0].value == ""))
        {
            event.preventDefault();
        }
    }

    var task6 = document.getElementsByName("projectMember3Task2");
    var deadline6 = document.getElementsByName("projectMember3DeadlineTask2");
    if(task6[0].value != "" || deadline6[0].value != "")
    {
        if((task6Checker2(task6[0].value, deadline6[0].value) == false) || (member3[0].value == ""))
        {
            event.preventDefault();
        }
    }

    var task7 = document.getElementsByName("projectMember4Task1");
    var deadline7 = document.getElementsByName("projectMember4DeadlineTask1");
    if(task7[0].value != "" || deadline7[0].value != "")
    {
        if((task7Checker2(task7[0].value, deadline7[0].value) == false) || (member4[0].value == ""))
        {
            event.preventDefault();
        }
    }

    var task8 = document.getElementsByName("projectMember4Task2");
    var deadline8 = document.getElementsByName("projectMember4DeadlineTask2");
    if(task8[0].value != "" || deadline8[0].value != "")
    {
        if((task8Checker2(task8[0].value, deadline8[0].value) == false) || (member4[0].value == ""))
        {
            event.preventDefault();
        }
    }
}
