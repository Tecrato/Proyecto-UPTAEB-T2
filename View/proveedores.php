<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding">

    <section class="uk-background-secondary uk-padding uk-border-rounded uk-light" uk-filter="target: .js-filter">
        <div>
            <div class="uk-flex uk-flex-between" style="align-items: baseline;">
                <div class="uk-flex uk-flex-wrap" style="align-items: baseline;">
                    <div class="uk-margin-right">
                        <div class="uk-flex uk-flex-wrap">
                            <div class="uk-margin formDelete">
                                <form class="uk-search uk-search-default search-responsive-product">
                                    <span class="uk-search-icon-flip" uk-search-icon></span>
                                    <input class="uk-search-input" type="search" placeholder="Buscar" aria-label="Search">
                                </form>
                            </div>
                            <div class="uk-margin-left">
                                <a href="#register_supplier" uk-toggle uk-tooltip="title:Añadir Proveedor; delay: 500" class="uk-margin-small-left">
                                    <img class="btn_agg" src="./static/images/btn_agg.png" alt="" width="35px">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav filter_product" uk-margin>
                            <li class="uk-active" uk-filter-control><a href="#">TODO</a></li>
                            <li>
                                <a href="#">CATEGORIA <span uk-drop-parent-icon></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li uk-filter-control="filter: [data-color='white']; group: data-color"><a href="#">White</a></li>
                                        <li uk-filter-control="filter: [data-color='blue']; group: data-color"><a href="#">Blue</a></li>
                                        <li uk-filter-control="filter: [data-color='black']; group: data-color"><a href="#">Black</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">PROVEEDOR <span uk-drop-parent-icon></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li uk-filter-control="filter: [data-size='small']; group: size"><a href="#">Small</a></li>
                                        <li uk-filter-control="filter: [data-size='medium']; group: size"><a href="#">Medium</a></li>
                                        <li uk-filter-control="filter: [data-size='large']; group: size"><a href="#">Large</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">MARCA <span uk-drop-parent-icon></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li uk-filter-control="filter: [data-size='small']; group: size"><a href="#">Small</a></li>
                                        <li uk-filter-control="filter: [data-size='medium']; group: size"><a href="#">Medium</a></li>
                                        <li uk-filter-control="filter: [data-size='large']; group: size"><a href="#">Large</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">PRESENTACION <span uk-drop-parent-icon></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li uk-filter-control="filter: [data-size='small']; group: size"><a href="#">Small</a></li>
                                        <li uk-filter-control="filter: [data-size='medium']; group: size"><a href="#">Medium</a></li>
                                        <li uk-filter-control="filter: [data-size='large']; group: size"><a href="#">Large</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav> -->
                </div>

                <div class="uk-flex uk-margin-left container-view-order">
                    <div class="uk-margin-right">
                        <span class="uk-icon-link" id="list" uk-icon="icon: list; ratio: 1.3" style="cursor: pointer;"></span>
                    </div>
                    <div class="uk-width-auto uk-text-nowrap flechas">
                        <span class="uk-active" uk-filter-control="sort: data-name"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-down" aria-label="Sort ascending"></a></span>
                        <span uk-filter-control="sort: data-name; order: desc"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-up" aria-label="Sort descending"></a></span>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">


            <div>
                <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small dataTable" uk-grid>
                    <div class="container_marca_agua invisible">
                        <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
                    </div>
                    <div class="[email protected] uk-grid-medium uk-flex-center dataTable2 height_controller" uk-grid uk-height-match="target: > div > .uk-card">
                        <?php
                        for ($i = 0; $i < count($result); $i++) {
                            $row = $result[$i];
                            require 'complementos/tarjeta_proveedor.php';
                        }
                        ?>
                    </div>
                </section>
                <div class="uk-flex uk-flex-center">
                    <ul class="uk-pagination uk-margin-large-top">
                        <li><a class="pag-btn-proveedores" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                        <li><a class="pag-btn-proveedores" data-direccion="back">Previous</a></li>
                        <li><a class="pag-btn-proveedores" data-direccion="next">Next</a></li>
                        <li><a class="pag-btn-proveedores" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- ****************** Modal de registro ****************** -->

        <div id="register_supplier" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h3 class="uk-modal-title">Registro de proveedores</h3>
                </div>
                <div class="uk-modal-body">
                    <form class="uk-grid-small" uk-grid method="POST" action="Controller/funcs/agregar_cosas.php">
                        <input type="text" name="tipo" value='proveedor' id="" style="display:none">
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" pattern="^([A-Z]+){1}[a-z]{2,5}$" required>
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" placeholder="Razon Social" aria-label="100" name="razon_social" pattern="^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$" required>
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" placeholder="Rif" aria-label="50" name="rif" pattern="^[VJEGP][\d]{9}$" value="j-00000000" required>
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="number" minlength="9" placeholder="Número de teléfono" aria-label="50" name="telefono" pattern="^\+([0-9]{2})\s-([0-9]{7,9})$" required>
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="email" placeholder="Correo electrónico" aria-label="25" name="correo" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" required>
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" placeholder="Dirección" aria-label="25" name="direccion" pattern="^(\w{5,7})\s([0-9]{1,2}) entre (\w{5,7})\s([0-9]{1,2}) y (\w{5,7})\s([0-9]{1,2})$" required>
                        </div>
                        <input type="submit" id="subirxd" style="display:none" required>
                    </form>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <label class="uk-button uk-button-secondary" type="submit" for="subirxd">Guardar</label>
                </div>
            </div>
        </div>

    </section>


</main>



<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javascript/FuncionesGenerales.js"></script>

<script>
    $('.pag-btn-proveedores').click(ele => {
        cambiar_pagina_php(ele.target.dataset['direccion'], 'proveedores', 9)
    })
</script>

</body>

</html>