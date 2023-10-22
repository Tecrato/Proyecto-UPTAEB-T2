<?php
 echo '<div>
 <div class="target_supplier uk-card uk-card-default uk-flex uk-padding-small uk-background-secondary uk-light uk-border-rounded"
     style="width: 370px;">
     <div>
         <div class="img_proveedor_container uk-border-rounded">
             <img src="static/images/undraw_profile_2.svg" alt="" width="120px" />
             <h5
                 class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-margin-small-bottom uk-text-center">
                '.$row['nombre'].'
             </h5>
         </div>
     </div>

     <div>
         <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
             <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center">
                 DATOS
             </h4>
             <div>
                 <a href="#modificar_client" uk-toggle uk-tooltip="title:Editar; delay: 500"
                     class="uk-icon-button uk-margin-small-right" type="button"
                     style="border: none; cursor: pointer">
                     <span uk-icon="icon: file-edit"></span>
                 </a>
                 <a href="#eliminar_supplier" uk-toggle uk-tooltip="title:Eliminar; delay: 500"
                     class="uk-icon-button uk-margin-small-right" uk-tooltip="title:Eliminar; delay: 500"
                     type="button" style="border: none; cursor: pointer" type="button">
                     <span uk-icon="icon: trash"></span>
                 </a>
             </div>
         </div>

         <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />

         <div class="Container-details-suppliers" style="width: 200px;">
             <div class="uk-flex">
                 <h6 class="uk-margin-small">Documento</h6>
                 <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                     500000000
                 </p>
             </div>
             <div class="uk-flex">
                 <h6 class="uk-margin-small">Telefono</h6>
                 <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                     0000000000000
                 </p>
             </div>
             <div class="">
                 <h6 class="uk-margin-small-right uk-margin-remove-bottom" style="float: left;">Direccion
                 </h6>
                 <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-margin-remove-left uk-text-meta"
                     style="width: 185px; line-height: 23px;">
                     carrera 10, entre 15 y 17, sector matica de rosa
                 </p>
             </div>
         </div>
     </div>
 </div>
</div>';


?>