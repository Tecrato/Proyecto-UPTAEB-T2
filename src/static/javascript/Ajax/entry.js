let hola = "";
const cargarEntrys = () => {
  $.ajax({
    url: "api_search",
    type: "GET",
    data: { randomnautica: "entradas" },
    success: function (response) {
      let template;
      let json = JSON.parse(response);
      console.log(json);
      json.lista.forEach((f) => {
        let fechaVencimiento = new Date(f.fecha_vencimiento);
        let fechaActual = new Date();
        fechaVencimiento.setMinutes(
          fechaVencimiento.getMinutes() + fechaVencimiento.getTimezoneOffset()
        );
        let diferencia = fechaVencimiento.getTime() - fechaActual.getTime();
        let diasRestantes = Math.ceil(diferencia / (1000 * 60 * 60 * 24));
        let color;
        let texto;
        (diasRestantes);
        if (f.existencia == 0) {
          color = "activeEmpty";
          texto = "NO DISPONIBLE";
        } else if (diasRestantes <= 10 && diasRestantes >= 1) {
          color = "activeCloseToExpire";
          texto = "POR VENCER";
        } else if (diasRestantes > 10) {
          color = "activeGood";
          texto = "ACTIVO";
        } else if (diasRestantes <= 0) {
          color = "activeExpire";
          texto = "EXPIRO";
        }

        template += `<tr data-proveedor="${f.proveedor}" data-productEntry="${f.producto}">
                              <td><img src="./static/images/btn_lote2.png" alt="" width="40"></td>
                              <td>${f.id}</td>
                              <td>${f.producto}</td>
                              <td>${f.fecha_vencimiento}</td>
                              <td>${f.precio_compra} Bs</td>
                              <td>
                                  <div class="${color} uk-border-rounded uk-text-center uk-text-bold" style="padding: 5px; width: 115px;">${texto}</div>
                              </td>
                          </tr>`;
      });
      $(".cont_entry").append(template);
      let table_entry = document.querySelector(".cont_entry").childElementCount;
      if (table_entry <= 0 || table_entry < 4) {
        document.querySelector(".altura_table_entry").style.height = "300px";
      } else {
        document.querySelector(".altura_table_entry").style.height = "100%";
      }
    },
  });
};
cargarEntrys()

$.ajax({
  url: "api_search",
  type: "GET",
  data: { randomnautica: "proveedores" },
  success: function (response) {
    let json = JSON.parse(response);
    json.lista.forEach((p) => {
      hola += `      
        <li uk-filter-control="[data-proveedor='${p.razon_social}']"><a href="#" class="prov-entry-products" idSup="${p.id}">${p.razon_social}</a></li>    
      `;
    });
    $(".filter_prov_entry").html(hola);

    let listItem = document.querySelectorAll(".prov-entry-products");
    listItem.forEach((e) => {
      e.addEventListener("click", () => {
        let idSup = e.getAttribute("idSup");
        let template = "";
        $.ajax({
          url: "api_search",
          type: "GET",
          data: { randomnautica: "entradas", id_proveedor: idSup },
          success: function (response) {
            let json = JSON.parse(response);
            json.lista.forEach((l) => {
              template += `<li uk-filter-control="[data-productEntry='${l.producto}']"><a href="#">${l.producto}</a></li>`;
            });

            $(".filter_prov_entry_product").html(template);
          },
        });
      });
    });
  },
});

