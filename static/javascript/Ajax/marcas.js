const MarcasTable = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "marcas" },
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
                            <a href="#edit-U_M_C" uk-toggle uk-tooltip="title:Editar; delay: 500" class="uk-icon-button uk-margin-small-right Edit-U_M_C" type="button" style="border: none; cursor: pointer" tipo="marca">
                                <span uk-icon="icon: file-edit"></span>
                            </a>
                            <a href="#eliminar-U_M_C" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button uk-margin-small-right delete-M" uk-tooltip="title:Eliminar; delay: 500" type="button" style="border: none; cursor: pointer" type="button" tipo="marca">
                                <span uk-icon="icon: trash"></span>
                            </a>
                        </div>
                    </td>
                </tr>
        `;
            });
            $("#TemplateMarca").html(template);

            Edit_U_M_C(MarcasTable)
            DELETE_U_M_C(MarcasTable, ".delete-M")
            if (session_user_rol_num == "1") {
                $(".li_cont_m").removeClass("invisible")
                return
            } else {
                PermisosG(".Edit-U_M_C", ".delete-M", "marcas", ".li_cont_m", "G")
            }

        },
    });
};
MarcasTable();
Registrar_U_M_C("FORM_MARCA", MarcasTable, ".marca_name", "Marca Creada correctamente");