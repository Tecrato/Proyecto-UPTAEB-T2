let cargarBackup = () => {
    $.ajax({
        url: "backup",
        type: "POST",
        data: { type: "Search" },
        success: function (response) {
            let json = JSON.parse(response);
            let json2 = []
            json.forEach((e) => {
                if (e !== "." && e !== "..") {
                    json2.push({ archivo: e })
                }
            })
            let template = "";
            if (json2.length == 0) {
                template = `
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="uk-text-center">
                            <img class="uk-margin-top" style="opacity: 0.3;" src="./static/images/logo_letras-minimarketNewColor.png" alt="">
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    `
            } else {
                json2.forEach((p) => {
                    template += `
                    <tr>
                        <td><img class="img_config_logo" src="./static/images/logo_letras-minimarket.png" alt="" width="50"></td>
                        <td>${p.archivo}</td>
                        <td>
                            <div>
                                <a href="#eliminar_backup" uk-toggle class="uk-icon-button btnDeleteBackup" name="${p.archivo}" uk-icon="trash"></a>
                            </div>
                        </td>
                    </tr>
                    `;
                });
            }

            $("#table_backup").html(template);

            let btnDeleteBackup = document.querySelectorAll(".btnDeleteBackup");
            btnDeleteBackup.forEach((e) => {
                e.addEventListener("click", () => {
                    document.querySelector("#valueBackup").setAttribute("value", e.getAttribute("name"));
                })
            })
        }
    })
}
cargarBackup()

let formBackup = document.querySelector("#formDeleteBackup");
formBackup.addEventListener("submit", (e) => {
    e.preventDefault();
    let data = new FormData(formBackup);
    $.ajax({
        url: "backup",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            cargarBackup();
            UIkit.notification.closeAll();
            UIkit.notification({
                message: response,
                status: 'success',
                pos: 'bottom-right',
            });
            formBackup.reset();
            UIkit.modal("#eliminar_backup").hide();
        }
    })
})

let btnAggBackup = document.querySelector(".btnAggBackup");
btnAggBackup.addEventListener("click", () => {
    $.ajax({
        url: "backup",
        type: "POST",
        data: { type: "Insert" },
        success: function (response) {
            cargarBackup();
            UIkit.notification.closeAll();
            UIkit.notification({
                message: response,
                status: 'success',
                pos: 'bottom-right',
            });
        }
    })
})

