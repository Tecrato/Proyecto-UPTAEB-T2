let template = ""
let template2 = ""

const hora = (f) => {
    const fecha = new Date(f);
    const horas = fecha.getHours();
    const minutos = fecha.getMinutes();
    const periodo = horas >= 12 ? "PM" : "AM";
    const horas12 = horas % 12 || 12;
    const horaFormateada = `${horas12}:${minutos < 10 ? `0${minutos}` : minutos} ${periodo}`;
    return horaFormateada
}
const fecha = (f) => {
    const fecha = new Date(f);
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    const fechaFormateada = `${dia}/${mes}/${anio}`;
    return fechaFormateada
}

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
                                <td>${fecha(element.fecha)}</td>
                                <td>${hora(element.fecha)}</td>
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
                            <td>${fecha(element.fecha)}</td>
                            <td>${hora(element.fecha)}</td>
                            <td>${element.tabla}</td>
                        </tr>`
        });
        $("#registerActv").html(template2)
    },
});




//   let seed = generateAlphanumericSeed(20);
//   console.log(seed); // Puedes cambiar el número para ajustar la longitud de la semilla
let btnGenerate = document.querySelector(".btn-generate")
btnGenerate.addEventListener("click", () => {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < 20; i++) {
      result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.querySelector(".input-seed").value = result

})