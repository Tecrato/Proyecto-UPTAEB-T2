const input_correo = document.getElementById("email");
const input_pass = document.getElementById("semillaRecuperacion");

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
        url: "Controller/funcs_ajax/recuperar_pass.php",
        type: "POST",
        data: { email: input_correo.value, semilla: input_pass.value, metodo: 'semilla' },
        success: (response) => {
            console.log(response);
        },
    });
});