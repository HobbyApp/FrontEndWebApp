//opens userInfoForm onclick
function openEditInfoForm() {
    var x = document.getElementById("userInfoForm");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
          x.style.display = "none";
        }
  }

//validates the changed password, making sure it matches before user submits
var password = document.getElementById("password"),
  confirm_password = document.getElementById("confirm_password");

function validatePassword() {
  if (password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity("");
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
