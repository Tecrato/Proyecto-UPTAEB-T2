let hola = "";
const cargarEntrys = () => {
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "entradas" },
    success: function (response) {
      let template;
      let json = JSON.parse(response);
      json.lista.forEach((f) => {
        let fechaVencimiento = new Date(f.fecha_vencimiento);
        let fechaActual = new Date();
        fechaVencimiento.setMinutes(
          fechaVencimiento.getMinutes() + fechaVencimiento.getTimezoneOffset()
        );
        let diferencia = fechaVencimiento.getTime() - fechaActual.getTime();
        let diasRestantes = Math.ceil(diferencia / (1000 * 60 * 60 * 24));
        let color;
        let texto;
        console.log(diasRestantes)
        if (f.existencia == 0) {
          color = "activeEmpty";
          texto = "NO DISPONIBLE";
        } else if (diasRestantes <= 10 && diasRestantes >= 1) {
          color = "activeCloseToExpire";
          texto = "POR VENCER";
        } else if (diasRestantes > 10) {
          color = "activeGood";
          texto = "ACTIVO";
        } else if (diasRestantes <= 0) {
          color = "activeExpire";
          texto = "EXPIRO";
        }

        template +=     `<tr data-proveedor="${f.proveedor}" data-productEntry="${f.producto}">
                              <td><img src="./static/images/btn_lote2.png" alt="" width="40"></td>
                              <td>${f.id}</td>
                              <td>${f.producto}</td>
                              <td>${f.fecha_vencimiento}</td>
                              <td>${f.precio_compra} Bs</td>
                              <td>
                                  <div class="${color} uk-border-rounded uk-text-center uk-text-bold" style="padding: 5px; width: 115px;">${texto}</div>
                              </td>
                          </tr>`;
      });
      $(".cont_entry").append(template);
      let table_entry = document.querySelector(".cont_entry").childElementCount;
      if (table_entry <= 0 || table_entry < 4) {
        document.querySelector(".altura_table_entry").style.height = "300px";
      } else {
        document.querySelector(".altura_table_entry").style.height = "100%";
      }
    },
  });
};
cargarEntrys()

$.ajax({
  url: "Controller/funcs_ajax/search.php",
  type: "GET",
  data: { randomnautica: "proveedores" },
  success: function (response) {
    let json = JSON.parse(response);
    json.lista.forEach((p) => {
      hola += `      
        <li uk-filter-control="[data-proveedor='${p.razon_social}']"><a href="#" class="prov-entry-products" idSup="${p.id}">${p.razon_social}</a></li>    
      `;
    });
    $(".filter_prov_entry").html(hola);

    let listItem = document.querySelectorAll(".prov-entry-products");
    listItem.forEach((e) => {
      e.addEventListener("click", () => {
        let idSup = e.getAttribute("idSup");
        let template = "";
        $.ajax({
          url: "Controller/funcs_ajax/search.php",
          type: "GET",
          data: { randomnautica: "entradas", id_proveedor: idSup },
          success: function (response) {
            let json = JSON.parse(response);
            json.lista.forEach((l) => {
              template += `<li uk-filter-control="[data-productEntry='${l.producto}']"><a href="#">${l.producto}</a></li>`;
            });

            $(".filter_prov_entry_product").html(template);
          },
        });
      });
    });
  },
});