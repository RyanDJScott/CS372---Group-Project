//getEmployee AJAX function
function getEmployee (event) {
    var searchVal = event.currentTarget.value;

    //Create an instance of an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //Parse the JSON object
            var newEmployees = JSON.parse(xhr.responseText);

            //Update the DOM here
            var oldTables = document.getElementsByName("employeeCard");

            var loopCounter = oldTables.length;

            //Delete all of the employees off of the page so we can insert the new ones
            for (var i = 0; i < loopCounter; i++)
                oldTables[0].remove();

            //Get the insertion point for the cells
            var parent = document.getElementById("searchEmployees");

            var currentEmp = 0;

            //Iterate over all returned objects and update the DOM
            for (var j = 0; j < newEmployees.length; j++)
            {

                if (newEmployees[j].UID != currentEmp)
                {
                    //Set current employee flag
                    currentEmp = newEmployees[j].UID;

                    //Place all the information into variables
                    var FN = newEmployees[j].FirstName;
                    var LN = newEmployees[j].LastName;
                    var BIO = newEmployees[j].ProfileBio;
                    var EMAIL = newEmployees[j].Email;

                    if (newEmployees[j].managerId != null)
                        var ET = "Manager";
                    else if(newEmployees[j].managerId == null)
                        var ET = "Employee";

                    //Holder row
                    var tableRow = document.createElement("tr");
                    tableRow.setAttribute("name", "employeeCard");
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

                        var ulS = document.createElement("ul");
                        listC.appendChild(ulS);
                }

                    var li = document.createElement("li");
                    li.innerHTML = newEmployees[j].CodingLang;
                    ulS.appendChild(li);
            }
        }
    }

    xhr.open("GET", "searchEmployee.php?CodingLang=" + encodeURIComponent(event.currentTarget.value), true);
    xhr.send(null);
}

//Add event listener on the search bar
document.getElementById("employeeSearch").addEventListener("keyup", getEmployee);