let bool = true
let btnAggMetodoPago = document.querySelector(".btn_agg_metodoPago")
// Agregar metodo de pago
btnAggMetodoPago.addEventListener('click', () => {
  ("click");
  // Incrementar el contador para obtener el id único de cada pago
  // Obtener el contenedor de los métodos de pago
  let cont = document.querySelector(".cont_metodos_pagos")
  // Obtener todos los select de métodos de pago existentes
  let selectOptions = document.querySelectorAll(".selectMetodoPago")
  // Obtener los valores de los select seleccionados
  let options = []
  selectOptions.forEach((select) => {
    let option = select.options[select.selectedIndex]
    options.push(option.value)
  })
  let availableOptions = []
  $.ajax({
    url: "api_search",
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
      let template = `<div class="inputPago">
                          <div class="uk-flex uk-flex-around">
                              <select class="uk-select selectMetodoPago uk-form-small" name="" id="" style="background-color: transparent; border: transparent; width: 150px;">
                                  <option disabled>TIPO DE PAGO</option>
                                  ${availableOptions.map(option => `<option value="${option.id}">${option.nombre}</option>`).join('')}
                              </select>
                              <input class="uk-input uk-form-small uk-form-width-small AMOUNT-MP" placeholder="Monto" type="text" style="background-color: transparent; border: transparent;">
                               <button class="btn-deleteMP" uk-icon="trash"></button> 
                          </div>
                          <hr class="uk-margin-remove">
                      </div>`


      let contMetodos = document.querySelector(".cont_metodos_pagos")
      if (contMetodos.childElementCount == 0) {
        $(".cont_metodos_pagos").append(template)
        // Agregar la nueva plantilla al contenedor de los métodos de pago finales
        bool = false
      }
      if (contMetodos.lastElementChild.firstElementChild.firstElementChild.nextElementSibling.value == "") {
        bool = false
      }

      if (bool == true) {
        $(".cont_metodos_pagos").append(template)
        // Agregar la nueva plantilla al contenedor de los métodos de pago finales
      }
      // Agregar la nueva plantilla al contenedor de los métodos de 
      let select = document.querySelectorAll(".selectMetodoPago")


      //este sera el evento en donde colocaremos en pagos finales, el valor del input
      //seleccionamos todos los select
      let amount = []
      let INP = document.querySelectorAll(".AMOUNT-MP")
      let totalDebito = document.querySelector(".amount_MP")

      INP.forEach((B) => {

        // captamos el evento de keyup, osea si el usuario teclea sobre el input
        B.addEventListener("change", () => {
          if (B.value == "") {
            bool = false
          } else {
            bool = true
          }

          // let amount = []

          // INP.forEach((B) => {
          //   amount.push(B.value)
          // })
          // (totalDebito);
          // (amount);
          // let result = 0
          // amount.forEach((a) => {
          //   let number = a == "" ? 0 : parseFloat(a)
          //   result += number
          // })
          // let valor = totalDebito - result
          // totalDebito.textContent =  valor

          let valor = B.value == "" ? 0 : parseFloat(B.value)
          // ActualizarTotal()
          let valor2 = parseFloat(B.parentElement.parentElement.parentElement.parentElement.parentElement.firstElementChild.lastElementChild.textContent)
          // if (B.previousElementSibling.value == "Divisa" && valor2 != 0) {
          //   B.parentElement.parentElement.parentElement.parentElement.parentElement.firstElementChild.lastElementChild.textContent = (valor2 -(valor * dolar)).toFixed(2)
          // } else
          if (valor2 != 0 && B.value != "") {
            B.parentElement.parentElement.parentElement.parentElement.parentElement.firstElementChild.lastElementChild.textContent = (valor2 - valor).toFixed(2)
          }
        })
      })


      //esta parte es para eliminar un registro en los tipos de pago
      //seleccionamos todos los btn de eliminar, los recorremos y le asignamos el evento click
      let btnDeleteMP = document.querySelectorAll(".btn-deleteMP")
      btnDeleteMP.forEach((btn) => {
        btn.addEventListener('click', () => {
          //seleccionamos el contenedor de los tipos de pago en la izquierda, y removemos al hijo
          cont.removeChild(btn.parentElement.parentElement)

          for (const f of INP) {
            (f.value);
          }
          // amount.pop()
          let result = 0

          amount.forEach((a) => {
            let number = a == "" ? 0 : parseFloat(a)
            result += number
          })

            (btn.parentElement.parentElement.parentElement);

        })
      })
    }
  })
})

