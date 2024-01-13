$.ajax({
  url: "Controller/funcs_ajax/search_factura.php",
  type: "POST",
  data: { TYPE: "TRG_FACT" },
  success: function (response) {
    let json = JSON.parse(response)
    let ContainerTarget = document.querySelector(".Contanier_fact_item")
    let template = ""
    json.lista.forEach((t) =>{
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
                                  <p class="uk-margin-remove uk-text-meta text_fact_date">${(t.fecha)}</p>
                              </div>
                          </div>
                      </div>
                    </article> `
    })
    ContainerTarget.innerHTML = template
    let date = document.querySelectorAll(".text_fact_date");
    date.forEach((d) =>{
      d.textContent = d.textContent.slice(0,10)
    })
    

    let tarjetaFactura = document.querySelectorAll(".Target_factura");
    tarjetaFactura.forEach((tj) => {
      tj.addEventListener("click", () => {
        tj.tabIndex = tj.getAttribute("id");
    
        let iframe = document.querySelector(".iframe");
        iframe.src = `./View/FacturaPDF.php?c="${tj.getAttribute("id")}"`;

        // let id = tj.getAttribute('id')
        // $.ajax({
        //   url: "Controller/funcs_ajax/search_factura.php",
        //   type: "POST",
        //   data: { TYPE: "DETAIL-USER-FACT", ID: id },
        //   success: function (response) {
        //     let json = JSON.parse(response)
        //     console.log(json);
        //     $.ajax({
        //       url: "View/FacturaPDF.php",
        //       type: "POST",
        //       data: json,
        //       success: function (response) {
        //         console.log(response);
        //       }
        //     })

        //   }
        // })

      });
    });
  },
});
