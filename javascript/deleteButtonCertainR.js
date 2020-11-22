/*
event listener to confirm deletion of project on home page as well as on search employee page
*/ 

var submitListener = document.getElementById("submitForm");
submitListener.addEventListener("submit",submitChecker, false);

var buttonListener = document.getElementsByName("delete");
buttonListener.forEach(btn => 
        {
            btn.addEventListener("click", deleteButtonCertain, false);
        }
    )
