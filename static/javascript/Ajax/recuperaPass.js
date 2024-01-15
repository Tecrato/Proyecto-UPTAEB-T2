const input_pass = document.getElementById("email");

const SetPassword = document.querySelector(".SetPassword");
const login = document.querySelector(".Login");


const recuperarPass = document.querySelector(".recuperarPass");

recuperarPass.addEventListener("click", () => {
  login.classList.toggle('display-none')
  SetPassword.classList.toggle('display-none')
});

document.getElementById("cancel").addEventListener("click", () => {
  login.classList.toggle('display-none')
  SetPassword.classList.toggle('display-none')
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
