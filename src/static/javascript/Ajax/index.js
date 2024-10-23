Chart.defaults.color = "#888";
Chart.defaults.borderColor = "#444";



$.ajax({
    url: "api_estadisticas",
    type: "POST",
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
    url: "api_estadisticas",
    type: "POST",
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
    url: "api_estadisticas",
    type: "POST",
    data: { select: "total_productos_categoria" },
    success: function (response) {
        let json = JSON.parse(response);
        (json);
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

$.ajax({
    url: "api_caja",
    type: "POST",
    data: { accion: "check" },
    success: function (response) {
        let json = JSON.parse(response);
        if (json.estado == "no") {
            document.getElementById("check_box").textContent = "CERRADA";
        } else {
            document.getElementById("check_box").textContent = "ABIERTA";
        }
    }
})

const getDataColors = (opacity) => {
    const colors = [
        "#7448c2",
        "#21c0d7",
        "#d99e2b",
        "#cd3a81",
        "#9c99cc",
        "#e14eca",
        "#ffffff",
        "#ff0000",
        "#d6ff00",
        "#0038ff",
    ];
    return colors.map((color) => (opacity ? `${color + opacity}` : color));
};


const renderModelsChart6 = () => {

    ("object");
    $.ajax({
        url: "api_estadisticas",
        type: "POST",
        data: { select: "valor_total_inventario" },
        success: function (response) {
            (response);
            let json = JSON.parse(response);
            (json);
            let array = []
            json.lista.forEach(element => {
                if ((element.valor == null ? 0 : parseFloat(element.valor) * 100) > 0) {
                    array.push
                        ({
                            label: `${element.nombre}`,
                            data: [element.valor == null ? 0 : parseFloat(element.valor), "Bs"] ,
                            backgroundColor: getDataColors()[parseInt(Math.random() * 10)],
                            borderColor: getDataColors(0),
                            borderWidth: 0,
                        })
                }
            });

            const data = {
                labels: ["VALOR DE INVENTARIO POR CATEGORIA"],
                datasets: array
            };


            let chart = new Chart("inventoryChart", { type: "bar", data });
        }
    })
};

renderModelsChart6()