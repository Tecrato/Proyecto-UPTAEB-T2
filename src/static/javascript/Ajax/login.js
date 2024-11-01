// VALIDACIONES DE INPUTS
const validaciones = {
    nombre: /^([A-Zñáéó]|[a-zñáéó]){3,}( ([A-Zñáéó]|[a-zñáéó]){3,})?$/,
    apellido: /^([A-Zñáéó]|[a-zñáéó]){3,}( ([A-Zñáéó]|[a-zñáéó]){3,})?$/,
    codigo: /^\d{12}$/,
    valorUnidad: /^(\d{1,4})$/,
    cedula:/^([\d]{1,2})\.?([\d]{3})\.?([\d]{3})$/,
    telefono:/^([\+\d]{2,4} ?)?([\d]{4}) ?\-?([\d]{3}) ?\-?([\d]{4})$/,
    razonSocial:/([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$/,
    correo:/^([A-Za-z0-9\.\_]+)@([\w]{3,8})\.([\w]{2,3})(\.[\w]{2,4})?(\.[\w]{2,3})?$/,
    
  };
  function validarFormulario(datos) {
  const resultados = {};
  const errores = [];
  
  for (const campo in datos) {
  if (validaciones.hasOwnProperty(campo)) {
    const regex = validaciones[campo];
    const esValido = regex.test(datos[campo]);
    resultados[campo] = esValido;
    
    if (!esValido) {
        errores.push(`El campo ${campo} no es válido.`);
    }
  }
  }
  
  return { resultados, errores };
  }



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
const formRegisterUser = document.getElementById("formRegisterUser")

formRegisterUser.addEventListener("submit", (e) => {
    e.preventDefault();
    const datosFormulario = {
        nombre: document.querySelector('.inpRegisterName').value,
        apellido: document.querySelector('.inpRegisterLastName').value,
        correo: document.querySelector('.inpRegisterMail').value
    };
    const { resultados, errores } = validarFormulario(datosFormulario);
    const messageError = document.getElementById('messageError');
    messageError.innerHTML = ''; 
    if (errores.length > 0) {
        messageError.innerHTML = errores.join('<br>');
        console.log(errores)
    } else {
        let data = new FormData(formRegisterUser);
        data.append("tipo", "usuarios")
        let a = validarContrasena(val)
        if (a != "La contraseña es válida.") {
            document.querySelector("#msj").textContent = a;
            return
        }
        //peticion para registrar el usuario
        $.ajax({
            url: "api_agregar",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            success: (response) => {
                $.ajax({
                    url: "api_login",
                    type: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response == "1") {
                            window.location = "Administrar_perfil"
                            localStorage.setItem("intro", "true")
                        } else {
                            window.location = "login"
                        }
                    }
                })
            }
        })
    }
})
valid_pass.addEventListener("keyup", (e) => {
    val = e.target.value;
    const resultado = validarContrasena(val);
    document.querySelector("#msj").textContent = resultado;
})