let totalCredito = document.querySelector(".total_credito")


let bool = true
let btnAggMetodoPago = document.querySelector(".btn_agg_metodoPago2")
// Agregar metodo de pago
const metodoPago = () => {
    btnAggMetodoPago.addEventListener('click', () => {
        console.log("click");
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
            url: "Controller/funcs_ajax/search.php",
            type: "GET",
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
                                        <button uk-icon="check" type="button"></button> 
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

                //este sera el evento en donde colocaremos en pagos finales, el valor del input
                //seleccionamos todos los select
                let INP = document.querySelectorAll(".AMOUNT-MP2")
                const calcularTotal = () => {
                    INP.forEach((B) => {

                        // captamos el evento de keyup, osea si el usuario teclea sobre el input
                        B.addEventListener("change", () => {
                            if (B.value == "") {
                                bool = false
                            } else {
                                bool = true
                            }
                            let amount = []

                            INP.forEach((B) => {
                                if (B.previousElementSibling.children.namedItem("Divisa")) {
                                    let Divisa = B.previousElementSibling.children.namedItem("Divisa").value
                                    if (B.previousElementSibling.value == Divisa) {
                                        let dola = parseFloat(parseFloat(B.value) * parseFloat(document.getElementById("BCV").textContent))
                                        amount.push(dola)
                                    } else {
                                        amount.push(B.value)
                                    }
                                } else {
                                    amount.push(B.value)
                                }


                            })
                            let result = 0
                            amount.forEach((a) => {
                                let number = a == "" ? 0 : parseFloat(a)
                                result += number
                            })
                            document.querySelector(".total_pago_credito").textContent = result + ' Bs'
                            if (parseFloat(document.querySelector(".total_credito_bs").textContent.slice(13, Infinity)) != result) {
                                document.querySelector(".total_pago_credito").classList.remove("succesc")
                                document.querySelector(".total_pago_credito").classList.add("danger")
                            } else if (parseFloat(document.querySelector(".total_credito_bs").textContent.slice(13, Infinity)) == result) {
                                document.querySelector(".total_pago_credito").classList.remove("danger")
                                document.querySelector(".total_pago_credito").classList.add("succesc")
                            }


                        })
                    })
                }
                calcularTotal()


                //esta parte es para eliminar un registro en los tipos de pago
                //seleccionamos todos los btn de eliminar, los recorremos y le asignamos el evento click
                let btnDeleteMP = document.querySelectorAll(".btn-deleteMP2")
                btnDeleteMP.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        //seleccionamos el contenedor de los tipos de pago en la izquierda, y removemos al hijo
                        cont.removeChild(btn.parentElement.parentElement)
                        if (btn.previousElementSibling.previousElementSibling.children.namedItem("Divisa")) {
                            let divisa = btn.previousElementSibling.previousElementSibling.children.namedItem("Divisa").value
                            if (btn.previousElementSibling.previousElementSibling.value == divisa) {
                                let desc = parseFloat(document.querySelector(".total_pago_credito").textContent)
                                let dola = btn.previousElementSibling.value == "" ? 0 : parseFloat(btn.previousElementSibling.value) * parseFloat(document.getElementById("BCV").textContent)
                                document.querySelector(".total_pago_credito").textContent = (desc - dola).toFixed(2) + ' Bs'
                                calcularTotal()
                            } else {
                                let result = btn.previousElementSibling.value == "" ? 0 : parseFloat(btn.previousElementSibling.value)
                                let desc = parseFloat(document.querySelector(".total_pago_credito").textContent)
                                document.querySelector(".total_pago_credito").textContent = (desc - result).toFixed(2) + ' Bs'
                                if (parseFloat(document.querySelector(".total_pago_credito").textContent) == 0) {
                                    document.querySelector(".total_pago_credito").classList.remove("succesc")
                                    document.querySelector(".total_pago_credito").classList.remove("danger")
                                }
                            }
                        } else {
                            let result = btn.previousElementSibling.value == "" ? 0 : parseFloat(btn.previousElementSibling.value)
                            let desc = parseFloat(document.querySelector(".total_pago_credito").textContent)
                            document.querySelector(".total_pago_credito").textContent = (desc - result).toFixed(2) + ' Bs'
                            calcularTotal()
                        }
                        if (parseFloat(document.querySelector(".total_pago_credito").textContent) == 0) {
                            document.querySelector(".total_pago_credito").classList.remove("succesc")
                            document.querySelector(".total_pago_credito").classList.remove("danger")
                        }
                    })
                })
            }
        })
    })
}


$.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "credito" },
    success: function (response) {
        let json = JSON.parse(response);
        let template = ""
        console.log(json);
        json.lista.forEach((f) => {
            template += `
            
            <tr id_rv="${f.id_rv}" id="${f.id}">
                <td>${f.id}</td>
                <td>${f.nombre + " " + f.apellido}</td>
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
        let btn = document.querySelectorAll(".pagar_credito")

        btn.forEach((btn) => {
            btn.addEventListener("click", (e) => {
                let id = btn.parentElement.parentElement.getAttribute("id")
                $.ajax({
                    url: "Controller/funcs_ajax/search.php",
                    type: "GET",
                    data: { randomnautica: "credito", ID: id },
                    success: function (response) {
                        let json = JSON.parse(response);
                        totalCredito.textContent = "Total en $: " + json.lista[0].monto_final
                        document.querySelector(".total_credito_bs").textContent = "Total en Bs: " + parseFloat(document.getElementById("BCV").textContent) * parseFloat(json.lista[0].monto_final)
                        metodoPago()
                        let id_rv = btn.parentElement.parentElement.getAttribute("id_rv")
                        let btn_credito_pago = document.querySelector(".btn_pagar_credito")
                        btn_credito_pago.addEventListener("click", () => {
                            let jf = []
                            let n = document.querySelectorAll(".AMOUNT-MP2")
                            n.forEach((B) => {
                                let value_input = B.value == "" ? 0 : B.value
                                let value_Tpago = B.previousElementSibling.value

                                jf.push({
                                    metodo: value_Tpago,
                                    monto: value_input
                                })
                            })
                            $.ajax({
                                url: "Controller/funcs_ajax/pagar_credito.php",
                                type: "POST",
                                data: { id_rv, pagos: jf },
                                success: function (response) {
                                    console.log(response);
                                }
                            })
                        })
                    }
                })
            })
        })
    }
})