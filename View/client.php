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
                            <input type="text" name="tipo" value='Cliente' id="" style="display:none">
                            <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Nombre" aria-label="100">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Apellido" aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <select class="uk-select" id="form-stacked-select" name="Documento" required>
                                        <option selected disabled>Documento</option>
                                        <option>V</option>
                                        <option>J</option>
                                        <option>E</option>
                                    </select>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="cedula"
                                        aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Telefono"
                                        aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Dirección"
                                        aria-label="50">
                                </div>
                                <input type="submit" id="subirC" style="display:none">
                            </form>
                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                                <label class="uk-button uk-button-secondary" type="button" for="subirC">Guardar</label>
                            </div>
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
        <div class="[email protected] uk-grid-large uk-flex-center height_controller" uk-grid uk-height-match="target: > div > .uk-card">
        
            <?php
                for ($i=0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    include 'complementos/tarjeta_cliente.php';
                }
            ?>

        </div>
    </section>


    <!-- ****************** Botones de paginacion ****************** -->
    
    <?php include ("../View/complementos/btn_pag.html"); ?>
</main>




<?php require("../View/complementos/footer.php"); ?>