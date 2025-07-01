document.addEventListener("DOMContentLoaded", function () {
  var followBtns = document.querySelectorAll(".follow_btn");

  followBtns.forEach(function (followBtn) {
    followBtn.addEventListener("click", function () {
      var form = followBtn
        .closest(".card")
        .querySelector("[name='follow_submit']");
      form.click();
    });
  });
});
