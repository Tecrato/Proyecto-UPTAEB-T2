const fetchCapital = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "capital" },
        success: function (response) {
            let template = '';
            let json = JSON.parse(response);
            json.lista.forEach(element => {
                template += `
                        <tr data-tm="${(element.monto).toString().slice(0, 1) == '-' ? 'Egresos' : 'Ingresos'}">
                            <td>${element.id}</td>
                            <td>${element.descripcion}</td>
                            <td>${element.monto}</td>
                            <td>${element.fecha}</td>
                        </tr>
                    `;
                // element.monto.slice(0,1)
            });
            $("#tableCapital").html(template);

        }
    });
}
fetchCapital()

let FormCapital = document.getElementById('FormCapital');


let button = document.querySelectorAll('button[name="action"]')
button.forEach(b => {
    b.addEventListener('click', () => {
        const action = b.getAttribute('value');
        const montoInput = document.querySelector('input[name="monto"]');
        if (action == 'gasto') {
            montoInput.value = '-' + montoInput.value;
        }
    });
});

FormCapital.addEventListener("submit", (e) => {
    e.preventDefault();
    let data = new FormData(FormCapital);
    $.ajax({
        url: "Controller/funcs/agregar_cosas.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            UIkit.notification.closeAll();
            UIkit.notification({
                message: `<span uk-icon='icon: check'>${"Capital Modificado"}</span>`,
                status: "success",
                pos: "bottom-right",
            });
            fetchCapital();
            $("#FormCapital").trigger("reset")
        }
    });
});

