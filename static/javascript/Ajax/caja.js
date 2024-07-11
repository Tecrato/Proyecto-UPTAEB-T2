const checkCaja = () => {
    $.ajax({
        url: "api_caja",
        type: "POST",
        data: { accion: "check" },
        success: function (response) {
            console.log(response);
            let json = JSON.parse(response);
            if (json.estado == "no") {
                document.getElementById("check_box").textContent = "CERRADA";
            } else {
                document.getElementById("check_box").textContent = "ABIERTA";
            }
        }
    })
}

const cargarCajas = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "caja" },
        success: function (response) {
            let json = JSON.parse(response);
            console.log(json);
            let template = ""
            json.lista.forEach(element => {
                template += `<tr>
                                <td>${element.id}</td>
                                <td>${element.nombre}</td>
                                <td>${fecha(element.fecha)}</td>
                                <td>${element.monto_inicial}</td>
                                <td>${hora(element.fecha)}</td>
                                <td>${element.fecha_cierre == null ? "00:00" : hora(element.fecha_cierre)}</td>
                                <td>${element.total_ventas}</td>
                                <td>${parseFloat(element.monto_credito).toFixed(2)}</td>
                                <td>
                                    <a uk-tooltip="Imprimir Cierre" href="PDFCierreCaja?id_caja=${element.id}" class="btn_print_closeBox">${element.monto_final == null ? element.monto_inicial : parseFloat(element.monto_final).toFixed(2)}</a>
                                </td>
                                <td>
                                    <div class="${element.estado == 0 ? "activeGood" : "activeExpire"} uk-border-rounded" style="padding: 5px;">${element.estado == 0 ? "ABIERTA" : "CERRADA"}</div>
                                </td>
                                <td class="${element.estado == 1 ? "invisible" : ""}">
                                    <a  href="#cierre-caja" uk-toggle class="uk-button uk-button-default cerrarCaja">CERRAR CAJA</a>
                                </td>
                            </tr>`
            })

            $("#tbody_caja").html(template)

            let cerrarCaja = document.querySelectorAll(".cerrarCaja");
            cerrarCaja.forEach((element) => {
                element.addEventListener("click", () => {
                    let id = element.parentElement.parentElement.firstElementChild.textContent

                    let formCloseBox = document.querySelector("#FORM-CLOSE-BOX")
                    formCloseBox.addEventListener('submit', (e) => {
                        e.preventDefault()
                        let data = new FormData(formCloseBox)
                        data.append('id_caja', id)
                        data.append('accion', "cerrar")

                        $.ajax({
                            url: 'api_caja',
                            type: 'POST',
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                console.log(response);
                                cargarCajas()
                                checkCaja()
                                UIkit.notification.closeAll();
                                UIkit.notification({
                                    message: `<span uk-icon='icon: check'>Caja Cerrada</span>`,
                                    status: "success",
                                    pos: "bottom-right",
                                });
                                setTimeout(() => {
                                    UIkit.modal("#cierre-caja").hide();
                                }, 400)
                            }
                        })
                    })
                })
            })
        }
    })
}
cargarCajas()




checkCaja()


let formCaja = document.getElementById("FormCaja");
// console.log(formCaja);
formCaja.addEventListener("submit", (e) => {
    e.preventDefault();
    let data = new FormData(formCaja);
    data.append("accion", "abrir");

    $.ajax({
        url: "api_caja",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            cargarCajas()
            checkCaja()
            console.log(response);
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: check'>Caja Abieta</span>`,
                status: "success",
                pos: "bottom-right",
            });
            setTimeout(() => {
                UIkit.modal("#caja-modal").hide();
            }, 400)
        }
    })
})

