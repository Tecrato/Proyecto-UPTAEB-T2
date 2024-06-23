const input_correo = document.getElementById("email");
const input_pass = document.getElementById("semillaRecuperacion");
const input_passNew = document.getElementById("newPassRecuperacion");

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
        data: { email: input_correo.value, semilla: input_pass.value, metodo: 'semilla', password: input_passNew.value },
        success: (response) => {
            console.log(response)
            let json = JSON.parse(response)
            if (json.status == "error") {
                UIkit.notification.closeAll();
                UIkit.notification({
                    message: `<span uk-icon='icon: check'>${json.error}</span>`,
                    status: "warning",
                    pos: "bottom-right",
                });
            } else {
                UIkit.notification.closeAll();
                UIkit.notification({
                    message: `<span uk-icon='icon: check'>Contraseña Cambiada</span>`,
                    status: "success",
                    pos: "bottom-right",
                });
            }

        },
    });
});