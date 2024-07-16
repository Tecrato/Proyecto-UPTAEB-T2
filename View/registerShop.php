<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom uk-light">


    <ul uk-tab>
        <li><a id="FACTURA" href="#">FACTURA</a></li>
        <li><a id="CREDITO" href="#">CREDITO</a></li>
        <li><a id="CAJA" href="#">CAJA</a></li>
    </ul>

    <div class="uk-switcher uk-margin">
        <li>
            <section id="Container-modal-full" class="uk-background-secondary uk-padding uk-border-rounded" uk-filter="target: .js-filter">
                <div>
                    <div class="uk-flex uk-flex-between" style="align-items: baseline;">
                        <div class="uk-flex uk-flex-wrap" style="align-items: baseline;">
                            <div class="uk-margin-right">
                                <div class="uk-flex" style="height: 50px;">
                                    <div class="uk-margin formDelete uk-light">
                                        <form class="uk-search uk-search-default uk-light form_btns_search">
                                            <span class="uk-search-icon-flip uk-light" uk-search-icon></span>
                                            <input class="uk-search-input uk-light" type="search" placeholder="Buscar" aria-label="Search">
                                        </form>
                                    </div>
                                    <div class="uk-margin-left uk-light cont_btns_fact">
                                        <a href="Detalles_factura" uk-icon="icon: file-pdf; ratio: 1.5" uk-tooltip="title:PDF Factura; delay: 500"></a>
                                        <a href="#modal-full" uk-toggle uk-tooltip="title:Añadir Factura; delay: 500" class="uk-margin-small-left btn_agg_factura invisible">
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
                            <!-- <div class="uk-margin-right">
                                <span class="uk-icon-link" id="list" uk-icon="icon: list; ratio: 1.3" style="cursor: pointer;"></span>
                            </div> -->
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
                            <div class="[email protected] cont_ventas_target uk-grid-medium uk-flex-center dataTable2 height_controller" uk-grid uk-height-match="target: > div > .uk-card">
                                <!-- ****************** Ficha de la factura ****************** -->

                            </div>

                        </section>


                        <!-- **************************Modal para crear facturas************************** -->

                        <div id="modal-full" class="uk-modal-full" uk-modal>
                            <div class="uk-modal-dialog uk-background-secondary uk-light">
                                <button class="uk-modal-close-full uk-close-large uk-background-secondary" type="button" uk-close></button>
                                <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>
                                    <div class="uk-background-cover container_generate_fact" style="background-image: url('static/images/fondo2.jpg');" uk-height-viewport>

                                        <h4 class="uk-text-bolder"></h4>

                                        <div class="generate-fact uk-margin-auto">
                                            <div class="uk-flex uk-flex-center">
                                                <div class="btn-close invisible">
                                                    <span uk-icon="icon: close"></span>
                                                </div>
                                                <!-- ********************** modal para Añadir el cliente **********************  -->
                                                <nav id="nav" class="Nav1" uk-dropnav="mode: click">

                                                    <ul class="uk-subnav uk-margin-remove uk-padding-remove">
                                                        <li class="uk-flex uk-flex-column uk-flex-middle">
                                                            <div class="uk-flex uk-flex-around uk-border-rounded uk-margin-bottom" style="width: 172px; border: 1px solid #fff; padding: 3px;">
                                                                <div>VENDEDOR</div>
                                                                <div id="nameVendedor">LUIS</div>
                                                            </div>

                                                            <div class="uk-flex uk-flex-around uk-border-rounded uk-margin-bottom" style="width: 172px; border: 1px solid #fff; padding: 3px;">
                                                                <label><input class="uk-checkbox credito_check" type="checkbox"> CREDITO</label>
                                                            </div>

                                                            <div class="Plus-client uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-border-rounded">
                                                                <div id="Client-datails" class="uk-flex uk-flex-column uk-flex-center uk-flex-middle">
                                                                    <div class="uk-flex uk-flex-column uk-flex-middle uk-flex-center pointer" value="default">
                                                                        <h5 class="uk-text-bold uk-margin-remove">AÑADIR CLIENTE</h5>
                                                                        <a class="uk-margin-small-top" href="#" uk-icon="icon: plus-circle; ratio: 1.5"></a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="uk-dropdown uk-border-rounded uk-background-secondary holz">
                                                                <ul class="uk-nav uk-dropdown-nav">
                                                                    <li class="uk-active uk-margin-small-bottom">
                                                                        <form class="uk-search uk-search-default">
                                                                            <span class="uk-search-icon-flip" uk-search-icon></span>
                                                                            <input id="input-search-fact" class="uk-search-input" type="search" placeholder="Buscar" aria-label="Buscar">
                                                                        </form>
                                                                    </li>
                                                                    <div id="Client">

                                                                    </div>
                                                                </ul>
                                                            </div>

                                                            <div class="uk-margin-top">
                                                                <button class="btnCreateFact uk-button uk-button-default demo uk-border-rounded" type="button">
                                                                    GENERAR FACTURA
                                                                </button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                <!-- ******************************************************************************  -->
                                                <div class="uk-margin-medium-left cont_type_page">
                                                    <div class="container_config_fact uk-border-rounded">
                                                        <section style="width: 350px;">
                                                            <article class="uk-flex uk-flex-around" style="padding: 5px;">
                                                                <div class="name_MP">TIPO DE PAGO</div>
                                                                <div class="amount_MP">0.00 BS</div>
                                                            </article>
                                                            <hr class="uk-margin-remove">
                                                            <div class="Scroll_MP switcher_credit" style="height: 80%; overflow-y: auto;">

                                                                <form class="uk-form-horizontal formCredito uk-padding-small">
                                                                    <div class="uk-margin uk-flex">
                                                                        <label class="uk-form-label" for="form-horizontal-select">INICIO</label>
                                                                        <input class="uk-input uk-form-width-medium fecha_inicio_credito" type="date">
                                                                    </div>

                                                                    <div class="uk-margin uk-flex">
                                                                        <label class="uk-form-label" for="form-horizontal-select">VENCIMIENTO</label>
                                                                        <input class="uk-input uk-form-width-medium fecha_cierre_credito" type="date">
                                                                    </div>
                                                                </form>


                                                                <article class="cont_metodos_pagos" style="padding: 5px 10px;">
                                                                    <!-- aqui cargan los metodos de pago con js -->
                                                                </article>
                                                                <article class="uk-flex uk-flex-middle uk-flex-center uk-margin-small-top btn_agg_metodoPago" style="cursor: pointer;">
                                                                    <span class="uk-margin-small-right" uk-icon="plus-circle"></span>
                                                                    <p class="uk-margin-remove" style="font-size: 13px;">AGREGAR TIPO DE PAGO</p>
                                                                </article>
                                                            </div>
                                                        </section>
                                                    </div>


                                                </div>
                                            </div>

                                            <hr class="uk-divider-icon">

                                            <div class="uk-flex uk-flex-center">
                                                <h5>ADICIONAR PRODUCTOS</h5>
                                            </div>

                                            <div>
                                                <div class="uk-margin-small">
                                                    <form class="uk-search uk-search-default">
                                                        <span class="uk-search-icon-flip" uk-search-icon></span>
                                                        <input id="SearchProduct-Fact" class="uk-search-input" type="search" placeholder="Buscar..." aria-label="Search">
                                                    </form>
                                                </div>

                                                <div style="overflow: hidden; height: 280px;">
                                                    <div>
                                                        <table class="uk-table uk-table-divider">
                                                            <thead>
                                                                <tr>
                                                                    <th class="uk-text-truncate uk-table-shrink">Prod.</th>
                                                                    <th class="uk-text-truncate">Disp.</th>
                                                                    <th class="uk-text-truncate">Precio</th>
                                                                    <th class="uk-text-truncate">Cantidad</th>
                                                                    <th class="uk-text-truncate">Agregar</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="Product-detail-1">


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div style="padding: 55px;" class="cont_cash_fact">
                                        <h4 class="uk-text-bolder uk-padding-medium">DETALLES FACTURA</h4>
                                        <div class="container-result-fact">
                                            <div class="scroll-detail-fact" style="height: 300px; overflow: auto;">
                                                <table class="uk-table uk-table-hover uk-table-divider uk-table-middle uk-light">
                                                    <thead>
                                                        <tr>
                                                            <th class="uk-text-truncate">ID</th>
                                                            <th class="uk-text-truncate">Cantidad</th>
                                                            <th class="uk-text-truncate">Nombre</th>
                                                            <th class="uk-text-truncate">Precio unit.</th>
                                                            <th class="uk-text-truncate">Precio total</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="Detail-product-fact">

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="cont_detail-venta uk-flex uk-flex-right uk-margin-medium-top">
                                                <div class="Container-fact-price" style="background-color: rgba(51, 51, 51, 0.288);">
                                                    <div class="uk-flex uk-flex-between">
                                                        <div class="uk-margin-large-right">SUBTOTAL </div>
                                                        <div class="uk-flex uk-flex-middle">
                                                            <p id="subtotalFact" class="Fact-price uk-text-success">0.00</p>
                                                            <p id="subtotalFact_$" class="Fact-price uk-text-success uk-margin-remove-top uk-margin-small-left">0.00</p>
                                                        </div>
                                                    </div>
                                                    <div class="uk-flex uk-flex-between">
                                                        <div class="uk-margin-large-right">IVA 16% </div>
                                                        <div>
                                                            <p id="iva" class="Fact-price uk-text-success">0.00</p>
                                                        </div>
                                                    </div>
                                                    <div class="uk-flex uk-flex-between">
                                                        <div class="uk-margin-large-right">IGTF 3% </div>
                                                        <div>
                                                            <p id="IGTF" class="Fact-price uk-text-success">0.00</p>
                                                        </div>
                                                    </div>
                                                    <hr class="uk-margin-remove-top">
                                                    <div class="uk-flex uk-flex-between">
                                                        <div class="uk-margin-large-right uk-text-bolder">TOTAL </div>
                                                        <div class="uk-flex uk-flex-middle">
                                                            <p id="totalFact" class="Fact-price uk-text-success uk-margin-remove-bottom uk-text-bolder">0.00</p>
                                                            <p id="totalFact$" class="Fact-price uk-text-success uk-margin-remove-bottom uk-text-bolder uk-margin-remove-top uk-margin-small-left">0.00</p>
                                                        </div>
                                                    </div>
                                                    <div class="uk-flex uk-flex-between uk-margin-small-top">
                                                        <div class="uk-margin-large-right uk-text-bolder">TASA $ </div>
                                                        <div class="uk-flex uk-flex-middle">
                                                            <p id="Tasa_dolar_fact" class="Fact-price uk-text-success uk-margin-remove-bottom uk-text-bolder">36.02 Bs</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ******************************************************************************************************* -->



                        <div class="uk-flex uk-flex-center">
                            <ul class="uk-pagination uk-margin-large-top">
                                <li><a class="pag-btn-facturas" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                                <li><a class="pag-btn-facturas" data-direccion="back">Previous</a></li>
                                <li><a class="pag-btn-facturas" data-direccion="next">Next</a></li>
                                <li><a class="pag-btn-facturas" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </li>


        <li>
            <div class="uk-padding-small uk-overflow-auto">
                <table class="uk-table uk-light">
                    <thead class="uk-background-secondary">
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Inicio de credito</th>
                            <th>Final de credito</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody_credito">


                    </tbody>
                </table>
            </div>


            <div id="credito_page" class="uk-flex-top" uk-modal>
                <div class="uk-modal-dialog uk-margin-auto-vertical">
                    <form id="form_credito" action="">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header uk-flex">
                            <h2 class="uk-modal-title">PAGAR CREDITO</h2>
                        </div>
                        <div class="uk-modal-body">
                            <div class="uk-flex uk-flex-start">
                                <div class="uk-flex">
                                    <h2 class="uk-margin-remove-top total_credito uk-text-meta">2000.00 Bs</h2>
                                    <h5 class="uk-margin-remove-top uk-margin-medium-left total_credito_bs uk-text-meta">0.00 Bs</h5>
                                </div>
                                <div>
                                    <h2 class="total_pago_credito uk-margin-remove-top uk-margin-large-left uk-text-meta">0.00 Bs</h2>
                                </div>
                            </div>
                            <hr class="uk-margin-remove-top">
                            <section>
                                <div class="inputPago">

                                </div>
                                <div>
                                    <article class="uk-flex uk-flex-middle uk-flex-center uk-margin-small-top btn_agg_metodoPago2" style="cursor: pointer;">
                                        <span class="uk-margin-small-right" uk-icon="plus-circle"></span>
                                        <p class="uk-margin-remove" style="font-size: 13px;">AGREGAR TIPO DE PAGO</p>
                                    </article>
                                </div>
                            </section>
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">CANCELAR</button>
                            <button class="uk-button uk-button-secondary btn_pagar_credito" type="button">PAGAR</button>
                        </div>
                    </form>
                </div>
            </div>




        </li>


        <li>
            <a class="uk-button uk-button-default uk-margin-bottom uk-margin-top" uk-toggle href="#caja-modal">Apertura de Caja</a>

            <div class="uk-light uk-padding-small uk-overflow-auto">
                <table class="uk-table uk-light uk-table-divider">
                    <thead class="uk-background-secondary">
                        <tr>
                            <th>#</th>
                            <th>Nombre Usuario</th>
                            <th>Fecha de Apertura</th>
                            <th>Monto Inicial</th>
                            <th>Hora Apertura</th>
                            <th>Hora Cierre</th>
                            <th>Total de ventas</th>
                            <th>Monto Credito</th>
                            <th>Monto Final</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_caja">


                    </tbody>
                </table>
            </div>

            <!--***************************** MODAL CAJA *****************************-->
            <div id="caja-modal" uk-modal>
                <div class="uk-modal-dialog">
                    <button class="uk-modal-close-default" type="button" uk-close></button>
                    <div class="uk-modal-header">
                        <h3 class="uk-modal-title modal_title_client">ARQUEO DE CAJA</h3>
                    </div>
                    <div class="uk-modal-body">
                        <form id="FormCaja" class="uk-grid-small uk-form-stacked form_caja" uk-grid>
                            <!-- <input type="text" name="tipo" value='caja' style="display:none"> -->
                            <!-- <input class="" type="number" name="ID" style="display:none"> -->

                            <div class="uk-width-1-1@s">
                                <label class="uk-form-label">Monto Inicial</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" placeholder="Monto Inicial" name="monto_inicial" aria-label="100" required>
                                </div>
                                <input type="date" name="fecha" style="display: none;">
                                <input type="number" name="id_usuario" style="display: none;">
                            </div>

                            <input type="submit" id="subirCaja" style="display:none" required>
                        </form>
                    </div>
                    <div class="uk-modal-footer uk-text-right">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                        <label class="uk-button uk-button-secondary" type="button" for="subirCaja">Guardar</label>
                    </div>
                </div>
            </div>
            <!--***************************** *****************************-->

            <!--***************************** MODAL CERRAR CAJA *****************************-->

            <div id="cierre-caja" class="uk-flex-top uk-modal" uk-modal bg-close='false'>
                <div class="uk-modal-dialog uk-margin-auto-vertical">
                    <div class="uk-modal-header uk-flex uk-flex-middle">
                        <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                        <h2 class="uk-modal-title uk-margin-remove-top modalDeleteTitle">ELIMINAR</h2>
                    </div>
                    <div class="uk-modal-body">
                        <p class="modalDeleteBody">Deseas Cerrar esta caja? No podras abrirla mas adelante</p>
                    </div>
                    <div class="uk-modal-footer uk-text-right">
                        <form id="FORM-CLOSE-BOX" action="post">
                            <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                            <button class="uk-button uk-button-secondary" type="submit">Aceptar</button>
                        </form>

                    </div>
                </div>
            </div>
            <!--***************************** *****************************-->

        </li>
    </div>


</main>

<script src="static/javaScript/librerias/hammer.min.js"></script>
<script src="static/javascript/Ajax/registerShop.js" defer></script>
<script src="static/javascript/Ajax/caja.js" defer></script>
<script src="static/javascript/Ajax/credito.js" defer></script>


</body>

</html>