var template = ""
var template2 = ""

var page_general = 0
var total_general = 0
var page_personal = 0
var total_personal = 0


document.querySelector('.btn-update-dolar').addEventListener('click', () => {
    asyncfunc()
    DOLAR_DB("DOLAR_DB")
    DOLAR_DB("BCV")

})
$(".pag-btn-bitacora-general").click((ele) => {
    cambiar_pagina_ajax(
        ele.target.dataset["direccion"],
        generar_bitacora_general,
        10,
        page_general,
        total_general
    );
});
$(".pag-btn-bitacora-personal").click((ele) => {
    cambiar_pagina_ajax(
        ele.target.dataset["direccion"],
        generar_bitacora_personal,
        10,
        page_personal,
        total_personal
    );
});

function generar_bitacora_general(page) {
    page_general = page
    template = ""
    $.ajax({
        url: "api_search",
        type: "GET",
        data: { randomnautica: "bitacora", subFunction: "bitacora", limite: 10, n: page },
        success: function (response) {
            let json = JSON.parse(response)
            total_general = json['total']
            json.lista.forEach(element => {
                template += `
                                <tr>
                                    <td>${element.nombre}</td>
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
}

function generar_bitacora_personal(page) {
    page_personal = page
    template2 = ""
    $.ajax({
        url: "api_search",
        type: "GET",
        data: { randomnautica: "bitacora", subFunction: "bitacora", limite: 10, n: page, ID: session_user_id },
        success: function (response) {
            let json = JSON.parse(response)
            total_personal = json['total']
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
}


generar_bitacora_general(page_general)
generar_bitacora_personal(page_personal)


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

let formDolar = document.getElementById("form_dolar");
formDolar.addEventListener("submit", (e) => {
    e.preventDefault();
    let data = new FormData(formDolar);
    $.ajax({
        url: "Controller/funcs/modificar_cosas.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            asyncfunc()
            DOLAR_DB("DOLAR_DB")
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: check'>Dolar Modificado</span>`,
                status: "success",
                pos: "bottom-right",
            });
        },
    });
})

async function asyncfunc() {
    $.ajax({
        url: "https://ve.dolarapi.com/v1/dolares",
        success: function (response) {
            document.getElementById('BCV_actual').textContent = response[0].promedio + " Bs"
        }
    })
}
asyncfunc()


DOLAR_DB("DOLAR_DB")

