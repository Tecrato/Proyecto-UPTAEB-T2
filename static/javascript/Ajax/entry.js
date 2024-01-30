let hola = ""

$.ajax({
    url: "Controller/funcs_ajax/search.php",
    type: "POST",
    data: { randomnautica: "proveedores"},
    success: function (response) {
        
        let json = JSON.parse(response)
        json.lista.forEach(p => {
            hola += `<li>
                            <a  class="uk-accordion-title lola" href="#" idSupplier="${p.id}">
                                <div class="uk-flex">
                                    <p class="uk-margin-remove uk-text-bold">${p.razon_social.toUpperCase()}</p>
                                </div>
                            </a>
                            <div class="uk-accordion-content cont_product_prov">

                            </div>
                            
                        </li>`
        });
        $("#container_prov_entry").html(hola);
 
        
        document.querySelectorAll(".lola").forEach((p)=>{
            p.addEventListener('click', ()=>{
                let idSup = p.getAttribute('idSupplier')

                $.ajax({
                    url: "Controller/funcs_ajax/search.php",
                    type: "POST",
                    data: { randomnautica: "entradas", id_proveedor: idSup},
                    success: function (response) {
                        // console.log(response);
                        let template = ""
                      let json = JSON.parse(response)
                      console.log(json);
                      json.lista.forEach((l)=>{
                        template += `<h4 class="uk-margin-medium-left uk-margin-small-top uk-margin-small-bottom">
                                        <img class="img3ProductSwitcher" src="./static/images/cajas (2).png" width="30" alt="">
                                        <span class="uk-margin-small-left uk-text-bold">harina${l.id}</span>
                                    </h4>
                                    
                                    `
                      })
                    p.nextElementSibling.innerHTML = template
                    }
                })
                
            })
        })

        
        
    }
})

