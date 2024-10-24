let hola = "";
const cargarEntrys = () => {
  $.ajax({
    url: "api_search",
    type: "POST",
    data: { randomnautica: "entradas" },
    success: function (response) {
      console.log(response)

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
// cargarEntrys()

$.ajax({
  url: "api_search",
  type: "POST",
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
          type: "POST",
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
      type: "POST",
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
    type: "POST",
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
    "language": {
      "processing": "Procesando...",
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "No se encontraron resultados",
      "emptyTable": "Ningún dato disponible en esta tabla",
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "search": "Buscar:",
      "infoThousands": ",",
      "loadingRecords": "Cargando...",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      },
      "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
          "1": "Copiada 1 fila al portapapeles",
          "_": "Copiadas %ds fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
          "-1": "Mostrar todas las filas",
          "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir",
        "renameState": "Cambiar nombre",
        "updateState": "Actualizar",
        "createState": "Crear Estado",
        "removeAllStates": "Remover Estados",
        "removeState": "Remover",
        "savedStates": "Estados Guardados",
        "stateRestore": "Estado %d"
      },
      "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d</i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
      },
      "decimal": ",",
      "searchBuilder": {
        "add": "Añadir condición",
        "button": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
          "date": {
            "after": "Despues",
            "before": "Antes",
            "between": "Entre",
            "empty": "Vacío",
            "equals": "Igual a",
            "notBetween": "No entre",
            "notEmpty": "No Vacio",
            "not": "Diferente de"
          },
          "number": {
            "between": "Entre",
            "empty": "Vacio",
            "equals": "Igual a",
            "gt": "Mayor a",
            "gte": "Mayor o igual a",
            "lt": "Menor que",
            "lte": "Menor o igual que",
            "notBetween": "No entre",
            "notEmpty": "No vacío",
            "not": "Diferente de"
          },
          "string": {
            "contains": "Contiene",
            "empty": "Vacío",
            "endsWith": "Termina en",
            "equals": "Igual a",
            "notEmpty": "No Vacio",
            "startsWith": "Empieza con",
            "not": "Diferente de",
            "notContains": "No Contiene",
            "notStartsWith": "No empieza con",
            "notEndsWith": "No termina con"
          },
          "array": {
            "not": "Diferente de",
            "equals": "Igual",
            "empty": "Vacío",
            "contains": "Contiene",
            "notEmpty": "No Vacío",
            "without": "Sin"
          }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
      },
      "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
          "0": "Paneles de búsqueda",
          "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d",
        "showMessage": "Mostrar Todo",
        "collapseMessage": "Colapsar Todo"
      },
      "select": {
        "cells": {
          "1": "1 celda seleccionada",
          "_": "%d celdas seleccionadas"
        },
        "columns": {
          "1": "1 columna seleccionada",
          "_": "%d columnas seleccionadas"
        },
        "rows": {
          "1": "1 fila seleccionada",
          "_": "%d filas seleccionadas"
        }
      },
      "thousands": ".",
      "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
          "AM",
          "PM"
        ],
        "months": {
          "0": "Enero",
          "1": "Febrero",
          "2": "Marzo",
          "3": "Abril",
          "4": "Mayo",
          "5": "Junio",
          "6": "Julio",
          "7": "Agosto",
          "8": "Septiembre",
          "9": "Octubre",
          "10": "Noviembre",
          "11": "Diciembre"
        },
        "weekdays": [
          "Dom",
          "Lun",
          "Mar",
          "Mie",
          "Jue",
          "Vie",
          "Sab"
        ]
      },
      "editor": {
        "close": "Cerrar",
        "create": {
          "button": "Nuevo",
          "title": "Crear Nuevo Registro",
          "submit": "Crear"
        },
        "edit": {
          "button": "Editar",
          "title": "Editar Registro",
          "submit": "Actualizar"
        },
        "remove": {
          "button": "Eliminar",
          "title": "Eliminar Registro",
          "submit": "Eliminar",
          "confirm": {
            "1": "¿Está seguro que desea eliminar 1 fila?",
            "_": "¿Está seguro que desea eliminar %d filas?"
          }
        },
        "error": {
          "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\/a&gt;).</a>"
        },
        "multi": {
          "title": "Múltiples Valores",
          "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
          "restore": "Deshacer Cambios",
          "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
      },
      "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
      "stateRestore": {
        "creationModal": {
          "button": "Crear",
          "name": "Nombre:",
          "order": "Clasificación",
          "paging": "Paginación",
          "search": "Busqueda",
          "select": "Seleccionar",
          "columns": {
            "search": "Búsqueda de Columna",
            "visible": "Visibilidad de Columna"
          },
          "title": "Crear Nuevo Estado",
          "toggleLabel": "Incluir:"
        },
        "emptyError": "El nombre no puede estar vacio",
        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
        "removeError": "Error al eliminar el registro",
        "removeJoiner": "y",
        "removeSubmit": "Eliminar",
        "renameButton": "Cambiar Nombre",
        "renameLabel": "Nuevo nombre para %s",
        "duplicateError": "Ya existe un Estado con este nombre.",
        "emptyStates": "No hay Estados guardados",
        "removeTitle": "Remover Estado",
        "renameTitle": "Cambiar Nombre Estado"
      }
    },

    "ajax": {
      "url": "api_search", // URL de la petición AJAX
      "type": "POST",
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