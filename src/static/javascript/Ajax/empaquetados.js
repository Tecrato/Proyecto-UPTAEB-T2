let like_empaquetado = ""
const EmpaquetadosTable = () => {
    $.ajax({
        url: "api_search",
        type: "POST",
        data: { randomnautica: "empaquetado", like: like_empaquetado },
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
                            <a href="#edit-U_M_C" uk-toggle uk-tooltip="title:Editar; delay: 500" class="uk-icon-button uk-margin-small-right Edit-U_M_C" type="button" style="border: none; cursor: pointer" tipo="empaquetado">
                                <span uk-icon="icon: file-edit"></span>
                            </a>
                            <a href="#eliminar-U_M_C" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button uk-margin-small-right delete-E" uk-tooltip="title:Eliminar; delay: 500" type="button" style="border: none; cursor: pointer" type="button" tipo="empaquetado">
                                <span uk-icon="icon: trash"></span>
                            </a>
                        </div>
                    </td>
                </tr>
        `;
            });
            $("#TemplateEmpaquetado").html(template);

            Edit_U_M_C(EmpaquetadosTable)
            DELETE_U_M_C(EmpaquetadosTable, ".delete-E")
            if (session_user_rol_num == "1") {
                $(".li_cont_e").removeClass("invisible")
                return
            } else {
                PermisosG(".Edit-U_M_C", ".delete-E", "tipo_empaquetado", ".li_cont_e", "G")
            }

        },
    });
};

EmpaquetadosTable();
let search_input_empaque = document.querySelector(".search_empaquetado")
search_input_empaque.addEventListener("keyup", (e) => {
    like_empaquetado = e.target.value
    EmpaquetadosTable()
})
Registrar_U_M_C("FORM_EMPAQUETADO", EmpaquetadosTable, ".empaquetado_name", "Empaque Creado correctamente");