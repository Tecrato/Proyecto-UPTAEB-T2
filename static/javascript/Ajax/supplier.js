
//funciones para modicar, insertar y eliminar clientes, proveedores

function insertANDupdateCLient_proveedor (FORM, NUMBER, TABLE, TYPE) {

  let inp = document.querySelector(NUMBER);
  let iti = window.intlTelInput(inp, {
    utilsScript: "Plugins/build/js/utils.js",
  });
  iti.setCountry("VE");

  let form = document.querySelector(FORM);
  let url = ""

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    if (insertOrUpdate == false) {
      url = "Controller/funcs/agregar_cosas.php"
    } else {
      url = "Controller/funcs/modificar_cosas.php"
    }

    let countryData = iti.getSelectedCountryData();
    let fullNumber = iti.getNumber();
    let data = new FormData(form);
    data.append("TLFNO", fullNumber);
    $.ajax({
      url: url,
      type: "POST",
      processData: false,
      contentType: false,
      data: data,
      success: (response) => {
        console.log(response);
        let result = TABLE();
        if (insertOrUpdate == false) {
          UIkit.notification.closeAll();
          UIkit.notification({
            message: `<span uk-icon='icon: check'>${TYPE} Registrado correctamente</span>`,
            status: "success",
            pos: "bottom-right",
          });
        } else {
          UIkit.notification.closeAll();
          UIkit.notification({
            message: `<span uk-icon='icon: check'>${TYPE} Modificado correctamente</span>`,
            status: "success",
            pos: "bottom-right",
          });
        }

        setTimeout(() => {
          UIkit.modal("#register_supplier").hide();
        }, 400);

        setTimeout(() => {
          UIkit.modal("#agregar_client").hide();
        }, 400);

      },
    });
  });
}

function DeleteClientProv (BTN, FORM, IDSETTER, TR, notification){
  let btnDelete = document.querySelectorAll(BTN);
  btnDelete.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      let id = btn.getAttribute("id");
      document.querySelector(IDSETTER).setAttribute('value', id)
      let form = document.querySelector(FORM);
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(form); 
        $.ajax({
          url: "Controller/funcs/borrar_cosas.php",
          type: "POST",
          processData: false,
          contentType: false,
          data: data,
          success: (response) => {
            let tr = TR()
            UIkit.notification.closeAll();
            UIkit.notification({
              message: `<span uk-icon='icon: check'>${notification} Eliminado correctamente</span>`,
              status: "success",
              pos: "bottom-right",
            });
            setTimeout(() => {
              UIkit.modal("#eliminar_supplier").hide();
            },400)

            setTimeout(() => {
              UIkit.modal("#eliminar_cliente").hide();
            },400)
          }
        })
      })

    })
  })
}

document.querySelector("#title").textContent = "Gestión de Proveedores";
let insertOrUpdate = false;


document.querySelector(".btn-aggSupplier").addEventListener("click", () => {
  insertOrUpdate = false
  document.querySelector(".ValueInpUpdateProv").removeAttribute("value");
  $(".form_prov").trigger("reset");
  document.querySelector(".modal_title_proveedor").textContent = "REGISTRAR PROVEEDOR"
})
const ModalEdit = () => {
  let btn = document.querySelectorAll(".edit_prov")
  btn.forEach((b) => {
    b.addEventListener("click", () => {
      insertOrUpdate = true;
      let id = b.getAttribute("id")
      document.querySelector(".ValueInpUpdateProv").setAttribute("value", id);

      $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "proveedores", active: 1, ID: id },
        success: function (response) {
          let json = JSON.parse(response);
          json.lista.forEach((element) => {
            if (document.querySelector(".T-DProvUpdate").children[0].value == element.rif.slice(0, 1)) {
              document.querySelector(".T-DProvUpdate").children[0].setAttribute('selected', "")
              setTimeout(() => {
                document.querySelector(".T-DProvUpdate").children[0].removeAttribute('selected')
              }, 1000)

            } else if (document.querySelector(".T-DProvUpdate").children[1].value == element.rif.slice(0, 1)) {
              document.querySelector(".T-DProvUpdate").children[1].setAttribute('selected', "")

              setTimeout(() => {
                document.querySelector(".T-DProvUpdate").children[1].removeAttribute('selected')
              }, 1000)

            } else if (document.querySelector(".T-DProvUpdate").children[2].value == element.rif.slice(0, 1)) {
              document.querySelector(".T-DProvUpdate").children[2].setAttribute('selected', "")

              setTimeout(() => {
                document.querySelector(".T-DProvUpdate").children[2].removeAttribute('selected')
              }, 1000)
            }
            document.querySelector(".nameProvUpdate").value = element.nombre
            document.querySelector(".Razon_SocialProvUpdate").value = element.razon_social
            document.querySelector(".Nro_DocumentoProvUpdate").value = element.rif.slice(2, Infinity)
            document.querySelector(".tlfnProvUpdate").value = "0" + element.telefono.slice(3, Infinity)
            document.querySelector(".emailProvUpdate").value = element.correo
            document.querySelector(".directionProvUpdate").value = element.direccion
          });
          document.querySelector(".modal_title_proveedor").textContent = "MODIFICAR PROVEEDOR"
          UIkit.modal("#register_supplier").show();
        }

      })

    })
  })
}

