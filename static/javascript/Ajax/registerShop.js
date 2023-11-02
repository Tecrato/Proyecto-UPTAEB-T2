//aqui creamos los modales donde se hara la factura, cada modal dependiendo de la resolucion
//este es el de version de ordenador

if (screen > 1290) {
  modal = `<!-- **************************Modal para crear facturas************************** -->

  <div id="modal-full" class="uk-modal-full" uk-modal>
      <div class="uk-modal-dialog uk-background-secondary uk-light">
          <button class="uk-modal-close-full uk-close-large uk-background-secondary" type="button"
              uk-close></button>
          <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>
              <div class="uk-background-cover container_generate_fact"
                  style="background-image: url('static/images/fondo2.jpg');" uk-height-viewport>

                  <h4 class="uk-text-bolder"></h4>

                  <div class="generate-fact uk-margin-auto">
                      <div class="uk-flex uk-flex-center">
                          <div class="btn-close invisible">
                              <span uk-icon="icon: close"></span>
                          </div>
                          <!-- ********************** modal para Añadir el cliente **********************  -->
                          <nav id="nav" class="Nav1" uk-dropnav="mode: click">
                          
                              <ul class="uk-subnav uk-margin-remove uk-padding-remove">
                                  <li>
                                      <div
                                          class="Plus-client uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-margin-medium-right">
                                          <div id="Client-datails"
                                              class="uk-flex uk-flex-column uk-flex-center uk-flex-middle">

                                          </div>
                                      </div>
                                      <div class="uk-dropdown uk-border-rounded uk-background-secondary">
                                          <ul id="Client" class="uk-nav uk-dropdown-nav">
                                              <li class="uk-active uk-margin-small-bottom">
                                                  <form class="uk-search uk-search-default">
                                                      <span class="uk-search-icon-flip" uk-search-icon></span>
                                                      <input id="input-search-fact" class="uk-search-input"
                                                          type="search" placeholder="Buscar" aria-label="Buscar">
                                                  </form>
                                              </li>
                                          </ul>
                                      </div>
                                  </li>
                              </ul>
                          </nav>
                          <!-- ******************************************************************************  -->
                          <div>
                              <div>
                                  <form class="uk-form-horizontal uk-margin-medium-bottom">
                                      <div class="uk-margin">
                                          <label class="uk-form-label" style="width: 0px !important;"
                                              for="form-horizontal-select">VENDEDOR</label>
                                          <div class="uk-form-controls" style="margin-left: 130px; !important;">
                                              <input class="uk-input Casher uk-form-width-medium" type="text"
                                                  value="${sesion_user}" id="${sesionID}" disabled>
                                          </div>
                                      </div>

                                      <div class="uk-margin uk-margin-remove-bottom">
                                          <label class="uk-form-label" style="width: 100px !important;"
                                              for="form-horizontal-select">TIPO DE PAGO</label>
                                          <div class="uk-form-controls" style="margin-left: 130px; !important;">
                                              <select class="uk-select selectTypeCash" id="form-horizontal-select">
                                                  <option disabled selected></option>
                                                  <option>Pago Movil</option>
                                                  <option>Punto de Venta</option>
                                                  <option>Transferencia</option>
                                                  <option>Efectivo</option>
                                                  <option>Divisas</option>
                                              </select>
                                          </div>
                                      </div>
                                  </form>
                              </div>

                              <div class="uk-flex uk-flex-center">
                                  <button class="btnCreateFact uk-button uk-button-default demo" type="button">
                                    GENERAR FACTURA
                                  </button>
                              </div>
                          </div>
                      </div>

                      <hr class="uk-divider-icon">

                      <div class="uk-flex uk-flex-center">
                          <h5>ADICIONAR PRODUCTOS</h5>
                      </div>

                      <div>
                          <div class="uk-margin-small">
                              <form class="uk-search uk-search-default">
                                  <span class="uk-search-icon-flip" uk-search-icon></span>
                                  <input id="SearchProduct-Fact" class="uk-search-input" type="search"
                                      placeholder="Buscar..." aria-label="Search">
                              </form>
                          </div>

                          <div style="overflow: hidden; height: 280px;">
                              <div class="uk-overflow-auto">
                                  <table class="uk-table uk-table-divider">
                                      <thead>
                                          <tr>
                                              <th>Producto</th>
                                              <th>Disp.</th>
                                              <th>Precio</th>
                                              <th>Cantidad</th>
                                              <th class="uk-flex uk-flex-center">Agregar</th>
                                          </tr>
                                      </thead>

                                      <tbody id="Product-detail-1">


                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>

                  </div>

              </div>
              <div style="padding: 55px;">
                  <h4 class="uk-text-bolder uk-padding-medium">DETALLES FACTURA</h4>
                  <div class="container-result-fact">
                      <div style="height: 300px; overflow: auto;">
                          <table class="uk-table uk-table-hover uk-table-divider uk-table-middle">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Cantidad</th>
                                      <th>Nombre</th>
                                      <th>Precio unit.</th>
                                      <th>Precio total</th>
                                  </tr>
                              </thead>

                              <tbody id="Detail-product-fact">

                              </tbody>
                          </table>
                      </div>

                      <div class="uk-flex uk-flex-right uk-margin-medium-top">
                          <div class="Container-fact-price">
                              <div class="uk-flex uk-flex-between">
                                  <div class="uk-margin-large-right">SUBTOTAL </div>
                                  <div>
                                      <p id="subtotalFact" class="Fact-price uk-text-success">0.00</p>
                                  </div>
                              </div>
                              <div class="uk-flex uk-flex-between">
                                  <div class="uk-margin-large-right">IVA 16% </div>
                                  <div>
                                      <p id="iva" class="Fact-price uk-text-success">0.00</p>
                                  </div>
                              </div>
                              <hr class="uk-margin-remove-top">
                              <div class="uk-flex uk-flex-between">
                                  <div class="uk-margin-large-right uk-text-bolder">TOTAL </div>
                                  <div>
                                      <p id="totalFact"
                                          class="Fact-price uk-text-success uk-margin-remove-bottom uk-text-bolder">0.00</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- ******************************************************************************************************* -->`;
} else {
  //este es el de telefonos y tablets
  modal = `<!-- **************************Modal para crear facturas (Responsive)************************** -->

  <div id="modal-full" class="uk-modal-full" uk-modal>
      <div class="uk-modal-dialog uk-background-secondary uk-light">
          <button class="uk-modal-close-full uk-close-large uk-background-secondary" type="button"
              uk-close></button>
          <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>
              <div class="uk-background-cover" style="background-image: url('static/images/fondo2.jpg');"
                  uk-height-viewport>
                  <div>
                      <div
                          class="uk-flex uk-flex-center uk-flex-middle uk-flex-wrap uk-padding-small uk-margin-medium-top">
                          <div class="btn-close invisible">
                              <span uk-icon="icon: close"></span>
                          </div>
                          <nav class="Nav1" uk-dropnav="mode: click">
                              <ul class="uk-subnav uk-margin-remove uk-padding-remove">
                                  <li>
                                      <div id="Plus-client"
                                          class="Plus-client uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-margin-medium-right">
                                          <div id="Client-datails"
                                              class="uk-flex uk-flex-column uk-flex-center uk-flex-middle">
                                              <!-- aqui cargan los clientes -->
                                          </div>
                                      </div>
                                      <div class="uk-dropdown uk-border-rounded uk-background-secondary">
                                          <ul id="Client" class="uk-nav uk-dropdown-nav">
                                              <li class="uk-active uk-margin-small-bottom">
                                                  <form class="uk-search uk-search-default">
                                                      <span class="uk-search-icon-flip" uk-search-icon></span>
                                                      <input id="input-search-fact2" class="uk-search-input"
                                                          type="search" placeholder="Buscar" aria-label="Buscar">
                                                  </form>
                                              </li>
                                          </ul>
                                      </div>
                                  </li>
                              </ul>
                          </nav>
                          <div class="container_inputs_fact">
                              <div>
                                  <form class="uk-form-horizontal">
                                      <div class="uk-margin">
                                          <label class="uk-form-label"
                                              for="form-horizontal-select">VENDEDOR</label>
                                          <div class="uk-form-controls">
                                              <input class="uk-input uk-form-width-large Casher" type="text"
                                                  value="Administrador" id="2" disabled>
                                          </div>
                                      </div>

                                      <div class="uk-margin uk-margin-remove-bottom">
                                          <label class="uk-form-label" for="form-horizontal-select">TIPO DE
                                              PAGO</label>
                                          <div class="uk-form-controls">
                                              <select class="uk-select selectTypeCash" id="form-horizontal-select">
                                                    <option disabled selected></option>
                                                    <option>Pago Movil</option>
                                                    <option>Transferencia</option>
                                                    <option>Efectivo</option>
                                                    <option>Divisas</option>
                                              </select>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="uk-flex uk-flex-center uk-margin-medium-bottom uk-margin-medium-top">
                          <button class="uk-button uk-button-default demo btnCreateFact" type="button">
                              GENERAR FACTURA
                          </button>
                      </div>
                  </div>

                  <hr class="uk-divider-icon">

                  <div class="uk-flex uk-flex-center">
                      <h5>ADICIONAR PRODUCTOS</h5>
                  </div>

                  <div>
                      <div class="uk-margin-small uk-padding-small">
                          <form class="uk-search uk-search-default">
                              <span class="uk-search-icon-flip" uk-search-icon></span>
                              <input id="SearchProduct-Fact" class="uk-search-input" type="search" placeholder="Buscar..."
                                  aria-label="Search">
                          </form>
                      </div>
                      <div style="overflow: hidden; height: 280px;">
                              <div>
                                  <table class="uk-table uk-table-divider">
                                      <thead>
                                          <tr>
                                              <th class="uk-text-truncate">Producto</th>
                                              <th class=" uk-text-truncate">Disponible</th>
                                              <th class=" uk-text-truncate">Precio</th>
                                              <th class=" uk-text-truncate">Cantidad</th>
                                              <th class=" uk-text-truncate">Agregar</th>
                                            </tr>
                                      </thead>
                                      <tbody id="Product-detail-1">
                                      <!-- aqui cargan los PRODUCTOS Y SUS DETALLES -->
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                  </div>
              </div>
              <div class="uk-padding-small uk-margin-medium-top">
                  <h3 class="uk-text-bolder">Datos Factura</h3>
                  <div class="container_table_fact-responsive" style="height: 600px; overflow: auto;">
                      <table class="uk-table uk-table-divider">
                          <thead>
                              <tr>
                                  <th class="uk-text-truncate">ID</th>
                                  <th class="uk-text-truncate">Cantidad</th>
                                  <th class=" uk-text-truncate">Nombre</th>
                                  <th class=" uk-text-truncate">P.UNIT</th>
                                  <th class=" uk-text-truncate">P.TOTAL</th>
                              </tr>
                          </thead>
                          <tbody id="Detail-product-fact" style="heigth: 500px;">
                          <!-- aqui cargan los DATOS DE LA TABLA DE LA IZQUIERDA -->
                          </tbody>
                      </table>
                  </div>
                  <div class="uk-flex uk-flex-right uk-margin-medium-top">
                      <div class="Container-fact-price">
                          <div class="uk-flex uk-flex-between">
                              <div class="uk-margin-large-right">SUBTOTAL </div>
                              <div>
                                  <p id="subtotalFact" class="Fact-price uk-text-success">0.00</p>
                              </div>
                          </div>
                          <div class="uk-flex uk-flex-between">
                              <div class="uk-margin-large-right">IVA </div>
                              <div>
                                  <p id="iva" class="Fact-price uk-text-success">0.00</p>
                              </div>
                          </div>
                          <hr class="uk-margin-remove-top">
                          <div class="uk-flex uk-flex-between">
                              <div class="uk-margin-large-right">TOTAL </div>
                              <div>
                                  <p id="totalFact" class="Fact-price uk-text-success uk-margin-remove-bottom uk-text-bolder">0.00</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- ******************************************************************************************************* -->`;
}
//luego lo insertamos con el resto del codigo HTML que tiene el contenedor
let contenedor = document.querySelector("#Container-modal-full");
contenedor.innerHTML += modal;

