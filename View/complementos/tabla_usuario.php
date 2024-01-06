<?php 

echo '
<tr>
    <td>'.$row['id'].'</td>
    <td>'.$row['nombre'].'</td>
    <td>'.$row['correo'].'</td>
    <td>'.$row['rol'].'</td>
    <td class="uk-flex">
        <a href="#Update_user'.$row['id'].'" uk-toggle uk-tooltip="title:Editar; delay: 500" class="uk-icon-button uk-margin-small-right" type="button" style=" border: none; cursor: pointer;">
            <span uk-icon="icon: file-edit"></span>
        </a>
        <a href="#eliminar_user" uk-toggle class="uk-icon-button uk-margin-small-right" uk-tooltip="title:Eliminar; delay: 500" type="button" style=" border: none; cursor: pointer;" type="button">
            <span uk-icon="icon: trash"></span>
        </a>
    </td>
</tr>


<!-- ************************************ Modal de modificar ************************************ -->

<div id="Update_user'.$row['id'].'" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">EDITAR USUARIO</h2>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" method="POST" action="Controller/funcs/modificar_cosas.php" uk-grid>
                <div class="uk-width-1-3@s">
                    <input type="text" name="tipo" value="usuarios" id="" style="display:none">
                    <input class="uk-input" type="text" placeholder="Nombre" value="'.$row['nombre'].'" aria-label="100" name="Nombre" required>
                </div>
                <div class="uk-width-1-3@s">
                    <input class="uk-input" type="text" placeholder="Correo Electronico" value="'.$row['correo'].'"  aria-label="100"yname="nombre" required>
                </div>
                <div class="uk-width-1-2@s">
                    <select class="uk-select" id="form-stacked-select" name="categoria" required>
                        <option selected disabled>Seleccione un rol</option>
                        <option value="1">Dueño</option>
                        <option value="2">Administrador</option>
                        <option value="3">Cajero</option>
                    </select>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Contraseña" value="'.$row['password'].'" aria-label="100" name="nombre" required>
                </div>
                <input type="submit" id="modificar'.$row['id'].'" style="display:none">
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button" >Cancelar</button>
            <label class="uk-button uk-button-secondary" for="modificar'.$row['id'].'" >Guardar</label>
        </div>
    </div>
</div>



<!-- **************************Modal de confirmacion de eliminacion************************** -->

<div id="eliminar_user'.$row['id'].'" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <div class="uk-modal-header uk-flex uk-flex-middle">
            <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
            <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
        </div>
        <div class="uk-modal-body">
            <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
        <form action="Controller/funcs/borrar_cosas.php" method="POST">
            <input type=number value="'.$row['id'].'" name="ID" style="display:none">
            <input type=text value="usuarios" name="tipo" style="display:none">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-secondary" type="submit">Aceptar</button>
            <input type="submit" id="eliminar'.$row['id'].'" style="display:none">
        </form>
    </div>
    <div class="uk-modal-footer uk-text-right">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
        <label class="uk-button uk-button-secondary" type="submit" for="eliminar'.$row['id'].'">Aceptar</label>
    </div>
</div>
';

?>
