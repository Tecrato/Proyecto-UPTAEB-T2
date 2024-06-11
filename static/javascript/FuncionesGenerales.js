var page = 0;
var dolar = 37

function cambiar_pagina_ajax(dir, type, func, limit = 9) {
  limit = limit ? limit : 9
  $.ajax({
    url:
      `Controller/funcs_ajax/cambiar_pagina.php?dir=` + dir + "&p=" + page + "&type=" + type + "&n_p=" + limit,
    type: "GET",
    success: (response) => {
      page = parseInt(response);
      console.log(response)
      func();
    },
  });
}

function cambiar_pagina_php(dir, type, limit = 9) {
  limit = limit ? limit : 9
  window.location.href = 'Controller/funcs/cambiar_pagina.php?dir=' + dir + '&p=' + page + '&type=' + type + '&n_p=' + limit
}
// funcion para colocar la marca de agua en el fondo de los modulos
const marcaAgua = () => {
  //esto hace que el fondo de pantalla y altura se modifiquen si hay tarjetas en los modulos
  let containerMarca_agua = document.querySelector(".container_marca_agua");
  let containerMarca_agua2 = document.querySelector(".container_marca_agua2");
  let containerBody = document.querySelector(".Bg-Main-home");
  let containerHeight = document.querySelector(".height_controller").childElementCount;

  let pagination = document.querySelector(".uk-pagination");

  if (document.querySelector(".height_controller2") && document.querySelector(".uk-pagination2")) {
    let pagination2 = document.querySelector(".uk-pagination2");
    let containerHeight2 = document.querySelector(".height_controller2").childElementCount;
    if (containerHeight == 0 || containerHeight2 == 0) {
      // containerMarca_agua.parentElement.classList.add('uk-flex-center')
      // containerBody.style.height = `115vh`;
      containerMarca_agua.classList.remove('invisible')
      pagination.classList.add("invisible");
      // pagination2.classList.add("invisible");
    } else {
      // containerMarca_agua.parentElement.classList.remove('uk-flex-center')
      pagination.classList.remove("invisible");
      pagination2.classList.remove("invisible");
      containerMarca_agua.classList.add("invisible");
    }
  } else {
    if (containerHeight == 0) {
      // containerMarca_agua.parentElement.classList.add('uk-flex-center')
      // containerBody.style.height = `115vh`;
      containerMarca_agua.classList.remove('invisible')
      pagination.classList.add("invisible");
      // pagination2.classList.add("invisible");
    } else {
      // containerMarca_agua.parentElement.classList.remove('uk-flex-center')
      pagination.classList.remove("invisible");
      // pagination2.classList.remove("invisible");
      containerMarca_agua.classList.add("invisible");
    }
  }

};
marcaAgua()


//funcion para asignar clase de boton activo dependiendo de la pantall en donde este
$(function () {
  let pantalla = window.location.pathname;
  let link = $(".Link");
  link.each(function () {
    let enlace = $(this).attr("href");

    if (enlace === pantalla) {
      $(this).addClass("uk-active");
    }
  });
});

//funcion de gestos para moviles
const screen = window.screen.availWidth;
let modal = "";

if (screen < 768) {
  let main = document.querySelector(".Bg-Main-home2");
  let hammer = new Hammer(main);
  hammer.on("swipeleft swiperight", (e) => {
    let tipo = e.type;
    if (tipo === "swiperight") {
      UIkit.offcanvas("#offcanvas-nav").show();
    }
  });
  // let btnImpr = (document.querySelector(".ImprBtn").href = "fd");
}

async function asyncfunc() {
  $.ajax({
    url: "https://exchangemonitor.net/ajax/widget-unique",
    data: { "country": "ve", "type": "enparalelovzla" },
    success: response => {
      document.getElementById('PARALELO').textContent = JSON.parse(response).price
    }
  })
  $.ajax({
    url: "https://exchangemonitor.net/ajax/widget-unique",
    data: { "country": "ve", "type": "bcv" },
    success: response => {
      document.getElementById('BCV').textContent = JSON.parse(response).price
    }
  })
}
asyncfunc()

//funciones para modicar, insertar y eliminar clientes, proveedores

const insertANDupdateCLient_proveedor = (FORM, NUMBER, TABLE, TYPE) => {

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

const DeleteClientProv = (BTN, FORM, IDSETTER, TR, notification) => {
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