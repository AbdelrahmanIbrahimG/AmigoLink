var burger_box = document.getElementById("burger-box");
var btns = document.getElementById("btns");

burger_box.addEventListener("click", function () {
  btns.classList.toggle("flex");
});
let sub = document.getElementById("sub");
let post = document.getElementById("post");

post.addEventListener("click", () => {
  sub.click();
});

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
