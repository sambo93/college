window.onload = function () {
    
    var createScreenForm = document.getElementById('createScreenForm');
    if (createScreenForm !== null) {
        createScreenForm.addEventListener('submit', validateScreenForm);
    }

    function validateScreenForm(event) {
        var form = event.target; 

        var screenNumber = form['screenNumber'].value;
        var noOfFireExits = form['noOfFireExits'].value;
        var noOfSeats = form['noOfSeats'].value;
        var projectorType = form['projectorType'].value;

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (address === "") {
            errors["screenNumber"] = "* Screen Number cannot be blank!\n";
        }
        if (shopmanagername === "") {
            errors["noOfFireExits"] = "* Number of Fire Exits cannot be blank!\n";
        }
        if (phonenumber === "") {
            errors["noOfSeats"] = "* Number of Seats cannot be blank!\n";
        }
        if (dateopened === "") {
            errors["projectorType"] = "* Projector Type cannot be blank!\n";
        }

        var valid = true;
        for (var index in errors) {
            valid = false;
            var errorMessage = errors[index];
            var spanElement = document.getElementById(index + "Error");
            spanElement.innerHTML = errorMessage;
        }
        if (!valid) {
            event.preventDefault();
        }    
        else if (!confirm("Is The Data Correct ?")) {
            event.preventDefault();
        }
    }

    //-------------------------------------------------------------------------
    // Defines an event listener for the 'editShopForm'
    //-------------------------------------------------------------------------
    var editScreenForm = document.getElementById('editScreenForm');
    if (editScreenForm !== null) {
        editScreenForm.addEventListener('submit', validateScreenForm);
    }

    //-------------------------------------------------------------------------
    // Defines an event listener for any 'deleteShop' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteScreen');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this Screen?")) {
            event.preventDefault();
        }
    }

};