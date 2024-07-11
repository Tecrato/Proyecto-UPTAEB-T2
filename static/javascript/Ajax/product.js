document.querySelector('#iconReportInv').addEventListener('click', () => {
  window.location.href = 'PDFInventario'
})

if (screen < 1023) {
  document.querySelector(
    ".itemSwitcher1"
  ).innerHTML = `<img class="uk-preserve-width uk-margin-small-right img1ProductSwitcher" src="./static/images/cajas (2).png" width="30" height="30" alt="">`;
  document.querySelector(
    ".itemSwitcher2"
  ).innerHTML = `<img class="uk-preserve-width uk-margin-small-right img2ProductSwitcher" src="./static/images/suministros.png" width="32" height="32" alt="">`;
  document.querySelector(
    ".itemSwitcher3"
  ).innerHTML = `<img class="uk-preserve-width uk-margin-small-right img4ProductSwitcher" src="./static/images/menu.png" width="32" height="32" alt="">`;
  document.querySelector(
    ".itemSwitcher4"
  ).innerHTML = `<img class="uk-preserve-width uk-margin-small-right img5ProductSwitcher" src="./static/images/papelera-de-reciclaje.png" width="32" height="32" alt="">`;
}

if (screen < 1357) {
  let table_expand = document.querySelectorAll(".uk-table-expand");
  table_expand.forEach((e) => {
    e.classList.remove("uk-table-expand");
  });
}

//creamos una funcion que nos cargue todas las tarjetas y sus modales, dependiendo de que modal desea abrir
var page = 0;
//la varible val funcionara para usar el modal de registrar para editar, dependiendo del valor de val, la url de la peticion cambiara
let val = false;

$(".pag-btn-productos").click((ele) => {
  cambiar_pagina_ajax(
    ele.target.dataset["direccion"],
    "productos",
    cargarTargetProduct,
    18
  );
});

let selectMetodoGanancia = document.querySelector(".select_metodo_ganancia");

selectMetodoGanancia.addEventListener("change", ()=>{
  if (selectMetodoGanancia.value != 0) {
    document.querySelector(".PVUpdateProduct").setAttribute("disabled","")
    // document.querySelector(".PVUpdateProduct").value = ""
  } else {
    document.querySelector(".PVUpdateProduct").removeAttribute("disabled")
    // document.querySelector(".PVUpdateProduct").value = 0
  }
})

