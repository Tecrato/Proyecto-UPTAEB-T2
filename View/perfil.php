<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-light">

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
                    
                    <a href="#" class="uk-button uk-button-link uk-flex uk-flex-middle">
                        <span uk-icon="history" class="uk-icon uk-margin-small-right"></span>
                        <p class="uk-margin-remove">ACTIDADAD DEL SISTEMA</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

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
                <li><a href="#">Registro de actividad</a></li>
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
                <li>
                    <section>
                        <div class="uk-overflow-auto uk-light uk-margin-small-top">
                            <table class="uk-table uk-table-small uk-table-divider uk-table-hover">
                                <thead class="uk-background-secondary">
                                    <tr>
                                        <th>ACTIVIDAD</th>
                                        <th>FECHA</th>
                                        <th>HORA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i=1; $i <= 5; $i++) { ?>
                                    <tr>
                                        <td>REGISTRO DE PRODUCTO</td>
                                        <td>10/11/2023</td>
                                        <td>10:55 AM</td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>

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

</main>


<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javascript/FuncionesGenerales.js"></script>

</body>
</html>  