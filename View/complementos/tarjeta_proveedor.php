<?php
echo '<div>
    <div class="target_supplier uk-card uk-card-default uk-flex uk-padding-small uk-background-secondary uk-light uk-border-rounded" style="width: 405px;">
        <div>
            <div class="img_proveedor_container uk-border-rounded">
                <img src="static/images/logo_proveedor.png" alt="" width="90px" />
                <h5 class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-text-center">Montecarmelo C.A</h5>
            </div>
        </div>

        <div>
            <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
                <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center">DATOS</h4>
                <div>
                    <a href="#modal-modificar'.$row['id'].'" uk-toggle uk-tooltip="title:Editar; delay: 500"
                        class="uk-icon-button uk-margin-small-right" type="button"
                        style="border: none; cursor: pointer">
                        <span uk-icon="icon: file-edit"></span>
                    </a>
                    <a href="#eliminar_supplier'.$row['id'].'" uk-toggle class="uk-icon-button uk-margin-small-right"
                        uk-tooltip="title:Eliminar; delay: 500" type="button"
                        style="border: none; cursor: pointer" type="button">
                        <span uk-icon="icon: trash"></span>
                    </a>
                </div>
            </div>

            <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />

            <div class="Container-details-suppliers" style="width: 200px;">
                <div class="uk-flex">
                    <h6 class="uk-margin-small">Nombre</h6>
                    <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                        '.$row['nombre'].'
                    </p>
                </div>
                <div class="uk-flex">
                    <h6 class="uk-margin-small">RIF</h6>
                    <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                        '.$row['rif'].'
                    </p>
                </div>
                <div class="uk-flex">
                    <h6 class="uk-margin-small">Direccion</h6>
                    <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-break uk-text-meta"
                        style="width: 185px">
                        '.$row['direccion'].'
                    </p>
                </div>
                <div class="uk-flex">
                    <h6 class="uk-margin-small">Telefono</h6>
                    <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                        '.$row['telefono'].'
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ****************** Modal de modificacion ****************** -->

<div id="modal-modificar'.$row['id'].'" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">MODIFICAR PROVEEDOR</h3>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" method="POST" action="Controller/funcs/modificar_cosas.php" uk-grid>
                <input type="text" name="tipo" value="proveedor" id="" style="display:none">
                <input type=number value="'.$row['id'].'" name="ID" style="display:none">
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" value="'.$row['nombre'].'" name="nombre" requierd>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Razon Social" aria-label="100" value="'.$row['razon_social'].'" name="razon_social" required>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Rif" aria-label="50" value="'.$row['rif'].'" name="rif">
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Número de teléfono" aria-label="50" value="'.$row['telefono'].'" name="telefono" required>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="email" placeholder="Correo electrónico" aria-label="25" value="'.$row['correo'].'" name="correo" required>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Dirección" aria-label="25" value="'.$row['direccion'].'" name="direccion">
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">
                        Cancelar
                    </button>
                    <button class="uk-button uk-button-secondary" type="submit">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- **************************Modal de confirmacion de eliminacion************************** -->

<div id="eliminar_supplier'.$row['id'].'" class="uk-flex-top" uk-modal>
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
            <form action="Controller/funcs/borrar_cosas.php" method="POST">
                <input type=number value="'.$row['id'].'" name="ID" style="display:none">
                <input type=text value="proveedor" name="tipo" style="display:none">
                <button class="uk-button uk-button-default uk-modal-close" type="button">
                    Cancelar
                </button>
                <button class="uk-button uk-button-secondary" type="submit">
                    Aceptar
                </button>
            </form>
        </div>
    </div>
</div>';
?>