let InRegisterPage = document.getElementById("createaccount");
let signIn = document.getElementById("signin");
let register_form = $("#register-form");
let login_form = $("#login-form");

InRegisterPage.addEventListener("click", function () {
  localStorage.setItem("InRegisterPage", "true");
});

signIn.addEventListener("click", function () {
  localStorage.setItem("InRegisterPage", "false");
});

$(".message a").click(dothat);

function dothat() {
  $("form").animate({height: "toggle"}, "slow");
}
if (localStorage.getItem("InRegisterPage") === null) {
  localStorage.setItem("InRegisterPage", "false");
} else {
  if (localStorage.getItem("InRegisterPage") === "true") {
    register_form.css("display", "block");
    login_form.css("display", "none");
  } else {
    register_form.css("display", "none");
    login_form.css("display", "block");
  }
}

if (localStorage.getItem("darkornot") === null) {
  localStorage.setItem("darkornot", "true");
}
// get the dark icon div and light mode
var dark = document.getElementById("dark-mode");
var light = document.getElementById("light-mode");
var form = document.getElementById("form");
var inputs = document.querySelectorAll("input:not([type='submit'])");

lightfun = function () {
  document.body.classList.add("ligth-theme");
  document.body.style.backgroundImage = "url('images/light.jpg')";
  form.style.backgroundColor = "transparent";
  light.style.display = "flex";
  dark.style.display = "none";
  inputs.forEach(function (input) {
    input.style.borderBottom = "2px solid black";
    input.style.caretColor = "black";
    input.style.color = "black";
  });
  localStorage.setItem("darkornot", "false");
};

dark.addEventListener("click", lightfun);

darkfun = function () {
  document.body.classList.remove("ligth-theme");
  document.body.style.backgroundImage = "url('images/dark.jpg')";
  form.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
  light.style.display = "none";
  dark.style.display = "flex";
  inputs.forEach(function (input) {
    input.style.borderBottom = "2px solid white";
    input.style.caretColor = "white";
    input.style.color = "white";
  });
  localStorage.setItem("darkornot", "true");
};

light.addEventListener("click", darkfun);

const isDarkMode = localStorage.getItem("darkornot");
if (isDarkMode != "true") lightfun();
else darkfun();

// handle input feilds on register and login

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
// handle login page
let login_email = document.getElementById("Lemail");
let login_password = document.getElementById("Lpassword");
let login_submit_button = document.getElementById("Lsubmit");
let login_email_error = document.querySelector(".login-email-error");
let login_password_error = document.querySelector(".login-password-error");

login_submit_button.addEventListener("click", function (event) {
  if (login_email.value == "") {
    event.preventDefault();
    login_email_error.innerHTML = "please enter email";
  } else if (!isValidEmail(login_email.value)) {
    event.preventDefault();
    login_email_error.innerHTML = "enter valid email";
  }

  if (login_password.value == "") {
    event.preventDefault();
    login_password_error.innerHTML = "please enter password";
  }
});

login_email.addEventListener("blur", function () {
  if (login_email.value == "")
    login_email_error.innerHTML = "please enter email";
  else if (!isValidEmail(login_email.value))
    login_email_error.innerHTML = "enter valid email";
  else login_email_error.innerHTML = "";
});

login_password.addEventListener("input", function () {
  if (login_password.value == "")
    login_password_error.innerHTML = "please enter password";
  else login_password_error.innerHTML = "";
});

// handle register page
let first_name = document.getElementById("first-name");
let second_name = document.getElementById("second-name");
let email = document.getElementById("email");
let firstPasswordfeild = document.getElementById("type-password");
let secondPasswordfeild = document.getElementById("retype-password");
let submit_button = document.getElementById("submit");

let first_name_error = document.querySelector(".first-name-error");
let second_name_error = document.querySelector(".last-name-error");
let email_error = document.querySelector(".email-error");
let password_error = document.querySelector(".password-error");

let MatchPasswords = () => {
  if (firstPasswordfeild.value.length < 8) {
    password_error.innerHTML =
      "plesae enter at lesast 8 chars at first pass input";
  } else if (secondPasswordfeild.value.length < 8) {
    password_error.innerHTML =
      "plesae enter at lesast 8 chars at second pass input";
  } else if (firstPasswordfeild.value !== secondPasswordfeild.value)
    password_error.innerHTML = "the passwords does not match";
  else password_error.innerHTML = "";
};
secondPasswordfeild.addEventListener("input", MatchPasswords);
firstPasswordfeild.addEventListener("input", MatchPasswords);

// handle submit button clicking for all feilds
submit_button.addEventListener("click", function (event) {
  if (first_name.value == "") {
    event.preventDefault();
    first_name_error.innerHTML = "Please enter your first name";
  }

  if (second_name.value == "") {
    event.preventDefault();
    second_name_error.innerHTML = "Please enter your last name";
  }

  if (email.value == "") {
    event.preventDefault();
    email_error.innerHTML = "Please enter your email";
  } else if (!isValidEmail(email.value)) {
    event.preventDefault();
    email_error.innerHTML = "Please enter a valid email address";
  }

  if (firstPasswordfeild.value == "" && secondPasswordfeild.value == "") {
    event.preventDefault();
    password_error.innerHTML = "Please enter pass";
  } else if (
    firstPasswordfeild.value != secondPasswordfeild.value ||
    firstPasswordfeild.value.length < 8 ||
    secondPasswordfeild.value.length < 8
  ) {
    event.preventDefault();
  }
});

// handle names and email

first_name.addEventListener("input", function () {
  if (first_name.value != "") first_name_error.innerHTML = "";
  else first_name_error.innerHTML = "Please enter your first name";
});
second_name.addEventListener("input", function () {
  if (second_name.value != "") second_name_error.innerHTML = "";
  else second_name_error.innerHTML = "Please enter your last name";
});

email.addEventListener("blur", function (event) {
  if (!isValidEmail(email.value) && email.value != "") {
    email_error.innerHTML = "Please enter a valid email address";
  } else if (email.value != "") email_error.innerHTML = "";
  else email_error.innerHTML = "Please enter your email";
});