const cardProv = () => {
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "proveedores", active: 0 },
    success: function (response) {
      let template = "";
      let json = JSON.parse(response);
      json.lista.forEach((element) => {
        template += `<div>
                          <div class="target_supplier uk-card uk-card-default uk-flex uk-padding-small uk-light uk-border-rounded" style=" background-color: #333;">
                              <div>
                                  <div class="img_proveedor_container uk-border-rounded">
                                      <img src="static/images/logo_proveedor.png" alt="" width="80px" />
                                      <h5 class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-text-center">${element.razon_social}</h5>
                                  </div>
                              </div>
                      
                              <div style="width: 180px;">
                                  <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
                                      <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center">DATOS</h4>
                                      <div>
                                          <a href="#modal-modificar" id="${element.id}" uk-tooltip="title:Editar; delay: 500"
                                              class="uk-icon-button uk-margin-small-right edit_prov" type="button"
                                              style="border: none; cursor: pointer">
                                              <span uk-icon="icon: file-edit"></span>
                                          </a>
                                          <a href="#eliminar_supplier" uk-toggle id="${element.id}" class="uk-icon-button uk-margin-small-right delete_prov"
                                              uk-tooltip="title:Eliminar; delay: 500" type="button"
                                              style="border: none; cursor: pointer" type="button">
                                              <span uk-icon="icon: trash"></span>
                                          </a>
                                      </div>
                                  </div>
                      
                                  <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />
                      
                                  <div class="Container-details-suppliers" style="width: 200px;">
                                      <div class="uk-flex">
                                          <h6 class="uk-margin-small">Nombre</h6>
                                          <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${element.nombre}
                                          </p>
                                      </div>
                                      <div class="uk-flex">
                                          <h6 class="uk-margin-small">RIF</h6>
                                          <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${element.rif}
                                          </p>
                                      </div>
                                      <div class="uk-flex">
                                          <h6 class="uk-margin-small">Direccion</h6>
                                          <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-break uk-text-meta"
                                              style="width: 185px">
                                              ${element.direccion}
                                          </p>
                                      </div>
                                      <div class="uk-flex">
                                          <h6 class="uk-margin-small">Telefono</h6>
                                          <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${element.telefono}
                                          </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>`;
      });

      $(".cont_prov_cards").html(template)


      let j = document.querySelectorAll(".edit_prov")
      j.forEach((g) => {
        g.classList.add("invisible")
      })

      let n = document.querySelectorAll(".delete_prov")
      n.forEach((g) => {
        g.classList.add("invisible")
      })


      $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "permiso", ID: session_user_id },
        success: function (response) {
          let json = JSON.parse(response);

          json.lista.forEach((r) => {

            if (r.permiso == "modificar" && r.tabla == "proveedores") {
              j.forEach((g) => {
                g.classList.remove("invisible")
              })
            } else if (r.permiso == "eliminar" && r.tabla == "proveedores") {
              n.forEach((g) => {
                g.classList.remove("invisible")
              })
            } else if (r.permiso == "agregar" && r.tabla == "proveedores") {
              document.querySelector(".btn-aggSupplier").classList.remove("invisible")
            }
          })
        }
      })
      marcaAgua()
      ModalEdit()
      DeleteClientProv(".delete_prov", "#formDelete_supplier", "#IdDelete_supplier", cardProv, "Proveedoredor eliminado correctamente")
      colorDefault()
    },
  });
}

document.querySelector(".preloader_container").remove()
cardProv()
insertANDupdateCLient_proveedor('.form_prov', "#tlfn_pais", cardProv, "proveedor")

