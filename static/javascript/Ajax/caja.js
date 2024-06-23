const cargarCajas = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "caja" },
        success: function (response) {
            let json = JSON.parse(response);
            let template = ""

            console.log(json);
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
                                <td>${parseFloat(element.monto_final).toFixed(2)}</td>
                                <td>
                                    <div class="${element.estado == 0 ? "activeGood" : "activeExpire"} uk-border-rounded" style="padding: 5px;">${element.estado == 0 ? "ABIERTA" : "CERRADA"}</div>
                                </td>
                                <td>
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
                    formCloseBox.addEventListener('submit',(e)=>{
                        e.preventDefault()
                        let data = new FormData(formCloseBox)
                        data.append('id_caja',id)
                        data.append('accion',"cerrar")

                        $.ajax({
                            url:'api_caja',
                            type:'POST',
                            data:data,
                            processData:false,
                            contentType:false,
                            success: function(response){
                                console.log(response);
                                cargarCajas()
                                UIkit.notification.closeAll();
                                UIkit.notification({
                                    message: `<span uk-icon='icon: check'>Caja Cerrada</span>`,
                                    status: "success",
                                    pos: "bottom-right",
                                });
                            }
                        })
                    })


                })
            })

            

        }
    })
}
cargarCajas()

const hora = (f) => {
    const fecha = new Date(f);
    const horas = fecha.getHours();
    const minutos = fecha.getMinutes();
    const periodo = horas >= 12 ? "PM" : "AM";
    const horas12 = horas % 12 || 12;
    const horaFormateada = `${horas12}:${minutos < 10 ? `0${minutos}` : minutos} ${periodo}`;
    return horaFormateada
}
const fecha = (f) => {
    const fecha = new Date(f);
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    const fechaFormateada = `${dia}/${mes}/${anio}`;
    return fechaFormateada
}

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
            console.log(response);
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: check'>Caja Abieta</span>`,
                status: "success",
                pos: "bottom-right",
            });
        }
    })
})