const datos = [
  {
    id: 1,
    nombre: "Alejo",
    cedula: "000000000",
  },
  {
    id: 2,
    nombre: "Luis",
    cedula: "30087582",
  },
  {
    id: 3,
    nombre: "DALTO",
    cedula: "251616816",
  },
  {
    id: 4,
    nombre: "Bryan",
    cedula: "25555555",
  },
];
//Con  esta parte cargamos los datos en la pestana de detalles del cliente que quiere seleccionar
let LI = "";
let ClienteDatos = "";
datos.forEach((dato) => {
  LI += `   <li class="Client_register">
                <div class="uk-padding-remove-vertical uk-flex uk-flex-middle">
                    <span class="uk-margin-small-right" uk-icon="user"></span>
                    <p class="uk-margin-small">${dato.nombre}</p>
                </div>
            </li>`;
});
document.getElementById("Client").innerHTML += LI;
const Clientes = document.querySelectorAll(".Client_register");
//con esta parte cargamos por defecto la opcion de anadir cliente
document.getElementById(
  "Client-datails"
).innerHTML = `<div class="uk-flex uk-flex-column uk-flex-middle uk-flex-center pointer" value="default">
                  <h5 class="uk-text-bold">AÑADIR CLIENTE</h5>
                  <a href="#" uk-icon="icon: plus-circle; ratio: 2.5"></a>
                </div>`;
