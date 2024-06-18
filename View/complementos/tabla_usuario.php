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
        <a href="#eliminar_user'.$row['id'].'" uk-toggle class="uk-icon-button uk-margin-small-right" uk-tooltip="title:Eliminar; delay: 500" type="button" style=" border: none; cursor: pointer;" type="button">
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
            <form class="uk-grid-small" uk-grid method="POST" action="Controller/funcs/modificar_cosas.php">
                <input type=number value="'.$row['id'].'" name="ID" style="display:none">
                <input type=text value="usuario" name="tipo" style="display:none">
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Nombre" value="'.$row['nombre'].'" aria-label="100" name="nombre" pattern="^[A-Z][A-Za-z0-9]{2,20}$" required>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Correo Electronico" value="'.$row['correo'].'"  aria-label="100" name="correo" pattern="^([A-Za-z0-9\.\_]+)@([\w]{3,8})\.([\w]{2,3})(\.[\w]{2,4})?(\.[\w]{2,3})?$" required>
                </div>
                <div class="uk-width-1-2@s">
                    <select class="uk-select" name="rol" required>
                        <option value="'.$row['rol'].'" selected>Rol Actual</option>
                        <option value="1">Administrador</option>
                        <option value="2">Cajero</option>
                    </select>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Contraseña" value="" aria-label="100" pattern="^[\S]{8,}$" name="password" minlength="8" maxlength="50" required>
                </div>
                <input type="submit" id="modificar'.$row['id'].'" style="display:none">
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button" >Cancelar</button>
            <label class="uk-button uk-button-secondary" for="modificar'.$row['id'].'" >Aceptar</label>
        </div>
    </div>
</div>



<!-- **************************Modal de confirmacion de eliminacion************************** -->

<div id="eliminar_user'.$row['id'].'" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header uk-flex uk-flex-middle">
            <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
            <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
        </div>

        <div class="uk-modal-body">
            <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
            <form action="Controller/funcs/borrar_cosas.php" method="POST">
                <input type=number value="'.$row['id'].'" name="ID" style="display:none">
                <input type=text value="usuarios" name="tipo" style="display:none">
                <input type="submit" id="eliminar'.$row['id'].'" style="display:none">
            </form>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <label class="uk-button uk-button-secondary" type="submit" for="eliminar'.$row['id'].'">Aceptar</label>
        </div>
    </div>
</div>
';

?>
