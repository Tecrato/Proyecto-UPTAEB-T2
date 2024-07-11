var page = 0;
var dolar = 37


window.addEventListener("load", () => {
  // document.querySelector(".preloader_container").classList.toggle("invisible")
  document.querySelector(".preloader_container").remove()
})

function cambiar_pagina_ajax(dir, type, func, limit = 9, pagina=null) {
  limit = limit ? limit : 9
  if (pagina == null) {
    pagina = page
  }
  $.ajax({
    url:
      `Controller/funcs_ajax/cambiar_pagina.php?dir=` + dir + "&p=" + page + "&type=" + type + "&n_p=" + limit,
    type: "GET",
    success: (response) => {
      page = parseInt(response);
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

// if (screen < 768) {
//   let main = document.querySelector(".Bg-Main-home2");
//   let hammer = new Hammer(main);
//   hammer.on("swipeleft swiperight", (e) => {
//     let tipo = e.type;
//     if (tipo === "swiperight") {
//       UIkit.offcanvas("#offcanvas-nav").show();
//     }
//   });
//   // let btnImpr = (document.querySelector(".ImprBtn").href = "fd");
// }

async function asyncfunc() {
  $.ajax({
    url: "https://exchangemonitor.net/ajax/widget-unique",
    data: { "country": "ve", "type": "bcv" },
    success: function(response) {
      document.getElementById('BCV').textContent = JSON.parse(response).price
    }
  })
}
asyncfunc()


$.ajax({
  url: "api_caja",
  type: "POST",
  data: { accion: "check" },
  success: function (response) {
      let json = JSON.parse(response);
      if (json.estado == "no") {
          document.getElementById("check_box").textContent = "CERRADA";
      } else {
          document.getElementById("check_box").textContent = "ABIERTA";
      }
  }
})

function hora(f) {
  const fecha = new Date(f);
  const horas = fecha.getHours();
  const minutos = fecha.getMinutes();
  const periodo = horas >= 12 ? "PM" : "AM";
  const horas12 = horas % 12 || 12;
  const horaFormateada = `${horas12}:${minutos < 10 ? `0${minutos}` : minutos} ${periodo}`;
  return horaFormateada
}
function fecha(f) {
  const fecha = new Date(f);
  const dia = fecha.getDate();
  const mes = fecha.getMonth() + 1;
  const anio = fecha.getFullYear();
  const fechaFormateada = `${dia}/${mes}/${anio}`;
  return fechaFormateada
}