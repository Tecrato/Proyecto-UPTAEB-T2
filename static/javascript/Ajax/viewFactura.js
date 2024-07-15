//se hace una consulta ajax para traer los datos de la factura
$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "GET",
  data: { randomnautica: "ventas" , limite:20},
  success: function (response) {
    let json = JSON.parse(response);
    console.log(json);
    let ContainerTarget = document.querySelector(".Contanier_fact_item");
    let template = "";
    json.lista.forEach((t) => {

      let fecha2 = new Date(t.fecha)
      let dia = fecha2.getDate()
      let mes = fecha2.getMonth() + 1
      let year = fecha2.getFullYear()

      template += ` <article id=${t.id}>
                      <div class="uk-flex uk-flex-between uk-flex-middle uk-background-secondary Target_factura" id=${t.id}>
                          <div class="uk-flex uk-flex-middle uk-margin-medium-right">
                              <div class="uk-margin-small-right">
                                  <img src="static/images/logo_m.png" alt="" width="50px">
                              </div>
                              <div class="uk-flex uk-flex-column uk-flex-center">
                                  <h6 class="uk-margin-remove text_fact_info">Cliente: ${t.cliente_nombre +' '+ t.cliente_apellido}</h6>
                                  <h6 class="uk-margin-remove text_fact_info">N_FACT: ${t.id}</h6>
                                  <h6 class="uk-margin-remove text_fact_info status_fact">Pagada</h6>
                              </div>
                          </div>
                          <div>
                              <div>  
                                  <h4 class="uk-margin-remove uk-text-right uk-text-bold">BS  ${t.monto_final}</h4>
                                  <p class="uk-margin-remove uk-text-meta text_fact_date">${dia+"/"+mes+"/"+year}</p>
                              </div>
                          </div>
                      </div>
                    </article> `;
    });
    //se inserta las tarjetas de las facturas
    ContainerTarget.innerHTML = template;
    

    //cuando pulsemos sobre las fichas de la factura, obtenemos el id para luego enviarlo al controlador y buscar la factura segun el id
    let tarjetaFactura = document.querySelectorAll(".Target_factura");
    tarjetaFactura.forEach((tj) => {
      tj.addEventListener("click", () => {
        tj.tabIndex = tj.getAttribute("id");

        //cada vez que pulsemos sobre una ficha, el iframe se recarga con la misma ruta, solo que se le ira cambiando el id de la factura
        let iframe = document.querySelector(".iframe");
        iframe.src = `PDFFactura?id=${tj.getAttribute("id")}`;

        let id = tj.getAttribute("id");
        document.querySelector(".n_factura").textContent = "N_FACTURA " + id;
        //hacemos la peticion,mandando el id al controlador como una variable por url
        $.ajax({
          url: `PDFFactura?id=${id}`,
          type: "GET",
          success: function (response) {
            let json = JSON.parse(response);
            (response);
          },
        });
      });
    });
  },
});
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