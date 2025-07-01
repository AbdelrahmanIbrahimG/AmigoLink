const codes = document.querySelectorAll(".code");
let sub = document.getElementById("submit");
codes[0].focus();

function isLetterOrNumber(str) {
  return (
    (str.length === 1 && str.match(/[a-z]/i) !== null) ||
    (str >= "0" && str <= "9")
  );
}
function updateSubmitButtonState() {
  let done = true;

  codes.forEach((code) => {
    if (code.value.trim() === "") {
      done = false;
    }
  });

  if (done) {
    sub.disabled = false;
    sub.classList.remove("disabled");
  } else {
    sub.disabled = true;
    sub.classList.add("disabled");
  }
}

codes.forEach((code, idx) => {
  code.addEventListener("keyup", (e) => {
    if (isLetterOrNumber(e.key) && codes[idx + 1]) {
      setTimeout(() => codes[idx + 1].focus(), 10);
    } else if (e.key == "Backspace" && codes[idx - 1]) {
      setTimeout(() => codes[idx - 1].focus(), 1);
    }
    updateSubmitButtonState();
  });

  let done = true;
  if (idx == codes.length - 1) {
    codes.forEach((code, idx2) => {
      if (codes[idx] == "") done = false;
      if (done) {
        sub.disabled = false;
        sub.classList.add("disabled");
      } else {
        sub.disabled = true;
        sub.classList.remove("disabled");
      }
    });
  }

  // let allInputsFilled = codes.forEach((code) => code.value.trim() !== "");
  // console.log(allInputsFilled);
  // if (allInputsFilled) {
  //   sub.disabled = false;
  //   sub.style.opacity = 1;
  // } else {
  //   sub.disabled = true;
  //   sub.style.opacity = 0.7;
  // }

  code.addEventListener("input", function () {
    if (code.value.length > 1) {
      code.value = code.value.slice(-1);
    }
    updateSubmitButtonState();
  });
});
