const input_correo = document.getElementById("email");
const input_pass = document.getElementById("semillaRecuperacion");
const input_passNew = document.getElementById("newPassRecuperacion");

const SetPassword = document.querySelector(".SetPassword");
const login = document.querySelector(".Login");
const SetRegister = document.querySelector(".SetRegister");


const recuperarPass = document.querySelector(".recuperarPass");
const registerSystem = document.querySelector(".registerSystem");

recuperarPass.addEventListener("click", () => {
    login.classList.toggle('display-none')
    SetPassword.classList.toggle('display-none')
});

registerSystem.addEventListener("click", () => {
    login.classList.toggle('display-none')
    SetRegister.classList.toggle('display-none')
});


document.getElementById("cancel").addEventListener("click", () => {
    login.classList.toggle('display-none')
    SetPassword.classList.toggle('display-none')
});

document.getElementById("cancelRegister").addEventListener("click", () => {
    login.classList.toggle('display-none')
    SetRegister.classList.toggle('display-none')
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


//semilla

// let btnGenerate = document.querySelector(".btn-generate")

// btnGenerate.addEventListener("click", () => {
//     const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
//     let result = '';
//     for (let i = 0; i < 20; i++) {
//       result += characters.charAt(Math.floor(Math.random() * characters.length));
//     }
//     document.querySelector(".input-seed").value = result

// })
let valid_pass = document.querySelector(".valid-pass");

let icon_eye = document.querySelector(".controller_icon_eye");

icon_eye.addEventListener("click", () => {
    if (icon_eye.getAttribute("uk-icon") == "icon: eye") {
        icon_eye.setAttribute("uk-icon", "icon: eye-slash")
        valid_pass.setAttribute("type", "text")
    } else {
        icon_eye.setAttribute("uk-icon", "icon: eye")
        valid_pass.setAttribute("type", "password")
    }
})


function validarContrasena(contrasena) {
    const mensajes = [];

    if (!/(?=.*\d)/.test(contrasena)) {
        mensajes.push("Al menos un dígito.");
    }
    if (!/(?=.*[a-z])/.test(contrasena)) {
        mensajes.push("Al menos una letra minúscula.");
    }
    if (!/(?=.*[^a-zA-Z0-9])/.test(contrasena)) {
        mensajes.push("Al menos un carácter especial.");
    }
    if (/\s/.test(contrasena)) {
        mensajes.push("Sin espacios en blanco.");
    }
    if (contrasena.length < 8 || contrasena.length > 15) {
        mensajes.push("Longitud entre 8 y 15 caracteres.");
    }

    if (mensajes.length === 0) {
        return "La contraseña es válida.";
    } else {
        return "La contraseña debe cumplir con los siguientes requisitos:\n" + mensajes.join("\n");
    }
}

valid_pass.addEventListener("keyup", (e) => {
    let val = e.target.value;
    const resultado = validarContrasena(val);
    document.querySelector("#msj").textContent = resultado;

    if (validarContrasena(val) == "La contraseña es válida.") {

        let formRegisterUser = document.getElementById("formRegisterUser")

        formRegisterUser.addEventListener("submit", (e) => {
            e.preventDefault();
            let data = new FormData(formRegisterUser);
            data.append("tipo", "usuarios")

            //peticion para registrar el usuario
            $.ajax({
                url: "Controller/funcs/agregar_cosas.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                    $.ajax({
                        url: "Controller/funcs_ajax/login.php",
                        type: "POST",
                        data: data,
                        contentType: false,
                        processData: false,
                        success: (response) => {
                            console.log(response);
                            if (response == "1") {
                                window.location = "http://localhost/Proyecto-UPTAEB-T2/Administrar_perfil"
                                localStorage.setItem("intro", "true")
                            } else {
                                // window.location = "http://localhost/Proyecto-UPTAEB-T2/login"
                            }
                        }
                    })
                }
            })
        })
    } else {
        document.querySelector("#msj").textContent = resultado;
    }
})