//aqui hacemos la funcion para el credito

let checkCredito = document.querySelector(".check_entrys")
$('.formCredito_entrys').hide()

let credito = 1
checkCredito.addEventListener("change", () => {
  if (checkCredito.checked == true) {
    credito = 0
    $('.cont_metodos_pagos').hide()
    $('.btn_agg_metodoPago').hide()
    $('.amount_MP').hide()
    document.querySelector(".name_MP").textContent = "FECHA DE CREDITO"
    $('.formCredito_entrys').show()
  } else {
    credito = 1
    $('.cont_metodos_pagos').show()
    $('.btn_agg_metodoPago').show()
    $('.amount_MP').show()
    document.querySelector(".name_MP").textContent = "TIPO DE PAGO"
    $('.formCredito_entrys').hide()
  }
})

document.getElementById("input-search-fact").addEventListener("keyup", (e) => {
  //obtenemos el valor de lo que el usuario teclea
  let val = e.target.value;
  //si no esta vacio, entonces enviamos una solicitud ajax para buscar los clientes
  if (val != "") {
    $.ajax({
      url: "api_search",
      type: "GET",
      data: { randomnautica: "proveedores", like: val },
      success: function (response) {
        let json = JSON.parse(response);
        let LI = "";
        //recorremos la respuesta del server y creamos el template de los li
        json.lista.forEach((dato) => {
          LI += `   <li class="Client_register" name="${dato.razon_social}" ci="${dato.rif}" id="${dato.id}">
                      <div class="uk-padding-remove-vertical uk-flex uk-flex-middle">
                          <span class="uk-margin-small-right" uk-icon="user"></span>
                          <p class="uk-margin-small">${dato.razon_social}</p>
                      </div>
                    </li>`;
        });
        document.getElementById("Client").innerHTML = LI;

        let ClienteDetails = "";
        //ahora que los resultados se imprimieron, procedemos a captar el evento click sobre las opciones que se imprimieron
        const Clientes = document.querySelectorAll(".Client_register");

        // Con esto recorremos todos los clientes cargados, y dependiendo de cual pulse, nos trae el nombre del cliente
        // luego recorremos los datos del los clientes y el nombre lo comparamos con el extraido anteriormente
        //si es igual, entonces remplaza el contenido de cliente-details por el nombre del usuario y la cedula

        Clientes.forEach((date) => {
          date.addEventListener("click", () => {
            let name = date.getAttribute("name");
            let CI = date.getAttribute("ci");
            let ID = date.getAttribute("id");

            ClienteDetails = ` 
                              <div class="uk-flex uk-flex-column uk-flex-middle pointer" value="${ID}" >
                                <a class="Bg-user" uk-icon="icon: user; ratio: 1"></a>
                                <p class="uk-margin-remove uk-margin-small-bottom uk-text-meta">Cliente: <b>${name}</b></p>
                                <p class="uk-margin-remove uk-text-meta">Cedula: <b>${CI}</b></p>
                              </div>
                            `;

            document.getElementById("Client-datails").innerHTML =
              ClienteDetails;
          });
        });

        //esta validacion sirve para que cuando la respuesta del server sea vacia, cree un template para ese caso
        if (json.lista.length == 0) {
          document.getElementById("Client").innerHTML = `
          <li>
              <div class="uk-padding-remove-vertical uk-flex uk-flex-middle">
                  <span class="uk-margin-small-right" uk-icon="history"></span>
                  <p class="uk-margin-small">no se encontro resultado</p>
              </div>
              <div class="uk-padding-remove-vertical uk-flex uk-flex-middle">
                <div class="uk-flex uk-flex-center uk-margin-small-top" style="width: 100%;">
                    <a href="Proveedor" class="uk-button uk-button-default">Registrar Proveedor</a>
                </div>
              </div>
          </li>`;
        }
      },
    });
  } else {
    //si el usuario no teclea nada, osea el input se encuentra vacio, el container sera vacio
    document.getElementById("Client").innerHTML = "";
  }
});


