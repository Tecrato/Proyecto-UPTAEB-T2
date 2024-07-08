let button = document.querySelectorAll('button[name="action"]').forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        const action = event.target.value;
        const montoInput = document.querySelector('input[name="monto"]');
        if (action === 'gasto') {
            montoInput.value = '-' + montoInput.value;
        }
        //document.getElementById('FormCapital').submit();
    });
});

let FormCapital = document.getElementById('FormCapital');
FormCapital.addEventListener("submit", (e) => {
    e.preventDefault();
    let data = new FormData(FormCapital);
    $.ajax({
        url: "Controller/funcs/agregar_cosas.php",
        type: "POST",
        data: { randomnautica: "capital" },
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: check'>${"Capital Modificado"}</span>`,
                status: "success",
                pos: "bottom-right",
            });
            fetchCapital(page_general);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: warning'>${"Error al modificar Capital"}</span>`,
                status: "danger",
                pos: "bottom-right",
            });
        }
    });
});

function fetchCapital(page) {
    console.log("fetchCapital");
    let template = '';
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "Capital", limite: 10, n: page },
        success: function(response) {
            console.log(response);
            let json = JSON.parse(response);
            json.lista.forEach(element => {
                template += `
                    <tr>
                        <td>${element.id}</td>
                        <td>${element.descripcion}</td>
                        <td>${element.monto}</td>
                        <td>${element.fecha}</td>
                    </tr>
                `;
            });
            $("#tableCapital").html(template);
        }
    });
    page_general = page;
}

function cambiar_pagina_ajax(dir, type, func, limit = 9, page = 0) {
    limit = limit
    $.ajax({
        url: `Controller/funcs_ajax/cambiar_pagina.php?dir=` + dir + "&p=" + page + "&type=" + type + "&n_p=" + limit,
        type: "GET",
        success: (response) => {
            console.log(response);
            func(parseInt(response));
        },
    });
}
fetchCapital(page_general);