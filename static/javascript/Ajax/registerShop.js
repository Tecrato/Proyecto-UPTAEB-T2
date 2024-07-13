DOLAR_DB("Tasa_dolar_fact")
var pag_facturas = 0

function func(dolar) {
  $.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "GET",
  data: { randomnautica: "productos" },
  success: function (response) {
    let producto = JSON.parse(response);
    let productos = producto.lista;

    // aqui seleccionamos el contenedor de la tabla de la izquierda, es decir el tbody donde luego insertaremos los tr
    const ContainerTr = document.getElementById("Product-detail-1");

    //creamos el template donde estara el tr
    let tr = "";
    //recorremos los productos y creamos los tr
    //el tr tendra el value del id, para luego verificar si es igual al de la base de datos
    const InsertarProductos = () => {
      productos.forEach((producto) => {
        //esta condicion es para que agg el tr, pero modificando el tamaño del input de cantidad, para que se vea bien en versiones mobiles
        
        console.log(dolar);
        if (screen >= 1100) {
          tr += `
          <tr value="${producto.id}" class="TR-Product uk-light">
              <td class="uk-text-nowrap">
                  <input type="hidden" value="${producto.nombre}">
                  <p class="uk-margin-remove">${producto.nombre}</p>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall disponible" type="text" aria-label="disabled" value="${producto.stock ? producto.stock : 0}" disabled>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall" type="text" aria-label="disabled" value="${producto.precio_venta}" disabled>
              </td>
              <td>
                  <input class="uk-input uk-form-width-small State-input-stock" type="text" placeholder="Cantidad" aria-label="Input">
              </td>
              <td class="uk-flex uk-flex-center">
                  <input type="hidden" value="${producto.IVA}">
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

    //seleccionamos el input donde el usuario ingresa la cantidad de productos que desea comprar
    let inputState = document.querySelectorAll(".State-input-stock");
    inputState.forEach((input) => {
      //capturamos el evento de pulsar una tecla
      input.addEventListener("keyup", (e) => {
        //esta variable guarda la cantidad de stock del producto en esa fila
        let cantidad = parseInt(input.parentElement.previousElementSibling.previousElementSibling.firstElementChild.value);



        //esta variable guarda el valor de lo que el usuario teclea
        let cantidadCliente = parseInt(e.target.value);
        if (cantidadCliente <= cantidad && cantidadCliente > 0) {
          input.classList.add("succesc");
        } else {
          input.classList.remove("succesc");
        }
        if (cantidadCliente > cantidad || cantidadCliente == 0 || /^([a-zA-Z]+)$/.test(e.target.value)) {
          input.classList.add("danger");
        } else {
          input.classList.remove("danger");
        }
      });
    });

    //creamos esta funcion que calculara los montos de la factura
    let ActualizarTotal = () => {
      //obtenemos los valores del iva, ya sean true o false
      let IvaController = document.querySelectorAll(".controller-iva");
      let PriceExentIva = 0;
      let PriceNoExentIva = 0;
      let priceDolar = 0;
      for (const algo of IvaController) {
        let IvaStatus = algo.getAttribute("iva");
        let cantidadProduct = parseFloat(algo.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent)
        let valor$ = parseFloat(algo.parentElement.nextElementSibling.getAttribute('value') * cantidadProduct)
        console.log(algo.parentElement.nextElementSibling);
        priceDolar += valor$
        if (IvaStatus == 0) {
          let precioUndTotal = parseFloat(algo.parentElement.previousElementSibling.textContent);
          PriceExentIva += precioUndTotal;

        } else {
          let precioUndTotal = parseFloat(algo.parentElement.previousElementSibling.textContent);
          PriceNoExentIva += precioUndTotal;
        }
      }



      // esta varible tendra la suma del total parcial
      let totalAPagarParcial = PriceExentIva + PriceNoExentIva;
      //obtenemos el contenedor del subtotal
      let subtotal = document.getElementById("subtotalFact");
      let subtotal$ = document.getElementById("subtotalFact_$");
      //luego su texto sera igual a la variable totalAPagarParcial, mas el tipo de moneda
      subtotal.textContent = totalAPagarParcial.toFixed(2) + " BS";
      subtotal$.textContent = priceDolar.toFixed(2) + " $";
      // //creamos la variable que tendra el iva
      let iva = PriceNoExentIva * 0.16;

      let TextIva = (document.getElementById("iva").textContent = iva.toFixed(2) + " BS");


      //con esta varible obtenemos el total a pagar
      let totalAPagar = totalAPagarParcial + iva;

      //obtenemos el contenedor del total
      (document.getElementById("totalFact").textContent = totalAPagar.toFixed(2) + " BS");
      (document.getElementById("totalFact$").textContent = (priceDolar).toFixed(2) + " $");
      document.querySelector(".amount_MP").textContent = totalAPagar.toFixed(2) + " BS"


      document.getElementById("IGTF").textContent = "0.00 $"
      let INP = document.querySelectorAll(".AMOUNT-MP")
      INP.forEach((B) => {
        // captamos el evento de keyup, osea si el usuario teclea sobre el input
        if (B.previousElementSibling.value == "Divisa") {
          let IGTF = 0;
          IGTF = parseFloat(B.value) * 0.3
          if (B.value == "") {
            document.getElementById("IGTF").textContent = "0.00 $"
            document.getElementById("totalFact$").textContent = "0.00 $"
          } else {
            document.getElementById("IGTF").textContent = IGTF.toFixed(2) + " $"
            let monto$ = parseFloat(document.getElementById("totalFact$").textContent)
            monto$ += IGTF
            document.getElementById("totalFact$").textContent = monto$.toFixed(2) + " $"
          }

        }
      })
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
        let ivaIdentifier = boton.previousElementSibling.value;

        let idProducto = valor2;
        let cantidad = array[3] == "" ? 0 : parseInt(array[3]);
        let precioUnitario = parseFloat(array[2]);
        let totalParcial = cantidad * precioUnitario;

        // Seleccionamos el tbody de la tabla de la derecha
        let tbody = document.getElementById("Detail-product-fact");
        let filas = tbody.getElementsByTagName("tr");
        let existeProducto = false;

        for (let fila of filas) {
          if (fila.querySelector(".id_trDetail").textContent === idProducto) {
            // Si el producto ya existe, actualizamos los valores
            let cantidadExistente = parseInt(fila.children[1].textContent);
            let nuevaCantidad = cantidadExistente + cantidad;
            fila.children[1].textContent = nuevaCantidad;  // Actualizamos la cantidad
            fila.children[4].textContent = (nuevaCantidad * precioUnitario) + " BS";  // Actualizamos el total parcial

            // Restamos la cantidad del stock
            let idTableDetail = parseInt(fila.children[0].textContent);
            let StockDisponible = document.querySelectorAll(".stockHeight");
            StockDisponible.forEach((da) => {
              if (idTableDetail == parseInt(da.getAttribute("value"))) {
                let cantidadUsuario = parseInt(fila.children[1].textContent);
                let cantidadStock = parseInt(da.firstElementChild.nextElementSibling.firstElementChild.value);
                da.firstElementChild.nextElementSibling.firstElementChild.value = cantidadStock - cantidad;  // Restamos la cantidad del stock
                boton.parentElement.previousElementSibling.firstElementChild.classList.remove("succesc");
                boton.parentElement.previousElementSibling.firstElementChild.value = "";
              }
            });

            existeProducto = true;
            break;
          }
        }

        // Si el producto no existe, agregamos una nueva fila
        if (!existeProducto) {
          let trDetail = `
            <tr class="uk-light">
              <td class="id_trDetail">${idProducto}</td>
              <td>${cantidad}</td>
              <td>${array[0]} ${ivaIdentifier == 0 ? "(E)" : ""}</td>
              <td>${precioUnitario} BS</td>
              <td class="uk-text-success totalParcial">${totalParcial} BS</td>
              <td class="uk-flex uk-flex-center">
                <input class="controller-iva" type="hidden" iva="${array[4]}">
                <button href="" class="uk-icon-button Btn-delete" uk-icon="trash"></button>
              </td>
              <td value="${array[5]}" style="display: none;"></td>
            </tr>
          `;

          if (cantidad <= parseInt(array[1]) && cantidad != 0 && array[3] != "") {
            // A la vez que insertamos datos en la tabla de detalles, también restamos la cantidad que el usuario colocó
            boton.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value -= cantidad;
            // También quitamos el estilo del input
            boton.parentElement.previousElementSibling.firstElementChild.classList.remove("succesc");
            // Además reseteamos el input una vez pulsado el botón de plus
            boton.parentElement.previousElementSibling.firstElementChild.value = "";
            // Insertamos los tr con los detalles de los productos solo si se cumplen todas las condiciones
            tbody.innerHTML += trDetail;
          }
        }
        //en esta condicion mostraremos un mensaje si el campo de cantidad esta vacio
        if (array[3] == "") {
          boton.parentElement.previousElementSibling.firstElementChild.setAttribute("uk-tooltip", "title: Debe ingresar una cantidad");
          boton.parentElement.previousElementSibling.firstElementChild.classList.add("tooltip-efect");
          UIkit.tooltip(".tooltip-efect").show();

          setTimeout(() => {
            boton.parentElement.previousElementSibling.firstElementChild.removeAttribute("uk-tooltip");
            boton.parentElement.previousElementSibling.firstElementChild.classList.remove("tooltip-efect");
          }, 800);
        } else if (parseInt(array[3]) > parseInt(array[1]) || parseInt(array[3]) == 0) {
          //esta condicion es en caso que la cantidad que ingrese el usuario supere la cantidad en existencia
          boton.parentElement.previousElementSibling.firstElementChild.setAttribute("uk-tooltip", "title: La cantidad ingresada no es valida");
          boton.parentElement.previousElementSibling.firstElementChild.classList.add("tooltip-efect");
          UIkit.tooltip(".tooltip-efect").show();

          setTimeout(() => {
            boton.parentElement.previousElementSibling.firstElementChild.removeAttribute("uk-tooltip");
            boton.parentElement.previousElementSibling.firstElementChild.classList.remove("tooltip-efect");
          }, 800);
        } else if (/^([a-zA-Z]+)$/.test(array[3])) {
          boton.parentElement.previousElementSibling.firstElementChild.setAttribute("uk-tooltip", "title: Debe Ingresar solo numeros");
          boton.parentElement.previousElementSibling.firstElementChild.classList.add("tooltip-efect");
          UIkit.tooltip(".tooltip-efect").show();

          setTimeout(() => {
            boton.parentElement.previousElementSibling.firstElementChild.removeAttribute("uk-tooltip");
            boton.parentElement.previousElementSibling.firstElementChild.classList.remove("tooltip-efect");
          }, 800);
        }

        let stockHeight =
          boton.parentElement.parentElement.classList.add("stockHeight");
        let StockDisponible = document.querySelectorAll(".stockHeight");

        //con esta variable guardamos los botones de eliminar de cada tr, de la tabla de la derecha
        let BtnDelete = document.querySelectorAll(".Btn-delete");
        let btnStock = parseInt(boton.parentElement.parentElement.getAttribute("value"));

        //recorremos los botones para obtener la etiqueta html
        for (const btn of BtnDelete) {
          btn.addEventListener("click", () => {
            //aqui obtenemos el tr del boton que estamos pulsando
            let trash = btn.parentElement.parentElement;
            //seleccionamos el tbody de la tabla de la derecha y removemos al hijo
            // que en este caso, es la variable anterior
            document.getElementById("Detail-product-fact").removeChild(trash);
            // y luego actualizamos el total a pagar
            ActualizarTotal();
            let idTableDetail = parseInt(btn.parentElement.parentElement.firstElementChild.textContent);

            StockDisponible.forEach((da) => {
              if (idTableDetail == parseInt(da.getAttribute("value"))) {
                let cantidadUsuario = parseInt(btn.parentElement.parentElement.firstElementChild.nextElementSibling.textContent);
                let cantidadStock = parseInt(da.firstElementChild.nextElementSibling.firstElementChild.value);
                da.firstElementChild.nextElementSibling.firstElementChild.value = cantidadUsuario + cantidadStock;
              }
            });
          });
        }

        //esto actualiza el total a pagar
        //se actualiza dos veces, ya que esta actualiza al agg contenido de la tabla de la izquierda en la de la derecha
        // y tambien se llama cuando eliminamos un registro en la tabla de la derecha, ya que toma los tr, los vuelve
        // a recorrer y vuelve a sumar los montos

        //esta condicion actualiza el total solo si se cumple todas las condiciones
        if (parseInt(array[3]) <= parseInt(array[1]) && parseInt(array[3]) != 0 && array[3] != "") {
          ActualizarTotal();
        }
      });
    });

    //funcion para agg metodos de pago
    //este contador se usa para determinar el id de cada pago, para manipular los eventos en dos lados
    let bool = true
    let btnAggMetodoPago = document.querySelector(".btn_agg_metodoPago")
    // Agregar metodo de pago
    btnAggMetodoPago.addEventListener('click', () => {
      console.log("click");
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
              // console.log(totalDebito);
              // console.log(amount);
              // let result = 0
              // amount.forEach((a) => {
              //   let number = a == "" ? 0 : parseFloat(a)
              //   result += number
              // })
              // let valor = totalDebito - result
              // totalDebito.textContent =  valor

              let valor = B.value == "" ? 0 : parseFloat(B.value)
              console.log(valor);
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
                console.log(f.value);
              }
              // amount.pop()
              let result = 0

              console.log(amount);
              amount.forEach((a) => {
                let number = a == "" ? 0 : parseFloat(a)
                result += number
              })

              console.log(result);

              console.log(btn.parentElement.parentElement.parentElement);

            })
          })
        }
      })
    })

    //aqui hacemos la funcion para el credito

    let checkCredito = document.querySelector(".credito_check")
    $('.formCredito').hide()

    let credito = 1
    checkCredito.addEventListener("change", () => {

      if (checkCredito.checked == true) {
        credito = 0
        $('.cont_metodos_pagos').hide()
        $('.btn_agg_metodoPago').hide()
        $('.amount_MP').hide()
        document.querySelector(".name_MP").textContent = "FECHA DE CREDITO"
        $('.formCredito').show()





      } else {
        credito = 1
        $('.cont_metodos_pagos').show()
        $('.btn_agg_metodoPago').show()
        $('.amount_MP').show()
        document.querySelector(".name_MP").textContent = "TIPO DE PAGO"
        $('.formCredito').hide()
      }
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
        id_usuario: session_user_id,
        id_cliente: parseInt(idClient),
        IVA: parseFloat(document.getElementById("iva").textContent).toFixed(2),
        IGTF: parseFloat(document.getElementById("IGTF").textContent).toFixed(2),
        monto_final: parseFloat(document.getElementById("totalFact").textContent).toFixed(2),
        monto_dolar: parseFloat(document.getElementById("totalFact$").textContent),
        credito: checkCredito.checked,
        fecha_inicio_credito: document.querySelector('.fecha_inicio_credito').value,
        fecha_cierre_credito: document.querySelector('.fecha_cierre_credito').value,
        active: credito,
        detalles: [],
        pagos: []
      };

      if (tipoPago == 0 && !checkCredito.checked) {
        btnCreateFact.setAttribute("uk-tooltip", "title:Debe ingresar forma de pago; pos: right;");
        UIkit.tooltip(".btnCreateFact").show();

        setTimeout(() => {
          btnCreateFact.removeAttribute("uk-tooltip");
        }, 1000);
      } else if (TotalRestar != 0 && !checkCredito.checked) {
        btnCreateFact.setAttribute("uk-tooltip", "title:Debe ingresar un monto en el pago; pos: right");
        UIkit.tooltip(".btnCreateFact").show();
        setTimeout(() => {
          btnCreateFact.removeAttribute("uk-tooltip");
        }, 1000);
      } else if (tableDetailProduct == 0) {
        btnCreateFact.setAttribute("uk-tooltip", "title:Debe ingresar producto; pos: right");
        UIkit.tooltip(".btnCreateFact").show();
        setTimeout(() => {
          btnCreateFact.removeAttribute("uk-tooltip");
        }, 1000);
      } else {
        let blo = document.getElementById("Detail-product-fact").children;

        for (const iterator of blo) {
          let algo = parseInt(iterator.firstElementChild.textContent);
          let algo2 = parseInt(iterator.firstElementChild.nextElementSibling.textContent);
          let algo5 = parseFloat(iterator.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent);

          //insertamos los datos de los productos por cada tr que haya en detalles de factura
          json.detalles.push({
            id_product: algo,
            cantidad: algo2,
            precio: algo5,
          });
        }

        let select = document.querySelectorAll(".selectMetodoPago")
        select.forEach((e) => {

          console.log(e.value);
          let valor = e.value
          let monto = e.nextElementSibling.value

          json.pagos.push({
            metodo: valor,
            monto: monto
          });

        })

        console.log();
        console.log(json);


        //envio de datos con ajax
        //preparamos el json
        let jsonString = JSON.stringify(json);

        console.log(jsonString);

        $.ajax({
          url: "Controller/funcs_ajax/hacer_factura.php",
          type: "POST",
          data: { jsonString },
          success: function (response) {
            console.log(response);
            targetFact()
            let json = JSON.parse('{' + response.split('{')[1]);
            if (json.error == "Caja Error") {
              UIkit.notification.closeAll();
              UIkit.notification({
                message:
                  "<span uk-icon='icon: check'></span>No hay cajas abiertas",
                status: "danger",
                pos: "bottom-right",
              });
            } else if (json.error == "Te ganaron") {
              UIkit.notification.closeAll();
              UIkit.notification({
                message:
                  "<span uk-icon='icon: check'></span>Error Inesperado",
                status: "danger",
                pos: "bottom-right",
              });
            } else {

              //luego de enviar los datos reseteamos el modal

              document.querySelector(".cont_metodos_pagos").innerHTML = ""
              document.getElementById("Client-datails").innerHTML = `<div class="uk-flex uk-flex-column uk-flex-middle uk-flex-center pointer" value="default">
                                                            <h5 class="uk-text-bold uk-margin-remove">AÑADIR CLIENTE</h5>
                                                            <a class="uk-margin-small-top" href="#" uk-icon="icon: plus-circle; ratio: 1.5"></a>
                                                        </div>`;

              document.getElementById("Detail-product-fact").innerHTML = "";
              document.getElementsByClassName("metodo-pago_final").innerHTML = "";

              ActualizarTotal();

              setTimeout(() => {
                UIkit.modal("#modal-full").hide();
              }, 800);


              UIkit.notification({
                message:
                  "<span uk-icon='icon: check'></span> Factura generada correctamente ",
                status: "success",
                pos: "bottom-right",
              });
            }
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

const targetFact = (num) => {
  pag_facturas = num
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "ventas", n: pag_facturas, limite: 10 },
    success: function (response) {
      let json = JSON.parse(response)
      let template = ""
      json.lista.forEach((t) => {
        template += `
        <div>
      <div class="target-detail-fact uk-card uk-card-default uk-padding-small uk-background-secondary uk-light uk-border-rounded" style="width: 280px; background-color: #333;">
          <div class="cont1_tar_fact" style="background-color: #333;">
              <div class="uk-flex uk-flex-middle uk-flex-between">
                  <div class="uk-flex uk-flex-middle">
                      <img class="uk-margin-small-right" src="static/images/logo_m.png" alt="" width="50PX">
                      <h3 class="uk-margin-remove uk-text-bolder">#${t.id}</h3>
                  </div>
              </div>
  
              <hr class="uk-margin-remove divider">
  
              <section>
                  <div>
                      <div>
                          <div>
                              <p class="uk-text-meta uk-margin-remove">N∘_OPERACIÓN: <b class="uk-text-success">${t.id}</b></p>
                              <hr class="uk-margin-remove divider-2">
  
                              <p class="uk-text-meta uk-margin-remove">FECHA: <b class="uk-text-success">${fecha(t.fecha)}</b></p>
  
                              <hr class="uk-margin-remove divider-2">
  
                              <p class="uk-text-meta uk-margin-remove">CLIENTE: <b class="uk-text-success">${t.cliente_nombre + " " + t.cliente_apellido}</b></p>
  
                              <hr class="uk-margin-remove divider-2">
  
                              <p class="uk-text-meta uk-margin-remove">VENDEDOR: <b class="uk-text-success">${t.vendedor}</b></p>
  
                              <hr class="uk-margin-remove divider-2">
  
                              <p class="uk-text-meta uk-margin-remove">
                                  ESTADO FACTURA: <b class="state-fact ${t.active == 0 ? "activeEmpty" : "uk-text-emphasis"}">${t.active == 1 ? "PAGADO" : "CREDITO"}</b>
                              </p>
  
                              <hr class="uk-margin-remove divider-2">
  
                              <p class="uk-text-meta uk-margin-remove">TOTAL FACTURA: <b class="uk-text-success">${t.monto_final} BS</b></p>
                          </div>
                      </div>
                  </div>
              </section>
          </div>
      </div>
  </div>
        `
      })
      $(".cont_ventas_target").html(template)
      marcaAgua()
    }

  })
}
targetFact()

$(".pag-btn-facturas").click((ele) => {
  cambiar_pagina_ajax(
    ele.target.dataset["direccion"],
    "ventas",
    targetFact,
    10,
    pag_facturas
  );
});

//aqui empieza la funcion para buscar los clientes
//captamos el evento keyup del buscador
document.getElementById("input-search-fact").addEventListener("keyup", (e) => {
  //obtenemos el valor de lo que el usuario teclea
  let val = e.target.value;
  //si no esta vacio, entonces enviamos una solicitud ajax para buscar los clientes
  if (val != "") {
    $.ajax({
      url: "Controller/funcs_ajax/search.php",
      type: "GET",
      data: { randomnautica: "clientes", like_cedula: val },
      success: function (response) {
        console.log(response);
        let json = JSON.parse(response);
        let LI = "";
        //recorremos la respuesta del server y creamos el template de los li
        json.lista.forEach((dato) => {
          LI += `   <li class="Client_register" name="${dato.nombre + " " + dato.apellido
            }" ci="${dato.cedula}" id="${dato.id}">
                      <div class="uk-padding-remove-vertical uk-flex uk-flex-middle">
                          <span class="uk-margin-small-right" uk-icon="user"></span>
                          <p class="uk-margin-small">${dato.nombre + " " + dato.apellido
            }</p>
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
                    <a href="Clientes" class="uk-button uk-button-default">Registrar Cliente</a>
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

document.getElementById("nameVendedor").textContent = session_user_name

//ajax

DOLAR_RV(func)