const modalDetalles = (n) => {
  document.querySelectorAll(".btnDetails").forEach((info) => {
    //usamos el evento click para saber en cual pulsamos
    info.addEventListener("click", () => {
      let templateDetails = "";
      //obtenemos el id del producto para hacer la consulta
      let idProduct = info.dataset["id"];

      // if (session_user_rol == 'Usuario') {
      // let contProvDetail = document.querySelector('.container-prov_details')
      // let contProvDetail1 = document.querySelector('.container-prov_details').firstElementChild
      // let contProvDetail2 = document.querySelector('.container-prov_details').lastElementChild
      // contProvDetail.removeChild(contProvDetail1)
      // contProvDetail.removeChild(contProvDetail2)
      // }
      //hacemos la peticion ajax para crear el esqueleto del modag
      $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "productos", ID: idProduct, active: n },
        success: function (response) {
          let json = JSON.parse(response);
          json.lista.forEach((item) => {
    
            document.querySelector(".productDetailName").textContent =
              item.nombre + " " + item.valor_unidad + " " + item.unidad;
            document.querySelector(".productDetailmarca").textContent =
              item.marca;
            document.querySelector(".productDetailCategory").textContent =
              item.categoria;
            document.querySelector(".productDetailStock").textContent =
              item.stock ? item.stock : 0;
            document.querySelector(".productDetailPV").textContent =
              parseFloat(item.precio_venta).toFixed(2);
            // JsBarcode("#Bard","001000000001", {
            //   format: "CODE128",
            //   textMargin: 0,
            //   fontOptions: "bold",
            //   width: 1,
            //   height: 50
            // })
            JsBarcode("#Bard",item.codigo,{
              width: 1.3
            })

          });
          if (session_user_rol_num < 3) {
            //esta consulta es para cargar los lotes segun del id del producto y el proveedor
            let supplierName = "";
            $.ajax({
              url: "api_estadisticas",
              type: "GET",
              data: {
                select: "proveedor_de_una_entrada",
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
                    $.get(
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
                                                        ENTRADA Nro ${dat.id}</h6>
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
          } else {
            document.querySelector(".container-prov_details").remove();
          }
        },
      });
    });
  });
};
const modalEntradas = () => {
  //***************************************************  Modal de Agg entrada  ******************************************************

  //seleccionamos todos los btn con la clase Lote y lo recorremos

  document.querySelectorAll(".Lote").forEach((L) => {
    L.addEventListener("click", () => {
      let idProduct = L.dataset["id"];
      document.getElementById("ValueIdEntry").setAttribute("value", idProduct);
      // ejecutamos esta peticion para traer los proveedores de los productos a los select
      $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "proveedores" },
        success: function (response) {
          let options = ``;
          let json = JSON.parse(response);
          json.lista.forEach((date) => {
            options += `<option value="${date.id}">${date.razon_social}</option>`;
          });
          document.querySelector(".selectSupplier").innerHTML = options;
          document
            .querySelector(".selectSupplier")
            .insertAdjacentHTML(
              "afterbegin",
              `<option selected disabled>Proveedor</option>`
            );
        },
      });

      let formAggLote = document.getElementById("formLotes");
      // Verificamos si el event listener ya ha sido añadido
      if (!formAggLote.dataset.listenerAdded) {
        //captamos su evento submit, primero para evitar que la pagina se refresque, y segundo para insertar esos datos en un objeto FormData
        formAggLote.addEventListener("submit", (e) => {
          e.preventDefault();
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
              console.log(response);
              //en la respuesta le mostramos un mensaje de producto creado correctamente
              UIkit.notification.closeAll();
              UIkit.notification({
                message:
                  "<span uk-icon='icon: check'></span> Entrada agregada correctamente ",
                status: "success",
                pos: "bottom-right",
              });
              // y ocultamos el modal
              setTimeout(() => {
                UIkit.modal("#product-entry").hide();
                cargarEntrys();
              }, 300);
              cargarTargetProduct();

              $("#formLotes").trigger("reset");
              document.getElementById("ValueIdEntry").removeAttribute("value");
            },
          });
        });
        // Marcamos que el event listener ha sido añadido
        formAggLote.dataset.listenerAdded = "true";
      }
    });
  });
};

