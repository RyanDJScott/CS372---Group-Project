console.log("AJAX Script LOCKED AND LOADED");

//getEmployee AJAX function
function getEmployee (event) {
    var searchVal = event.currentTarget.value;
    console.log("IN THE SEARCH BAR: " + searchVal + "");

    //Create an instance of an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("       CALLBACK FUNCTION EXECUTING");

            //Parse the JSON object
            var newEmployees = JSON.parse(xhr.responseText);

            //Update the DOM here
            var oldTables = document.getElementById("employeeCard");

            //Delete all of the employees off of the page so we can insert the new ones
            for (var i = 0; i < oldTables.length; i++)
                oldTables[i].shift();

            //Get the insertion point for the cells
            var parent = document.getElementById("searchEmployees");

            var currentEmp = 0;

            //Iterate over all returned objects and update the DOM
            for (var j = 0; j < newEmployees.length; j++)
            {
                if (newEmployees[j].UID != currentEmp)
                {
                    //Close off the previous employee
                    var buttonC = document.createElement("td");
                    tableRow.appendChild(buttonC);

                        //Form tag
                        var formT = document.createElement("form");
                        formT.action = "deleteEmployee.php?UID=" + newEmployees[j -1].UID;
                        formT.method = "GET";
                        buttonC.appendChild(formT);

                            //Button
                            var dButton = document.createElement("button");
                            dButton.type = "submit";
                            dButton.class="edit-delete-button"
                            formT.appendChild(dButton);

                                //i Tag
                                var iTag = document.createElement("i");
                                iTag.class = "fa fa-trash";
                                dButton.appendChild(iTag);

                    //Set current employee flag
                    currentEmp = newEmployees[j].UID;

                    //Place all the information into variables
                    var FN = newEmployees[j].FirstName;
                    console.log("FirstName: " + FN + "");
                    var LN = newEmployees[j].LastName;
                    console.log("LastName: " + LN + "");
                    var BIO = newEmployees[j].ProfileBio;
                    console.log("Profile Bio: " + BIO + "");
                    var EMAIL = newEmployees[j].Email;
                    console.log("Email: " + EMAIL + "");

                    console.log("MID: " + newEmployees[j].managerId + "");

                    if (newEmployees[j].managerId != NULL)
                        var ET = "Manager";
                    else if(newEmployees[j].managerId == NULL)
                        var ET = "Employee";

                    //Holder row
                    var tableRow = document.createElement("tr");
                    parent.appendChild(tableRow);

                        //Employee type
                        var empC = document.createElement("td");
                        empC.innerHTML = ET;
                        tableRow.appendChild(empC);

                        //First Name
                        var fnC = document.createElement("td");
                        fnC.innerHTML = FN;
                        tableRow.appendChild(fnC);

                        //Last Name
                        var lnC = document.createElement("td");
                        lnC.innerHTML = LN;
                        tableRow.appendChild(lnC);

                        //Bio
                        var bioC = document.createElement("td");
                        bioC.innerHTML = BIO;
                        tableRow.appendChild(bioC);

                        //Email
                        var emailC = document.createElement("td");
                        emailC.innerHTML = EMAIL;
                        tableRow.appendChild(emailC);
                        
                        //Skills list
                        var listC = document.createElement("td");
                        tableRow.appendChild(listC);

                        var ul = document.createElement("ul");
                        tableRow.appendChild("ul");
                }

                var li = document.createElement("li");
                li.innerHTML = newEmployees[j].CodingLang;
                ul.appendChild(li);
            }
        }
    }

    xhr.open("GET", "searchEmployee.php?CodingLang=" + encodeURIComponent(event.currentTarget.value), true);

    xhr.send(NULL);
}

//Add event listener on the search bar
document.getElementById("employeeSearch").addEventListener("keyup", getEmployee);