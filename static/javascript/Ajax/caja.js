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
                            <td>${element.fecha}</td>
                            <td>${element.monto_inicial}</td>
                            <td>${element.fecha}</td>
                            <td>${element.fecha}</td>
                            <td>15</td>
                            <td>600.00</td>
                            <td>1500.00</td>
                            <td>
                                <div class="activeGood uk-border-rounded" style="padding: 5px;">ABIERTA</div>
                            </td>
                            <td>
                                <a href="#cierre-caja" uk-toggle class="uk-button uk-button-default">CERRAR CAJA</a>
                            </td>
                        </tr>`
        })
       
    }
})



