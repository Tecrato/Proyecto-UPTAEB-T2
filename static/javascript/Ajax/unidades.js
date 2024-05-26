// esta funcion se encargara de cargar las filas de las tablas de unidades
const UnidadesTable = () => {
  $.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "unidades" },
    success: function (response) {
      let template = "";
      let json = JSON.parse(response);
      json.lista.forEach((U) => {
        template += `
              <tr>
                  <td><img src="./static/images/logo_m.png" alt="" width="50"></td>
                  <td>${U.id}</td>
                  <td>${U.nombre}</td>
                  <td>
                      <div class="uk-flex">
                          <a href="#edit-U_M_C" uk-toggle uk-tooltip="title:Editar; delay: 500" class="uk-icon-button uk-margin-small-right Edit-U_M_C" type="button" style="border: none; cursor: pointer" tipo="unidad">
                              <span uk-icon="icon: file-edit"></span>
                          </a>
                          <a href="#eliminar-U_M_C" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button uk-margin-small-right delete-U_M_C" uk-tooltip="title:Eliminar; delay: 500" type="button" style="border: none; cursor: pointer" type="button" tipo="unidad">
                              <span uk-icon="icon: trash"></span>
                          </a>
                      </div>
                  </td>
              </tr>
      `;
      });
      $("#TemplateUnidad").html(template);

      Edit_U_M_C(UnidadesTable)
      DELETE_U_M_C(UnidadesTable)

    },
  });
};
UnidadesTable();

Registrar_U_M_C("FORM_UNIDAD",UnidadesTable,".nombre_unidad","Unidad Creada correctamente");