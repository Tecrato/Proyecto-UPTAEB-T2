let hola = "";

$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "POST",
  data: { randomnautica: "proveedores" },
  success: function (response) {
    let json = JSON.parse(response);
    json.lista.forEach((p) => {
      hola += `   
            
                                <li class="list_item list_item_click">
                                    <div class="list_botton list_botton_click" idSup="${p.id}">
                                        <div class="nav_link uk-text-uppercase uk-text-bold">${p.razon_social}</div>
                                        <img class="list_arrow" src="./static/images/bx-chevron-right.svg" alt="">
                                    </div>
                                    <ul class="list_show">
                                        
                                    </ul>
                                </li>`;
    });
    $(".list").html(hola);

    let listItem = document.querySelectorAll(".list_botton_click");
    listItem.forEach((e) => {
      e.addEventListener("click", () => {
        let idSup = e.getAttribute("idSup");
        let template = "";
        $.ajax({
          url: "Controller/funcs_ajax/search.php",
          type: "POST",
          data: { randomnautica: "entradas", id_proveedor: idSup },
          success: function (response) {
            let json = JSON.parse(response);
            json.lista.forEach((l) => {
              template += `<li class="list_inside">
                                <div class="uk-flex uk-flex-middle" style="gap: 10px;">
                                    <img class="img3ProductSwitcher" src="./static/images/cajas (2).png" width="30" alt="">
                                    <div class="nav_link nav_link_inside uk-text-uppercase uk-text-bold">Harina${l.id}</div>
                                </div> 
                            </li>`;
            });
            e.nextElementSibling.innerHTML = template;
            e.classList.toggle("arrow");
            let height = 0;
            let menu = e.nextElementSibling;
            if (menu.clientHeight == "0") {
              height = menu.scrollHeight;
            }
            menu.style.height = `${height}px`;
          },
        });
      });
    });
  },
});
