let totalCredito = document.querySelector(".total_credito")

var page_creditos = 0
var total_creditos = 0


$(".pag-btn-creditos").click((ele) => {
    cambiar_pagina_ajax(
        ele.target.dataset["direccion"],
        cargarCajas,
        10,
        page_cajas,
        total_cajas
    );
});


let bool = true
let btnAggMetodoPago = document.querySelector(".btn_agg_metodoPago2")
// Agregar metodo de pago
const metodoPago = (dolar) => {
    btnAggMetodoPago.addEventListener('click', () => {
        ("click");
        // Incrementar el contador para obtener el id único de cada pago
        // Obtener el contenedor de los métodos de pago
        let cont = document.querySelector(".inputPago")
        // Obtener todos los select de métodos de pago existentes
        let selectOptions = document.querySelectorAll(".selectMetodoPago2")
        // Obtener los valores de los select seleccionados
        let options = []
        selectOptions.forEach((select) => {
            let option = select.options[select.selectedIndex]
            options.push(option.value)
        })
        let availableOptions = []
        $.ajax({
            url: "api_search",
            type: "POST",
            data: { randomnautica: "metodo_pago" },
            success: function (response) {
                let json = JSON.parse(response);
                json.lista.forEach((date) => {
                    // Solo agregar opciones que no hayan sido seleccionadas previamente
                    if (!options.includes(date.id.toString())) {
                        availableOptions.push({
                            nombre: date.nombre,
                            id: date.id
                        });
                    }
                });

                // Crear la plantilla HTML para el nuevo método de pago
                let template = `<div>
                                    <div class="uk-flex uk-flex-around">
                                        <select class="uk-select selectMetodoPago2 uk-form-small" name="" id="" style="background-color: transparent; border: transparent; width: 150px;">
                                            <option disabled>TIPO DE PAGO</option>
                                            ${availableOptions.map(option => `<option name="${option.nombre}" value="${option.id}">${option.nombre}</option>`).join('')}
                                        </select>
                                        <input class="uk-input uk-form-small uk-form-width-small AMOUNT-MP2" placeholder="Monto" type="text" style="background-color: transparent; border: transparent;">
                                        <button class="btn-deleteMP2" uk-icon="trash"></button> 
                                    </div>
                                    <hr class="uk-margin">
                                </div>`


                let contMetodos = document.querySelector(".inputPago")
                if (contMetodos.childElementCount == 0) {
                    $(".inputPago").append(template)
                    // Agregar la nueva plantilla al contenedor de los métodos de pago finales
                    bool = false
                }
                if (contMetodos.lastElementChild.firstElementChild.firstElementChild.nextElementSibling.value == "") {
                    bool = false
                }

                if (bool == true) {
                    $(".inputPago").append(template)
                    // Agregar la nueva plantilla al contenedor de los métodos de pago finales
                }
                let totalDebito = document.querySelector(".total_pago_credito")
                let totalDebitoInit = parseFloat(totalDebito.textContent)
                //este sera el evento en donde colocaremos en pagos finales, el valor del input
                //seleccionamos todos los select
                let INP = document.querySelectorAll(".AMOUNT-MP2")
                InputFormaterAll(".AMOUNT-MP2")
                INP.forEach((B) => {
                    // captamos el evento de keyup, osea si el usuario teclea sobre el input
                    B.addEventListener("keyup", (e) => {
                        if (B.value == "") bool = false
                        else bool = true
                        let val = e.target.value == "" ? 0 : parseFloat(e.target.value.replace(/\./g, '').replace(',', '.'))
                        let divisa = B.parentElement.firstElementChild.options[B.parentElement.firstElementChild.selectedIndex].textContent
                        if (divisa == "Divisa" || divisa == "divisa") {
                            totalDebito.textContent = (totalDebitoInit + (val * dolar)).toFixed(2)
                        } else {
                            totalDebito.textContent = (totalDebitoInit + val).toFixed(2)
                        }
                        if (parseFloat(document.querySelector(".total_credito_bs").textContent.slice(13, Infinity)) == val) {
                            document.querySelector(".total_pago_credito").classList.add("succesc")
                        } else if ((parseFloat(document.querySelector(".total_credito_bs").textContent.slice(13, Infinity)) != val)) {
                            document.querySelector(".total_pago_credito").classList.remove("succesc")
                        }
                    })
                })


                //esta parte es para eliminar un registro en los tipos de pago
                //seleccionamos todos los btn de eliminar, los recorremos y le asignamos el evento click
                let btnDeleteMP = document.querySelectorAll(".btn-deleteMP2")
                btnDeleteMP.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        //seleccionamos el contenedor de los tipos de pago en la izquierda, y removemos al hijo
                        cont.removeChild(btn.parentElement.parentElement)
                        let val = btn.previousElementSibling.value == "" ? 0 : parseFloat(btn.previousElementSibling.value.replace(',', '.'))
                        console.log(val);
                        let divisa = btn.parentElement.firstElementChild.options[btn.parentElement.firstElementChild.selectedIndex].textContent
                        if (divisa == "Divisa" || divisa == "divisa") {
                            totalDebito.textContent = (parseFloat(totalDebito.textContent) - parseFloat((val * dolar).toFixed(2))).toFixed(2)
                        } else {
                            totalDebito.textContent = (parseFloat(totalDebito.textContent) - val).toFixed(2)
                        }
                    })
                })
            }
        })
    })
}
function TrCredito(response) {
    let json = JSON.parse(response);
    total_creditos = json['total']
    let template = ""
    json.lista.forEach((f) => {
        template += `
                
                <tr id_rv="${f.id_rv}" id="${f.id}">
                    <td>${f.id}</td>
                    <td>${f.nombre_cliente + " " + f.apellido_cliente}</td>
                    <td>${fecha(f.fecha_inicio)}</td>
                    <td>${fecha(f.fecha_limite)}</td>
                    <td>
                        <div class="${parseInt(f.status) == 0 ? "activeGood" : "activeEmpty"} uk-border-rounded" style="padding: 5px; width: 50%">${parseInt(f.status) == 1 ? "PENDIENTE" : "PAGADO"}</div>
                    </td>
                    <td>
                        <a uk-toggle href="#credito_page" class="uk-button uk-button-default pagar_credito ${parseInt(f.status) == 0 ? "invisible" : ""}">PAGAR</a>
                    </td>
                </tr>
                `
    })
    $("#Tbody_credito").html(template)

    $(".pagar_credito").click((btn) => {
        let id = btn.target.parentElement.parentElement.getAttribute("id")
        $.ajax({
            url: "api_search",
            type: "POST",
            data: { randomnautica: "credito", ID: id },
            success: function (response) {
                let json = JSON.parse(response);
                totalCredito.textContent = "Total en $: " + json.lista[0].monto_final
                document.querySelector(".total_credito_bs").textContent = "Total en Bs: " + (parseFloat(document.getElementById("BCV").textContent) * parseFloat(json.lista[0].monto_final)).toFixed(2)
                DOLAR_RV(metodoPago)
                let id_rv = btn.target.parentElement.parentElement.getAttribute("id_rv")
                let btn_credito_pago = document.querySelector(".btn_pagar_credito")
                btn_credito_pago.addEventListener("click", () => {
                    let jf = []
                    let n = document.querySelectorAll(".AMOUNT-MP2")
                    n.forEach((B) => {
                        let value_input = B.value == "" ? 0 : B.value
                        let value_Tpago = B.previousElementSibling.value

                        jf.push({
                            metodo: value_Tpago,
                            monto: value_input.replace(',','.')
                        })
                    })
                    $.ajax({
                        url: "api_credito",
                        type: "POST",
                        data: { id_rv, pagos: jf },
                        success: function (response) {
                            UIkit.notification.closeAll();
                            UIkit.notification({
                                message: `<span uk-icon='icon: check'>Pago de credito correctamente</span>`,
                                status: "success",
                                pos: "bottom-right",
                            });
                            setTimeout(() => {
                                UIkit.modal("#credito_page").hide();
                            }, 400)
                            TrCredito()
                        }
                    })
                })
            }
        })
    })
}
function generar_creditos(page) {
    page_creditos = page
    $.ajax({
        url: "api_search",
        type: "POST",
        data: { randomnautica: "credito", n: page_creditos, limite: 10 },
        success: function (response) {
            TrCredito(response)
        }
    })
}
generar_creditos(0)

//filtro de creditos

//filtro por fecha
let FORM_CREDIT_DATE = document.querySelector(".FORM_CREDIT_DATE")
FORM_CREDIT_DATE.addEventListener("submit", (e) => {
    e.preventDefault()
    let fecha_inicio = FORM_CREDIT_DATE.firstElementChild.firstElementChild.lastElementChild.value
    let fecha_fin = FORM_CREDIT_DATE.firstElementChild.lastElementChild.lastElementChild.value
    $.ajax({
        url: "api_search",
        type: "POST",
        data: { randomnautica: "credito", between_fecha: { inicio: fecha_inicio, fin: fecha_fin } },
        success: function (response) {
            TrCredito(response)
        }
    })
})

let search_credito = document.querySelector(".search_credito")
search_credito.addEventListener("keyup", (e) => {
    let search = e.target.value
    $.ajax({
        url: "api_search",
        type: "POST",
        data: { randomnautica: "credito", like_nombre_cliente: search },
        success: function (response) {
            TrCredito(response)
        }
    })
})