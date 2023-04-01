/* functions.js */
/* Author: Alexis Demetriou (G20970098) */
/* Email: ADemetriou5@uclan.ac.uk */

var x = window.matchMedia("(max-width: 900px)"); // The matchMedia() method returns a MediaQueryList with the

function toggleMenu(x, shouldToggle = false) {
    var menu = document.getElementById("header-right");

    if (x.matches) {
        if (shouldToggle) {
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
        else {
            menu.style.display = "none";
        }
    }
    else {
        menu.style.display = "block";
    }
}

function click_button_action() {
    toggleMenu(x, true);
}

toggleMenu(x);
x.addListener(toggleMenu);

function showValidator() {
    document.getElementById("validator").style.display = "block";
}

function hideValidator() {
    document.getElementById("validator").style.display = "none";
}

function validatePassword() {
    const password = document.getElementById("password").value;
    document.getElementById("number").checked = /\d/.test(password);
    document.getElementById("lowercase").checked = /[a-z]/.test(password);
    document.getElementById("uppercase").checked = /[A-Z]/.test(password);
    document.getElementById("length").checked = /.{8,}/.test(password);
}

function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const togglePasswordIcon = document.getElementById("togglePassword");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePasswordIcon.classList.remove("fa-eye");
        togglePasswordIcon.classList.add("fa-eye-slash");
    }
    else {
        passwordInput.type = "password";
        togglePasswordIcon.classList.remove("fa-eye-slash");
        togglePasswordIcon.classList.add("fa-eye");
    }
}

function toggleConfirmPasswordVisibility() {
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const toggleConfirmPasswordIcon = document.getElementById("toggleConfirmPassword");

    if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
        toggleConfirmPasswordIcon.classList.remove("fa-eye");
        toggleConfirmPasswordIcon.classList.add("fa-eye-slash");
    }
    else {
        confirmPasswordInput.type = "password";
        toggleConfirmPasswordIcon.classList.remove("fa-eye-slash");
        toggleConfirmPasswordIcon.classList.add("fa-eye");
    }
}