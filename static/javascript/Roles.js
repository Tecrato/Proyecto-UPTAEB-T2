const cargarPermisos = () => {
    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "permiso", limite: 10 },
        success: function (response) {
            let template = ""
            let json = JSON.parse(response);
            json.lista.forEach((e) => {
                template += `
                                <tr data-tp="${e.permiso}">
                                    <td>${e.id}</td>
                                    <td>${e.nombre}</td>
                                    <td>${e.tabla}</td>
                                    <td>${e.permiso}</td>
                                 </tr>`
            });

            $('#table-rol').html(template)
        }
    });
}
cargarPermisos()

$.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "GET",
    data: { randomnautica: "usuario" },
    success: function (response) {
        let json = JSON.parse(response);
        let options = ``;
        json.lista.forEach((date) => {
            options += `<option value="${date.id}">${date.nombre}</option>`;
        });
        document.querySelector(".select-user-rol").innerHTML = options;
    }
});

let radio = document.querySelectorAll(".uk-radio");
let select_ID = document.querySelector(".select-user-rol");
let id_user = 0;
let tabla = document.querySelector(".table_permisos tbody").children;

const identificador = {
    'agregar': 1,
    'modificar': 2,
    'eliminar': 3,
    'imprimir': 4
};

// Evento para manejar el cambio en los radios
radio.forEach((r) => {
    r.addEventListener("change", () => {
        let tabla = r.closest('tr').firstElementChild.textContent.toLowerCase();
        let accion = r.getAttribute("accion");
        let condicion = r.value;

        if (condicion == 'Si') {
            $.ajax({
                url: "Controller/funcs/agregar_cosas.php",
                type: "POST",
                data: { tipo: "permiso", id_usuario: id_user, tabla: tabla, permiso: accion },
                success: function (response) {
                }
            });
        } else {
            $.ajax({
                url: "Controller/funcs/borrar_cosas.php",
                type: "POST",
                data: { tipo: "permiso", id_usuario: id_user, tabla, accion },
                success: function (response) {
                }
            });
        }
        cargarPermisos()
    });
});

// Evento para manejar el cambio de usuario
select_ID.addEventListener("change", () => {
    id_user = select_ID.value;

    // Reiniciar todos los radios a "No"
    radio.forEach((r) => {
        if (r.value === "No") {
            r.checked = true;
        } else {
            r.checked = false;
        }
    });

    $.ajax({
        url: "Controller/funcs_ajax/search.php",
        type: "GET",
        data: { randomnautica: "permiso", ID: id_user, limite: 500 },
        success: function (response) {
            let json = JSON.parse(response);
            json.lista.forEach((e) => {
                for (const iterator of tabla) {
                    if (e.tabla == iterator.firstElementChild.textContent.toLowerCase()) {
                        let permisoIndex = identificador[e.permiso];
                        let radios = iterator.children[permisoIndex].querySelectorAll('.uk-radio');

                        radios.forEach((radio) => {
                            if (radio.value === 'Si') {
                                radio.checked = true;
                            } else {
                                radio.checked = false;
                            }
                        });
                    }
                }
            });
        }
    });
});