//cargar productos
function func(dolar) {
  document.getElementById('Tasa_dolar_fact').textContent = (dolar) + " $"

  $.ajax({
    url: "api_search",
    type: "GET",
    data: { randomnautica: "productos" },
    success: function (response) {
      let productos = JSON.parse(response).lista;

      // aqui seleccionamos el contenedor de la tabla de la izquierda, es decir el tbody donde luego insertaremos los tr
      const ContainerTr = document.getElementById("Product-detail-1");

      //creamos el template donde estara el tr
      let tr = "";
      //recorremos los productos y creamos los tr
      //el tr tendra el value del id, para luego verificar si es igual al de la base de datos
      const InsertarProductos = () => {
        productos.forEach((producto) => {
          //esta condicion es para que agg el tr, pero modificando el tamaño del input de cantidad, para que se vea bien en versiones mobiles

          (dolar);

          if (screen >= 1100) {
            tr += `
          <tr value="${producto.id}" class="TR-Product uk-light">
              <td style="display: none">
                  <input type="hidden" value="${producto.id}">
              </td>
              <td class="uk-text-nowrap uk-table-shrink">
                  <input type="hidden" value="${producto.nombre + " " + producto.valor_unidad + " " + producto.unidad + " " + producto.marca}">
                  ${producto.nombre + " " + producto.valor_unidad + " " + producto.unidad + " " + producto.marca}
              </td>
              <td>
                  <select class="uk-select" name="" id="">
                      <option value="Saco">Saco</option>
                      <option value="Paquete">Paquete</option>
                      <option value="Bulto">Bulto</option>
                      <option value="Paca">Paca</option>
                      <option value="Caja">Caja</option>
                  </select>
              </td>
              <td>
                  <input class="uk-input uk-form-width-small" type="number" aria-label="disabled"" placeholder="magnitud mercancia">
              </td>
              <td>
                  <input class="uk-input uk-form-width-small State-input-stock" type="text" placeholder="Cantidad" aria-label="Input">
              </td>
              <td>
                  <input class="uk-input uk-form-width-small State-input-stock" type="date" placeholder="Cantidad" aria-label="Input">
              </td>
              <td>
                  <input class="uk-input uk-form-width-small State-input-stock" type="text" placeholder="Precio" aria-label="Input">
              </td>
              <td class="uk-flex uk-flex-center">
                  <button class="uk-icon-button ButtonPlus" uk-icon="plus"></button>
              </td>
              <td style="display: none">
                  <input type="hidden" value="${(producto.precio_venta / parseFloat(dolar)).toFixed(2)}">
              </td>
          </tr>
      `;
          } else {
            tr += `
          <tr value="${producto.id}" class="TR-Product uk-light">
              <td>
                  <input type="hidden" value="${producto.nombre}">
                  <p class="uk-margin-remove uk-text-truncate">${producto.nombre}</p>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall" type="text" aria-label="disabled" value="${producto.stock ? producto.stock : 0
              }" disabled>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall" type="text" aria-label="disabled" value="${producto.precio_venta
              }" disabled>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall State-input-stock" type="text" placeholder="Cantidad" aria-label="Input">
              </td>
              <td class="uk-flex uk-flex-center">
                  <input type="hidden" value="${producto.IVA}">
                  <button class="uk-icon-button ButtonPlus" uk-icon="plus"></button>
              </td>
          </tr>
      `;
          }

        });
      };

      InsertarProductos();

      //aqui insertamos los tr
      ContainerTr.innerHTML += tr;


      //creamos esta funcion que calculara los montos de la factura
      let ActualizarTotal = () => {
        //obtenemos los valores del iva, ya sean true o false
        let IvaController = document.querySelectorAll(".total_pagar_entrys");
        let priceFinal = 0;
        for (const algo of IvaController) {
          let monto = parseFloat(algo.parentElement.previousElementSibling.textContent)
          priceFinal += monto
        }

        //obtenemos el contenedor del total
        (document.getElementById("totalFact").textContent = priceFinal.toFixed(2) + " BS");
        (document.getElementById("totalFact$").textContent = (priceFinal / (dolar)).toFixed(2) + " $");
        document.querySelector(".amount_MP").textContent = priceFinal.toFixed(2) + " BS"


        // document.getElementById("IGTF").textContent = "0.00 $"
        // let INP = document.querySelectorAll(".AMOUNT-MP")
        // INP.forEach((B) => {
        //   // captamos el evento de keyup, osea si el usuario teclea sobre el input
        //   if (B.previousElementSibling.value == "Divisa") {
        //     let IGTF = 0;
        //     IGTF = parseFloat(B.value) * 0.3
        //     if (B.value == "") {
        //       document.getElementById("IGTF").textContent = "0.00 $"
        //       document.getElementById("totalFact$").textContent = "0.00 $"
        //     } else {
        //       document.getElementById("IGTF").textContent = IGTF.toFixed(2) + " $"
        //       let monto$ = parseFloat(document.getElementById("totalFact$").textContent)
        //       monto$ += IGTF
        //       document.getElementById("totalFact$").textContent = monto$.toFixed(2) + " $"
        //     }

        //   }
        // })
      };

      //seleccionamos todos los botones de +, ya que necesitamos agg los valores del tr en la tabla de la derecha
      let botonAgg = document.querySelectorAll(".ButtonPlus");
      //este sera el template de los tr de la tabla de la derecha
      let trDetail = "";
      //recorremos los botones para ver las etiquetas html
      botonAgg.forEach((boton) => {
        //con esto sabremos que boton pertenece a cada tr
        boton.addEventListener("click", () => {
          //esta varible accedemos al padre del boton, osea el tr
          //ademas de una lista de todos los child, esto es para poder obtener los valores que el usuario escoja
          let valor = boton.parentElement.parentElement.children;
          //esta variable contiene el nombre del producto, para luego hacer una comprobaciob
          let valor2 = boton.parentElement.parentElement.attributes.value.textContent;
          // este array guardara los datos del producto que puso el cliente
          let array = [];

          //con este bucle, recorremos todos los hijos del tr
          for (const child of valor) {
            //por cada vuelta, inserta en el array el valor de los inputs, dentro de cada TD
            array.push(child.firstElementChild.value);
          }
          let idProducto = valor2;
          let cantidad = array[4] == "" ? 0 : parseInt(array[4]);

          // Seleccionamos el tbody de la tabla de la derecha
          let tbody = document.getElementById("Detail-product-fact");
          let filas = tbody.getElementsByTagName("tr");
          let existeProducto = false;

          // Si el producto no existe, agregamos una nueva fila
          let trDetail = `
            <tr class="uk-light">
              <td style="display: none">${array[0]}</td>
              <td class="id_trDetail">${array[1]}</td>
              <td>${array[2]}</td>
              <td>${array[3]}</td>
              <td>${cantidad}</td>
              <td>${array[5]}</td>
              <td>${array[6]}</td>
              <td>${cantidad * parseFloat(array[6])} BS</td>
              <td class="uk-flex uk-flex-center">
                <input type="hidden" class="total_pagar_entrys">
                <button class="uk-icon-button Btn-delete_entrys" uk-icon="trash"></button>
              </td>
            </tr>
          `;

          //en esta condicion mostraremos un mensaje si el campo de cantidad esta vacio
          if (array[3] == "" || array[4] == "" || array[5] == "" || array[6] == "") {
            boton.setAttribute("uk-tooltip", "title:Los campos no pueden estar vacios");
            boton.classList.add("tooltip-efect");
            UIkit.tooltip(".tooltip-efect").show();

            setTimeout(() => {
              boton.removeAttribute("uk-tooltip");
              boton.classList.remove("tooltip-efect");
            }, 800);
          } else if (array[3] != "" && array[4] != "" && array[5] != "" && array[6] != "") {
            tbody.innerHTML += trDetail;
            ActualizarTotal()
          }

          //con esta variable guardamos los botones de eliminar de cada tr, de la tabla de la derecha
          let BtnDeleteEntrys = document.querySelectorAll(".Btn-delete_entrys");
          //recorremos los botones para obtener la etiqueta html
          for (const btn of BtnDeleteEntrys) {
            btn.addEventListener("click", () => {

              //aqui obtenemos el tr del boton que estamos pulsando
              let trash = btn.parentElement.parentElement;
              //seleccionamos el tbody de la tabla de la derecha y removemos al hijo
              // que en este caso, es la variable anterior
              document.getElementById("Detail-product-fact").removeChild(trash);
              // y luego actualizamos el total a pagar
              ActualizarTotal();
              let idTableDetail = parseInt(btn.parentElement.parentElement.firstElementChild.textContent);
            });
          }

          //esto actualiza el total a pagar
          //se actualiza dos veces, ya que esta actualiza al agg contenido de la tabla de la izquierda en la de la derecha
          // y tambien se llama cuando eliminamos un registro en la tabla de la derecha, ya que toma los tr, los vuelve
          // a recorrer y vuelve a sumar los montos

        });
      });

      //funcion para agg metodos de pago
      //este contador se usa para determinar el id de cada pago, para manipular los eventos en dos lados
      let bool = true
      function removeEventListenerIfExists(element, event, handler) {
        const clone = element.cloneNode(true);
        element.replaceWith(clone);
        return clone;
      }
      let btnAggMetodoPago = document.querySelector(".btn_agg_metodoPago")
      btnAggMetodoPago = removeEventListenerIfExists(btnAggMetodoPago, 'click');
      // Agregar metodo de pago
      btnAggMetodoPago.addEventListener('click', () => {

        // Incrementar el contador para obtener el id único de cada pago
        // Obtener el contenedor de los métodos de pago
        let cont = document.querySelector(".cont_metodos_pagos")
        // Obtener todos los select de métodos de pago existentes
        let selectOptions = document.querySelectorAll(".selectMetodoPago")
        // Obtener los valores de los select seleccionados
        let options = []
        selectOptions.forEach((select) => {
          let option = select.options[select.selectedIndex]
          options.push(option.value)
        })
        let availableOptions = []
        $.ajax({
          url: "api_search",
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
            let template = `<div class="inputPago">
                          <div class="uk-flex uk-flex-around">
                              <select class="uk-select selectMetodoPago uk-form-small" name="" id="" style="background-color: transparent; border: transparent; width: 150px;">
                                  <option disabled>TIPO DE PAGO</option>
                                  ${availableOptions.map(option => `<option value="${option.id}">${option.nombre}</option>`).join('')}
                              </select>
                              <input class="uk-input uk-form-small uk-form-width-small AMOUNT-MP" placeholder="Monto" type="text" style="background-color: transparent; border: transparent;">
                               <button class="btn-deleteMP" uk-icon="trash"></button> 
                          </div>
                          <hr class="uk-margin-remove">
                      </div>`


            let contMetodos = document.querySelector(".cont_metodos_pagos")
            if (contMetodos.childElementCount == 0) {
              $(".cont_metodos_pagos").append(template)
              // Agregar la nueva plantilla al contenedor de los métodos de pago finales
              bool = false
            }
            if (contMetodos.lastElementChild.firstElementChild.firstElementChild.nextElementSibling.value == "") {
              bool = false
            }


            if (bool == true) {
              $(".cont_metodos_pagos").append(template)
              // Agregar la nueva plantilla al contenedor de los métodos de pago finales
            }
            // Agregar la nueva plantilla al contenedor de los métodos de 
            let select = document.querySelectorAll(".selectMetodoPago")


            //este sera el evento en donde colocaremos en pagos finales, el valor del input
            //seleccionamos todos los select
            let INP = document.querySelectorAll(".AMOUNT-MP")
            let totalDebito = document.querySelector(".amount_MP");
            let initialTotalDebito = parseFloat(totalDebito.textContent);

            INP.forEach((B) => {

              // captamos el evento de keyup, osea si el usuario teclea sobre el input
              B.addEventListener("keyup", () => {
                if (B.value == "") {
                  bool = false
                } else {
                  bool = true
                }
                let valor = B.value == "" ? 0 : parseFloat(B.value)
                if (B.previousElementSibling.options[B.previousElementSibling.selectedIndex].textContent == "Divisa") {
                  totalDebito.textContent = (initialTotalDebito - (valor * dolar)).toFixed(2) + " Bs"
                } else {
                  totalDebito.textContent = (initialTotalDebito - valor).toFixed(2) + " BS"
                }
              })
            })

            //esta parte es para eliminar un registro en los tipos de pago
            //seleccionamos todos los btn de eliminar, los recorremos y le asignamos el evento click
            let btnDeleteMP = document.querySelectorAll(".btn-deleteMP")
            btnDeleteMP.forEach((btn) => {
              btn.addEventListener('click', () => {
                //seleccionamos el contenedor de los tipos de pago en la izquierda, y removemos al hijo
                cont.removeChild(btn.parentElement.parentElement)
                let value = parseFloat(btn.previousElementSibling.value)
                if (btn.previousElementSibling.previousElementSibling.options[btn.previousElementSibling.previousElementSibling.selectedIndex].textContent == "Divisa") {
                  totalDebito.textContent = (parseFloat(totalDebito.textContent) + (value * dolar)).toFixed(2) + " Bs"
                } else {
                  totalDebito.textContent = (parseFloat(totalDebito.textContent) + value).toFixed(2) + " BS"
                }
              })
            })
          }
        })
      })



      //funcion para verificar si ya se puede enviar los datos para hacer la factura
      let btnCreateFact = document.querySelector(".btnCreateFact");

      btnCreateFact.addEventListener("click", () => {
        let tipoPago = document.querySelector(".cont_metodos_pagos").childElementCount
        let TotalRestar = parseFloat(document.querySelector(".amount_MP").textContent)

        // let idCasher = document.querySelector(".Casher").getAttribute("id");
        let idClient = document.getElementById("Client-datails").firstElementChild.getAttribute("value")
        let tableDetailProduct = document.getElementById("Detail-product-fact").childElementCount;


        //este json sera el que se envie al server para insertar los datos de la factura
        let json = {
          proveedor: parseInt(idClient),
          tipo: "entrada",
          fecha_compra: document.querySelector(".date_compra_entrys").value,
          codigo: (Math.random() * 50000).toFixed(0),
          detalles: document.querySelector(".detalles-compra_entry").value,
          metodos_pagos: [],
          lista: [],
        };


        if (idClient == "default") {
          btnCreateFact.setAttribute("uk-tooltip", "title:Debe seleccionar un proveedor; pos: right");
          UIkit.tooltip(".btnCreateFact").show();
          setTimeout(() => { btnCreateFact.removeAttribute("uk-tooltip"); }, 1000);
        } else if (tableDetailProduct == 0) {
          btnCreateFact.setAttribute("uk-tooltip", "title:Debe ingresar producto; pos: right");
          UIkit.tooltip(".btnCreateFact").show();
          setTimeout(() => { btnCreateFact.removeAttribute("uk-tooltip"); }, 1000);
        } else if (tipoPago == 0 && !checkCredito.checked) {
          btnCreateFact.setAttribute("uk-tooltip", "title:Debe ingresar forma de pago; pos: right;");
          UIkit.tooltip(".btnCreateFact").show();
          setTimeout(() => { btnCreateFact.removeAttribute("uk-tooltip"); }, 1000);
        } else if (TotalRestar != 0 && !checkCredito.checked) {
          btnCreateFact.setAttribute("uk-tooltip", "title:Debe ingresar un monto en el pago; pos: right");
          UIkit.tooltip(".btnCreateFact").show();
          setTimeout(() => { btnCreateFact.removeAttribute("uk-tooltip"); }, 1000);
        } else {
          let blo = document.getElementById("Detail-product-fact").children;
          for (const iterator of blo) {
            let id = iterator.firstElementChild.textContent
            let precio_compra = iterator.lastElementChild.previousElementSibling.previousElementSibling.textContent
            let fechaV = iterator.lastElementChild.previousElementSibling.previousElementSibling.previousElementSibling.textContent
            let mercancia = iterator.firstElementChild.nextElementSibling.nextElementSibling.textContent
            let t_mercancia = iterator.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.textContent
            let cantidad_m = iterator.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent

            // insertamos los datos de los productos por cada tr que haya en detalles de factura
            json.lista.push({
              id_producto: id,
              precio_compra: precio_compra,
              fecha_vencimiento: fechaV,
              mercancia: mercancia,
              t_mercancia: t_mercancia,
              cantidad_mercancia: cantidad_m,
            });
          }

          let select = document.querySelectorAll(".selectMetodoPago")
          select.forEach((e) => {

            (e.value);
            let valor = e.value
            let monto = e.nextElementSibling.value

            json.metodos_pagos.push({
              metodo: valor,
              monto: monto
            });

          })

          //envio de datos con ajax
          //preparamos el json
          console.log(json);
          let jsonString = JSON.stringify(json);



          $.ajax({
            url: "api_agregar",
            type: "POST",
            data: json,
            success: function (response) {
              console.log(response);

            },
          });

        }

      });

      //con esto hacemos la busqueda de los productos
      document
        .getElementById("SearchProduct-Fact")
        .addEventListener("keyup", (e) => {
          if (e.target.matches("#SearchProduct-Fact")) {
            document.querySelectorAll(".TR-Product").forEach((r) => {
              if (r.firstElementChild.lastElementChild.textContent.toLowerCase().includes(e.target.value)) {
                r.classList.remove("invisible");
              } else {
                r.classList.add("invisible");
              }
            });
          }
        });
    },
  });
}
DOLAR_RV(func)




        $(document).ready(function () {
            // Inicialización de la tabla con AJAX
            var table = $('#miTabla').DataTable({
                "ajax": {
                    "url": "api_search", // URL de la petición AJAX
                    "type": "GET",
                    "data": { randomnautica: "entradas" },  // Parámetros enviados al servidor
                    "dataSrc": "lista"  // Espera que la respuesta JSON contenga un array en 'data'
                },
                "columns": [
                    { "data": "id" },
                    { "data": "id_producto" },
                    { "data": "fecha_vencimiento" },
                    { "data": "precio_compra" },
                ],
                "dom": 'Plfrtip',  // Integrar SearchPanes en el DOM
                "searchPanes": {
                    "panes": [
                        { header: 'Producto', options: [{ label: 'Producto A', value: 'Producto A' }, { label: 'Producto B', value: 'Producto B' }] },
                        { header: 'Proveedor', options: [{ label: 'Proveedor 1', value: 'Proveedor 1' }, { label: 'Proveedor 2', value: 'Proveedor 2' }] }
                    ]
                },
                "select": false  // Habilitar la selección
            });

            // Inicializar el DateTime picker para el filtro de rango de fechas
            var minDate, maxDate;
            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });

            // Filtro de rango de fechas
            $('#min, #max').on('change', function () {
                table.draw();
            });

            // Extender el método de búsqueda de DataTables para filtrar por rango de fechas
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = moment(data[2], 'YYYY-MM-DD');  // Columna de fecha (índice 3)

                if (
                    (min === null && max === null) ||
                    (min === null && date.isSameOrBefore(max)) ||
                    (min.isSameOrBefore(date) && max === null) ||
                    (min.isSameOrBefore(date) && date.isSameOrBefore(max))
                ) {
                    return true;
                }
                return false;
            });
        });