const fecha = (f) => {
    const fecha = new Date(f);
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    const fechaFormateada = `${dia}/${mes}/${anio}`;
    return fechaFormateada
}


setInterval(() => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "entradas", subFunction: "badge" },
        success: function (response) {
            let json = JSON.parse(response);
            let badge = document.querySelector(".uk-badge");
            badge.textContent = json.lista;
        }
    })
}, 1000)

$.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "entradas", subFunction: "notification" },
    success: function (response) {
        let templete = ``
        let json = JSON.parse(response);
        if (json.lista.length == 0) {
            $(".cont_notify").append(`
                <li>
                    <a href="#" class="uk-flex Container_notify">
                        <div>
                            <span class="uk-margin-small-right" uk-icon="icon: info; ratio: 2"></span>
                        </div>
                        <div>
                            <p class="uk-margin-remove"><b>No tiene notificaciones</b></p>
                        </div>
                    </a>
                </li>
                `)
        } else {
           json.lista.forEach(e => {
                templete += `
                <li>
                    <a href="#" class="uk-flex Container_notify ${e.status == 1 ? "notify-write" : ""}" id=${e.id}>
                        <div>
                            <span class="uk-margin-small-right" uk-icon="icon: info; ratio: 2"></span>
                        </div>
                        <div>
                            <p class="uk-margin-remove date_notify">${fecha(e.fecha)}</p>
                            <p class="uk-margin-remove"><b>${e.mensaje}</b></p>
                        </div>
                    </a>
                </li>`
           });
            $(".cont_notify").append(templete);

            let btn_notify = document.querySelectorAll(".Container_notify");
            btn_notify.forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    let id = btn.getAttribute("id");
                    $.ajax({
                        url: "Controller/funcs/modificar_cosas.php",
                        type: "POST",
                        data: { tipo: "entrada", ID: id },
                        success: (response) => {
                            
                        }
                    })
                })
            })
        }
    }
})