let ClienteDetails = "";

// Con esto recorremos todos los clientes cargados, y dependiendo de cual pulse, nos trae el nombre del cliente
// luego recorremos los datos del los clientes y el nombre lo comparamos con el extraido anteriormente
//si es igual, entonces remplaza el contenido de cliente-details por el nombre del usuario y la cedula

Clientes.forEach((date) => {
  date.addEventListener("click", () => {
    let textoCliente = date.firstElementChild.lastElementChild.textContent;
    datos.forEach((dat) => {
      if (dat.nombre == textoCliente) {
        ClienteDetails = ` 
                            <div class="uk-flex uk-flex-column uk-flex-middle pointer" value="${dat.id}" >
                              <a class="Bg-user uk-margin-small-bottom" uk-icon="icon: user; ratio: 1.5"></a>
                              <p class="uk-margin-remove uk-margin-small-bottom uk-text-meta">Cliente: <b>${dat.nombre}</b></p>
                              <p class="uk-margin-remove uk-text-meta">Cedula: <b>${dat.cedula}</b></p>
                            </div>
                          `;
      }
    });
    document.getElementById("Client-datails").innerHTML = ClienteDetails;
    document.querySelector(".btn-close").classList.remove("invisible");
  });
});

const resetCloseClient = (clase) => {
  let btnClose = document.querySelector(clase);

  btnClose.addEventListener("click", () => {
    document.getElementById(
      "Client-datails"
    ).innerHTML = `<div class="uk-flex uk-flex-column uk-flex-middle uk-flex-center pointer" value="default">
                    <h5 class="uk-text-bold">AÑADIR CLIENTE</h5>
                    <a href="#" uk-icon="icon: plus-circle; ratio: 2.5"></a>
                  </div>`;
    btnClose.classList.add("invisible");
  });
};

