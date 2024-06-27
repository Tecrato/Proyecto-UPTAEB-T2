setInterval(() => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "notificaciones", status: 1 , subFunction: 'count'},
        success: function (response) {
            let json = JSON.parse(response);
            let badge = document.querySelector(".uk-badge");
            badge.textContent = json.lista;
        }
    })
}, 1000)

const cargarNotify = () =>{
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "notificaciones" },
        success: function (response) {
            let templete = ``
            let json = JSON.parse(response);
            if (json.lista.length == 0) {
                $(".cont_notify").html(`
                    <li>
                        <a href="#" class="uk-flex Container_notify">
                            <div>
                                <span class="uk-margin-small-right" style="color: #888;" uk-icon="icon: info; ratio: 2"></span>
                            </div>
                            <div>
                                <p class="uk-margin-remove" style="color: #888;"><b>No tiene notificaciones</b></p>
                            </div>
                        </a>
                    </li>
                    `)
            } else {
               json.lista.forEach(e => {
                    templete += `
                    <li>
                        <a href="Productos" class="uk-flex Container_notify ${e.status == 1 ? "notify-write" : ""}" id=${e.id}>
                            <div>
                                <span class="uk-margin-small-right" style="color: #333;" uk-icon="icon: info; ratio: 2"></span>
                            </div>
                            <div>
                                <p class="uk-margin-remove date_notify" style="color: #888;">${fecha(e.fecha)}</p>
                                <p class="uk-margin-remove" style="color: #888;"><b>${e.mensaje}</b></p>
                            </div>
                        </a>
                    </li>`
               });
                $(".cont_notify").html(templete);
    
                let btn_notify = document.querySelectorAll(".Container_notify");
                btn_notify.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        btn.classList.toggle("notify-write");
                        let id = btn.getAttribute("id");
                        $.ajax({
                            url: "Controller/funcs/borrar_cosas.php",
                            type: "POST",
                            data: { tipo: "notificaciones", ID: id },
                            success: (response) => {
                            }
                        })
                    })
                })
            }
        }
    })
}

setInterval(cargarNotify, 1000)