const modalModificar = () => {
  //***************************************************  Modal de modificar producto  ******************************************************

  //seleccionamos todos los btn con la clase UpdateProduct y lo recorremos

  document.querySelectorAll(".UpdateProduct").forEach((L) => {
    L.addEventListener("click", () => {
      val = true;
      let idProduct = L.dataset["id"];
      document
        .querySelector(".ValueInpUpdate")
        .setAttribute("value", idProduct);
      // ejecutamos esta peticion para traer los proveedores de los productos a los select
      $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "productos", ID: idProduct },
        success: function (response) {
          let json = JSON.parse(response);
          console.log(json);
          json.lista.forEach((i) => {
            document.querySelector(".NameUpdateProduct").value = i.nombre;
            document.querySelector(".MarcaUpdateProduct").value = i.marca;
            document.querySelector(".PVUpdateProduct").value = i.precio_venta;
            document.querySelector(".SMMUpdateProduct").value = i.stock_min;
            document.querySelector(".SMXUpdateProduct").value = i.stock_max;
            document.querySelector(".ValorUnidadUpdateProduct").value = i.valor_unidad;
            document.querySelector(".CodeUpdateProduct").value = i.codigo;
            if (i.IVA == 0) {
              document
                .querySelector(".IVA_EUpdateProduct")
                .setAttribute("checked", "");
            } else {
              document
                .querySelector(".IVA_NEUpdateProduct")
                .setAttribute("checked", "");
            }
          });
          document.querySelector(".title_modal_reg_upd").textContent = "MODIFICAR PRODUCTO";

          cargarCategoriaRegProduct();
          cargarUnidadesRegProduct();
          cargarMarcasRegProduct();

          UIkit.modal("#modal-register-product").show();
        },
      });
    });
  });
};
const modalEliminar = () => {
  //***************************************************  Modal de eliminar  ******************************************************

  //seleccionamos todos los btn con la clase deleteID y lo recorremos
  //esta parte tiene el fin de dar el id al input que se enviara para eliminar el producto
  document.querySelectorAll(".deleteID").forEach((btn) => {
    //usamos el evento click para saber en que tarjeta pulso, para luego capturar el id del producto
    btn.addEventListener("click", () => {
      document.querySelector(".modalDeleteTitle").textContent = "ELIMINAR";
      document.querySelector(".modalDeleteBody").textContent =
        "Deseas eliminar este producto? Podras restaurarlo al inventario desde papelera";
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
            cargarTargetProductDesactive();
            //ocultamos el modal
            UIkit.modal("#eliminar_product").hide();
            //mostramos el mensaje de eliminacion exitosa
            UIkit.notification.closeAll();

            UIkit.notification({
              message:
                "<span uk-icon='icon: check'></span> Producto Eliminado correctamente ",
              status: "success",
              pos: "bottom-right",
              group: idDelete,
            });

            //para al final, llamar a la funcion de cargar las tarjetas
            cargarTargetProduct();
            document.querySelector(".searchProductActive").value = "";
          },
        });
      });
    });
  });
};
const modalEliminarProductDesactive = () => {
  //***************************************************  Modal de eliminar  ******************************************************

  //seleccionamos todos los btn con la clase deleteID y lo recorremos
  //esta parte tiene el fin de dar el id al input que se enviara para eliminar el producto
  document.querySelectorAll(".deleteID2").forEach((btn) => {
    //usamos el evento click para saber en que tarjeta pulso, para luego capturar el id del producto
    btn.addEventListener("click", () => {
      document.querySelector(".modalDeleteTitle").textContent =
        "RESTAURAR PRODUCTO";
      document.querySelector(".modalDeleteBody").textContent =
        "Deseas restaurar este producto a su estado de inventario";

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
            cargarTargetProduct();
            //ocultamos el modal
            UIkit.modal("#eliminar_product").hide();
            //mostramos el mensaje de eliminacion exitosa
            UIkit.notification.closeAll();

            UIkit.notification({
              message:
                "<span uk-icon='icon: check'></span>Producto Restaurado Correctamente",
              status: "success",
              pos: "bottom-right",
              group: idDelete,
            });

            //para al final, llamar a la funcion de cargar las tarjetas
            cargarTargetProductDesactive();
            document.querySelector(".searchProductNotActive").value = "";
          },
        });
      });
    });
  });
};
const tarjetas = (response, cont) => {
  //convertimos la respuesta en un objeto
  let json = JSON.parse(response);
  //tarjeta sera el template de las tarjetas
  let tarjeta = "";
  //recorremos el json para crear las tarjetas
  json.lista.forEach((item) => {
    tarjeta += `
              
  <div id="${item.id}" data-supplier="${item.proveedor}" data-category="${item.categoria
      }" data-marca="${item.marca}" data-name="${item.nombre
        .slice(0, 1)
        .toUpperCase()}">
    <div class="uk-card uk-card-default uk-background-secondary uk-light uk-border-rounded">
        <div class="uk-visible-toggle" tabindex="-1">
            <article class="uk-transition-toggle">
                <img src="Media/imagenes/${item.imagen
      }"" alt="" class="img_product" width="150px" style="object-fit: cover; height: 215px;">
                <div class="uk-position-top-right uk-transition-fade uk-position-small">
                    <a href="#modal-details-product" uk-toggle class="btnDetails" data-id="${item.id
      }">
                      
                        <span class="Bg-info" uk-icon="icon: info; ratio: 1.5"></span>
                    </a>
                </div>
                <div class="uk-position-bottom-center btns_option_product">
                    <ul class=" uk-iconnav uk-background-secondary uk-transition-slide-bottom-small" style="width: 105%; padding: 5px;">
                        <li><a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button deleteID" uk-icon="icon: trash" data-id="${item.id
      }"></a></li>
                        <li><a href="#Producto-modificar" uk-tooltip="title:Modificar; delay: 500" class="uk-icon-button UpdateProduct" uk-icon="icon: file-edit" data-id="${item.id
      }"></a></li>
                        <li>
                            <a href="#product-entry" uk-toggle class="Lote" uk-tooltip="title:Añadir Entrada; delay: 500" data-id="${item.id
      }">
                                <img src="./static/images/btn_lote2.png" alt="" width="35px">
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div style="padding: 0px 10px; width: 130px;">
                        <div class="uk-text-truncate">${item.nombre}</div>
                        <div>stock: <b class="uk-text-success">${item.stock ? item.stock : 0
      }</b></div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
          `;
    //seleccionamos el contenedor de las tarjetas, y las insertamos
    $(cont).html(tarjeta);

    //esto es para acomodar la posicion de los botones dependiendo de la resolucion
    if (screen < 938) {
      let options = document.querySelectorAll(".btns_option_product");
      options.forEach((e) => {
        e.classList.remove("uk-position-bottom-center");
        e.classList.add("uk-position-bottom-right");
      });
    }

    //preguntamamos si la sesion es la de usuario, para eliminar los botones de accion
    if (session_user_rol == "Usuario") {
      let options = document.querySelectorAll(".btns_option_product");
      options.forEach((e) => {
        e.removeChild(e.firstElementChild);
      });
    }
  });

  if (json.lista.length == 0) {
    document
      .querySelector(".container_marca_agua")
      .classList.remove("invisible");
    document.querySelector(".uk-pagination").classList.add("invisible");
    $(".container-target-product").html("");
  } else {
    document.querySelector(".container_marca_agua").classList.add("invisible");
    document.querySelector(".uk-pagination").classList.remove("invisible");
  }

  modalEntradas();
  modalEliminar();
  modalModificar();
  colorDefault()

};
const tarjetasProductosDesactive = (response, cont) => {
  console.log(response)
  //convertimos la respuesta en un objeto
  let json = JSON.parse(response);
  //tarjeta sera el template de las tarjetas
  let tarjeta = "";
  //recorremos el json para crear las tarjetas
  json.lista.forEach((item) => {
    tarjeta += `
              
  <div id="${item.id}" data-supplier="${item.proveedor}" data-category="${item.categoria
      }" data-marca="${item.marca}" data-name="${item.nombre
        .slice(0, 1)
        .toUpperCase()}">
    <div class="uk-card uk-card-default uk-background-secondary uk-light uk-border-rounded">
        <div class="uk-visible-toggle" tabindex="-1">
            <article class="uk-transition-toggle">
                <img src="Media/imagenes/${item.imagen
      }"" alt="" class="img_product" width="150px" style="object-fit: cover; height: 215px;">
                <div class="uk-position-top-right uk-transition-fade uk-position-small">
                    <a href="#modal-details-product" uk-toggle class="btnDetails" data-id="${item.id
      }">
                      
                        <span class="Bg-info" uk-icon="icon: info; ratio: 1.5"></span>
                    </a>
                </div>
                <div class="uk-position-bottom-right btns_option_product2">
                    <ul class=" uk-iconnav uk-background-secondary uk-transition-slide-bottom-small" style="width: 105%; padding: 5px;">
                        <li><a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button deleteID2" uk-icon="icon: future" data-id="${item.id
      }"></a></li>
                    </ul>
                </div>
                <div>
                    <div style="padding: 0px 10px; width: 130px;">
                        <div class="uk-text-truncate">${item.nombre}</div>
                        <div>stock: <b class="uk-text-success">${item.stock ? item.stock : 0
      }</b></div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
          `;

    //seleccionamos el contenedor de las tarjetas, y las insertamos
    $(cont).html(tarjeta);

    //esto es para acomodar la posicion de los botones dependiendo de la resolucion
    if (screen < 938) {
      let options = document.querySelectorAll(".btns_option_product2");
      options.forEach((e) => {
        e.classList.remove("uk-position-bottom-center");
        e.classList.add("uk-position-bottom-right");
      });
    }

    //preguntamamos si la sesion es la de usuario, para eliminar los botones de accion
    if (session_user_rol == "Usuario") {
      let options = document.querySelectorAll(".btns_option_product2");
      options.forEach((e) => {
        e.removeChild(e.firstElementChild);
      });
    }
  });

  if (json.lista.length == 0) {
    document
      .querySelector(".container_marca_agua2")
      .classList.remove("invisible");
    document.querySelector(".uk-pagination2").classList.add("invisible");
    $(".cont_product_desactive").html("");
  } else {
    document.querySelector(".container_marca_agua2").classList.add("invisible");
    document.querySelector(".uk-pagination2").classList.remove("invisible");
  }

  // modalEntradas();
  modalEliminarProductDesactive();
  modalModificar();
};
const cargarTargetProduct = () => {
  //hacemos la petion ajax
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: {
      randomnautica: "productos",
      n: page, // Aca va el numero de la pagina actual
      limite: 10, // Aca va el numero maximo de tarjetas que se pueden imprimir
      like: "",
    },
    success: function (response) {
      marcaAgua();
      tarjetas(response, ".container-target-product");
      modalDetalles(1);
    },
  });
};

