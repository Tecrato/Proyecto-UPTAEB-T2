<?php require ("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding">

    <section class="uk-flex uk-flex-center">

        <article class="uk-flex uk-flex-around cont-search uk-flex-middle uk-background-secondary Section-search">

            <div class="Section-search">
                <div class="uk-flex uk-flex-center uk-flex-middle">
                    <div class="uk-light">
                        <form class="uk-search uk-search-default">
                            <span uk-search-icon></span>
                            <input class="uk-search-input form-search uk-border-rounded" type="search"
                                placeholder="Buscar" aria-label="Search">
                        </form>
                    </div>
                </div>
            </div>

            <div class="uk-flex uk-flex-center uk-flex-middle Options-nav">

                <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-right">
                    <a href="#register_supplier" uk-toggle uk-tooltip="title:Añadir Proveedor; delay: 500">
                        <img class="btn_agg" src="static/images/btn_agg_proveedor.png" alt="" width="40px">
                    </a>
                </div>

                <!-- ****************** Modal de registro ****************** -->

                <div id="register_supplier" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Registro de proveedores</h3>
                        </div>
                        <div class="uk-modal-body">
                            <form class="uk-grid-small" uk-grid method="POST"
                                action="Controller/funcs/agregar_cosas.php">
                                <input type="text" name="tipo" value='proveedor' id="" style="display:none">
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Nombre" aria-label="100"
                                        name="nombre" requierd>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Razon Social" aria-label="100"
                                        name="razon_social">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Rif" aria-label="50" name="rif"
                                        value="j-00000000">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="number" minlength="9" placeholder="Número de teléfono"
                                        aria-label="50" name="telefono" required>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="email" placeholder="Correo electrónico"
                                        aria-label="25" name="correo" required>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Dirección" aria-label="25"
                                        name="direccion">
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

        </article>

    </section>

    <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small uk-flex-center" uk-grid>
        <div class="container_marca_agua invisible">
            <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
        </div>
        <div class="[email protected] uk-grid-medium uk-flex-center height_controller" uk-grid uk-height-match="target: > div > .uk-card">
           
            <?php
            for ($i=0; $i < count($result); $i++) { 
                $row = $result[$i];
                require 'complementos/tarjeta_proveedor.php';
            }
        ?>
        </div>
    </section>
</main>

<?php include ("../View/complementos/btn_pag.html"); ?>

<?php require("../View/complementos/footer.php"); ?>