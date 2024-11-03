
var page_cajas = 0
var total_cajas = 0


$(".pag-btn-cajas").click((ele) => {
    cambiar_pagina_ajax(
        ele.target.dataset["direccion"],
        cargarCajas,
        10,
        page_cajas,
        total_cajas
    );
});

const checkCaja = () => {
    $.ajax({
        url: "api_caja",
        type: "POST",
        data: { accion: "check" },
        success: function (response) {
            (response);
            let json = JSON.parse(response);
            if (json.estado == "no") {
                document.getElementById("check_box").textContent = "CERRADA";
            } else {
                document.getElementById("check_box").textContent = "ABIERTA";
            }
        }
    })
}

$.ajax({
    url: "api_search",
    type: "POST",
    data: { randomnautica: "usuario" },
    success: function (response) {
        let json = JSON.parse(response);
        let options = ``;
        json.lista.forEach((date) => {
            options += `<option value="${date.id}">${date.nombre}</option>`;
        });
        document.querySelector(".selectUserBox").innerHTML = options;
    }
});

function TrCaja(response) {
    let json = JSON.parse(response);
    total_cajas = json['total']
    let template = ""
    json.lista.forEach(element => {
        template += `<tr>
                                <td>${element.id}</td>
                                <td>${element.nombre_usuario}</td>
                                <td>${fecha(element.fecha)}</td>
                                <td>${element.monto_inicial}</td>
                                <td>${hora(element.fecha)}</td>
                                <td>${element.fecha_cierre == null ? "00:00" : hora(element.fecha_cierre)}</td>
                                <td>${element.total_ventas}</td>
                                <td>${parseFloat(element.monto_credito).toFixed(2)} $</td>
                                <td>
                                    <a uk-tooltip="Imprimir Cierre" href="PDFCierreCaja/${element.id}" class="btn_print_closeBox">${element.monto_final == null ? element.monto_inicial : parseFloat(element.monto_final).toFixed(2)} Bs</a>
                                </td>
                                <td>
                                    <div class="${element.estado == 0 ? "activeGood" : "activeExpire"} uk-border-rounded" style="padding: 5px;">${element.estado == 0 ? "ABIERTA" : "CERRADA"}</div>
                                </td>
                                <td class="${element.estado == 1 ? "invisible" : ""}">
                                    <a  href="#cierre-caja" uk-toggle class="uk-button uk-button-default cerrarCaja date_caja invisible">CERRAR CAJA</a>
                                </td>
                            </tr>`
    })

    $("#tbody_caja").html(template)
    if (parseInt(session_user_rol_num) == 1) {
        $(".cerrarCaja").removeClass("invisible")
        $(".btn_agg_caja").removeClass("invisible")
    } else {
        PermisosG(".cerrarCaja", null, "caja", ".btn_agg_caja", "G")
    }

    let cerrarCaja = document.querySelectorAll(".cerrarCaja");
    cerrarCaja.forEach((element) => {
        element.addEventListener("click", () => {
            let id = element.parentElement.parentElement.firstElementChild.textContent
            let formCloseBox = document.querySelector("#FORM-CLOSE-BOX")
            formCloseBox.addEventListener('submit', (e) => {
                e.preventDefault()
                let data = new FormData(formCloseBox)
                data.append('id_caja', id)
                data.append('accion', "cerrar")

                $.ajax({
                    url: 'api_caja',
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        cargarCajas(0)
                        checkCaja()
                        UIkit.notification.closeAll();
                        UIkit.notification({
                            message: `<span uk-icon='icon: check'>Caja Cerrada</span>`,
                            status: "success",
                            pos: "bottom-right",
                        });
                        setTimeout(() => {
                            UIkit.modal("#cierre-caja").hide();
                        }, 400)
                    }
                })
            })
        })
    })
}
function cargarCajas(page) {
    let data = {}
    if (parseInt(session_user_rol_num) <= 2) {
        data = { randomnautica: "caja", n: page_cajas, limite: 10 }
    } else {
        data = { randomnautica: "caja", n: page_cajas, limite: 10, id_usuario: session_user_id }
    }
    page_cajas = page
    $.ajax({
        url: "api_search",
        type: "POST",
        data: data,
        success: function (response) {
            TrCaja(response)
        }
    })
}
cargarCajas(0)

//filtro de creditos

//filtro por fecha
let FORM_BOX_DATE = document.querySelector(".FORM_BOX_DATE")
FORM_BOX_DATE.addEventListener("submit", (e) => {
    e.preventDefault()
    let fecha_inicio = FORM_BOX_DATE.firstElementChild.firstElementChild.lastElementChild.value
    let fecha_fin = FORM_BOX_DATE.firstElementChild.lastElementChild.lastElementChild.value
    $.ajax({
        url: "api_search",
        type: "POST",
        data: { randomnautica: "credito", between_fecha: { inicio: fecha_inicio, fin: fecha_fin } },
        success: function (response) {
            console.log(JSON.parse(response));
            TrCaja(response)
        }
    })
})

let search_caja = document.querySelector(".search_caja")
search_caja.addEventListener("keyup", (e) => {
    let search = e.target.value
    $.ajax({
        url: "api_search",
        type: "POST",
        data: { randomnautica: "caja", like_nombre_usuario: search },
        success: function (response) {
            TrCaja(response)
        }
    })
})


checkCaja()


let formCaja = document.getElementById("FormCaja");
formCaja.addEventListener("submit", (e) => {
    e.preventDefault();
    let data = new FormData(formCaja);
    data.append("accion", "abrir");
    data.set('monto_inicial',getDatabaseFormattedValue('.inputFormatAmountCaja'))

    $.ajax({
        url: "api_caja",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            cargarCajas(0)
            checkCaja()
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: check'>Caja Abieta</span>`,
                status: "success",
                pos: "bottom-right",
            });
            setTimeout(() => {
                UIkit.modal("#caja-modal").hide();
            }, 400)
        }
    })
})
InputFormater('.inputFormatAmountCaja')