cargarTargetProduct()
const cargarTargetProductDesactive = () => {
  //hacemos la petion ajax
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: {
      randomnautica: "productos",
      n: page, // Aca va el numero de la pagina actual
      limite: 10, // Aca va el numero maximo de tarjetas que se pueden imprimir
      like: "",
      active: 0,
    },
    success: function (response) {
      if (
        document.querySelector(".height_controller2").childElementCount == 0
      ) {
        // document.querySelector(".container_marca_agua2").classList.remove('invisible')
        document.querySelector(".uk-pagination2").classList.add("invisible");
      } else {
        document
          .querySelector(".container_marca_agua2")
          .classList.add("invisible");
        document.querySelector(".uk-pagination2").classList.remove("invisible");
      }
      tarjetasProductosDesactive(response, ".cont_product_desactive");
      modalDetalles(0);
    },
  });
};
// cargarTargetProductDesactive();
//***************************************************  Modal de Registro de productos  ******************************************************

const cargarCategoriaRegProduct = () => {
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "categorias" },
    success: function (response) {
      let options = ``;
      let json = JSON.parse(response);
      json.lista.forEach((date) => {
        options += `<option value="${date.id}">${date.nombre}</option>`;
      });
      document.getElementById("selectCat").innerHTML = options;
      // document
      //   .getElementById("selectCat")
      //   .insertAdjacentHTML(
      //     "afterbegin",
      //     `<option value="" disabled selected>Categoria</option>`
      //   );
    },
  });
};
const cargarUnidadesRegProduct = () => {
  //   //ejecutamos esta peticion para traer las unidades de los productos a los select
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "unidades" },
    success: function (response) {
      let options = ``;
      let json = JSON.parse(response);
      json.lista.forEach((date) => {
        options += `<option value="${date.id}">${date.nombre}</option>`;
      });
      document.getElementById("selectUni").innerHTML = options;
      document
        .getElementById("selectUni")
        .insertAdjacentHTML(
          "afterbegin",
          `<option value="" disabled selected>Unidad</option>`
        );
    },
  });
};
const cargarMarcasRegProduct = () => {
  //   //ejecutamos esta peticion para traer las unidades de los productos a los select
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "marcas" },
    success: function (response) {
      let options = ``;
      let json = JSON.parse(response);
      json.lista.forEach((date) => {
        options += `<option value="${date.id}">${date.nombre}</option>`;
      });
      document.getElementById("selectMar").innerHTML = options;
      document
        .getElementById("selectMar")
        .insertAdjacentHTML(
          "afterbegin",
          `<option value="" disabled selected>Marca</option>`
        );
    },
  });
};

