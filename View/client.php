<?php require ("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom">

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
                    <a href="#agregar_client" uk-toggle uk-tooltip="title:Añadir Proveedor; delay: 500">
                        <img class="btn_agg" src="static/images/btn_agg_cliente.png" alt="" width="40px">
                    </a>
                </div>

                <!-- ****************** Modal de registro ****************** -->

                <div id="agregar_client" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">REGISTRO CLIENTES</h3>
                        </div>
                        <div class="uk-modal-body">
                            <form class="uk-grid-small" uk-grid method="POST" action="Controller/funcs/agregar_cosas.php" enctype="multipart/form-data">
                            <input type="text" name="tipo" value='cliente' id="" style="display:none">
                            <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Nombre"  name="nombre" aria-label="100">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Apellido"  name="apellido" aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <select class="uk-select" id="form-stacked-select" name="documento" required>
                                        <option selected disabled>Documento</option>
                                        <option value="V">V</option>
                                        <option value="J">J</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="number" placeholder="cedula"  name="cedula"
                                        aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Telefono"  name="telefono"
                                        aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Dirección"  name="direccion"
                                        aria-label="50">
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

            </div>

        </article>

    </section>

    <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small uk-flex-center" uk-grid>
        <div class="container_marca_agua">
            <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
        </div>
        <div class="[email protected] uk-grid-large uk-flex-center height_controller" uk-grid uk-height-match="target: > div > .uk-card">
        
            <?php
                for ($i=0; $i < count($result); $i++) {
                    $row = $result[$i];
                    include 'complementos/tarjeta_cliente.php';
                }
            ?>

        </div>
    </section>


    <!-- ****************** Botones de paginacion ****************** -->
    
    <?php include ("../View/complementos/btn_pag.html"); ?>
</main>




<?php require("../View/complementos/footer.php"); ?>