/*
event listener to confirm deletion of project on home page as well as on search employee page
*/ 

var buttonListener = document.getElementsByName("delete");
buttonListener.forEach(btn => 
        {
            btn.addEventListener("click", deleteButtonCertain, false);
        }
    )