document.querySelector(".btn-modal-register").addEventListener("click", () => {
  val = false;
  $("#formAggProduct").trigger("reset");
  document.querySelector(".title_modal_reg_upd").textContent =
    "REGISTRAR PRODUCTO";
  cargarCategoriaRegProduct();
  cargarUnidadesRegProduct();
  cargarMarcasRegProduct();
});
let formAggProduct = document.getElementById("formAggProduct");
//captamos su evento submit, primero para evitar que la pagina se refresque, y segundo para insertar esos datos en un objeto FormData
formAggProduct.addEventListener("submit", (e) => {
  e.preventDefault();
  let url;
  if (val == false) {
    url = "Controller/funcs/agregar_cosas.php";
  } else {
    url = "Controller/funcs/modificar_cosas.php";
  }
  //aqui instanciamos el objeto formData y como parametro, le pasamos el formulario
  //el formData es un objeto que actua con encapsulamiento de datos de los form
  let formDataProduct = new FormData(formAggProduct)
  // formDataProduct.set("precio_venta",document.querySelector(".PVUpdateProduct").value)
  //hacemos la peticion ajax
  $.ajax({
    url: url,
    type: "POST",
    data: formDataProduct,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      if (val == false) {
        UIkit.notification.closeAll();
        UIkit.notification({
          message:
            "<span uk-icon='icon: check'></span> Producto creado correctamente ",
          status: "success",
          pos: "bottom-right",
        });
      } else {
        UIkit.notification.closeAll();
        UIkit.notification({
          message:
            "<span uk-icon='icon: check'></span> Producto Modificado correctamente ",
          status: "success",
          pos: "bottom-right",
        });
      }
      // y ocultamos el modal
      setTimeout(() => {
        UIkit.modal("#modal-register-product").hide();
      }, 400);
      //en la respuesta le mostramos un mensaje de producto creado correctamente

      cargarTargetProduct();
    },
  });
});

