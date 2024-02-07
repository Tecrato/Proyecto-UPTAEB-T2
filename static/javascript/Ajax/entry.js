let hola = "";
$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "POST",
  data: { randomnautica: "entradas" },
  success: function (response) {
    let template;
    let json = JSON.parse(response);
    json.lista.forEach((f) => {
      let fechaVencimiento = new Date(f.fecha_vencimiento);
      let fechaActual = new Date();
      fechaVencimiento.setMinutes(fechaVencimiento.getMinutes() + fechaVencimiento.getTimezoneOffset());
      let diferencia = fechaVencimiento.getTime() - fechaActual.getTime();
      let diasRestantes = Math.ceil(diferencia / (1000 * 60 * 60 * 24));
      let color
      let texto
      if (f.existencia == 0) {
        color = "activeEmpty"
        texto = "NO DISPONIBLE"
      } else if (diasRestantes < 10) {
        color = "activeCloseToExpire"
        texto = "POR VENCER"
      } else if (diasRestantes > 10) {
        color = "activeGood"
        texto = "ACTIVO"
      } else if (diasRestantes <= 0) {
        color = "EXPIRO"
      }

      template = `<div>
                      <div class="uk-card uk-card-default uk-flex uk-padding-small uk-background-secondary uk-light uk-border-rounded">
                          <div style="width: 125px;">
                              <div class="img_proveedor_container uk-border-rounded">
                                  <img src="static/images/btn_lote2.png" alt="" width="90px" />
                                  <h5 class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-margin-small-bottom uk-text-center uk-text-bold">
                                      ENTRADA NRO ${f.id}
                                  </h5>
                              </div>
                          </div>

                          <div style="width: 180px;">
                              <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
                                  <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center uk-text-truncate">
                                      ${f.producto}
                                  </h4>
                                  <div>
                                     
                                  </div>
                              </div>

                              <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />

                              <div class="Container-details-suppliers" style="width: 200px;">
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">CANTIDAD</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.cantidad}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">EXISTENCIA</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.existencia}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">EXP</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.fecha_vencimiento}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">PRECIO COMPRA</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.precio_compra}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <div class="uk-margin-small-right">
                                          <h6>ESTADO</h6>
                                      </div>
                                      <div>
                                          <h6 class="${color} uk-margin-remove uk-text-center uk-border-rounded uk-text-bold state-entrys" style="width: 120px; padding: 2px 0px;">${texto}</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>`;
      $(".cont_entry").append(template);
    });
  },
});

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
                                <div class="uk-flex uk-flex-middle" style="gap: 10px;" idProducto="${l.id_producto}" idProveedor="${l.id_proveedor}">
                                    <img class="img3ProductSwitcher" src="./static/images/cajas (2).png" width="30" alt="">
                                    <div class="nav_link nav_link_inside uk-text-uppercase uk-text-bold  btnPP">${l.producto}</div>
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

            let option = document.querySelectorAll(".btnPP");
            option.forEach((r) => {
              r.addEventListener("click", () => {
                let idProducto = r.parentElement.getAttribute("idProducto");
                let idProveedor = r.parentElement.getAttribute("idProveedor");
                let template = "";
                $.ajax({
                  url: "Controller/funcs_ajax/search.php",
                  type: "POST",
                  data: {
                    randomnautica: "entradas",
                    id_proveedor: idProveedor,
                    id_producto: idProducto,
                  },
                  success: function (response) {
                    let json = JSON.parse(response);
                    json.lista.forEach((f) => {
                      template += `<div>
                      <div class="uk-card uk-card-default uk-flex uk-padding-small uk-background-secondary uk-light uk-border-rounded">
                          <div style="width: 125px;">
                              <div class="img_proveedor_container uk-border-rounded">
                                  <img src="static/images/btn_lote2.png" alt="" width="90px" />
                                  <h5 class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-margin-small-bottom uk-text-center uk-text-bold">
                                      ENTRADA NRO ${f.id}
                                  </h5>
                              </div>
                          </div>

                          <div style="width: 180px;">
                              <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
                                  <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center uk-text-truncate">
                                      ${f.producto}
                                  </h4>
                                  <div>
                                      <a href="#eliminar_supplier" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button uk-margin-small-right" uk-tooltip="title:Eliminar; delay: 500" type="button" style="border: none; cursor: pointer" type="button">
                                          <span uk-icon="icon: trash"></span>
                                      </a>
                                  </div>
                              </div>

                              <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />

                              <div class="Container-details-suppliers" style="width: 200px;">
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">CANTIDAD</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.cantidad}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">EXISTENCIA</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.existencia}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">EXP</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.fecha_vencimiento}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <h6 class="uk-margin-small">PRECIO COMPRA</h6>
                                      <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                          ${f.precio_compra}
                                      </p>
                                  </div>
                                  <div class="uk-flex">
                                      <div class="uk-margin-small-right">
                                          <h6>ESTADO</h6>
                                      </div>
                                      <div>
                                          <h6 class="uk-background-primary uk-margin-remove uk-text-center uk-border-rounded uk-text-bold state-entrys" style="width: 120px; padding: 2px 0px;">ACTIVO</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>`;
                    });
                    $(".cont_entry").html(template);
                  },
                });
              });
            });
          },
        });
      });
    });
  },
});
