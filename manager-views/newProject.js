//Add to field function
function addToField1 (event) {
    //Find the input field
    var inputField1 = document.getElementsByName("projectMember1");

    //Get the value of what is inside the p tag
    var name1 = event.currentTarget.innerHTML;

    //Insert this value into the input field
    inputField1[0].value = name1;

    //Delete all the created buttons
    var buttons = document.getElementsByClassName("add-member-AJAX1");
    var bLen = buttons.length;

    for (var j = 0; j < bLen; j++)
        buttons[0].remove(); 
}

function addToField2 (event) {
    //Find the input field
    var inputField2 = document.getElementsByName("projectMember2");

    //Get the value of what is inside the p tag
    var name2 = event.currentTarget.innerHTML;

    //Insert this value into the input field
    inputField2[0].value = name2;

    //Delete all the created buttons
    var buttons = document.getElementsByClassName("add-member-AJAX2");
    var bLen = buttons.length;

    for (var j = 0; j < bLen; j++)
        buttons[0].remove();
}

function addToField3 (event) {
    //Find the input field
    var inputField3 = document.getElementsByName("projectMember3");

    //Get the value of what is inside the p tag
    var name3 = event.currentTarget.innerHTML;

    //Insert this value into the input field
    inputField3[0].value = name3;

    //Delete all the created buttons
    var buttons = document.getElementsByClassName("add-member-AJAX3");
    var bLen = buttons.length;

    for (var j = 0; j < bLen; j++)
        buttons[0].remove();
}

function addToField4 (event) {
    //Find the input field
    var inputField4 = document.getElementsByName("projectMember4");

    //Get the value of what is inside the p tag
    var name4 = event.currentTarget.innerHTML;

    //Insert this value into the input field
    inputField4[0].value = name4;

    //Delete all the created buttons
    var buttons = document.getElementsByClassName("add-member-AJAX4");
    var bLen = buttons.length;

    for (var j = 0; j < bLen; j++)
        buttons[0].remove();
}

//AJAX Function starts here
function getMember (value, memNum) {
    //Create a new instance of an XMLHttpRequest Object
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //Parse the JSON object
            var possibleEmployees = JSON.parse(xhr.responseText);

            //Find the suggest member spot in the DOM
            var insertSpot = document.getElementById("suggestMember"+ memNum + "");

            //Find any old searches and remove them
            var oldSearches = document.getElementsByClassName("add-member-AJAX"+ memNum +"");
            var oldTags = oldSearches.length;

            for (var j = 0; j < oldTags; j++)
                oldSearches[0].remove();
            

            //Iterate over the results
            for (var i = 0; i < possibleEmployees.length; i++)
            {
                //Insert the value into this spot
                var node = document.createElement("p");
                node.classList.add("add-member-AJAX"+ memNum +"");

                //Register an event on this item to insert into the field when clicked
                switch (memNum) {
                    case 1: 
                        node.addEventListener("click", addToField1);
                        break;
                    case 2: 
                        node.addEventListener("click", addToField2);
                        break;
                    case 3: 
                        node.addEventListener("click", addToField3);
                        break;
                    case 4:
                        node.addEventListener("click", addToField4);
                }

                //Append the tag
                insertSpot.appendChild(node);
                node.innerHTML = ""+possibleEmployees[i].FirstName+" "+possibleEmployees[i].LastName+"";
            }
        }
    }

    xhr.open("GET", "newProject.php?MemberName=" + encodeURIComponent(value), true);
    xhr.send(null);
}

//Functions for each input field; calls AJAX function with parameters
function getMem1 (event) { 
    //Send to generic function with field input and ##
    var fieldInput1 = event.currentTarget.value;
    getMember(fieldInput1, 1);
}

function getMem2 (event) {
    //Send to generic function with field input and ##
    var fieldInput2 = event.currentTarget.value;
    getMember(fieldInput2, 2);
}

function getMem3 (event) {
    //Send to generic function with field input and ##
    var fieldInput3 = event.currentTarget.value;
    getMember(fieldInput3, 3);
}

function getMem4 (event) {
    //Send to generic function with field input and ##
    var fieldInput4 = event.currentTarget.value;
    getMember(fieldInput4, 4);
}

//Get the input fields by name
var projectMember1 = document.getElementsByName("projectMember1");
var projectMember2 = document.getElementsByName("projectMember2");
var projectMember3 = document.getElementsByName("projectMember3");
var projectMember4 = document.getElementsByName("projectMember4");

//Add event listener on each project member
projectMember1[0].addEventListener("keyup", getMem1);
projectMember2[0].addEventListener("keyup", getMem2);
projectMember3[0].addEventListener("keyup", getMem3);
projectMember4[0].addEventListener("keyup", getMem4);