<?php 

echo ' <tr>
    <td>
    '.$row['id'].'
    </td>
    <td>'.$row['nombre'].'</td>
    <td>'.$row['correo'].'</td>
    <td>'.$row['rol'].'</td>
    <td class="uk-flex">
        <a href="#Update_user" uk-toggle uk-tooltip="title:Editar; delay: 500"
            class="uk-icon-button uk-margin-small-right" type="button"
            style=" border: none; cursor: pointer;">
            <span uk-icon="icon: file-edit"></span>
        </a>
        <a href="#eliminar_user" uk-toggle class="uk-icon-button uk-margin-small-right"
            uk-tooltip="title:Eliminar; delay: 500" type="button"
            style=" border: none; cursor: pointer;" type="button">
            <span uk-icon="icon: trash"></span>
        </a>
    </td>
</tr>
<!-- ************************************ Modal de modificar ************************************ -->

<div id="Update_user" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">EDITAR USUARIO</h2>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" uk-grid method="POST" action="../Controller/funcs/modificar_cosas.php">
                <div class="uk-width-1-2">
                <input type="text" name="tipo" value="Usuarios" id="" style="display:none">
                    <input class="uk-input" type="text" placeholder="Nombre" value="'.$row['nombre'].'" aria-label="100" name="Nombre"
                        required>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Apellido" aria-label="50" name="Apellido">
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Correo Electronico" value="'.$row['correo'].'"  aria-label="100"
                        name="nombre" required>
                </div>
                <div class="uk-width-1-2@s">
                    <select class="uk-select" id="form-stacked-select" name="categoria" required>
                        <option selected disabled>'.$row['rol'].'</option>
                        <option >Dueño</option>
                        <option>Administrador</option>
                        <option>Cajero</option>
                    </select>
                </div>
                <div class="uk-width-1-1@s">
                    <input class="uk-input" type="password" placeholder="Contraseña" value="'.$row['password'].'" aria-label="100" name="nombre"
                        required>
                </div>
                <input type="submit" id="subirxd" style="display:none">
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
        <label class="uk-button uk-button-secondary" type="submit" for="subirxd">Guardar</label>
    </div>
        </div>
    </div>
</div>

<!-- ************************************************************************************************************ -->

<!-- **************************Modal de confirmacion de eliminacion************************** -->

<div id="eliminar_user'.$row['id'].'" class="uk-flex-top" uk-modal>
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
            <input type=text value="Usuarios" name="tipo" style="display:none">
            <button class="uk-button uk-button-default uk-modal-close" type="button">
                Cancelar
            </button>
            <button class="uk-button uk-button-secondary" type="submit">
                Aceptar
            </button>
            <input type="submit" id="subirxd" style="display:none">
        </form>
    </div>
    <div class="uk-modal-footer uk-text-right">
    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
    <label class="uk-button uk-button-secondary" type="submit" for="subirxd">Guardar</label>
</div>
    </div>
</div>


<!-- ****************************************************************************** -->


</main>'
?>