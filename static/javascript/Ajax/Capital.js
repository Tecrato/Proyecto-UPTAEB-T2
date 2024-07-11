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
                            <td>${element.monto} Bs</td>
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
const detailsCapital = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: {randomnautica: "capital", subFunction: "detallesCapital"},
        success: function (response) {
            let template = '';
            let json = JSON.parse(response);
            json.lista.forEach(element => {
                const Gastos = element.Gastos.startsWith('-') ? element.Gastos.slice(1) : element.Gastos;
                template += `
                    <div class="uk-flex uk-flex-column uk-flex-middle">
                                        <h5>INGRESOS</h5>
                                        <div class="item_capital" style="background-color: #007D35">
                                            ${element.Ingresos} Bs
                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-column uk-flex-middle">
                                        <h5>VENTAS</h5>
                                        <div class="item_capital" style="background-color: #aaa;">
                                            ${element.Ventas} Bs
                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-column uk-flex-middle">
                                        <h5>GASTOS</h5>
                                        <div class="item_capital" style="background-color: #f0506e;">
                                            ${Gastos} Bs
                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-column uk-flex-middle">
                                        <h5>UTILIDAD NETA</h5>
                                        <div class="item_capital uk-font-bold" style="background-color: #9800b3;">
                                            ${element.capital} Bs
                                        </div>
                                    </div>
                `;
            });
            $("#detallesCapital").html(template);
        }
    });
}
detailsCapital()
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

