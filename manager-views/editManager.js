//Click event listener on AJAX results
function addToManagerField (event) {
    //Find the input field
    var inputField = document.getElementsByName("projectManager");

    //Get the value of what is inside the p tag
    var name = event.currentTarget.innerHTML;

    //Insert this value into the input field
    inputField[0].value = name;

    //Delete all the created buttons
    var buttons = document.getElementsByClassName("add-manager-AJAX");
    var bLen = buttons.length;

    for (var j = 0; j < bLen; j++)
        buttons[0].remove(); 
}

//AJAX Function
function getManager(projectManager){
    //Create a new instance of an XMLHttpRequest Object
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //Parse the JSON object
            var possibleManagers = JSON.parse(xhr.responseText);

            //Find the suggest member spot in the DOM
            var insertSpot = document.getElementById("suggestManager");

            //Find any old searches and remove them
            var oldSearches = document.getElementsByClassName("add-manager-AJAX");
            var oldTags = oldSearches.length;

            for (var j = 0; j < oldTags; j++)
                oldSearches[0].remove();

            //Iterate over the results
            for (var i = 0; i < possibleManagers.length; i++)
            {
                //Insert the value into this spot
                var node = document.createElement("p");
                node.classList.add("add-manager-AJAX");

                node.addEventListener("click", addToManagerField);

                //Append the tag
                insertSpot.appendChild(node);
                node.innerHTML = ""+possibleManagers[i].FirstName+" "+possibleManagers[i].LastName+"";
            }
        }
    }

    xhr.open("GET", "editManager.php?ManagerName=" + encodeURIComponent(projectManager), true);
    xhr.send(null);
}

//Send the value of the field to the AJAX function
function getMan (event) {
    var projectManager = event.currentTarget.value;
    getManager(projectManager);
}

//Get the field input by name
var managerField = document.getElementsByName("projectManager");

//Add event listener on keyup
managerField[0].addEventListener("keyup", getMan);