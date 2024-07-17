<?php require("../View/complementos/header.php"); ?>
<main class="Bg-Main-home2 uk-padding uk-light">

    <div class="uk-child-width-1-1@s" uk-grid>
        <div>
            <div uk-grid>
                <div class="uk-width-auto@m">
                    <ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                        <li style="padding-bottom: 20px;">
                            <a id="aUser" href="#">
                                <span class="uk-margin-small-right" uk-icon="user"></span> USUARIO
                            </a>
                        </li>
                        <li style="padding-bottom: 20px;">
                            <a id="aBinnacle" href="#">
                                <span class="uk-margin-small-right" uk-icon="history"></span> BITACORA
                            </a>
                        </li>
                        <?php if ($_SESSION['rol_num'] <= 1) { ?>
                            <li style="padding-bottom: 20px;">
                                <a id="aCapital" href="#">
                                    <span class="uk-margin-small-right" uk-icon="credit-card"></span>CAPITAL
                                </a>
                            </li>
                            <script src="static/javaScript/Ajax/capital.js" defer></script>
                        <?php }; ?>
                        <li>
                            <a id="aSets" href="#">
                                <span class="uk-margin-small-right" uk-icon="cog"></span>AJUSTES
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="uk-width-expand@m">
                    <div id="component-tab-left" class="uk-switcher">

                        <div>

                            <div class="uk-child-width-1-1@s" uk-grid>
                                <div>
                                    <div uk-grid>
                                        <div class="uk-width-auto@m">
                                            <ul class="uk-tab-left" uk-tab="connect: #component-tab-user; animation: uk-animation-fade">
                                                <li>
                                                    <a href="#">
                                                        <span class="uk-margin-small-right" uk-icon="users"></span>USUARIO
                                                    </a>
                                                </li>
                                                <?php if ($_SESSION['rol_num'] <= 1) { ?>
                                                    <li>
                                                        <a href="#">
                                                            <span class="uk-margin-small-right" uk-icon="settings"></span>ROLES Y FUNCIONES
                                                        </a>
                                                    </li>
                                                <?php }; ?>
                                            </ul>
                                        </div>
                                        <div class="uk-width-expand@m">
                                            <div id="component-tab-user" class="uk-switcher">
                                                <li>
                                                    <?php if ($_SESSION['rol_num'] <= 2) { ?>
                                                        <div>
                                                            <div>
                                                                <div class="uk-flex uk-flex-middle uk-flex-between uk-flex-wrap uk-margin-small-bottom uk-light">
                                                                    <h2 class="uk-margin-remove">ADMINISTRAR PERFIL</h2>
                                                                    <div class="newUser uk-flex">
                                                                        <a id="btnRegisterUser" href="#register_user" uk-toggle class="uk-button uk-button-default uk-flex uk-flex-middle uk-border-rounded">
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
                                                        <p class="item-profile">Correo</p><span class="uk-article-meta">' . $tu['correo'] . '</span>
                                                    </div>
                                                    <div class="uk-flex">
                                                        <p class="item-profile uk-margin-remove-bottom">Tipo de usuario</p>
                                                        <span class="uk-article-meta">' . $_SESSION['rol'] . '</span>
                                                    </div>';
                                                                        ?>
                                                                        <div id="seedGenerator" class="uk-flex uk-margin-top">
                                                                            <p class="item-profile">Semilla</p>
                                                                            <span id="inpSeed" class="uk-article-meta uk-flex">
                                                                                <input class="uk-input uk-form-small uk-form-width-medium uk-border-rounded input-seed" value="<?= $tu['semilla'] ?>" type="text">
                                                                                <a>
                                                                                    <span id="seedInfo" class="uk-margin-small-left" uk-icon="icon: info; ratio: 1.2"></span>
                                                                                </a>
                                                                            </span>
                                                                        </div>
                                                                        <div id="" class="uk-flex uk-margin-top">
                                                                            <p class="item-profile">Semilla</p>
                                                                            <span id="inpSeed" class="uk-article-meta uk-flex">
                                                                                <input class="uk-input uk-form-small uk-form-width-medium uk-border-rounded input-seed" value="<?= $tu['semilla'] ?>" type="text">
                                                                                <a>
                                                                                    <span id="seedInfo" class="uk-margin-small-left" uk-icon="icon: refresh; ratio: 1.2"></span>
                                                                                </a>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <form class="uk-form-horizontal uk-margin-large" method="POST" action="Controller/funcs/modificar_cosas.php">
                                                                        <input type=number value=<?php echo $tu['id'] ?> name="ID" style="display:none">
                                                                        <input type=text value="usuario" name="tipo" style="display:none">
                                                                        <input type=text value="zi" name="self" style="display:none">
                                                                        <div class="uk-margin">
                                                                            <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                                                                            <div class="uk-form-controls">
                                                                                <input class="uk-input" value="<?php echo $tu['nombre'] ?>" type="text" placeholder="Nombre" name="nombre">
                                                                            </div>
                                                                        </div>
                                                                        <div class="uk-margin">
                                                                            <label class="uk-form-label" for="form-horizontal-text">Correo</label>
                                                                            <div class="uk-form-controls">
                                                                                <input class="uk-input" value="<?php echo $tu['correo'] ?>" name="correo" type="email" placeholder="Correo">
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
                                                    <?php if ($_SESSION['rol_num'] <= 1) { ?>
                                                        <section id="tableUsers">
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

                                                                        for ($i = 0; $i < count($result); $i++) {
                                                                            $row = $result[$i];
                                                                            require('complementos/tabla_usuario.php');
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </section>
                                                    <?php }; ?>
                                                </li>
                                                <?php if ($_SESSION['rol_num'] <= 1) { ?>



                                                    <li>
                                                        <section uk-filter="target: .js-filter; animation: fade">
                                                            <h3>PERMISOS DE MODULOS</h3>
                                                            <div class="uk-flex uk-flex-middle">
                                                                <a href="#modal_asignar_rol" uk-toggle class="uk-button uk-button-default uk-margin-medium-right">ASIGNAR MODULO</a>
                                                                <nav uk-dropnav="mode: click" class="uk-flex-middle">
                                                                    <ul class="uk-subnav">
                                                                        <li>
                                                                            <a href>Tipo de permiso <span uk-drop-parent-icon></span></a>
                                                                            <div class="uk-dropdown">
                                                                                <ul class="uk-nav uk-dropdown-nav">
                                                                                    <li uk-filter-control><a href="#">Todo</a></li>
                                                                                    <li uk-filter-control="[data-tp='agregar']"><a href="#">Registrar</a></li>
                                                                                    <li uk-filter-control="[data-tp='modificar']"><a href="#">Modificar</a></li>
                                                                                    <li uk-filter-control="[data-tp='eliminar']"><a href="#">Eliminar</a></li>
                                                                                    <li uk-filter-control="[data-tp='imprimir']"><a href="#">Imprimir</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                            <table class="uk-table uk-table-hover uk-table-divider uk-light uk-table-responsive">
                                                                <thead class="uk-background-secondary">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>USUARIO</th>
                                                                        <th>MODULO</th>
                                                                        <th>PERMISO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="js-filter" id="table-rol">


                                                                </tbody>
                                                            </table>
                                                        </section>



                                                    <?php }; ?>

                                                    <!--******************* MODAL DE ASIGNAR ROL *******************-->

                                                    <div id="modal_asignar_rol" class="uk-modal-container" uk-modal>
                                                        <div class="uk-modal-dialog">
                                                            <button class="uk-modal-close-default" type="button" uk-close></button>
                                                            <div class="uk-modal-header">
                                                                <h2 class="uk-modal-title">PERMISOS</h2>
                                                            </div>
                                                            <div class="uk-modal-body">
                                                                <form class="uk-grid-small uk-form-stacked" uk-grid>
                                                                    <div class="uk-width-1-1@s">
                                                                        <label class="uk-form-label" for="form-stacked-text">Usuario</label>
                                                                        <div class="uk-form-controls">
                                                                            <select class="uk-select select-user-rol" name="" id="">
                                                                                <!-- Las opciones se agregarán dinámicamente -->
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-1-1@s">
                                                                        <label class="uk-form-label" for="form-stacked-text">PERMISOS POR MODULO</label>
                                                                        <div class="uk-form-controls">
                                                                            <table class="uk-table uk-table-striped uk-table-responsive table_permisos">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>MODULO</th>
                                                                                        <th>AGREGAR</th>
                                                                                        <th>MODIFICAR</th>
                                                                                        <th>ELIMINAR</th>
                                                                                        <th>IMPRIMIR</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>PRODUCTOS</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="productos_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="productos_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="modificar" name="productos_modificar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="modificar" name="productos_modificar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="eliminar" name="productos_eliminar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="eliminar" name="productos_eliminar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="imprimir" name="productos_imprimir" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="imprimir" name="productos_imprimir" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td>UNIDADES</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="unidades_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="unidades_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="modificar" name="unidades_modificar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="modificar" name="unidades_modificar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="eliminar" name="unidades_eliminar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="eliminar" name="unidades_eliminar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>CATEGORIAS</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="categorias_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="categorias_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="modificar" name="categorias_modificar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="modificar" name="categorias_modificar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="eliminar" name="categorias_eliminar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="eliminar" name="categorias_eliminar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>MARCAS</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="marcas_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="marcas_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="modificar" name="marcas_modificar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="modificar" name="marcas_modificar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="eliminar" name="marcas_eliminar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="eliminar" name="marcas_eliminar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td>PROVEEDORES</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="proveedores_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="proveedores_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="modificar" name="proveedores_modificar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="modificar" name="proveedores_modificar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="eliminar" name="proveedores_eliminar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="eliminar" name="proveedores_eliminar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>CLIENTES</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="clientes_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="clientes_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="modificar" name="clientes_modificar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="modificar" name="clientes_modificar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="eliminar" name="clientes_eliminar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="eliminar" name="clientes_eliminar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>VENTAS</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="registro_venta_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="registro_venta_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="imprimir" name="ventas_imprimir" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="imprimir" name="ventas_imprimir" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>CREDITO</td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="agregar" name="credito_agregar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="agregar" name="credito_agregar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <label for=""><input class="uk-radio" accion="modificar" name="credito_modificar" value="Si" type="radio"> Si</label>
                                                                                                <label for=""><input class="uk-radio radio_no" accion="modificar" name="credito_modificar" value="No" type="radio"> No</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td></td>

                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--******************* ******************** *******************-->


                                                    </li>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>


                        <div>
                            <ul uk-tab>
                                <li><a href="#">REGISTRO DE USUARIO</a></li>
                                <?php if ($_SESSION['rol_num'] <= 2) { ?>
                                    <li><a href="#">REGISTRO DE SISTEMA</a></li>
                                <?php }; ?>
                            </ul>

                            <div class="uk-switcher uk-margin">
                                <div>
                                    <section>
                                        <div class="uk-overflow-auto uk-light uk-margin-small-top">
                                            <table class="uk-table uk-table-small uk-table-divider uk-table-hover uk-light">
                                                <thead class="uk-background-secondary">
                                                    <tr>
                                                        <th>ACTIVIDAD</th>
                                                        <th>FECHA</th>
                                                        <th>HORA</th>
                                                        <th>TABLA AFECTADA</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="registerActv">

                                                </tbody>
                                            </table>
                                            <div class="uk-flex uk-flex-center">
                                                <ul class="uk-pagination uk-margin-large-top">
                                                    <li><a class="pag-btn-bitacora-personal" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                                                    <li><a class="pag-btn-bitacora-personal" data-direccion="back">Previous</a></li>
                                                    <li><a class="pag-btn-bitacora-personal" data-direccion="next">Next</a></li>
                                                    <li><a class="pag-btn-bitacora-personal" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div>
                                    <section>
                                        <div class="uk-overflow-auto uk-light uk-margin-small-top">
                                            <table class="uk-table uk-table-small uk-table-divider uk-table-hover uk-light">
                                                <thead class="uk-background-secondary">
                                                    <tr>
                                                        <th>USUARIO</th>
                                                        <th>ACTIVIDAD</th>
                                                        <th>FECHA</th>
                                                        <th>HORA</th>
                                                        <th>TABLA AFECTADA</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="registerSystem">

                                                </tbody>
                                            </table>
                                            <div class="uk-flex uk-flex-center">
                                                <ul class="uk-pagination uk-margin-large-top">
                                                    <li><a class="pag-btn-bitacora-general" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                                                    <li><a class="pag-btn-bitacora-general" data-direccion="back">Previous</a></li>
                                                    <li><a class="pag-btn-bitacora-general" data-direccion="next">Next</a></li>
                                                    <li><a class="pag-btn-bitacora-general" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>


                        <?php if ($_SESSION['rol_num'] <= 1) { ?>

                            <div>
                                <section class="uk-flex uk-flex-around uk-flex-wrap uk-padding-small uk-border-rounded" style="border: 1px solid #555;">
                                    <article>
                                        <div>
                                            <form id="FormCapital" class="uk-form-stacked">
                                                <input type="hidden" name="tipo" value="capital">
                                                <div class="uk-margin">
                                                    <label class="uk-form-label" for="form-stacked-text">Monto</label>
                                                    <div class="uk-form-controls">
                                                        <input class="uk-input uk-border-rounded" id="form-stacked-text" type="number" step="0.01" name="monto" placeholder="0.00">
                                                    </div>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label" for="form-stacked-text">Descripcion</label>
                                                    <div class="uk-form-controls">
                                                        <textarea class="uk-textarea uk-border-rounded" rows="5" column="10" name="descripcion" id=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="uk-margin uk-flex uk-flex-around">
                                                    <button class="uk-button uk-button-default uk-border-rounded" type="submit" name="action" value="ingreso">GUARDAR INGRESO</button>
                                                    <button class="uk-button uk-button-danger uk-border-rounded" type="submit" name="action" value="gasto">GUARDAR GASTO</button>
                                                </div>
                                            </form>
                                        </div>
                                    </article>
                                    <article id="detallesCapital" class="uk-flex uk-flex-middle cont_item-CAPITAL uk-flex-around uk-width-2xlarge uk-flex-wrap">
                                        <div class="uk-flex uk-flex-column uk-flex-middle">
                                            <h5>INGRESOS</h5>
                                            <div class="item_capital" style="background-color: #007D35">
                                                0.00
                                            </div>
                                        </div>
                                        <div class="uk-flex uk-flex-column uk-flex-middle">
                                            <h5>VENTAS</h5>
                                            <div class="item_capital" style="background-color: #aaa;">
                                                0.00
                                            </div>
                                        </div>
                                        <div class="uk-flex uk-flex-column uk-flex-middle">
                                            <h5>GASTOS</h5>
                                            <div class="item_capital" style="background-color: #f0506e;">
                                                0.00
                                            </div>
                                        </div>
                                        <div class="uk-flex uk-flex-column uk-flex-middle">
                                            <h5>UTILIDAD NETA</h5>
                                            <div class="item_capital uk-font-bold" style="background-color: #9800b3;">
                                                0.00
                                            </div>
                                        </div>
                                    </article>
                                </section>
                                <section class="uk-margin-medium-top uk-padding-small uk-border-rounded" uk-filter="target: .js-filter; animation: fade" style="border: 1px solid #555;">
                                    <div class="uk-flex uk-flex-middle">
                                        <h2 class="uk-margin-medium-right">MOVIMIENTOS DE CAPITAL</h2>
                                        <nav uk-dropnav="mode: click">
                                            <ul class="uk-subnav">
                                                <li>
                                                    <a href>Tipo de movimiento <span uk-drop-parent-icon></span></a>
                                                    <div class="uk-dropdown">
                                                        <ul class="uk-nav uk-dropdown-nav">
                                                            <li uk-filter-control><a href="#">Todo</a></li>
                                                            <li uk-filter-control="[data-tm='Ingresos']"><a href="#">Ingresos</a></li>
                                                            <li uk-filter-control="[data-tm='Egresos']"><a href="#">Egresos</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <table class="uk-table uk-table-hover uk-table-divider">
                                        <thead class="uk-background-secondary">
                                            <tr>
                                                <th>#</th>
                                                <th>DESCRIPCION</th>
                                                <th>MONTO</th>
                                                <th>FECHA</th>
                                            </tr>
                                        </thead>
                                        <tbody class="js-filter" id="tableCapital">
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="uk-flex uk-flex-center">
                                        <ul class="uk-pagination uk-pagination2">
                                            <li><a class="pag-btn-movimiento-capital" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                                            <li><a class="pag-btn-movimiento-capital" data-direccion="back">Previous</a></li>
                                            <li><a class="pag-btn-movimiento-capital" data-direccion="next">Next</a></li>
                                            <li><a class="pag-btn-movimiento-capital" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                                        </ul>
                                    </div>
                                </section>
                            </div>

                        <?php }; ?>


                        <div>
                            <div class="uk-child-width-1-1@s" uk-grid>
                                <div>
                                    <div uk-grid>
                                        <div class="uk-width-auto@m">
                                            <ul class="uk-tab-left" uk-tab="connect: #component-tab-leftt; animation: uk-animation-fade">
                                                <li><a href="#">MONEDA</a></li>
                                                <?php if ($_SESSION['rol_num'] <= 1) { ?>
                                                    <li><a href="#">METODOS DE PAGO</a></li>

                                                    <script src="static/javaScript/Ajax/metodo_pago.js" defer></script>
                                                <?php }; ?>
                                            </ul>
                                        </div>
                                        <div class="uk-width-expand@m">
                                            <div id="component-tab-leftt" class="uk-switcher">
                                                <li class="uk-background-secondary uk-padding uk-border-rounded">
                                                    <div class="uk-flex uk-flex-between uk-flex-bottom">
                                                        <div>
                                                            <h3>PRECIO DEL DOLAR</h3>
                                                            <form id="form_dolar">
                                                                <section class="uk-flex uk-flex-middle uk-flex-wrap">
                                                                    <article class="uk-margin-right">
                                                                        <label for="">DOLAR</label>
                                                                    </article>
                                                                    <article>
                                                                        <input class="uk-input" type="number" step="0.01" name="valor">
                                                                        <input type="hidden" name="llave" value="dolar">
                                                                        <input type="hidden" name="tipo" value="configuraciones">
                                                                    </article>
                                                                    <article class="uk-margin-left">
                                                                        <button class="uk-button uk-button-default" type="submit">GUARDAR</button>
                                                                    </article>
                                                                </section>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <button class="uk-button uk-button-default btn-update-dolar">ACTUALIZAR</button>
                                                        </div>
                                                    </div>

                                                    <section class="uk-flex uk-flex-around uk-flex-wrap uk-margin-medium-top" style="width: 100%;">
                                                        <article class="uk-padding uk-margin-small uk-border-rounded" style="background-color: #333; width: 20%;">
                                                            <div>
                                                                <h4 class="uk-text-center">TASA ACTUAL</h4>
                                                                <h4 id="DOLAR_DB" class="uk-text-center">38.00 BS</h4>
                                                                <img src="./static/images/logo_letras-minimarket.png" alt="" style="width: 100%; min-width: 50%;">
                                                            </div>
                                                        </article>
                                                        <article class="uk-padding uk-margin-small uk-border-rounded" style="background-color: #333; width: 20%;">
                                                            <div>
                                                                <h4 class="uk-text-center">TASA BCV</h4>
                                                                <h4 id="BCV_actual" class="uk-text-center">37.00 BS</h4>
                                                                <img src="./static/images/bcv2.png" alt="" style="width: 100%; min-width: 50%;">
                                                            </div>
                                                        </article>
                                                    </section>
                                                </li>


                                                <?php if ($_SESSION['rol_num'] <= 1) { ?>
                                                    <li>
                                                        <div class="uk-flex uk-flex-between uk-flex-middle">
                                                            <div>
                                                                <h2>Metodos de pago</h2>
                                                                <h4>Modos de transacción para los pagos</h4>
                                                            </div>
                                                            <a href="#modal-metodo_pago" uk-toggle class="uk-button uk-button-default btnAggMetodo">
                                                                <span uk-icon="icon: plus;"></span>AGREGAR</a>
                                                        </div>

                                                        <!-- ***************** MODAL DE REGISTRO ***************** -->

                                                        <div class="uk-flex-top" id="modal-metodo_pago" uk-modal>
                                                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                                                <div class="uk-modal-header">
                                                                    <h2 class="uk-modal-title titleModalmetodos">REGISTRAR METODO DE PAGO</h2>
                                                                </div>
                                                                <div class="uk-modal-body">
                                                                    <form id="FORM_METODO_PAGO" class="uk-form-horizontal uk-margin-large">
                                                                        <input type="text" name="tipo" value='metodo_pago' style="display:none">
                                                                        <input id="inputIdMetodo" type="text" name="ID" style="display:none">
                                                                        <div class="uk-margin">
                                                                            <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                                                                            <div class="uk-form-controls">
                                                                                <input class="uk-input inputUpdateMetodo" name="nombre" id="form-horizontal-text" type="text" placeholder="Nombre">
                                                                            </div>
                                                                        </div>
                                                                        <input id="Send" type="submit" style="display: none;">
                                                                    </form>
                                                                </div>
                                                                <div class="uk-modal-footer uk-text-right">
                                                                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                                                                    <label class="uk-button uk-button-secondary" for="Send">Guardar</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- **************************Modal de confirmacion de eliminacion************************** -->

                                                        <div id="eliminar_metodo" class="uk-flex-top" uk-modal>
                                                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                                                <div class="uk-modal-header uk-flex uk-flex-middle">
                                                                    <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                                                                    <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
                                                                </div>
                                                                <div class="uk-modal-body">
                                                                    <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
                                                                </div>
                                                                <div class="uk-modal-footer uk-text-right">
                                                                    <form id="formDeleteMetodo" action="" method="POST">
                                                                        <input type=number id="IdDelete_Metodo" name="ID" style="display:none">
                                                                        <input type=text value="metodo_pago" name="tipo" style="display:none">
                                                                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                                                                        <button class="uk-button uk-button-secondary" type="submit">Aceptar</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <table class="uk-table uk-table-divider uk-table-middle">
                                                            <thead class="uk-background-secondary">
                                                                <tr>
                                                                    <th></th>
                                                                    <th>#</th>
                                                                    <th>Metodo</th>
                                                                    <th>Accion</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="Metodo-Pago-Table">


                                                            </tbody>
                                                        </table>
                                                    </li>

                                                <?php }; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- ************************************ Modal de registro ************************************ -->

    <div id="register_user" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">REGISTRO USUARIO</h2>
            </div>
            <div class="uk-modal-body ">
                <form class="uk-grid-small uk-form-stacked" uk-grid method="POST" action="./Controller/funcs/agregar_cosas.php">
                    <input type="text" name="tipo" value='usuarios' id="" style="display:none">
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label">Nombre</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label">Apellido</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" placeholder="Apellido" aria-label="50" name="apellido" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$">
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label">Correo Electronico</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="email" placeholder="Correo Electronico" aria-label="100" name="correo" pattern="^([A-Za-z0-9\.\_]+)@([\w]{3,8})\.([\w]{2,3})(\.[\w]{2,4})?(\.[\w]{2,3})?$" required>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label">Tipo de usuario</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="form-stacked-select" name="rol" required>
                                <option selected disabled>Tipo de usuario</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-1-1@s">
                        <label class="uk-form-label">Contraseña</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="password" placeholder="Contraseña" aria-label="100" name="password" minlength="8" maxlength="50" pattern="^[\w\S]{8,}$" required>
                        </div>
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



<script src="static/javaScript/Roles.js" defer></script>

<script src="static/javaScript/Ajax/RegisterUser.js" defer></script>
<script src="static/javaScript/Ajax/user.js" defer></script>



</body>

</html>