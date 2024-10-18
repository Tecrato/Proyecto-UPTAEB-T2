window.addEventListener("load", () => {
  // document.querySelector(".preloader_container").classList.toggle("invisible")
  document.querySelector(".preloader_container").remove()
})

function cambiar_pagina_ajax(dir, func, limite = 9, page = 0, total = 0) {
  limite = limite
  if (dir == 'next' && page < Math.ceil(total / limite) - 1) {
    page += 1;
  } else if (dir == 'back' && page > 0) {
    page -= 1;
  } else if (dir == 'start') {
    page = 0;
  } else if (dir == 'end') {
    page = Math.ceil(total / limite) - 1;
  }
  console.log(dir, page, total, limite)
  func(page)
}

function cambiar_pagina_php(dir, type, limit = 9) {
  limit = limit
  window.location.href = 'Controller/funcs/cambiar_pagina.php?dir=' + dir + '&p=' + page + '&type=' + type + '&n_p=' + limit
}
// funcion para colocar la marca de agua en el fondo de los modulos
function marcaAgua() {
  //esto hace que el fondo de pantalla y altura se modifiquen si hay tarjetas en los modulos
  let containerMarca_agua = document.querySelector(".container_marca_agua");
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
try {
  marcaAgua()
} catch (error) {
  null
}


function DOLAR_RV(func) {
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "configuraciones", llave: "dolar" },
    success: function (response) {
      json = JSON.parse(response)
      func(parseFloat(json.lista[0].valor))
    }
  })
}


function DOLAR_DB(id) {
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "configuraciones", llave: "dolar" },
    success: function (response) {
      json = JSON.parse(response)
      document.getElementById(id).textContent = json.lista[0].valor + " Bs"
    }
  })
}
DOLAR_DB("BCV")


function PermisosG(btnEdit, btnDelete, tabla, btnAgg, T) {
  if (T == "G") {
    let j = document.querySelectorAll(btnEdit)
    j.forEach((g) => {
      g.classList.add("invisible")
    })
    let n = document.querySelectorAll(btnDelete)
    n.forEach((g) => {
      g.classList.add("invisible")
    })
  }



  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "permiso", ID: session_user_id },
    success: function (response) {
      let json = JSON.parse(response);

      json.lista.forEach((r) => {
        if (T == "G") {
          if (r.permiso == "modificar" && r.tabla == tabla) {
            j.forEach((g) => {
              g.classList.remove("invisible")
            })
          } else if (r.permiso == "eliminar" && r.tabla == tabla) {
            n.forEach((g) => {
              g.classList.remove("invisible")
            })
          } else if (r.permiso == "agregar" && r.tabla == tabla) {
            document.querySelector(btnAgg).classList.remove("invisible")
          } else if (r.permiso == "imprimir" && r.tabla == tabla) {
            document.querySelector(btnAgg).classList.remove("invisible")
          }
        } else if (T == "R") {
          if (r.permiso == "agregar" && r.tabla == tabla) {
            $(btnAgg).removeClass("invisible")
          } else if (r.permiso == "modificar" && r.tabla == tabla) {
            $(btnAgg).removeClass("invisible")
          }
        }
      })
    }
  })
}