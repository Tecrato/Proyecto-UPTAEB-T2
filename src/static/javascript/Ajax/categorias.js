const CategoriasTable = () => {
    $.ajax({
    url: "api_search",
    type: "GET",
    data: { randomnautica: "categorias" },
    success: function (response) {
      let template = "";
      let json = JSON.parse(response);
      json.lista.forEach((C) => {
        template += `
              <tr>
                  <td><img src="./static/images/logo_m.png" alt="" width="50"></td>
                  <td>${C.id}</td>
                  <td>${C.nombre}</td>
                  <td>
                      <div class="uk-flex">
                          <a href="#edit-U_M_C" uk-toggle uk-tooltip="title:Editar; delay: 500" class="uk-icon-button uk-margin-small-right Edit-U_M_C" type="button" style="border: none; cursor: pointer" tipo="categoria">
                              <span uk-icon="icon: file-edit"></span>
                          </a>
                          <a href="#eliminar-U_M_C" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button uk-margin-small-right delete-C" uk-tooltip="title:Eliminar; delay: 500" type="button" style="border: none; cursor: pointer" type="button" tipo="categoria">
                              <span uk-icon="icon: trash"></span>
                          </a>
                      </div>
                  </td>
              </tr>
      `;
      });
      $("#TemplateCategoria").html(template);
      Edit_U_M_C(CategoriasTable)
      DELETE_U_M_C(CategoriasTable,".delete-C")

      if (session_user_rol_num == "1") {
        $(".li_cont_c").removeClass("invisible")
        return
      } else {
        PermisosG(".Edit-U_M_C", ".delete-C", "categorias", ".li_cont_c", "G")
      }

    },
  });
}

CategoriasTable()
Registrar_U_M_C("FORM_CATEGORIA",CategoriasTable,".categoria_name","Categoria Creada correctamente");
