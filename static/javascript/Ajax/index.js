$.ajax({
    url: "Controller/funcs_ajax/estadisticas.php",
    type: "GET",
    data: { select: "ratio_ventas" },
    success: function (response) {
        let json = JSON.parse(response);
        let template = ""
        json.lista.forEach(element => {
            template += `
                        <tr>
                            <td><span uk-icon="icon: factura; ratio: 1.5"></span></td>
                            <td>${element.id}</td>
                            <td>${element.nombre + " " + element.marca + " " + element.unidad_valor + " " + element.unidad}</td>
                            <td>${Math.round(element.ratio_ventas * 100) / 100} %</td>
                        </tr>
            `
        });

        $("#tbody_ratio_ventas").html(template)
    }
})

$.ajax({
    url: "Controller/funcs_ajax/estadisticas.php",
    type: "GET",
    data: { select: "clientes_frecuentes" },
    success: function (response) {
        let json = JSON.parse(response);
        let template = ""
        json.lista.forEach(element => {
            template += `
                        <tr>
                            <td><span uk-icon="icon: user; ratio: 1.5"></span></td>
                            <td>${element.idCliente}</td>
                            <td>${element.Cliente}</td>
                            <td>${element.Compras}</td>
                        </tr>
            `
        });

        $("#tbody_clientes_frecuentes").html(template)
    }
})


$.ajax({
    url: "Controller/funcs_ajax/estadisticas.php",
    type: "GET",
    data: { select: "total_productos_categoria" },
    success: function (response) {
        let json = JSON.parse(response);
        console.log(json);
        let template = ""
        json.lista.forEach(element => {
            template += `
                    <article class="uk-flex uk-flex-center Container-stats ">
                        <span uk-icon="icon: category; ratio: 4.5"></span>
                        <div class="uk-margin-small-left uk-text-truncate">
                            <h3>${element.total_productos}</h3>
                            <p class="">${element.categoria.toUpperCase()}</p>
                        </div>
                    </article>
            `
        });

        $(".cont-stats-index").html(template)
    }
})