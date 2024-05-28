let inp = document.querySelector('#tlfn_pais');
let iti = window.intlTelInput(inp, {
    utilsScript: "Plugins/build/js/utils.js" // Asegúrate de incluir la ruta correcta al utils.js
});

// document.querySelector('#hola').addEventListener('submit', function(event) {
//     event.preventDefault(); // Previene el envío del formulario para poder mostrar los datos
//     let countryData = iti.getSelectedCountryData();
//     let fullNumber = iti.getNumber(); // Obtiene el número de teléfono completo con el código del país

//     document.querySelector('#country-code').innerText = "Código del País: " + countryData.iso2;
//     document.querySelector('#phone-number').innerText = "Número Completo: " + fullNumber;
// });