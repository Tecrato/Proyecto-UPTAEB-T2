// Esta funcion cambia la pagina
function cambiar_pagina_php(dir) {
  window.location.href = `Controller/funcs/cambiar_pagina.php?dir=` + dir + "&p="+num_page+"&type="+ type_page;
}


//funcion para colocar la marca de agua en el fondo de los modulos
$(function () {
    //esto hace que el fondo de pantalla y altura se modifiquen si hay tarjetas en los modulos
    let containerMarca_agua = document.querySelector(".container_marca_agua");
    let containerBody = document.querySelector(".Bg-Main-home");
    let containerHeight =
      document.querySelector(".height_controller").childElementCount;
    let pagination = document.querySelector(".uk-pagination");
  
    if (containerHeight == 0) {
      containerBody.style.height = `110vh`;
      containerMarca_agua.classList.remove("invisible");
      pagination.classList.add("invisible");
    } else {
      pagination.classList.remove("invisible");
    }
  });

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
  let btnImpr = (document.querySelector(".ImprBtn").href = "fd");
}


