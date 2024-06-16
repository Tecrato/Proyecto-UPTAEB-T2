let bool = false

document.querySelector(".btnAggMetodo").addEventListener("click", () => {
    bool = false
    document.querySelector("#inputIdMetodo").removeAttribute("value");
    $("#FORM_METODO_PAGO").trigger("reset");
    document.querySelector(".titleModalmetodos").textContent = "REGISTRAR METODO DE PAGO"
})

const cargarMetodosPago = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "metodo_pago"},
        success: function (response) {
            let json = JSON.parse(response);
            let template = "";
            if (json.lista.length == 0) {
                template = `
                <tr>
                    <td></td>
                    <td></td>
                    <td class="uk-text-center">
                        <img class="uk-margin-top" style="opacity: 0.3;" src="./static/images/logo_letras-minimarket.png" alt="">
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                `
            } else {
                json.lista.forEach((p) => {
                    template += `
                <tr>
                    <td><img src="./static/images/logo_letras-minimarket.png" alt="" width="50"></td>
                    <td>${p.id}</td>
                    <td>${p.nombre}</td>
                    <td>
                        <div>
                            <a class="uk-icon-button uk-margin-small-right btnUpdateMetodo" id="${p.id}" uk-icon="pencil"></a>
                            <a href="#eliminar_metodo" uk-toggle class="uk-icon-button btnDeleteMetodo" id="${p.id}" uk-icon="trash"></a>
                        </div>
                    </td>
                </tr>
                `;
                });
            }

            $("#Metodo-Pago-Table").html(template);


            let btnUpdateMetodo = document.querySelectorAll(".btnUpdateMetodo");
            btnUpdateMetodo.forEach((btn) => {
                btn.addEventListener("click", () => {
                    bool = true
                    let input = document.querySelector(".inputUpdateMetodo")
                    input.value = btn.parentElement.parentElement.previousElementSibling.textContent
                    let id = btn.getAttribute("id");
                    let idSet = document.querySelector("#inputIdMetodo")
                    idSet.setAttribute("value", id)
                    document.querySelector(".titleModalmetodos").textContent = "MODIFICAR METODO DE PAGO"
                    UIkit.modal("#modal-metodo_pago").show();
                })
            })


            let btnDeleteMetodo = document.querySelectorAll(".btnDeleteMetodo");
            btnDeleteMetodo.forEach((btn) => {
                btn.addEventListener("click", () => {
                    let id = btn.getAttribute("id");
                    let idSet = document.querySelector("#IdDelete_Metodo")
                    idSet.setAttribute("value", id)

                    let form = document.querySelector("#formDeleteMetodo")
                    form.addEventListener("submit", (e) => {
                        e.preventDefault();
                        let data = new FormData(form);
                        $.ajax({
                            url: "Controller/funcs/borrar_cosas.php",
                            type: "POST",
                            processData: false,
                            contentType: false,
                            data: data,
                            success: (response) => {
                                console.log(response);
                                UIkit.notification.closeAll();
                                UIkit.notification({
                                    message: `<span uk-icon='icon: check'>Metodo Eliminado</span>`,
                                    status: "success",
                                    pos: "bottom-right",
                                });
                                cargarMetodosPago();
                                UIkit.modal("#eliminar_metodo").hide();
                            },
                        });
                    })
                })
            })
        },
    });
}

let formMetodoPago = document.getElementById("FORM_METODO_PAGO");
let UrlSite = ""
formMetodoPago.addEventListener("submit", (e) => {
    if (bool == false) {
        UrlSite = "Controller/funcs/agregar_cosas.php"
    } else {
        UrlSite = "Controller/funcs/modificar_cosas.php"
    }
    e.preventDefault();
    let data = new FormData(formMetodoPago);
    $.ajax({
        url: UrlSite,
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                UIkit.modal("#modal-metodo_pago").hide();
            }, 400)
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: check'>${bool == false ? "Metodo Agregado" : "Metodo Modificado"}</span>`,
                status: "success",
                pos: "bottom-right",
            });
            cargarMetodosPago();
        },
    })
})

cargarMetodosPago()