resetCloseClient(".btn-close");

//con esto hacemos la busqueda de los clientes
let input = document.getElementById("input-search-fact");
document.addEventListener("keyup", (e) => {
  if (e.target.matches("input")) {
    Clientes.forEach((dato) => {
      if (
        dato.firstElementChild.lastElementChild.textContent
          .toLowerCase()
          .includes(e.target.value)
      ) {
        dato.classList.remove("invisible");
      } else {
        dato.classList.add("invisible");
      }
    });
  }
});

//ajax
$.ajax({
  url: "Controller/funcs_ajax/search_factura.php",
  type: "POST",
  processData: true,
  contentType: true,
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
        if (screen >= 1024) {
          tr += `
          <tr value="${producto.id}" class="TR-Product uk-dark">
              <td>
                  <input type="hidden" value="${producto.nombre}">
                  <p class="uk-margin-remove">${producto.nombre}</p>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall disponible" type="text" aria-label="disabled" value="${producto.stock}" disabled>
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
          </tr>
      `;
        } else {
          tr += `
          <tr value="${producto.id}" class="TR-Product uk-dark">
              <td>
                  <input type="hidden" value="${producto.nombre}">
                  <p class="uk-margin-remove">${producto.nombre}</p>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall" type="text" aria-label="disabled" value="${producto.stock}" disabled>
              </td>
              <td>
                  <input class="uk-input uk-form-width-xsmall" type="text" aria-label="disabled" value="${producto.precio_venta}" disabled>
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
        let cantidad = parseInt(
          input.parentElement.previousElementSibling.previousElementSibling
            .firstElementChild.value
        );
        //esta variable guarda el valor de lo que el usuario teclea
        let cantidadCliente = parseInt(e.target.value);
        if (cantidadCliente <= cantidad && cantidadCliente > 0) {
          input.classList.add("succesc");
        } else {
          input.classList.remove("succesc");
        }
        if (cantidadCliente > cantidad || cantidadCliente == 0) {
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
      for (const algo of IvaController) {
        let IvaStatus = algo.getAttribute("iva");
        if (IvaStatus == 0) {
          let precioUndTotal = parseFloat(
            algo.parentElement.previousElementSibling.textContent
          );
          PriceExentIva += precioUndTotal;
        } else {
          let precioUndTotal = parseFloat(
            algo.parentElement.previousElementSibling.textContent
          );
          PriceNoExentIva += precioUndTotal;
        }
      }
      // esta varible tendra la suma del total parcial
      let totalAPagarParcial = PriceExentIva + PriceNoExentIva;
      //obtenemos el contenedor del subtotal
      let subtotal = document.getElementById("subtotalFact");
      //luego su texto sera igual a la variable totalAPagarParcial, mas el tipo de moneda
      subtotal.textContent = totalAPagarParcial.toFixed(2) + " BS";
      // //creamos la variable que tendra el iva
      let iva = PriceNoExentIva * 0.16;

      let TextIva = (document.getElementById("iva").textContent =
        iva.toFixed(2) + " BS");
      //con esta varible obtenemos el total a pagar
      let totalAPagar = totalAPagarParcial + iva;

      //obtenemos el contenedor del total
      let total = (document.getElementById("totalFact").textContent =
        totalAPagar.toFixed(2) + " BS");
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
        let valor2 =
          boton.parentElement.parentElement.attributes.value.textContent;
        // este array guardara los datos del producto que puso el cliente
        let array = [];

        //con este bucle, recorremos todos los hijos del tr
        for (const child of valor) {
          //por cada vuelta, inserta en el array el valor de los inputs, dentro de cada TD
          array.push(child.firstElementChild.value);
        }

        let ivaIdentifier = boton.previousElementSibling.value;

        //Creamos los tr de la tabla de la derecha
        if (ivaIdentifier == 0) {
          trDetail = `
                    <tr>
                        <td>${valor2}</td>
                        <td>${array[3]}</td>
                        <td>${array[0]} (E)</td>
                        <td>${array[2]} BS</td>
                        <td class="uk-text-success totalParcial">${
                          array[3] * array[2] + " BS"
                        }</td>
                        <td class="uk-flex uk-flex-center">
                            <input class="controller-iva" type="hidden" iva="${
                              array[4]
                            }">
                            <button href="" class="uk-icon-button Btn-delete" uk-icon="trash"></button>
                        </td>
                    </tr>
                `;
        } else {
          trDetail = `
                    <tr>
                        <td>${valor2}</td>
                        <td>${array[3]}</td>
                        <td>${array[0]}</td>
                        <td>${array[2]} BS</td>
                        <td class="uk-text-success totalParcial">${
                          array[3] * array[2] + " BS"
                        }</td>
                        <td class="uk-flex uk-flex-center">
                            <input class="controller-iva" type="hidden" iva="${
                              array[4]
                            }">
                            <button href="" class="uk-icon-button Btn-delete" uk-icon="trash"></button>
                        </td>
                    </tr>
                `;
        }

        if (
          parseInt(array[3]) <= parseInt(array[1]) &&
          parseInt(array[3]) != 0 &&
          array[3] != ""
        ) {
          //seleccionamos el tbody de la tabla de la derecha, y le insertamos los tr con los detalles de los productos solo si se
          //cumplen todas las condiciones
          document.getElementById("Detail-product-fact").innerHTML += trDetail;

          //a la vez que insertamos datos en la tabla de detalles, tambien restamos la cantidad que el usuario coloco
          parseInt(
            (boton.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value -=
              array[3])
          );

          //tambien quitamos el estilo del input
          boton.parentElement.previousElementSibling.firstElementChild.classList.remove(
            "succesc"
          );
          //ademas resetemos el input una vez pulsado el boton de plus
          boton.parentElement.previousElementSibling.firstElementChild.value =
            "";
        }

        //en esta condicion mostraremos un mensaje si el campo de cantidad esta vacio
        if (array[3] == "") {
          boton.parentElement.previousElementSibling.firstElementChild.setAttribute(
            "uk-tooltip",
            "title: Debe ingresar una cantidad"
          );
          boton.parentElement.previousElementSibling.firstElementChild.classList.add(
            "tooltip-efect"
          );
          UIkit.tooltip(".tooltip-efect").show();

          setTimeout(() => {
            boton.parentElement.previousElementSibling.firstElementChild.removeAttribute(
              "uk-tooltip"
            );
            boton.parentElement.previousElementSibling.firstElementChild.classList.remove(
              "tooltip-efect"
            );
          }, 800);
        } else if (
          parseInt(array[3]) > parseInt(array[1]) ||
          parseInt(array[3]) == 0
        ) {
          //esta condicion es en caso que la cantidad que ingrese el usuario supere la cantidad en existencia
          boton.parentElement.previousElementSibling.firstElementChild.setAttribute(
            "uk-tooltip",
            "title: La cantidad ingresada no es valida"
          );
          boton.parentElement.previousElementSibling.firstElementChild.classList.add(
            "tooltip-efect"
          );
          UIkit.tooltip(".tooltip-efect").show();

          setTimeout(() => {
            boton.parentElement.previousElementSibling.firstElementChild.removeAttribute(
              "uk-tooltip"
            );
            boton.parentElement.previousElementSibling.firstElementChild.classList.remove(
              "tooltip-efect"
            );
          }, 800);
        }

        let stockHeight =
          boton.parentElement.parentElement.classList.add("stockHeight");
        let StockDisponible = document.querySelectorAll(".stockHeight");

        //con esta variable guardamos los botones de eliminar de cada tr, de la tabla de la derecha
        let BtnDelete = document.querySelectorAll(".Btn-delete");
        let btnStock = parseInt(
          boton.parentElement.parentElement.getAttribute("value")
        );

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
            let idTableDetail = parseInt(
              btn.parentElement.parentElement.firstElementChild.textContent
            );

            StockDisponible.forEach((da) => {
              if (idTableDetail == parseInt(da.getAttribute("value"))) {
                let cantidadUsuario = parseInt(
                  btn.parentElement.parentElement.firstElementChild
                    .nextElementSibling.textContent
                );
                let cantidadStock = parseInt(
                  da.firstElementChild.nextElementSibling.firstElementChild
                    .value
                );

                da.firstElementChild.nextElementSibling.firstElementChild.value =
                  cantidadUsuario + cantidadStock;
              }
            });
          });
        }

        //esto actualiza el total a pagar
        //se actualiza dos veces, ya que esta actualiza al agg contenido de la tabla de la izquierda en la de la derecha
        // y tambien se llama cuando eliminamos un registro en la tabla de la derecha, ya que toma los tr, los vuelve
        // a recorrer y vuelve a sumar los montos

        //esta condicion actualiza el total solo si se cumple todas las condiciones
        if (
          parseInt(array[3]) <= parseInt(array[1]) &&
          parseInt(array[3]) != 0 &&
          array[3] != ""
        ) {
          ActualizarTotal();
        }
      });
    });

    //funcion para verificar si ya se puede enviar los datos para hacer la factura
    let btnCreateFact = document.querySelector(".btnCreateFact");

    btnCreateFact.addEventListener("click", () => {
      let tipoPago = document.querySelector(".selectTypeCash").value;
      let idCasher = document.querySelector(".Casher").getAttribute("id");
      let idClient = document
        .getElementById("Client-datails")
        .firstElementChild.getAttribute("value");
      let tableDetailProduct = document.getElementById(
        "Detail-product-fact"
      ).childElementCount;

      //este json sera el que se envie al server para insertar los datos de la factura
      let json = {
        idCasher: parseInt(idCasher),
        idClient: parseInt(idClient),
        TPago: tipoPago,
        tIva: parseFloat(document.getElementById("iva").textContent).toFixed(2),
        pTotal: parseFloat(
          document.getElementById("totalFact").textContent
        ).toFixed(2),
        details: [],
      };

      if (tipoPago == "") {
        btnCreateFact.setAttribute(
          "uk-tooltip",
          "title:Debe ingresar forma de pago; pos: right;"
        );
        UIkit.tooltip(".btnCreateFact").show();

        setTimeout(() => {
          btnCreateFact.removeAttribute("uk-tooltip");
        }, 1000);
      } else if (tableDetailProduct == 0) {
        btnCreateFact.setAttribute(
          "uk-tooltip",
          "title:Debe ingresar producto; pos: right"
        );
        UIkit.tooltip(".btnCreateFact").show();

        setTimeout(() => {
          btnCreateFact.removeAttribute("uk-tooltip");
        }, 1000);
      } else {
        let blo = document.getElementById("Detail-product-fact").children;

        for (const iterator of blo) {
          let algo = parseInt(iterator.firstElementChild.textContent);
          let algo2 = parseInt(
            iterator.firstElementChild.nextElementSibling.textContent
          );
          let algo5 = parseFloat(
            iterator.lastElementChild.previousElementSibling.textContent
          );

          //insertamos los datos de los productos por cada tr que haya en detalles de factura
          json.details.push({
            idProduct: algo,
            cantidad: algo2,
            precioT: algo5,
          });
        }

        //luego de enviar los datos reseteamos el modal
        UIkit.notification({
          message:
            "<span uk-icon='icon: check'></span> Factura generada correctamente ",
          status: "success",
          pos: "bottom-right",
        });
        document.querySelector(".selectTypeCash").value = "";
        document.getElementById(
          "Client-datails"
        ).innerHTML = `<div class="uk-flex uk-flex-column uk-flex-middle" value="default">
                                                              <h5 class="uk-text-bold">AÑADIR CLIENTE</h5>
                                                              <a href="#" uk-icon="icon: plus-circle; ratio: 2.5"></a>
                                                          </div>`;
        document.getElementById("Detail-product-fact").innerHTML = "";
        ActualizarTotal();

        setTimeout(() => {
          UIkit.modal("#modal-full").hide();
        }, 800);

        //envio de datos con ajax
        //preparamos el json
        let jsonString = JSON.stringify(json);

        $.ajax({
          url: "Controller/funcs_ajax/hacer_factura.php",
          type: "POST",
          data: { jsonString },
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
            if (
              r.firstElementChild.lastElementChild.textContent
                .toLowerCase()
                .includes(e.target.value)
            ) {
              r.classList.remove("invisible");
            } else {
              r.classList.add("invisible");
            }
          });
        }
      });
  },
});
