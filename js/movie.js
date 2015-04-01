window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createMovieForm'
    //-------------------------------------------------------------------------
    var createMovieForm = document.getElementById('createMovieForm');
    if (createMovieForm !== null) {
        createMovieForm.addEventListener('submit', validateMovieForm);
    }

    function validateMovieForm(event) {
        var form = event.target;

        if (!confirm("Is the form data correct?")) {
            event.preventDefault();
        }
    }

    //-------------------------------------------------------------------------
    // define an event listener for the '#createMovieForm'
    //-------------------------------------------------------------------------
    var editMovieForm = document.getElementById('editMovieForm');
    if (editMovieForm !== null) {
        editMovieForm.addEventListener('submit', validateMovieForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteMovie' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteMovie');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this movie?")) {
            event.preventDefault();
        }
    }

};