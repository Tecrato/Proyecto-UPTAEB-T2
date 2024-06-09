let inp = document.querySelector("#tlfn_pais");
let iti = window.intlTelInput(inp, {
  utilsScript: "Plugins/build/js/utils.js",
});

// document.querySelector('#hola').addEventListener('submit', function(event) {
//     event.preventDefault(); // Previene el envío del formulario para poder mostrar los datos
//     let countryData = iti.getSelectedCountryData();
//     let fullNumber = iti.getNumber(); // Obtiene el número de teléfono completo con el código del país

//     document.querySelector('#country-code').innerText = "Código del País: " + countryData.iso2;
//     document.querySelector('#phone-number').innerText = "Número Completo: " + fullNumber;
// });

document.querySelector("#title").textContent = "Gestión de Proveedores";

// $.ajax({
//   url: "Controller/funcs_ajax/search.php",
//   type: "GET",
//   data: { randomnautica: "proveedores", active: 0 },
//   success: function (response) {
//     console.log(response);
//     let template;
//     let json = JSON.parse(response);
//     console.log(json.lista.length);
//     json.lista.forEach((element) => {
//       template += `<div>
//                         <div class="target_supplier uk-card uk-card-default uk-flex uk-padding-small uk-light uk-border-rounded" style=" background-color: #333;">
//                             <div>
//                                 <div class="img_proveedor_container uk-border-rounded">
//                                     <img src="static/images/logo_proveedor.png" alt="" width="80px" />
//                                     <h5 class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-text-center">${element.razon_social}</h5>
//                                 </div>
//                             </div>
                    
//                             <div style="width: 180px;">
//                                 <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
//                                     <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center">DATOS</h4>
//                                     <div>
//                                         <a href="#modal-modificar" uk-toggle uk-tooltip="title:Editar; delay: 500"
//                                             class="uk-icon-button uk-margin-small-right" type="button"
//                                             style="border: none; cursor: pointer">
//                                             <span uk-icon="icon: file-edit"></span>
//                                         </a>
//                                         <a href="#eliminar_supplier" uk-toggle class="uk-icon-button uk-margin-small-right"
//                                             uk-tooltip="title:Eliminar; delay: 500" type="button"
//                                             style="border: none; cursor: pointer" type="button">
//                                             <span uk-icon="icon: trash"></span>
//                                         </a>
//                                     </div>
//                                 </div>
                    
//                                 <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />
                    
//                                 <div class="Container-details-suppliers" style="width: 200px;">
//                                     <div class="uk-flex">
//                                         <h6 class="uk-margin-small">Nombre</h6>
//                                         <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
//                                         ${element.nombre}
//                                         </p>
//                                     </div>
//                                     <div class="uk-flex">
//                                         <h6 class="uk-margin-small">RIF</h6>
//                                         <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
//                                         ${element.rif}
//                                         </p>
//                                     </div>
//                                     <div class="uk-flex">
//                                         <h6 class="uk-margin-small">Direccion</h6>
//                                         <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-break uk-text-meta"
//                                             style="width: 185px">
//                                             ${element.direccion}
//                                         </p>
//                                     </div>
//                                     <div class="uk-flex">
//                                         <h6 class="uk-margin-small">Telefono</h6>
//                                         <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
//                                         ${element.telefono}
//                                         </p>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>`;
//     });
//     $(".cont_prov_cards").html(template)
//   },
// });
