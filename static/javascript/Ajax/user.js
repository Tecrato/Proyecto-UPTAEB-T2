var template = ""
var template2 = ""

const hora = (f) => {
        const fecha = new Date(f);
        const horas = fecha.getHours();
        const minutos = fecha.getMinutes();
        const periodo = horas >= 12 ? "PM" : "AM";
        const horas12 = horas % 12 || 12;
        const horaFormateada = `${horas12}:${minutos < 10 ? `0${minutos}` : minutos} ${periodo}`;
    return horaFormateada
}
const fecha = (f) => {
    const fecha = new Date(f);
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    const fechaFormateada = `${dia}/${mes}/${anio}`;
    return fechaFormateada
}

var page_general = 0
var page_personal = 0

function generar_bitacora_general(page) {
    template = ""
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "bitacora", subFunction: "bitacora", limite: 10, n:page},
        success: function (response) {
           /*  console.log(response) */
            let json = JSON.parse(response)
            json.lista.forEach(element => {
                template += `
                                <tr>
                                    <td>${element.id_usuario}</td>
                                    <td>${element.detalles}</td>
                                    <td>${fecha(element.fecha)}</td>
                                    <td>${hora(element.fecha)}</td>
                                    <td>${element.tabla}</td>
                                </tr>
                                `
            });
            $("#registerSystem").html(template)
        },
    });
    page_general = page
}

function generar_bitacora_personal(page) {
    template2 = ""
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "bitacora", subFunction: "bitacora", limite: 10, n:page, ID: sesion_user_id },
        success: function (response) {
            let json = JSON.parse(response)
            json.lista.forEach(element => {
                template2 += `<tr>
                                <td>${element.detalles}</td>
                                <td>${fecha(element.fecha)}</td>
                                <td>${hora(element.fecha)}</td>
                                <td>${element.tabla}</td>
                            </tr>`
            });
            $("#registerActv").html(template2)
        },
    });
    page_personal = page
}
function cambiar_pagina_ajax(dir, type, func, limit = 9, page=0) {
    limit = limit
    $.ajax({
      url:
        `Controller/funcs_ajax/cambiar_pagina.php?dir=` + dir + "&p=" + page + "&type=" + type + "&n_p=" + limit,
      type: "GET",
      success: (response) => {
        console.log(response);
        func(parseInt(response));
      },
    });
}

$(".pag-btn-bitacora-general").click((ele) => {
    cambiar_pagina_ajax(
      ele.target.dataset["direccion"],
      "bitacora",
      generar_bitacora_general,
      10,
      page_general
    );
});
$(".pag-btn-bitacora-personal").click((ele) => {
    cambiar_pagina_ajax(
      ele.target.dataset["direccion"],
      "bitacora",
      generar_bitacora_personal,
      10,
      page_personal
    );
});

generar_bitacora_general(page_general)
generar_bitacora_personal(page_personal)


let btnGenerate = document.querySelector(".btn-generate")

// btnGenerate.addEventListener("click", () => {
//     const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
//     let result = '';
//     for (let i = 0; i < 20; i++) {
//       result += characters.charAt(Math.floor(Math.random() * characters.length));
//     }
//     document.querySelector(".input-seed").value = result

// })

$.ajax({
    url: "api_caja",
    type: "POST",
    data: { accion: "check" },
    success: function (response) {
        let json = JSON.parse(response);
        if (json.estado == "no") {
            document.getElementById("check_box").textContent = "CERRADA";
        } else {
            document.getElementById("check_box").textContent = "ABIERTA";
        }
    }
})