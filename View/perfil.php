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
            <nav class="Breadcrumb" aria-label="Breadcrumb">
                <ul class="uk-breadcrumb uk-background-secondary profile-breadcrumb">
                    <li><a href="#">Inicio</a></li>
                    <li><span>Perfil</span></li>
                </ul>
            </nav>
        </div>
    </div>

    <section class="container-item_profile uk-flex">

        <div class="item_profile-target">
            <div class="uk-margin">
                <img width="160px" src="static/images/undraw_profile.svg" alt="">
            </div>
            <div>
                <h3 class="uk-text-center ">Nombre del usuario</h3>
                <p class="uk-text-center uk-margin-remove-bottom">Administrador</p>
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
                            <p class="item-profile">Nombre </p><span class="uk-article-meta">Nombre del usuario</span>
                        </div>
                        <div class="uk-flex">
                            <p class="item-profile">Correo</p><span class="uk-article-meta">correo@gmail.com</span>
                        </div>
                        <div class="uk-flex">
                            <p class="item-profile">Fecha de Registro</p><span class="uk-article-meta">20/11/2002</span>
                        </div>
                        <div class="uk-flex">
                            <p class="item-profile uk-margin-remove-bottom">Tipo de usuario</p><span
                                class="uk-article-meta">Usuario tal</span>
                        </div>
                    </div>
                </li>
                <li>
                    <form class="uk-form-horizontal uk-margin-large">

                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Apellido</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" placeholder="Apellido">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Correo</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="email" placeholder="Correo">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Contraseña</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="password"
                                    placeholder="Contraseña">
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
                    <?php for ($i=1; $i <= 5; $i++) { ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>Usuario</td>
                        <td>usuario@gmail.com</td>
                        <td>Administrador</td>
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- ************************************ Modal de registro ************************************ -->

    <div id="register_user" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">REGISTRO USUARIO</h2>
            </div>
            <div class="uk-modal-body ">
                <form class="uk-grid-small" uk-grid method="POST" action="../Controller/agregar_cosas.php">
                    <div class="uk-width-1-2">
                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="Nombre"
                            required>
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Apellido" aria-label="50" name="Apellido">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Correo Electronico" aria-label="100"
                            name="nombre" required>
                    </div>
                    <div class="uk-width-1-2@s">
                        <select class="uk-select" id="form-stacked-select" name="categoria" required>
                            <option selected disabled>Tipo de usuario</option>
                            <option>Dueño</option>
                            <option>Administrador</option>
                            <option>Cajero</option>
                        </select>
                    </div>
                    <div class="uk-width-1-1@s">
                        <input class="uk-input" type="password" placeholder="Contraseña" aria-label="100" name="nombre"
                            required>
                    </div>
                </form>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <button class="uk-button uk-button-secondary" type="submit">Guardar</button>
            </div>
        </div>
    </div>

    <!-- ************************************************************************************************************ -->


    <!-- ************************************ Modal de modificar ************************************ -->

    <div id="Update_user" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">EDITAR USUARIO</h2>
            </div>
            <div class="uk-modal-body ">
                <form class="uk-grid-small" uk-grid method="POST" action="../Controller/agregar_cosas.php">
                    <div class="uk-width-1-2">
                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="Nombre"
                            required>
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Apellido" aria-label="50" name="Apellido">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Correo Electronico" aria-label="100"
                            name="nombre" required>
                    </div>
                    <div class="uk-width-1-2@s">
                        <select class="uk-select" id="form-stacked-select" name="categoria" required>
                            <option selected disabled>Tipo de usuario</option>
                            <option>Dueño</option>
                            <option>Administrador</option>
                            <option>Cajero</option>
                        </select>
                    </div>
                    <div class="uk-width-1-1@s">
                        <input class="uk-input" type="password" placeholder="Contraseña" aria-label="100" name="nombre"
                            required>
                    </div>
                </form>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <button class="uk-button uk-button-secondary" type="submit">Guardar</button>
            </div>
        </div>
    </div>

    <!-- ************************************************************************************************************ -->

    <!-- **************************Modal de confirmacion de eliminacion************************** -->

    <div id="eliminar_user" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">

            <div class="uk-modal-header uk-flex uk-flex-middle">
                <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
            </div>
            <div class="uk-modal-body">
                <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <button class="uk-button uk-button-secondary" type="button">Aceptar</button>
            </div>
        </div>
    </div>


    <!-- ****************************************************************************** -->


</main>

<?php require("../View/complementos/footer.php"); ?>