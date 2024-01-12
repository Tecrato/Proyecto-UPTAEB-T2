const input_pass = document.getElementById("email");

const SetPassword = document.querySelector(".SetPassword");
const login = document.querySelector(".Login");

// SetPassword.style.display= "none"

login.style.marginRight = "-200%";
SetPassword.style.marginRight = "100%";

const recuperarPass = document.querySelector(".recuperarPass");
recuperarPass.addEventListener("click", () => {
  login.style.display = 'none'
  SetPassword.style.margin = "0px";
  login.style.marginLeft = "100%";
  // login.style.display= "none"
  // SetPassword.style.display= "flex"
});

document.getElementById("forget-pass").addEventListener("click", () => {
  $.ajax({
    url: "Controller/funcs_ajax/recuperar_pass.php?email=" + input_pass.value,
    type: "GET",
    success: (response) => {
      console.log(response);
    },
  });
});
