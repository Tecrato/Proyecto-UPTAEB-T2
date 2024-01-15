//creamos una funcion que nos cargue todas las tarjetas y sus modales, dependiendo de que modal desea abrir
var page = 0;

function cambiar_pagina_php(dir) {
  // window.location.href = `Controller/funcs_ajax/cambiar_pagina.php?dir=` + dir + "&p="+num_page+"&type="+ type_page;
  $.ajax({
    url:
    // en n_p colocas el numero de tarjetas que se van a visualizar, en las tarjetas viejas era 9
      `Controller/funcs_ajax/cambiar_pagina.php?dir=` + dir + "&p=" +  num_page + "&type=" + type_page + "&n_p=" + 9,
    type: "GET",
    success: (response) => {
      page = parseInt(response);
      cargarTargetProduct();
    },
  });
}

const cargarTargetProduct = () => {
  //hacemos la petion ajax
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "POST",
    data: {
      randomnautica: "tarjeta_productos",
      n: page, // Aca va el numero de la pagina actual
      limite: 9, // Aca va el numero maximo de tarjetas que se pueden imprimir
    },
    success: function (response) {
      //convertimos la respuesta en un objeto
      let json = JSON.parse(response);
      //tarjeta sera el template de las tarjetas
      let tarjeta = "";

      //recorremos el json para crear las tarjetas
      json.lista.forEach((item) => {
        tarjeta += `
                  
      <div id="${item.id}">
        <div class="uk-card uk-card-default uk-background-secondary uk-light uk-border-rounded">
            <div class="uk-visible-toggle" tabindex="-1">
                <article class="uk-transition-toggle">
                    <img src="Media/imagenes/${item.imagen}"" alt="" class="img_product" width="150px" style="object-fit: cover; height: 215px;">
                    <div class="uk-position-top-right uk-transition-fade uk-position-small">
                        <a href="#modal-details-product" class="btnDetails">
                            <span class="Bg-info" uk-icon="icon: info; ratio: 1.5"></span>
                        </a>
                    </div>
                    <div class="uk-position-bottom-center ">
                        <ul class="uk-iconnav uk-background-secondary uk-transition-slide-bottom-small" style="width: 105%; padding: 5px;">
                            <li><a href="#eliminar_product" uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button deleteID" uk-icon="icon: trash"></a></li>
                            <li><a href="#Producto-modificar" uk-tooltip="title:Modificar; delay: 500" class="uk-icon-button" uk-icon="icon: file-edit"></a></li>
                            <li>
                                <a href="#product-date" class="Lote" uk-tooltip="title:Añadir Entrada; delay: 500">
                                    <img src="./static/images/btn_lote2.png" alt="" width="35px">
                                </a>
                            </li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
              `;   
        //seleccionamos el contenedor de las tarjetas, y las insertamos
        $(".container-target-product").html(tarjeta);
      });


      

      if (json.lista.length === 0) {
        document
          .querySelector(".container_marca_agua")
          .classList.remove("invisible");
        $(".container-target-product").html("");
      }

      // en esta parte se cargan los modales segun el que quiera ver



      //***************************************************  Modal de Eliminar  ******************************************************

      //seleccionamos todos los btn con la clase deleteID y lo recorremos

      document.querySelectorAll(".deleteID").forEach((btn) => {
        //usamos el evento click para saber en que tarjeta pulso, para luego capturar el id del producto
        btn.addEventListener("click", () => {
          //obtenemos el id del producto pulsado
          let idDelete = 
            parseInt(btn.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute('id'))
            console.log(idDelete);
          //creamos el template del modal de eliminar
          let ModalDeleteProduct = `<div id="eliminar_product" class="uk-flex-top" uk-modal>
                                          <div class="uk-modal-dialog uk-margin-auto-vertical">
                                              <div class="uk-modal-header uk-flex uk-flex-middle">
                                                  <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                                                  <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
                                              </div>
                                              <div class="uk-modal-body">
                                                  <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
                                              </div>
                                              <div class="uk-modal-footer uk-text-right">
                                                  <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                                                  <label class="uk-button uk-button-secondary subir" type="button" for="btn">Aceptar</label>
                                                  <form id="formDelete" action="" method="POST" style="display:none">
                                                      <input type=number value="${idDelete}" name="ID">
                                                      <input type=text value="producto" name="tipo">
                                                      <input type=submit id="btn">
                                                  </form>
                                              </div>
                                          </div>
                                      </div>`;

          //esta variable funciona para que una vez creado el modal, utilizamos childElementCount del body para que no se
          //creen mas modales cada vez que el usuario de el btn de delete
          let controllerModal = document.querySelector(".controller-modal");

          //si exede el n 10(que es el numero fijo de elementos en el body, sin ningun modal) no le permite crear mas modales de delete
          if (controllerModal.childElementCount == 9 || 10) {
            //agg el atributo uk-toggle que tiene uikit para poder abrir los modales
            btn.setAttribute("uk-toggle", "");
            //insertamos el template del modal en el contenedor
            $("#container-modals").html(ModalDeleteProduct);
            //para luego mostrarlo
            UIkit.modal("#eliminar_product").show();
          }
          //estas dos varibles, sirven para eliminar le modal segun el que pulse
          let subir = document.querySelector(".subir");
          let cancelar = document.querySelector(".cancelar");

          //seleccionamos el form que esta en el modal de delete
          let formDelete = document.querySelector("#formDelete");

          //captamos su evento submit
          formDelete.addEventListener("submit", (e) => {
            //creamos y luego pasamos por parametro los datos del form
            let detailDelete = new FormData(formDelete);
            //hacemos la peticion ajax
            $.ajax({
              url: "Controller/funcs/borrar_cosas.php",
              type: "POST",
              data: detailDelete,
              processData: false,
              contentType: false,
              success: function (response) {
                //ocultamos el modal
                UIkit.modal("#eliminar_product").hide();
                //mostramos el mensaje de eliminacion exitosa
                UIkit.notification({
                  message:
                    "<span uk-icon='icon: check'></span> Producto Eliminado correctamente ",
                  status: "success",
                  pos: "bottom-right",
                });
                //esta varible sirve para obtener el contenedor principal del modal
                let modal = subir.parentElement.parentElement.parentElement;
                //unos milisegundos despues
                setTimeout(() => {
                  //removemos el modal
                  controllerModal.removeChild(modal);
                  //y removemos el atributo uk-toggle
                  btn.removeAttribute("uk-toggle");
                }, 300);
                //para al final, llamar a la funcion de cargar las tarjetas
                cargarTargetProduct();
              },
            });
            e.preventDefault();
          });

          //si el usuario pulsa sobre cancelar, tambien elimina el modal
          cancelar.addEventListener("click", () => {
            UIkit.modal("#eliminar_product").hide();
            let modal = cancelar.parentElement.parentElement.parentElement;
            setTimeout(() => {
              controllerModal.removeChild(modal);
              btn.removeAttribute("uk-toggle");
            }, 300);
          });
        });
      });

      //***************************************************  Modal de Agg entrada  ******************************************************

      let controllerModal = document.querySelector(".controller-modal");

      //seleccionamos todos los btn con la clase Lote y lo recorremos

      document.querySelectorAll(".Lote").forEach((L) => {
        L.addEventListener("click", () => {
          let idProduct =
            L.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
          let templateAggLote = `
            <div id="product-lote" uk-modal>
                  <div class="uk-modal-dialog">
                      <button class="uk-modal-close-default close" type="button" uk-close></button>
                      <div class="uk-modal-header">
                          <h2 class="uk-modal-title">DETALLES DE LOTE</h2>
                      </div>
                      <div class="uk-modal-body">
                          <form id="formLotes" class="uk-grid-small" uk-grid method="POST" action="">
                              <input type="text" name="tipo" value="lote" style="display:none">
                              <input type="text" name="ID" value="${idProduct}" style="display:none">
                              <div class="uk-width-1-3@s">
                                  <select class="uk-select selectSupplier" id="form-stacked-select" name="proveedor" required>
                                      <option selected disabled>Proveedor</option>
                                  </select>
                              </div>
                              <div class="uk-width-1-3@s">
                                  <input class="uk-input" type="number" placeholder="Cantidad" aria-label="100" name="cantidad"
                                      required>
                              </div>
                              <div class="uk-width-1-3@s">
                                  <input class="uk-input" type="number" step="0.1" placeholder="precio_compra" aria-label="25"
                                      name="precio_compra" required>
                              </div>
                              <div class="uk-width-1-1@s uk-flex uk-flex-middle">
                                  <label for="" style="width: 265px;">Fecha adquisicion</label>
                                  <input class="uk-input" type="date" step="0.01" aria-label="25" name="fecha_c" required>
                              </div>
                              <div class="uk-width-1-1@s uk-flex uk-flex-middle">
                                  <label for="" style="width: 265px;">Fecha de vencimiento</label>
                                  <input class="uk-input" type="date" step="0.01" aria-label="25" name="fecha_v" required>
                              </div>
                              <input type="submit" id="subir" style="display:none">
                          </form>
                      </div>
                      <div class="uk-modal-footer uk-text-right">
                          <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                          <label class="uk-button uk-button-secondary subir" type="submit" for="subir">Guardar</label>
                      </div>
                  </div>
              </div>
                      `;
          if (controllerModal.childElementCount == 9 || 10) {
            L.setAttribute("uk-toggle", "");
            $("#container-modals").html(templateAggLote);
            UIkit.modal("#product-lote").show();
            // ejecutamos esta peticion para traer los proveedores de los productos a los select
            $.ajax({
              url: "Controller/funcs_ajax/search.php",
              type: "POST",
              data: { randomnautica: "proveedores" },
              success: function (response) {
                let options = ``;
                let json = JSON.parse(response);
                json.lista.forEach((date) => {
                  options += `<option value="${date.id}">${date.razon_social}</option>`;
                });
                document.querySelector(".selectSupplier").innerHTML += options;
              },
            });
          }

          let formAggLote = document.getElementById("formLotes");
          //captamos su evento submit, primero para evitar que la pagina se refresque, y segundo para insertar esos datos en un objeto FormData
          formAggLote.addEventListener("submit", (e) => {
            //aqui instanciamos el objeto formData y como parametro, le pasamos el formulario
            //el formData es un objeto que actua con encapsulamiento de datos de los form
            let formDataLote = new FormData(formAggLote);
            //hacemos la peticion ajax
            $.ajax({
              url: "Controller/funcs/agregar_cosas.php",
              type: "POST",
              data: formDataLote,
              processData: false,
              contentType: false,
              success: function (response) {
                //en la respuesta le mostramos un mensaje de producto creado correctamente
                console.log(response);
                UIkit.notification({
                  message:
                    "<span uk-icon='icon: check'></span> Lote agregado correctamente ",
                  status: "success",
                  pos: "bottom-right",
                });
                // y ocultamos el modal
                setTimeout(() => {
                  UIkit.modal("#product-lote").hide();
                }, 400);
                //lo eliminamos
                let subir =
                  document.querySelector(".subir").parentElement.parentElement
                    .parentElement;
                controllerModal.removeChild(subir);
                //y llamamos a la funcion de cargar contenido
                cargarTargetProduct();
              },
            });
            e.preventDefault();
          });

          let close = document.querySelector(".close");
          let cancelar = document.querySelector(".cancelar");

          cancelar.addEventListener("click", () => {
            UIkit.modal("#product-lote").hide();
            let modal = cancelar.parentElement.parentElement.parentElement;
            setTimeout(() => {
              controllerModal.removeChild(modal);
              L.removeAttribute("uk-toggle");
            }, 300);
          });

          close.addEventListener("click", () => {
            UIkit.modal("#product-lote").hide();
            let modal = close.parentElement.parentElement;
            setTimeout(() => {
              controllerModal.removeChild(modal);
              L.removeAttribute("uk-toggle");
            }, 300);
          });
        });
      });

      //***************************************************  Modal de detalles  ******************************************************

      //seleccionamos todos los btn de detalles y los recorremos
      document.querySelectorAll(".btnDetails").forEach((info) => {
        //usamos el evento click para saber en cual pulsamos
        info.addEventListener("click", () => {
          let templateDetails = "";
          //obtenemos el id del producto para hacer la consulta
          let idProduct =
            info.parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
          //hacemos la peticion ajax para crear el esqueleto del modal
          $.ajax({
            url: "Controller/funcs_ajax/search_lotes.php",
            type: "POST",
            data: { TB: "MODAL", ID: idProduct },
            success: function (response) {
              let json = JSON.parse(response);
              json.lista.forEach((item) => {
                templateDetails = `<div id="modal-details-product" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-border-rounded uk-margin-auto-vertical container-modal-detailProduct">
                <button class="uk-modal-close-default close" type="button" uk-close></button>
                <div>
        
                    <div class="uk-flex uk-flex-center uk-flex-wrap  container-detailProduct">
                        <div class="uk-margin-small-right margin-img-detailPoduct">
                            <img src="Media/imagenes/${item.imagen}" alt="" width="155px"
                                style="height: 195px; object-fit: cover;">
                        </div>
                        <div class="container-stats-productDetail">
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">NOMBRE</h5>
                                </div>
                                <div>
                                    <h5 class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        ${item.nombre}</h5>
                                </div>
                            </div>
                            <div class="uk-flex">
                                <div>
                                    <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2"
                                        style="float: left;"></span>
                                    <h5 class="uk-margin-small-right uk-margin-remove-top uk-margin-remove-left uk-margin-remove-bottom uk-text-bolder"
                                        style="float: left;">DESCRIPCIÓN</h5>
                                    <h5 class="Description-item-productDetail uk-margin-remove Color-icon-detailProduct uk-text-bold uk-text-uppercase"
                                        style="width: 360px; line-height: 23px;">
                                        ${item.descripcion}
                                    </h5>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">CATEGORIA</h5>
                                </div>
                                <div>
                                    <h5 class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        ${item.categoria}</h5>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">EXISTENCIA</h5>
                                </div>
                                <div>
                                    <h5 class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        ${item.existencia}
                                    </h5>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">PRECIO UNITARIO</h5>
                                </div>
                                <div>
                                    <h5 class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        ${item.precio_venta}
                                        BS</h5>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <hr class="uk-divider-icon Color-icon-detailProduct">
        
                    <div>
                        <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-bottom">
                            <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2"></span>
                            <h5 class=" uk-text-bold uk-text-center uk-margin-remove">PROVEEDOR</h5>
                        </div>
                        <section class="uk-margin-small-bottom" style="height: 150px; overflow: auto;">
                            <ul id="containerSupplierName" uk-accordion>
                                
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
                </div>`;
              });
              //le damos el atributo para que pueda abrir el modal
              info.getAttribute("uk-toogle", "");
              //insertamos el template en el contenedor
              $("#container-modals").html(templateDetails);

              //esta consulta es para cargar los lotes segun del id del producto y el proveedor
              let supplierName = "";
              $.ajax({
                url: "Controller/funcs_ajax/search_lotes.php",
                type: "POST",
                data: { TB: "NP", ID: idProduct },
                success: function (response) {
                  let json = JSON.parse(response);
                  json.lista.forEach((s) => {
                    supplierName += `<li class="uk-text-uppercase lotes-content" idProveedor="${s.id_proveedor}">
                                        <a class="uk-accordion-title uk-text-bold uk-text-default SupplierID" href="#" style="color: #106733;" idProduct="${idProduct}">
                                            <span uk-icon="icon:bookmark; ratio: 1.5"></span>
                                            ${s.proveedor}
                                        </a>
                                        <div class="uk-accordion-content detailLote">

                                        </div>
                                        <hr>
                                    </li>
                                   `;
                  });
                  $("#containerSupplierName").html(supplierName);

                  //esta consulta es para insertar las entradas en los a que generamos anteriormente

                  let SupplierID = document.querySelectorAll(".SupplierID");
                  SupplierID.forEach((sup) => {
                    sup.addEventListener("click", () => {
                      let detailsLote = "";
                      let idProveedor =
                        sup.parentElement.getAttribute("idProveedor");
                      let contenedor = sup.nextElementSibling;

                      $.post(
                        "Controller/funcs_ajax/search_lotes.php",
                        { TB: "LP", ID: idProduct, SUPPLIER: idProveedor },
                        function (response) {
                          let json = JSON.parse(response);
                          json.lista.forEach((dat) => {
                            detailsLote += `
                                        <div class="uk-flex uk-flex-center uk-flex-middle">
                                            <article class="tag_modal-detailProduct uk-margin-small-right">
                                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                    <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                                        style="color: #fff; padding: 2px;">
                                                        LOTE Nro ${dat.id}</h6>
                                                </div>
                                            </article>
                                            <article class="tag_modal-detailProduct-2">
                                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                    <span class="uk-margin-small-right icon" style="color: #fff;"
                                                        uk-icon="icon: star; ratio: 1.1"></span>
                                                    <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product"
                                                        style="color: #fff;">
                                                        CANTIDAD</h6>
                                                    <h6 class="uk-margin-small-left uk-margin-remove-right uk-margin-remove-top uk-margin-remove-bottom uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                                        style="color: #fff;">${dat.cantidad}</h6>
                                                </div>
                                            </article>
                                            <article class="tag_modal-detailProduct uk-margin-small-left">
                                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                    <span class="uk-margin-small-right icon" style="color: #fff;"
                                                        uk-icon="icon: calendar; ratio: 1.2"></span>
                                                    <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product"
                                                        style="color: #fff;">
                                                        EXP</h6>
                                                    <h6 class="uk-margin-small-left uk-margin-remove-right uk-margin-remove-top uk-margin-remove-bottom uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                                        style="color: #fff;">${dat.fecha_vencimiento}</h6>
                                                </div>
                                            </article>
                                        </div>
                                      <hr>`;
                          });
                          contenedor.innerHTML = detailsLote;
                        }
                      );
                    });
                  });
                },
              });

              //lo mostramos
              UIkit.modal("#modal-details-product").show();

              //seleccionamos el btn de cerrar
              let close = document.querySelector(".close");
              //captamos su evento click
              close.addEventListener("click", () => {
                //ocultamos el modal
                UIkit.modal("#modal-details-product").hide();
                //luego le removemos el atributo y lo removemos del contenedor
                setTimeout(() => {
                  info.removeAttribute("uk-toggle");
                  controllerModal.removeChild(
                    close.parentElement.parentElement
                  );
                }, 50);
              });
            },
          });
        });
      });

      marcaAgua();
    },
  });
};
cargarTargetProduct();

