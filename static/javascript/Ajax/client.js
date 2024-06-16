document.querySelector("#title").textContent = "Gestión de Clientes";
let insertOrUpdate = false;

document.querySelector(".btn-agg_client").addEventListener("click", () => {
    insertOrUpdate = false
    document.querySelector(".ValueInpUpdateClient").removeAttribute("value");
    $(".form_client").trigger("reset");
    document.querySelector(".modal_title_client").textContent = "REGISTRAR CLIENTE"
})
const ModalEdit = () => {
    let btn = document.querySelectorAll(".edit_client")
    btn.forEach((b) => {
        b.addEventListener("click", () => {
            insertOrUpdate = true;
            let id = b.getAttribute("id")
            document.querySelector(".ValueInpUpdateClient").setAttribute("value", id);
            $.ajax({
                url: "Controller/funcs_ajax/search.php",
                type: "GET",
                data: { randomnautica: "clientes", ID: id },
                success: function (response) {
                    let json = JSON.parse(response);
                    json.lista.forEach((element) => {
                        if (document.querySelector(".inputT_DUpdateClient").children[0].value == element.documentO) {
                            document.querySelector(".inputT_DUpdateClient").children[0].setAttribute('selected', "")
                            setTimeout(() => {
                                document.querySelector(".inputT_DUpdateClient").children[0].removeAttribute('selected')
                            }, 1000)

                        } else if (document.querySelector(".inputT_DUpdateClient").children[1].value == element.documentO) {
                            document.querySelector(".inputT_DUpdateClient").children[1].setAttribute('selected', "")

                            setTimeout(() => {
                                document.querySelector(".inputT_DUpdateClient").children[1].removeAttribute('selected')
                            }, 1000)

                        } else if (document.querySelector(".inputT_DUpdateClient").children[2].value == element.documentO) {
                            document.querySelector(".inputT_DUpdateClient").children[2].setAttribute('selected', "")

                            setTimeout(() => {
                                document.querySelector(".inputT_DUpdateClient").children[2].removeAttribute('selected')
                            }, 1000)
                        }
                        document.querySelector(".inputNameUpdateClient").value = element.nombre
                        document.querySelector(".inputLastNameUpdateClient").value = element.apellido
                        document.querySelector(".inputNroDcUpdateClient").value = element.cedula
                        document.querySelector(".inputTLFNOUpdateClient").value = element.telefono.slice(3, Infinity)
                        document.querySelector(".inputDirUpdateClient").value = element.direccion
                    });
                    document.querySelector(".modal_title_client").textContent = "MODIFICAR CLIENTE"
                    UIkit.modal("#agregar_client").show();
                }

            })

        })
    })
}

const cardClient = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "clientes" },
        success: function (response) {
            let template = "";
            let json = JSON.parse(response);
            json.lista.forEach((element) => {
                template += `   <div>
                                    <div class="target_supplier uk-card uk-card-default uk-flex uk-padding-small uk-background-secondary uk-light uk-border-rounded"
                                        style="width: 370px; background-color: #333;">
                                        <div>
                                            <div class="img_proveedor_container uk-border-rounded">
                                                <img src="static/images/undraw_profile_2.svg" alt="" width="120px" />
                                                <h5
                                                    class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-margin-small-bottom uk-text-center">
                                                    ${element.nombre}
                                                </h5>
                                            </div>
                                        </div>
                                
                                        <div>
                                            <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
                                                <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center">
                                                    DATOS
                                                </h4>
                                                <div>
                                                    <a href="#modificar_cliente" id="${element.id}" uk-tooltip="title:Editar; delay: 500"
                                                        class="uk-icon-button uk-margin-small-right edit_client" type="button"
                                                        style="border: none; cursor: pointer">
                                                        <span uk-icon="icon: file-edit"></span>
                                                    </a>
                                                    <a href="#eliminar_cliente" uk-toggle id="${element.id}" uk-tooltip="title:Eliminar; delay: 500"
                                                        class="uk-icon-button uk-margin-small-right delete_client" uk-tooltip="title:Eliminar; delay: 500"
                                                        type="button" style="border: none; cursor: pointer" type="button">
                                                        <span uk-icon="icon: trash"></span>
                                                    </a>
                                                </div>
                                            </div>
                                
                                            <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />
                                
                                            <div class="Container-details-suppliers" style="width: 200px;">
                                                <div class="uk-flex">
                                                    <h6 class="uk-margin-small">Documento</h6>
                                                    <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                                    ${element.documento + "-" + element.cedula}
                                                    </p>
                                                </div>
                                                <div class="uk-flex">
                                                    <h6 class="uk-margin-small">Telefono</h6>
                                                    <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                                    ${element.telefono}
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <h6 class="uk-margin-small-right uk-margin-remove-bottom" style="float: left;">Direccion
                                                    </h6>
                                                    <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-margin-remove-left uk-text-meta"
                                                        style="width: 185px; line-height: 23px;">
                                                        ${element.direccion}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
            });
            $(".cont_client_cards").html(template)
            marcaAgua()
            ModalEdit()
            DeleteClientProv(".delete_client", "#formDeleteClient", "#IdDelete_client", cardClient, "Eliminado")
        },
    });
}

cardClient()
insertANDupdateCLient_proveedor('.form_client', "#tlfno_client", cardClient, "cliente")