//esta consulta sirve para cargar los datos de las categorias en el filtro
$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "GET",
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
  type: "GET",
  data: { randomnautica: "marcas" },
  success: function (response) {
    let options = ``;
    let json = JSON.parse(response);
    json.lista.forEach((E) => {
      options += `<li  uk-filter-control="filter: [data-marca='${E.nombre}']; group: marca"><a class='filterS' href="#">${E.nombre}</a></li>`;
    });
    document.querySelector(".filter_marca").innerHTML += options;
  },
});
//esta funcion tiene el objetivo de mostrar los productos por nombre
document
  .querySelector(".searchProductActive")
  .addEventListener("keyup", (e) => {
    let val = e.target.value;
    if (val != "") {
      $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "productos", like: val },
        success: function (response) {
          tarjetas(response, ".container-target-product");
        },
      });
    } else {
      cargarTargetProduct();
    }
  });

document
  .querySelector(".searchProductNotActive")
  .addEventListener("keyup", (e) => {
    let val = e.target.value;
    if (val != "") {
      $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "productos", like: val, active: 0 },
        success: function (response) {
          tarjetasProductosDesactive(response, ".cont_product_desactive");
        },
      });
    } else {
      cargarTargetProductDesactive();
    }
  });

let inpNameProduct = document.querySelector(".NameUpdateProduct");
inpNameProduct.addEventListener("keyup", (e) => {
  let val = e.target.value.toLowerCase();
  if (val != "") {
    $.ajax({
      url: "Controller/funcs_ajax/search.php",
      type: "GET",
      data: { randomnautica: "productos", like: val },
      success: function (response) {
        let json = JSON.parse(response);
        json.lista.forEach((e) => {
          let nombre = e.nombre.toLowerCase();
          if (nombre == val) {
            inpNameProduct.setAttribute(
              "uk-tooltip",
              "title:El producto ya existe, use otro nombre; pos: left"
            );
            UIkit.tooltip(".NameUpdateProduct").show();
          } else {
            inpNameProduct.removeAttribute("uk-tooltip");
            if (document.querySelector(".uk-tooltip")) {
              document
                .querySelector(".controller-modal")
                .removeChild(document.querySelector(".uk-tooltip"));
            }
          }
        });
        if (json.lista.length == 0) {
          UIkit.tooltip(".NameUpdateProduct").hide();
          inpNameProduct.removeAttribute("uk-tooltip");
          if (document.querySelector(".uk-tooltip")) {
            document
              .querySelector(".controller-modal")
              .removeChild(document.querySelector(".uk-tooltip"));
          }
        }
      },
    });
  } else {
    inpNameProduct.removeAttribute("uk-tooltip");
    if (document.querySelector(".uk-tooltip")) {
      document
        .querySelector(".controller-modal")
        .removeChild(document.querySelector(".uk-tooltip"));
    }
  }
});

