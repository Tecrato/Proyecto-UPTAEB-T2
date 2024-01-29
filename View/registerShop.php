<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom">

    <section id="Container-modal-full" class="uk-background-secondary uk-padding uk-border-rounded" uk-filter="target: .js-filter">
        <div>
            <div class="uk-flex uk-flex-between" style="align-items: baseline;">
                <div class="uk-flex uk-flex-wrap" style="align-items: baseline;">
                    <div class="uk-margin-right">
                        <div class="uk-flex" style="height: 50px;">
                            <div class="uk-margin formDelete uk-light">
                                <form class="uk-search uk-search-default uk-light">
                                    <span class="uk-search-icon-flip uk-light" uk-search-icon></span>
                                    <input class="uk-search-input uk-light" type="search" placeholder="Buscar" aria-label="Search">
                                </form>
                            </div>
                            <div class="uk-margin-left uk-light">
                                <a href="Detalles_factura" uk-icon="icon: print; ratio: 1.5" uk-tooltip="title:Imprimir Facturas; delay: 500"></a>
                                <a href="#modal-full" uk-toggle uk-tooltip="title:Añadir Factura; delay: 500" class="uk-margin-small-left">
                                    <img class="btn_agg" src="./static/images/btn_agg_factura2.png" alt="" width="35px">
                                </a>
                            </div>
                            <nav uk-dropnav="mode: click">
                                <ul class="uk-subnav uk-margin-remove">
                                    <li>
                                        <div class="">
                                            <a href="" class="uk-icon-link icon-filter" uk-icon="icon: filter; ratio: 1.7"></a>
                                        </div>
                                        <div class="uk-dropdown uk-border-rounded">
                                            <ul class="uk-nav uk-dropdown-nav uk-border-rounded">
                                                <li class="uk-margin-small-bottom uk-text-center"><strong>FILTRAR</strong></li>
                                                <li>
                                                    <div class="">
                                                        <form>
                                                            <div class="uk-margin-small-top">
                                                                <div class="uk-flex uk-flex-middle uk-margin-small-top">
                                                                    <span class="uk-margin-small-right uk-text-bold">De</span>
                                                                    <input class="uk-input" type="date" placeholder="100" aria-label="100">
                                                                </div>
                                                                <div class="uk-flex uk-flex-middle uk-margin-top">
                                                                    <span class="uk-margin-small-right uk-text-bold">Hasta</span>
                                                                    <input class="uk-input" type="date" placeholder="100" aria-label="100">
                                                                </div>
                                                            </div>
                                                            <div class="uk-margin-top">
                                                                <div class="uk-flex uk-flex-center">
                                                                    <input class="uk-button uk-button-secondary" type="submit" value="APLICAR">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-margin-left uk-light">
                    <div class="uk-margin-right">
                        <span class="uk-icon-link" id="list" uk-icon="icon: list; ratio: 1.3" style="cursor: pointer;"></span>
                    </div>
                    <div class="uk-width-auto uk-text-nowrap flechas">
                        <span class="uk-active" uk-filter-control="sort: data-name"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-down" aria-label="Sort ascending"></a></span>
                        <span uk-filter-control="sort: data-name; order: desc"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-up" aria-label="Sort descending"></a></span>
                    </div>
                </div>
            </div>
            <div class="uk-light">
                <hr class="uk-margin-small-top uk-margin-remove-bottom uk-margin-remove-left uk-margin-remove-right">
            </div>
            <div class="uk-light">
                <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small dataTable" uk-grid>
                    <div class="container_marca_agua">
                        <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
                    </div>
                    <div class="[email protected] uk-grid-medium uk-flex-center dataTable2 height_controller" uk-grid uk-height-match="target: > div > .uk-card">
                        <!-- ****************** Ficha de la factura ****************** -->
                        <?php
                        for ($i = 0; $i < count($result); $i++) {
                            $row = $result[$i];
                            require 'complementos/tarjeta_venta.php';
                        }
                        ?>
                    </div>
                </section>
                <div class="uk-flex uk-flex-center">
                    <ul class="uk-pagination uk-margin-large-top" style="align-items: baseline;">
                        <li><a class="pag-btn-facturas uk-text-decoration-none" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                        <li><a class="pag-btn-facturas uk-text-decoration-none" data-direccion="back">Previous</a></li>
                        <li><a class="pag-btn-facturas uk-text-decoration-none" data-direccion="next">Next</a></li>
                        <li><a class="pag-btn-facturas uk-text-decoration-none" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javaScript/librerias/hammer.min.js"></script>
<script src="static/javascript/FuncionesGenerales.js"></script>
<script src="static/javascript/Ajax/registerShop.js"></script>

<script>
    $('.pag-btn-facturas').click(ele => {
        cambiar_pagina_php(ele.target.dataset['direccion'], 'ventas', 9)
    })
</script>


</body>

</html>