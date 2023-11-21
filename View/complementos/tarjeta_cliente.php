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
                 <a href="#eliminar_supplier'.$row["id"].'"  uk-toggle uk-tooltip="title:Eliminar; delay: 500"
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
                    '.$row['documento'].'-'.$row['cedula'].'
                 </p>
             </div>
             <div class="uk-flex">
                 <h6 class="uk-margin-small">Telefono</h6>
                 <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                    '.$row['telefono'].'
                 </p>
             </div>
             <div class="">
                 <h6 class="uk-margin-small-right uk-margin-remove-bottom" style="float: left;">Direccion
                 </h6>
                 <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-margin-remove-left uk-text-meta"
                     style="width: 185px; line-height: 23px;">
                    '.$row['direccion'].'
                 </p>
             </div>
         </div>
     </div>
 </div>
</div>
<!-- ****************** Modal de modificacion ****************** -->

<div id="modificar_client" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">EDITAR CLIENTES</h3>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" uk-grid>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Nombre" aria-label="100">
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Apellido" aria-label="50">
                </div>
                <div class="uk-width-1-2@s">
                    <select class="uk-select" id="form-stacked-select" name="categoria" required>
                        <option selected disabled>Documento</option>
                        <option>V</option>
                        <option>J</option>
                        <option>E</option>
                    </select>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Numero de documento" aria-label="50">
                </div>
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-secondary" type="button">Guardar</button>
        </div>
    </div>
</div>

<!-- **************************Modal de confirmacion de eliminacion************************** -->

<div id="eliminar_supplier'.$row["id"].'" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <div class="uk-modal-header uk-flex uk-flex-middle">
            <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
            <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
        </div>
        <div class="uk-modal-body">
            <p>
                Deseas eliminar este registro para siempre? No podras recuperlo mas
                adelante
            </p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">
                Cancelar
            </button>
            <form method="POST" action="Controller/funcs/borrar_cosas.php">
                <input type="number" name="ID" value='.$row["id"].' style="display:none">
                <input type="text" name="tipo" value="cliente" style="display:none">
                <input type="submit" class="uk-button uk-button-secondary"  >
            </form>
        </div>
    </div>
</div>';

?>
