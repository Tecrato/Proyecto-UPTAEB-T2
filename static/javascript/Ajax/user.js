let template = ""
let template2 = ""
$.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "bitacora", subFunction: "bitacora", limite: 20 },
    success: function (response) {
        let json = JSON.parse(response)
        json.lista.forEach(element => {
            template += `
                            <tr>
                                <td>${element.id_usuario}</td>
                                <td>${element.detalles}</td>
                                <td>${element.fecha}</td>
                                <td>${element.tabla}</td>
                            </tr>
                            `
        });
        $("#registerSystem").html(template)
    },
});

$.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "bitacora", subFunction: "bitacora", limite: 20, ID: 6 },
    success: function (response) {
        let json = JSON.parse(response)
        json.lista.forEach(element => {
            template2 += `<tr>
                            <td>${element.detalles}</td>
                            <td>${element.fecha}</td>
                            <td>${element.tabla}</td>
                        </tr>`
        });
        $("#registerActv").html(template2)
    },
});