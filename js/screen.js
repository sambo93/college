window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createScreenForm'
    //-------------------------------------------------------------------------
    var createScreenForm = document.getElementById('createScreenForm');
    if (createScreenForm !== null) {
        createScreenForm.addEventListener('submit', validateScreenForm);
    }

    function validateScreenForm(event) {
        var form = event.target;

        if (!confirm("Is the form data correct?")) {
            event.preventDefault();
        }
    }

    //-------------------------------------------------------------------------
    // define an event listener for the '#createScreenForm'
    //-------------------------------------------------------------------------
    var editScreenForm = document.getElementById('editScreenForm');
    if (editScreenForm !== null) {
        editScreenForm.addEventListener('submit', validateScreenForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteScreen' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteScreen');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this screen?")) {
            event.preventDefault();
        }
    }

};