// estas funciones son para las marcas, unidades y categorias
const Registrar_U_M_C = (form, tr, item_reset, notification) => {
  // seleccionamos el formulario
  let Form_identificador = document.getElementById(form);
  // captamos su evento submit
  Form_identificador.addEventListener("submit", (e) => {
    e.preventDefault();
    // guardamos los datos del formulario en un formData
    let Form_Send = new FormData(Form_identificador);
    // enviamos los datos la backend con una peticion ajax
    $.ajax({
      url: "Controller/funcs/agregar_cosas.php",
      type: "POST",
      data: Form_Send,
      processData: false,
      contentType: false,
      success: function (response) {
        let result = tr();
        document.querySelector(item_reset).value = "";
        UIkit.notification.closeAll();
        UIkit.notification({
          message: `<span uk-icon='icon: check'>${notification}</span>`,
          status: "success",
          pos: "bottom-right",
        });
      },
    });
  });
};
const Edit_U_M_C = (tr) => {
  // seleccionamos todos los btn de editar de las tablas
  let btnAction = document.querySelectorAll(".Edit-U_M_C");
  // los recorremos
  btnAction.forEach((b) => {
    // y obtenemos el btn que pulso el usuario por su evento click
    b.addEventListener("click", () => {
      // obtenemos el id del registro
      let id =
        b.parentElement.parentElement.previousElementSibling
          .previousElementSibling.textContent;
      // obtenemos el tipo, ya sea marcas, categoria o unidades
      let tipo = b.getAttribute("tipo");
      // obtenemos el titulo del modal para renombrarlo segun el tipo
      let modal_title = document.querySelector(".modal_title_rename");
      modal_title.textContent = "EDITAR " + tipo.toUpperCase();

      // aca obtenemos el input donde esta el valor que usuario coloco
      let nombre_item =
        b.parentElement.parentElement.previousElementSibling.textContent;
      // y le asignamos el valor que el usuario previamente guardo
      document.querySelector(".name_U-C-M_edit").value = nombre_item;
      // obtenemos el input que mandara el id del registro y se lo asignamos como value
      let id_2 = document.getElementById("id_delete_edit-U-M-C");
      id_2.setAttribute("value", id);

      let type_edit = document.getElementById("Edit_type");
      type_edit.setAttribute("value", tipo);
      let msj = "";
      if (tipo == "unidad") {
        msj = "Unidad Modificada correctamente";
      } else if (tipo == "categoria") {
        msj = "Categoria Modificada correctamente";
      } else {
        msj = "Marca Modificada correctamente";
      }
      let formEdit = document.getElementById("form_edit-U-C-M");

      formEdit.addEventListener("submit", (e) => {
        e.preventDefault();
        let formDataEdit = new FormData(formEdit);

        $.ajax({
          url: "Controller/funcs/modificar_cosas.php",
          type: "POST",
          data: formDataEdit,
          processData: false,
          contentType: false,
          success: function (response) {
            let result = tr();
            UIkit.notification.closeAll();
            UIkit.notification({
              message: `<span uk-icon='icon: check'>${msj}</span>`,
              status: "success",
              pos: "bottom-right",
            });
            setTimeout(() => {
              UIkit.modal("#edit-U_M_C").hide();
            }, 400);
          },
        });

        id_2.removeAttribute("value");
        type_edit.removeAttribute("value");
      });
    });
  });
};
const DELETE_U_M_C = (TR, BTN) => {
  //seleccionamos todos los btn de eliminar de el modulo correspondiente
  let btnDeletes = document.querySelectorAll(BTN);
  btnDeletes.forEach((b) => {
    b.addEventListener("click", () => {

      //obtenemos el tipo del registro ya sea unidad, marca o categoria
      let tipo = b.getAttribute("tipo");
      let msj = "";
      //obtenemos el id del registro
      let id = parseInt(b.parentElement.parentElement.previousElementSibling.previousElementSibling.textContent)
      //seleccionamos los inputs del formulario de eliminar, tanto el que tendra el id del registro y el tipo de modelo
      let idInput = document.getElementById('IDDeleteM-U-C')
      let TypeInput = document.getElementById('IDTypeDeleteM-U-C')
      //le asignamos los values
      idInput.setAttribute('value', id)
      TypeInput.setAttribute('value', tipo)

      //usamos el form para captar su evento submit
      let FORM_DELETE = document.querySelector("#FORM-DELETE_U-M-C");
      FORM_DELETE.addEventListener("submit", (e) => {
        e.preventDefault()
        let data = new FormData(FORM_DELETE)

        $.ajax({
          url: "Controller/funcs/borrar_cosas.php",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log(response);
            if (tipo == "unidad") {
              msj = "Unidad Eliminada correctamente";
            } else if (tipo == "categoria") {
              msj = "Categoria Eliminada correctamente";
            } else {
              msj = "Marca Eliminada correctamente";
            }
            let result = TR();
            UIkit.notification.closeAll();
            UIkit.notification({
              message: `<span uk-icon='icon: check'>${msj}</span>`,
              status: "success",
              pos: "bottom-right",
            });
            setTimeout(() => {
              UIkit.modal("#eliminar-U_M_C").hide();
            }, 400);
          },
        });
        idInput.removeAttribute('value')
        TypeInput.removeAttribute('value')
      });
    });
  });
};