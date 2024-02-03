<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-light">

            <?php if ($_SESSION['rol'] == 'Administrador') { ?>
    <div>
        <div>
            <div class="uk-flex uk-flex-middle uk-flex-between uk-flex-wrap uk-margin-small-bottom uk-light">
                <h2 class="uk-margin-remove">ADMINISTRAR PERFIL</h2>
                <div class="newUser uk-flex">
                    <a href="#register_user" uk-toggle
                        class="uk-button uk-button-link uk-flex uk-flex-middle uk-margin-medium-right">
                        <span uk-icon="plus" class="uk-icon uk-margin-small-right"></span>
                        <p class="uk-margin-remove">CREAR USUARIO</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
            <?php }; ?>

    <section class="container-item_profile uk-flex">

        <div class="item_profile-target">
            <div class="uk-margin">
                <img width="160px" src="static/images/undraw_profile.svg" alt="">
            </div>
            <div>
                <h3 class="uk-text-center "><?php echo $_SESSION['user_name']; ?></h3>
                <p class="uk-text-center uk-margin-remove-bottom"><?php echo $_SESSION['rol']; ?></p>
            </div>
        </div>

        <div class="item_profile-target-2">
            <ul class="switcherEdit" uk-tab uk-switcher>
                <li><a href="#">Perfil</a></li>
                <li><a href="#">Editar</a></li>
                <!-- <li><a href="#">Registro de actividad</a></li> -->
            </ul>

            <ul class="uk-switcher uk-margin">
                <li>
                    <h3>Acerca de</h3>
                    <p class="uk-article-meta uk-margin-small">Sistema de facturacion</p>

                    <div>
                        <h3>Detalles del perfil</h3>
                            <div class="uk-flex">
                                <p class="item-profile">Nombre </p><span class="uk-article-meta"> <?php echo $tu['nombre']; ?></span>
                            </div>
                        <?php 
                        
                        echo '
                            <div class="uk-flex">
                                <p class="item-profile">Correo</p><span class="uk-article-meta">'.$tu['correo'].'</span>
                            </div>
                            <div class="uk-flex">
                                <p class="item-profile uk-margin-remove-bottom">Tipo de usuario</p>
                                <span class="uk-article-meta">'.$_SESSION['rol'].'</span>
                            </div>';
                        ?>
                    </div>
                </li>
                <li>
                    <form class="uk-form-horizontal uk-margin-large" method="POST" action="Controller/funcs/modificar_cosas.php">
                        <input type=number value=<?php echo $tu['id']?> name="ID" style="display:none">
                        <input type=text value="usuario" name="tipo" style="display:none">
                        <input type=text value="zi" name="self" style="display:none">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" value="<?php echo $tu['nombre']?>"  type="text" placeholder="Nombre" name="nombre">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Correo</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" value="<?php echo $tu['correo']?>" name="correo" type="email" placeholder="Correo">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Contraseña</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" value="<?php echo $tu['password']?>" type="text"
                                    placeholder="Contraseña" name="password">
                            </div>
                        </div>

                        <div class="uk-margin-small-top uk-flex uk-flex-center">
                            <div>
                                <input class="uk-button uk-button-default" type="submit" value="Guardar">
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>

    </section>
    <?php if ($_SESSION['rol'] == 'Administrador') { ?>
    <section>
        <div class="uk-flex uk-flex-center uk-margin-medium-top">
            <h2>USUARIOS REGISTRADOS</h2>
        </div>
        <div class="uk-overflow-auto uk-light uk-margin-small-top">
            <table class="uk-table uk-table-small uk-table-divider uk-table-hover">
                <thead class="uk-background-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                    for ($i=0; $i < count($result); $i++) { 
                        $row = $result[$i];
                        require ('complementos/tabla_usuario.php');
                    }
                ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php }; ?>

     <!-- ************************************ Modal de registro ************************************ -->

     <div id="register_user" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">REGISTRO USUARIO</h2>
            </div>
            <div class="uk-modal-body ">
                <form class="uk-grid-small" uk-grid method="POST" action="./Controller/funcs/agregar_cosas.php">
                    <input type="text" name="tipo" value='usuarios' id="" style="display:none">
                    <div class="uk-width-1-2">
                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" pattern="^[A-Z][a-z0-9]{2,20}$" 
                            required>
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Apellido" aria-label="50" name="apellido" pattern="^[A-Z][a-z0-9]{2,20}$" >
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Correo Electronico" aria-label="100"
                            name="correo" parent="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" required>
                    </div>
                    <div class="uk-width-1-2@s">
                        <select class="uk-select" id="form-stacked-select" name="rol" required>
                            <option selected disabled>Tipo de usuario</option>
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>
                    <div class="uk-width-1-1@s">
                        <input class="uk-input" type="password" placeholder="Contraseña" aria-label="100" name="password" minlength="3" maxlength="50" required>
                    </div>
                    <input type="submit" id="subirC" style="display:none">
                </form>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <label class="uk-button uk-button-secondary" type="button" for="subirC">Guardar</label>
            </div>
        </div>
    </div>

    <!-- ************************************************************************************************************ -->

</main>


<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javaScript/ChangeColor.js"></script>


</body>
</html>  