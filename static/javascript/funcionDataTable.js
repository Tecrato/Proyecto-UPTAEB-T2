document.addEventListener("DOMContentLoaded", () => {
  let lista = document.getElementById("list");
  let data1 = document.querySelector(".dataTable");
  let data2 = document.querySelector(".dataTable2");

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
                          <tbody class="js-filter">
                              <tr data-color="white">
                                  <td>1</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                          <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>
                                  </td>
                              </tr>
                              <tr data-color="blue">
                                  <td>1</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>ALEJO</td>
                                  <td>VARGAS</td>
                                  <td>21.145.268</td>
                                  <td>MI CASA</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                              <tr data-color="blue">
                                  <td>2</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                              <tr data-color="white">
                                  <td>3</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                              <tr data-color="white">
                                  <td>3</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                              <tr data-color="blue">
                                  <td>3</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                              <tr data-color="white">
                                  <td>3</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                              <tr data-color="white">
                                  <td>3</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                              <tr data-color="blue">
                                  <td>3</td>
                                  <td><img class="uk-preserve-width uk-border-circle" src="./Image/logo_m.png" width="40" height="40" alt=""></td>
                                  <td>Luis</td>
                                  <td>Garnica</td>
                                  <td>30.087.582</td>
                                  <td>alguna direccion</td>
                                  <td>
                                      <div class="uk-flex uk-flex-middle">
                                              <a href="#Producto-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"><span
                                                      class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                                              <a href="#eliminar_product" uk-toggle uk-tooltip="title:Eliminar; delay: 500"><span
                                                      class="uk-icon-button" uk-icon="icon: trash"></span></a>
                                          </div>                
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                      `;

      data1.innerHTML = template;

      data1.removeAttribute("uk-grid");
      data1.classList.remove("uk-grid-small");
      data1.classList.remove("uk-grid");
      //       data1.classList.remove("uk-grid-stack");
      document.querySelector(".formDelete").style.display = "none";
      document.querySelector(".flechas").style.display = "none";

      $(document).ready(function () {
        $("#tabla").DataTable({
          responsive: true,
        });
      });
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

//   document.querySelectorAll('.uk-background-secondary').forEach(element => {
//       element.classList.remove('uk-background-secondary')
//       element.classList.add('uk-background-default')
//       document.querySelectorAll('.uk-light').forEach(element2 => {
//           element2.classList.remove('uk-light')
//           element2.classList.add('uk-dark')
//           document.querySelector('.Bg-Main-home').style.backgroundColor = '#f7f7f7'
//       });
//   });
});
