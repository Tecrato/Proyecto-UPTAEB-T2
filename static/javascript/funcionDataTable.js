document.addEventListener("DOMContentLoaded", () => {
  let lista = document.getElementById("list");
  let data1 = document.querySelector(".dataTable");
  let data2 = document.querySelector(".dataTable2");

  const cargarTrProduct = ()=>{
        $.ajax({
                url: "Controller/funcs_ajax/search.php",
                type: "POST",
                data: {
                  randomnautica: "tarjeta_productos",
                  n: page,  // Aca va el numero de la pagina actual
                  limite: 9, // Aca va el numero maximo de tarjetas que se pueden imprimir
                },
                success: function (response) {
                  let json = JSON.parse(response);
                  let json2 = json.lista;
        
                  $(document).ready(function () {
                    $("#tabla").DataTable({
                      data: json2,
                      columns: [
                        { data: "id" },
                        {
                          data: "imagen",
                          render: function (data, type, row) {
                            return `<img class="uk-preserve-width uk-border-circle" src="Media/imagenes/${data}" " style="height: 50px; width: 50px; object-fit: cover;">`;
                          },
                        },
        
                        { data: "nombre" },
                        { data: "id" },
                        { data: "id" },
                        { data: "id" },
                        {
                          data: "id",
                          render: function (data, type, row) {
                            return `<div class="uk-flex uk-flex-middle">
                                <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                        class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                        class="uk-icon-button" uk-icon="icon: trash"></span></a>
                            </div>`;
                          },
                        },
                      ],
                      responsive: true,
                    });
                  });
                },
              });
      }

  const view = () => {
    if (localStorage.getItem("view") == "false") {
      data1.removeChild(data2);
      lista.setAttribute("uk-icon", "icon: thumbnails; ratio: 1.3");

      let template = `
                      <table id="tabla" class="uk-table uk-table-divider uk-table-striped">
                          <thead>
                              <th>id</th>
                              <th>Img</th>
                              <th>Nombre</th>
                              <th>Categoria</th>
                              <th>Existencia</th>
                              <th>Precio Unit</th>
                              <th>Acciones</th>
                          </thead>
                          <tbody class="js-filter" id="tbodyDataTable">
                              
                          </tbody>
                      </table>
                      `;

      data1.innerHTML = template;
     


      cargarTrProduct()
      data1.removeAttribute("uk-grid");
      data1.classList.remove("uk-grid-small");
      data1.classList.remove("uk-grid");
      //       data1.classList.remove("uk-grid-stack");
      document.querySelector(".formDelete").style.display = "none";
      document.querySelector(".flechas").style.display = "none";
    } else {
      lista.style.transition = "5s all ease";
      lista.setAttribute("uk-icon", "icon: list; ratio: 1.3");
      data1.appendChild(data2);
      if (document.getElementById("tabla_wrapper")) {
        data1.removeChild(document.getElementById("tabla_wrapper"));
      }
      document.querySelector(".formDelete").style.display = "block";
      document.querySelector(".flechas").style.display = "block";
    }
  };

  view();

  lista.addEventListener("click", () => {
    let val = lista.classList.toggle("list");
    localStorage.setItem("view", val);

    view();
  });

});
