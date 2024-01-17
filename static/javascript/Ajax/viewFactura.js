//se hace una consulta ajax para traer los datos de la factura
$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "POST",
  data: { randomnautica: "ventas" },
  success: function (response) {
    let json = JSON.parse(response);
    let ContainerTarget = document.querySelector(".Contanier_fact_item");
    let template = "";
    json.lista.forEach((t) => {
      template += ` <article id=${t.id}>
                      <div class="uk-flex uk-flex-between uk-flex-middle uk-background-secondary Target_factura" id=${t.id}>
                          <div class="uk-flex uk-flex-middle uk-margin-medium-right">
                              <div class="uk-margin-small-right">
                                  <img src="static/images/logo_m.png" alt="" width="50px">
                              </div>
                              <div class="uk-flex uk-flex-column uk-flex-center">
                                  <h6 class="uk-margin-remove text_fact_info">${t.cliente}</h6>
                                  <h6 class="uk-margin-remove text_fact_info">N_FACT: ${t.id}</h6>
                                  <h6 class="uk-margin-remove text_fact_info status_fact">Pagada</h6>
                              </div>
                          </div>
                          <div>
                              <div>  
                                  <h4 class="uk-margin-remove uk-text-right uk-text-bold">BS  ${t.monto_final}</h4>
                                  <p class="uk-margin-remove uk-text-meta text_fact_date">${t.fecha}</p>
                              </div>
                          </div>
                      </div>
                    </article> `;
    });
    //se inserta las tarjetas de las facturas
    ContainerTarget.innerHTML = template;
    let date = document.querySelectorAll(".text_fact_date");
    date.forEach((d) => {
      //con esto se resetea la fecha
      d.textContent = d.textContent.slice(0, 10);
    });

    //cuando pulsemos sobre las fichas de la factura, obtenemos el id para luego enviarlo al controlador y buscar la factura segun el id
    let tarjetaFactura = document.querySelectorAll(".Target_factura");
    tarjetaFactura.forEach((tj) => {
      tj.addEventListener("click", () => {
        tj.tabIndex = tj.getAttribute("id");

        //cada vez que pulsemos sobre una ficha, el iframe se recarga con la misma ruta, solo que se le ira cambiando el id de la factura
        let iframe = document.querySelector(".iframe");
        iframe.src = `FacturaPDF?d=${tj.getAttribute("id")}`;

        let id = tj.getAttribute("id");
        document.querySelector(".n_factura").textContent = "N_FACTURA " + id;
        //hacemos la peticion,mandando el id al controlador como una variable por url
        $.ajax({
          url: `Controller/funcs_ajax/print_factura.php?d=${id}`,
          type: "GET",
          success: function (response) {
            let json = JSON.parse(response);
            console.log(response);
          },
        });
      });
    });
  },
});
