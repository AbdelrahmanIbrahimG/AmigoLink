var burger_box = document.getElementById("burger-box");
var btns = document.getElementById("btns");

burger_box.addEventListener("click", function () {
  btns.classList.toggle("flex");
});

let submit_profile_image = document.getElementById("submit-profile-image-btn");
let icon_profile_image = document.getElementById("icon-profile-image-btn");
let open_pro_image = document.getElementById("choose-profile-image");

icon_profile_image.addEventListener("click", () => {
  open_pro_image.click();
});
open_pro_image.addEventListener("change", () => {
  submit_profile_image.click();
});

let icon_background_image = document.getElementById(
  "icon-choose-background-image-btn"
);
let upload_background_image = document.getElementById("upload");
let background_image_sub_form = document.getElementById(
  "choose-background-image-btn"
);

icon_background_image.addEventListener("click", () => {
  upload_background_image.click();
});
upload_background_image.addEventListener("change", () => {
  background_image_sub_form.click();
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
