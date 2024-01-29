//creamos una funcion que nos cargue todas las tarjetas y sus modales, dependiendo de que modal desea abrir
var page = 0;

$(".pag-btn-productos").click((ele) => {
  cambiar_pagina_ajax(
    ele.target.dataset["direccion"],
    "productos",
    cargarTargetProduct,
    9
  );
});

const tarjetas = (response) => {
  //convertimos la respuesta en un objeto
  let json = JSON.parse(response);
  //tarjeta sera el template de las tarjetas
  let tarjeta = "";
  //recorremos el json para crear las tarjetas
  json.lista.forEach((item) => {
    tarjeta += `
              
  <div id="${item.id}" data-supplier="${item.proveedor}" data-category="${item.categoria}" data-marca="${item.marca}" data-name="${item.nombre.slice(0,1).toUpperCase()}">
    <div class="uk-card uk-card-default uk-background-secondary uk-light uk-border-rounded">
        <div class="uk-visible-toggle" tabindex="-1">
            <article class="uk-transition-toggle">
                <img src="Media/imagenes/${
                  item.imagen
                }"" alt="" class="img_product" width="150px" style="object-fit: cover; height: 215px;">
                <div class="uk-position-top-right uk-transition-fade uk-position-small">
                    <a href="#modal-details-product" class="btnDetails" data-id="${
                      item.id
                    }">
                        <span class="Bg-info" uk-icon="icon: info; ratio: 1.5"></span>
                    </a>
                </div>
                <div class="uk-position-bottom-center ">
                    <ul class="uk-iconnav uk-background-secondary uk-transition-slide-bottom-small" style="width: 105%; padding: 5px;">
                        <li><a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button deleteID" uk-icon="icon: trash" data-id="${
                          item.id
                        }"></a></li>
                        <li><a href="#Producto-modificar" uk-tooltip="title:Modificar; delay: 500" class="uk-icon-button" uk-icon="icon: file-edit" data-id="${
                          item.id
                        }"></a></li>
                        <li>
                            <a href="#product-entry" uk-toggle class="Lote" uk-tooltip="title:Añadir Entrada; delay: 500" data-id="${
                              item.id
                            }">
                                <img src="./static/images/btn_lote2.png" alt="" width="35px">
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div style="padding: 0px 10px;">
                        <div>${item.nombre}</div>
                        <div>stock: <b class="uk-text-success">${item.stock ? item.stock : 0}</b></div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
          `;
    //seleccionamos el contenedor de las tarjetas, y las insertamos
    $(".container-target-product").html(tarjeta);
  });

  if (json.lista.length == 0) {
    document.querySelector(".container_marca_agua").classList.remove("invisible");
    document.querySelector(".uk-pagination").classList.add('invisible');
    $(".container-target-product").html("");
  } else {
    document.querySelector(".container_marca_agua").classList.add("invisible");
    document.querySelector(".uk-pagination").classList.remove('invisible');
  }
};
const cargarTargetProduct = () => {
  //hacemos la petion ajax
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "POST",
    data: {
      randomnautica: "productos",
      n: page, // Aca va el numero de la pagina actual
      limite: 9, // Aca va el numero maximo de tarjetas que se pueden imprimir
    },
    success: function (response) {
        tarjetas(response);

      //seleccionamos todos los btn con la clase deleteID y lo recorremos
      //esta parte tiene el fin de dar el id al input que se enviara para eliminar el producto
      document.querySelectorAll(".deleteID").forEach((btn) => {
        //usamos el evento click para saber en que tarjeta pulso, para luego capturar el id del producto
        btn.addEventListener("click", () => {
          //obtenemos el id del producto pulsado
          let idDelete = parseInt(btn.dataset["id"]);
          //le damos el atributo de value con el id del producto a eliminar
          document
            .getElementById("ValueInputDelete")
            .setAttribute("value", idDelete);

          //seleccionamos el form que esta en el modal de delete
          let formDelete = document.querySelector("#formDelete");

          //captamos su evento submit
          formDelete.addEventListener("submit", (e) => {
            e.preventDefault();
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
                console.log(response);
                //ocultamos el modal
                UIkit.modal("#eliminar_product").hide();
                //mostramos el mensaje de eliminacion exitosa
                UIkit.notification({
                  message:
                    "<span uk-icon='icon: check'></span> Producto Eliminado correctamente ",
                  status: "success",
                  pos: "bottom-right",
                });
                //para al final, llamar a la funcion de cargar las tarjetas
                cargarTargetProduct();
              },
            });
          });
        });
      });

      //***************************************************  Modal de Agg entrada  ******************************************************

      //seleccionamos todos los btn con la clase Lote y lo recorremos

      document.querySelectorAll(".Lote").forEach((L) => {
        L.addEventListener("click", () => {
          let idProduct = L.dataset["id"];
            document.getElementById("ValueIdEntry").setAttribute("value", idProduct);
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
              document.querySelector(".selectSupplier").innerHTML = options;
              document.querySelector(".selectSupplier").insertAdjacentHTML('afterbegin', `<option selected disabled>Proveedor</option>`)
              
            },
          });

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
                    "<span uk-icon='icon: check'></span> Entrada agregado correctamente ",
                  status: "success",
                  pos: "bottom-right",
                });
                // y ocultamos el modal
                setTimeout(() => {
                  UIkit.modal("#product-entry").hide();
                }, 300);
                cargarTargetProduct();
              },
            });
            e.preventDefault();
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
          let idProduct = info.dataset["id"];
          //hacemos la peticion ajax para crear el esqueleto del modal
          $.ajax({
            url: "Controller/funcs_ajax/search.php",
            type: "POST",
            data: { randomnautica: "productos", ID: idProduct },
            success: function (response) {
              console.log(response);
              let json = JSON.parse(response);
              json.lista.forEach((item) => {
                templateDetails = `<div id="modal-details-product" class="uk-flex-top" uk-modal bg-close='false'>
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
                                        ${item.stock}
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
              $("#container-modals").append(templateDetails);

              //esta consulta es para cargar los lotes segun del id del producto y el proveedor
              let supplierName = "";
              $.ajax({
                url: "Controller/funcs_ajax/search.php",
                type: "POST",
                data: {
                  randomnautica: "entradas",
                  subFunction: "proveedor_de_una_entrada",
                  id_producto: idProduct,
                },
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
                        "Controller/funcs_ajax/search.php",
                        {
                          randomnautica: "entradas",
                          id_producto: idProduct,
                          id_proveedor: idProveedor,
                        },
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
    },
  });
};
cargarTargetProduct();

//***************************************************  Modal de Registro de productos  ******************************************************

  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "POST",
    data: { randomnautica: "categorias" },
    success: function (response) {
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
    data: { randomnautica: "unidades" },
    success: function (response) {
      let options = ``;
      let json = JSON.parse(response);
      json.lista.forEach((date) => {
        options += `<option value="${date.id}">${date.nombre}</option>`;
      });
      document.getElementById("selectUni").innerHTML += options;
    },
  });

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
        //y llamamos a la funcion de cargar contenido
        cargarTargetProduct();
      },
    });
    e.preventDefault();
  });


// aqui insertaremos los proveedores, categoria y marcas para los filtros de los productos

//esta consulta sirve para cargar los datos de los proveedores en el filtro
$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "POST",
  data: { randomnautica: "proveedores" },
  success: function (response) {
    let options = ``;
    let json = JSON.parse(response);
    json.lista.forEach((date) => {
      options += `<li  uk-filter-control="filter: [data-supplier='${date.razon_social}']; group: supplier"><a class='filterS' href="#">${date.razon_social}</a></li>`;
    });
    document.querySelector(".filter_supplier").innerHTML += options;
  },
});
//esta consulta sirve para cargar los datos de las categorias en el filtro
$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "POST",
  data: { randomnautica: "categorias" },
  success: function (response) {
    let options = ``;
    let json = JSON.parse(response);
    json.lista.forEach((date) => {
      options += `<li  uk-filter-control="filter: [data-category='${date.nombre}']; group: category"><a class='filterS' href="#">${date.nombre}</a></li>`;
    });
    document.querySelector(".filter_category").innerHTML += options;
  },
});
//esta consulta sirve para cargar los datos de las marcas en el filtro
$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "POST",
  data: { randomnautica: "productos", subFunction: "marca" },
  success: function (response) {
    let options = ``;
    let json = JSON.parse(response);
    json.lista.forEach((E) => {
      options += `<li  uk-filter-control="filter: [data-marca='${E.marca}']; group: marca"><a class='filterS' href="#">${E.marca}</a></li>`;
    });
    document.querySelector(".filter_marca").innerHTML += options;
  },
});
//esta funcion tiene el objetivo de mostrar los productos por nombre
document.querySelector(".searchProduct").addEventListener("keyup", (e) => {
  let val = e.target.value;
  if (val != "") {
    $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "POST",
    data: { randomnautica: "productos", like: val },
    success: function (response) {
      console.log(response);
      tarjetas(response);
    },
  });
  } else {
    cargarTargetProduct()
  }
});