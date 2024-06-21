const cargarCajas = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: {randomnautica : "caja"},
        success: function (response) {
            let json = JSON.parse(response);
            let template = ""
    
            json.lista.forEach(element => {
                template += `<tr>
                                <td>${element.id}</td>
                                <td>${element.id_usuario}</td>
                                <td>${fecha(element.fecha)}</td>
                                <td>${element.monto_inicial}</td>
                                <td>${hora(element.fecha)}</td>
                                <td>${element.fecha_cierre == null ? "00:00" : element.fecha_cierre}</td>
                                <td>${element.total_ventas}</td>
                                <td>${element.monto_credito}</td>
                                <td>${element.monto_final}</td>
                                <td>
                                    <div class="activeGood uk-border-rounded" style="padding: 5px;">ABIERTA</div>
                                </td>
                                <td>
                                    <a href="#cierre-caja" uk-toggle class="uk-button uk-button-default">CERRAR CAJA</a>
                                </td>
                            </tr>`
            })
    
            $("#tbody_caja").html(template)
           
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

let formCaja =  document.getElementById("FormCaja");
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