//***************************************************  Modal de Registro de productos  ******************************************************

//creamos el template del modal de registro de productos
let templateRegisterProduct = `
                                    <div id="modal-register-product" uk-modal>
                                        <div class="uk-modal-dialog">
                                            <button class="uk-modal-close-default close" type="button" uk-close></button>
                                            <div class="uk-modal-header">
                                                <h2 class="uk-modal-title">REGISTRAR PRODUCTO</h2>
                                            </div>
                                            <div class="uk-modal-body ">
                                                <form id="formAggProduct" class="uk-grid-small" uk-grid method="POST" action="" enctype="multipart/form-data">
                                                    <input type="text" name="tipo" value='producto' id="" style="display:none">
                                                    <div class="uk-width-1-2">
                                                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" required>
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <input class="uk-input" type="text" placeholder="Descripción" aria-label="50" name="descripcion">
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <select id="selectCat" class="uk-select" id="form-stacked-select" name="categoria" required>
                                                            <option value="" disabled selected>Categoria</option>
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <select id="selectUni" class="uk-select" id="form-stacked-select" name="unidad" required>
                                                            <option value="" disabled selected>Unidad</option>
                                                           
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <input class="uk-input" type="number" step="0.1" placeholder="precio_venta" aria-label="25" name="precio_venta" required>
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <input class="uk-input" type="number" placeholder="Stock mínimo" aria-label="25" name="stock_min" required>
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <input class="uk-input" type="number" placeholder="Stock maximo" aria-label="25" name="stock_max" required>
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <label class="uk-margin-medium-right" for="">IVA</label>
                                                        <label><input class="uk-radio" type="radio" name="IVA" value=0 checked> Exento</label>
                                                        <label><input class="uk-radio" type="radio" name="IVA" value=1> No Exento</label>
                                                    </div>
                                                    <div class="uk-width-1-2@s">
                                                        <div uk-form-custom>
                                                            <input type="file" accept="image/*" aria-label="Custom controls" name="imagen1">
                                                            <button class="uk-button uk-button-default" type="button" tabindex="-1">Selecciona Imagen</button>
                                                        </div>
                                                    </div>
                                                    <input type="submit" id="subirxd" style="display:none">
                                                </form>
                                            </div>
                                            <div class="uk-modal-footer uk-text-right">
                                                <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                                                <label class="uk-button uk-button-secondary subir" type="submit" for="subirxd">Guardar</label>
                                            </div>
                                        </div>
                                    </div>
`;
let controllerModal = document.querySelector(".controller-modal");
//seleccionamos el btn que abre el modal
let btnAgg = document.querySelector(".btn-modal-register");
console.log(controllerModal.childElementCount);

