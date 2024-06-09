var page = 0;
var dolar = 37

function cambiar_pagina_ajax(dir,type,func,limit=9) {
  limit = limit ? limit : 9
  $.ajax({
    url:
      `Controller/funcs_ajax/cambiar_pagina.php?dir=` + dir + "&p=" +  page + "&type=" + type + "&n_p=" + limit,
    type: "GET",
    success: (response) => {
      page = parseInt(response);
      console.log(response)
      func();
    },
  });
}

function cambiar_pagina_php(dir,type,limit=9) {
  limit = limit ? limit : 9
  window.location.href = 'Controller/funcs/cambiar_pagina.php?dir='+dir + '&p='+page + '&type='+type + '&n_p='+limit
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

// funcion para cambiar el color de las vistas
// const btnModeColorView = document.querySelector(".btn-ModeColorView");
// const btnModeColorView2 = document.querySelector(".btn-ModeColorView2");
// const ColorViewLight = () => {
//   document.querySelectorAll(".uk-background-secondary").forEach((element) => {
//     element.classList.remove("uk-background-secondary");
//     element.classList.add("uk-background-default");
//     document.querySelectorAll(".uk-light").forEach((element2) => {
//       element2.classList.remove("uk-light");
//       element2.classList.add("uk-dark");
//       document.querySelector(".Bg-Main-home").style.backgroundColor = "#f7f7f7";
//       if (
//         document.querySelector(".img1ProductSwitcher") ||
//         document.querySelector(".img2ProductSwitcher")
//       ) {
//         document.querySelector(".img1ProductSwitcher").src =
//           "./static/images/cajas (2) newColor.png";
//         document.querySelector(".img2ProductSwitcher").src =
//           "./static/images/suministrosNewColor.png";
//       }
//       document.querySelectorAll(".img_proveedor_container").forEach((el) => {
//         el.style.backgroundColor = "#fff";
//       });
//       document.querySelectorAll(".img3ProductSwitcher").forEach((img) => {
//         img.src = "./static/images/cajas (2) newColor.png";
//       });
//       if (document.querySelector(".target-detail-fact") || document.querySelector(".cont1_tar_fact")) {
//         document.querySelector(".target-detail-fact").style.backgroundColor = "#fff"
//         document.querySelector(".cont1_tar_fact").style.backgroundColor = "#fff"
//       }
      
//       document.querySelector(".marca_agua").src = "./static/images/logo_letras-minimarket_color2.png"
      
//       if ( document.querySelector(".item_profile-target") || document.querySelector(".item_profile-target-2")) {
//         // document.querySelector(".item_profile-target").style.backgroundColor = "#fff"; 
//         // document.querySelector(".item_profile-target-2").style.backgroundColor = "#fff";  
//       }

//       document.querySelector(".formSearchHeader").classList.add("uk-light");
//       document.querySelector(".iconNotification").classList.add("uk-light");
//     });
//   });

//   let iconMoon2 = ` <img class="iconMoon" src="static/images/moon-solid.svg" alt="" width="18px"> `;
//   btnModeColorView.innerHTML = iconMoon2;
//   btnModeColorView2.innerHTML = iconMoon2;
// };
// ColorViewLight();
// const ColorViewDark = () => {
//   document.querySelectorAll(".uk-background-default").forEach((element) => {
//     element.classList.add("uk-background-secondary");
//     element.classList.remove("uk-background-default");
//     document.querySelectorAll(".uk-dark").forEach((element2) => {
//       element2.classList.add("uk-light");
//       element2.classList.remove("uk-dark");
//       document.querySelector(".Bg-Main-home").style.backgroundColor = "#111";
//       if (
//         document.querySelector(".img1ProductSwitcher") ||
//         document.querySelector(".img2ProductSwitcher")
//       ) {
//         document.querySelector(".img1ProductSwitcher").src =
//           "./static/images/cajas (2).png";
//         document.querySelector(".img2ProductSwitcher").src =
//           "./static/images/suministros.png";
//       }
//       document.querySelectorAll(".img_proveedor_container").forEach((el) => {
//         el.style.backgroundColor = "rgb(62, 62, 62)";
//       });
//       document.querySelectorAll(".img3ProductSwitcher").forEach((img) => {
//         img.src = "./static/images/cajas (2).png";
//       });

//       if (document.querySelector(".target-detail-fact") || document.querySelector(".cont1_tar_fact")) {
//         document.querySelector(".target-detail-fact").style.backgroundColor = "#333"
//         document.querySelector(".cont1_tar_fact").style.backgroundColor = "#333"
//       }

//       document.querySelector(".marca_agua").src = "./static/images/logo_letras-minimarket.png"
//       // if (document.querySelector(".item_profile-target") || document.querySelector(".item_profile-target-2")){
//       //   // document.querySelector(".item_profile-target").style.backgroundColor = "rgb(62, 62, 62)";
//       //   // document.querySelector(".item_profile-target-2").style.backgroundColor = "rgb(62, 62, 62)";
//       // }
//     });
//   });
//   let iconSun = `<img class="iconSun" src="static/images/sun-solid.svg" alt="" width="23px">`;
//   btnModeColorView.innerHTML = iconSun;
//   btnModeColorView2.innerHTML = iconSun;
// };

// btnModeColorView.addEventListener("click", () => {
//   let light = btnModeColorView.classList.toggle("light");
//   localStorage.setItem("btnSwitch", light);

//   let valor = localStorage.getItem("btnSwitch");
//   if (valor == "false") {
//     ColorViewLight();
//   } else {
//     ColorViewDark();
//   }
// });
// btnModeColorView2.addEventListener("click", () => {
//   console.log('pul');
//   let light = btnModeColorView2.classList.toggle("light");
//   localStorage.setItem("btnSwitch", light);

//   let valor = localStorage.getItem("btnSwitch");
//   if (valor == "false") {
//     ColorViewLight();
//   } else {
//     ColorViewDark();
//   }
// });

// let valor = localStorage.getItem("btnSwitch");
//   if (valor == "false") {
//     ColorViewLight();
//   } else { 
//     ColorViewDark();
//   }


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

async function asyncfunc(){
  $.ajax({
    url:"https://exchangemonitor.net/ajax/widget-unique",
    data: {"country":"ve","type":"enparalelovzla"},
    success: response => {
        document.getElementById('PARALELO').textContent = JSON.parse(response).price
    }
  })
  $.ajax({
    url:"https://exchangemonitor.net/ajax/widget-unique",
    data: {"country":"ve","type":"bcv"},
    success: response => {
        document.getElementById('BCV').textContent = JSON.parse(response).price
    }
  })
}

// $.ajax({
//   url: "Controller/funcs_ajax/search.php",
//   type: "GET",
//   data: { randomnautica: "entradas" },
//   success: function (response) {
//     let json = JSON.parse(response);
//       json.lista.forEach((f) => {
//         let fechaVencimiento = new Date(f.fecha_vencimiento);
//         let fechaActual = new Date();
//         fechaVencimiento.setMinutes(fechaVencimiento.getMinutes() + fechaVencimiento.getTimezoneOffset());
//         let diferencia = fechaVencimiento.getTime() - fechaActual.getTime();
//         let diasRestantes = Math.ceil(diferencia / (1000 * 60 * 60 * 24));
//         let color;
//         let texto;
//         if (f.existencia == 0) {
//           color = "activeEmpty";
//           texto = "NO DISPONIBLE";
//         } else if (diasRestantes <= 10 && diasRestantes >= 1) {
//           color = "activeCloseToExpire";
//           texto = "POR VENCER";
//         } else if (diasRestantes > 10) {
//           color = "activeGood";
//           texto = "ACTIVO";
//         } else if (diasRestantes <= 0) {
//           color = "activeExpire";
//           texto = "EXPIRO";
//         }
//       })
//   }

// })

asyncfunc()