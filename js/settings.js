var burger_box = document.getElementById("burger-box");
var btns = document.getElementById("btns");

burger_box.addEventListener("click", function () {
  btns.classList.toggle("flex");
});

let pass1 = document.getElementById("pass1");
let pass2 = document.getElementById("pass2");
let subbtn = document.getElementById("submit_btn");
let err_done = document.getElementById("err_done");

pass1.addEventListener("input", () => {
  if (pass1.value.length == 0) {
    err_done.innerHTML = "enter first pass";
  } else if (pass1.value.length < 8) {
    err_done.innerHTML =
      "password must be greater than 8 chars at input pass one";
  } else if (pass1.value != pass2.value) {
    err_done.innerHTML = "passwords not equal ";
  } else err_done.innerHTML = "";
});
pass2.addEventListener("input", () => {
  if (pass2.value.length == 0) {
    err_done.innerHTML = "enter second pass please";
  } else if (pass2.value.length < 8) {
    err_done.innerHTML =
      "password must be greater than 8 chars at input pass two";
  } else if (pass1.value != pass2.value) {
    err_done.innerHTML = "passwords not equal";
  } else err_done.innerHTML = "";
});
subbtn.addEventListener("click", (e) => {
  if (pass1.value.length == 0) {
    e.preventDefault();
    err_done.innerHTML = "enter first pass please";
  } else if (pass1.value.length == 0) {
    e.preventDefault();
    err_done.innerHTML = "enter second pass please";
  } else if (pass1.value.length < 8) {
    err_done.innerHTML =
      "password must be greater than 8 chars at input pass one";
    e.preventDefault();
  } else if (pass2.value.length < 8) {
    err_done.innerHTML =
      "password must be greater than 8 chars at input pass two";
    e.preventDefault();
  }
  if (pass1.value != pass2.value) {
    err_done.innerHTML = "passwords not equal";
    e.preventDefault();
  }
});
// ligth dark mode
let darkmodebtn = document.getElementById("dark-mode");
let lightmodebtn = document.getElementById("light-mode");

if (localStorage.getItem("light_main_page") === null) {
  localStorage.setItem("light_main_page", "true");
}

let dark = function () {
  darkmodebtn.style.display = "flex";
  lightmodebtn.style.display = "none";
  document.body.classList.add("body-light-mode");
  localStorage.setItem("light_main_page", "true");
};

let light = function () {
  console.log(4);
  lightmodebtn.style.display = "flex";
  darkmodebtn.style.display = "none";
  document.body.classList.remove("body-light-mode");
  localStorage.setItem("light_main_page", "false");
};

lightmodebtn.addEventListener("click", dark);
darkmodebtn.addEventListener("click", light);

const islightmode = localStorage.getItem("light_main_page");
if (islightmode == "false") {
  document.body.classList.remove("body-light-mode");
  console.log(4);
  lightmodebtn.style.display = "flex";
  darkmodebtn.style.display = "none";
} else {
  document.body.classList.add("body-light-mode");
  darkmodebtn.style.display = "flex";
  lightmodebtn.style.display = "none";
}
