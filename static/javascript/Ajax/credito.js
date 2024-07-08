let totalCredito = document.querySelector(".total_credito")
let valorInicial = parseFloat(totalCredito.getAttribute("data-initial-value")) || parseFloat(totalCredito.textContent);


let bool = true
let btnAggMetodoPago = document.querySelector(".btn_agg_metodoPago2")
// Agregar metodo de pago
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
                                  ${availableOptions.map(option => `<option value="${option.id}">${option.nombre}</option>`).join('')}
                              </select>
                              <input class="uk-input uk-form-small uk-form-width-small AMOUNT-MP2" placeholder="Monto" type="text" style="background-color: transparent; border: transparent;">
                               <button class="btn-deleteMP2" uk-icon="trash"></button> 
                          </div>
                          <hr class="uk-margin-remove">
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
                            amount.push(B.value)
                        })

                        let result = 0
                        amount.forEach((a) => {
                            let number = a == "" ? 0 : parseFloat(a)
                            result += number
                        })
                        let valor = valorInicial - result
                        totalCredito.textContent = valor
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
                    let valor2 = btn.previousElementSibling.value
                    let valor = parseFloat(totalCredito.textContent) + parseFloat(valor2)
                    totalCredito.textContent = valor
                })
            })
        }
    })
})