btnAgg.addEventListener("click", () => {
  //esto es para que se cree solo una vez, ya que el body tiene 10 elementos por defecto
  if (controllerModal.childElementCount == 9 || 10) {
    btnAgg.setAttribute("uk-toggle", "");
    $("#container-modals").html(templateRegisterProduct);
    UIkit.modal("#modal-register-product").show();
    //   //ejecutamos esta peticion para traer las categorias de los productos a los select
    $.ajax({
      url: "Controller/funcs_ajax/search.php",
      type: "POST",
      data: { randomnautica: "categoria" },
      success: function (response) {
        console.log(response);
        let options = ``;
        let json = JSON.parse(response);
        json.lista.forEach((date) => {
          options += `<option value="${date.id}">${date.nombre}</option>`;
        });
        document.getElementById("selectCat").innerHTML += options;
      },
    });
    //   //ejecutamos esta peticion para traer las unidades de los productos a los select
    $.ajax({
      url: "Controller/funcs_ajax/search.php",
      type: "POST",
      data: { randomnautica: "unidad" },
      success: function (response) {
        let options = ``;
        let json = JSON.parse(response);
        json.lista.forEach((date) => {
          options += `<option value="${date.id}">${date.nombre}</option>`;
        });
        document.getElementById("selectUni").innerHTML += options;
      },
    });
  }

  // //primero seleccionamos el form que tiene los datos para crear los productos
  let formAggProduct = document.getElementById("formAggProduct");
  //captamos su evento submit, primero para evitar que la pagina se refresque, y segundo para insertar esos datos en un objeto FormData
  formAggProduct.addEventListener("submit", (e) => {
    //aqui instanciamos el objeto formData y como parametro, le pasamos el formulario
    //el formData es un objeto que actua con encapsulamiento de datos de los form
    let formDataProduct = new FormData(formAggProduct);
    //hacemos la peticion ajax
    $.ajax({
      url: "Controller/funcs/agregar_cosas.php",
      type: "POST",
      data: formDataProduct,
      processData: false,
      contentType: false,
      success: function (response) {
        //en la respuesta le mostramos un mensaje de producto creado correctamente
        UIkit.notification({
          message:
            "<span uk-icon='icon: check'></span> Producto creado correctamente ",
          status: "success",
          pos: "bottom-right",
        });
        // y ocultamos el modal
        setTimeout(() => {
          UIkit.modal("#modal-register-product").hide();
        }, 400);
        //lo eliminamos
        let subir =
          document.querySelector(".subir").parentElement.parentElement
            .parentElement;
        controllerModal.removeChild(subir);
        btnAgg.removeAttribute("uk-toggle");
        console.log(response);
        //y llamamos a la funcion de cargar contenido
        cargarTargetProduct();
      },
    });
    e.preventDefault();
  });

  let close = document.querySelector(".close");
  let cancelar = document.querySelector(".cancelar");

  cancelar.addEventListener("click", () => {
    UIkit.modal("#modal-register-product").hide();
    let modal = cancelar.parentElement.parentElement.parentElement;
    setTimeout(() => {
      controllerModal.removeChild(modal);
      btnAgg.removeAttribute("uk-toggle");
    }, 300);
  });

  close.addEventListener("click", () => {
    UIkit.modal("#modal-register-product").hide();
    let modal = close.parentElement.parentElement;
    setTimeout(() => {
      controllerModal.removeChild(modal);
      btnAgg.removeAttribute("uk-toggle");
    }, 300);
  });
});
