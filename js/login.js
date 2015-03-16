window.onload= function() {

    var loginForm = document.getElementById("loginForm");
    var registerBtn = document.getElementById("registerBtn");
    var forgotBtn = document.getElementById("forgotBtn");

    loginForm.addEventListener("submit", validateLogin);
    registerBtn.addEventListener("click", onRegisterBtn);
   forgotBtn.addEventListener("click", onForgotBtn);

    function validateLogin(event) {
        var form = event.target;
       var username = form['username'].value;
        var password = form['password'].value;

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (username === "") {
            errors["username"] = "Username cannot be empty\n";
       }
        if (password === "") {
            errors["password"] = "Password cannot be empty\n";
        }
        else if (password.length < 6) {
            errors["password"] = "Password must be at least six characters\n";
        }

        var valid = true;
        for (var index in errors) {
            valid = false;
            var errorMessage = errors[index];
            var spanElement = document.getElementById(index + "Error");
            spanElement.innerHTML = errorMessage;

            form["password"].value = "";
        }
        if (!valid) {
            event.preventDefault();
        }
    }

    function onRegisterBtn(event) {
        document.location.href = "registerForm.php";
    }

    function onForgotBtn(event) {
        document.location.href = "forgotPasswordForm.php";
    }
};/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


