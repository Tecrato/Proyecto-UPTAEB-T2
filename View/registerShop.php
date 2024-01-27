<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom">

    <section id="Container-modal-full" class="uk-flex uk-flex-center">

        <!--************************** barra de busqueda y filtrado **************************-->

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

            <div class="uk-flex uk-flex-middle Options-nav">
                <nav uk-dropnav="mode: click">
                    <ul class="uk-subnav uk-margin-remove">
                        <li>
                            <div class="uk-light">
                                <a href="" class="uk-icon-link icon-filter" uk-icon="icon: filter; ratio: 1.5"></a>
                            </div>
                            <div class="uk-dropdown uk-border-rounded">
                                <ul class="uk-nav uk-dropdown-nav uk-border-rounded">
                                    <li class="uk-margin-small-bottom uk-text-center"><strong>FILTRAR</strong></li>
                                    <li>
                                        <div class="uk-dark">
                                            <form>
                                                <div class="uk-margin-small-top">
                                                    <div class="uk-flex uk-flex-middle uk-margin-small-top">
                                                        <span class="uk-margin-small-right uk-text-bold">De</span>
                                                        <input class="uk-input" type="date" placeholder="100"
                                                            aria-label="100">
                                                    </div>
                                                    <div class="uk-flex uk-flex-middle uk-margin-top">
                                                        <span class="uk-margin-small-right uk-text-bold">Hasta</span>
                                                        <input class="uk-input" type="date" placeholder="100"
                                                            aria-label="100">
                                                    </div>
                                                </div>
                                                <div class="uk-margin-top">
                                                    <div class="uk-flex uk-flex-middle">
                                                        <span
                                                            class="uk-margin-small-right uk-text-bold">Clientes</span>
                                                        <select class="uk-select" id="form-stacked-select"
                                                            name="distribuidor" required>
                                                            <option selected disabled>Cliente</option>
                                                            <option>Option 01</option>
                                                            <option>Option 02</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="uk-margin-top">
                                                    <div class="uk-flex uk-flex-center">
                                                        <input class="uk-button uk-button-secondary" type="submit"
                                                            value="APLICAR">
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

                <div
                    class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-left uk-margin-small-right uk-light cont_imprimir">
                    <a href="Detalles_factura" class="uk-icon-link" uk-tooltip="title:Imprimir Facturas; delay: 500">
                        <span uk-icon="icon: print; ratio: 1.7"></span>
                    </a>
                </div>

                <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-right">
                    <a href="#modal-full" uk-toggle uk-tooltip="title:Añadir Factura; delay: 500">
                        <img class="btn_agg" src="static/images/btn_agg_factura2.png" alt="" width="38px">
                    </a>
                </div>
            </div>
        </article>

    </section>

    <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small uk-flex-center" uk-grid>
        <div class="container_marca_agua invisible">
            <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
        </div>
        <div class="[email protected] uk-grid-medium uk-flex-center height_controller" uk-grid uk-height-match="target: > div > .uk-card">

            <!-- ****************** Ficha de la factura ****************** -->
            <?php
            for ($i=0; $i < count($result); $i++) { 
                $row = $result[$i];
                require 'complementos/tarjeta_venta.php';
            }
            ?>
        </div>
    </section>




<div class="uk-flex uk-flex-center">
    <ul class="uk-pagination uk-margin-large-top">
        <li><a class="pag-btn-facturas" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
        <li><a class="pag-btn-facturas" data-direccion="back">Previous</a></li>
        <li><a class="pag-btn-facturas" data-direccion="next">Next</a></li>
        <li><a class="pag-btn-facturas" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
    </ul>
</div>
</main>

<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javaScript/librerias/hammer.min.js"></script>
<script src="static/javascript/FuncionesGenerales.js"></script>
<script src="static/javascript/Ajax/registerShop.js"></script>

<script>
    $('.pag-btn-facturas').click(ele => {
        cambiar_pagina_php(ele.target.dataset['direccion'],'ventas',9)
    })
</script>


</body>
</html>
