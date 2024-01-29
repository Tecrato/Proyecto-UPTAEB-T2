<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom main-Product uk-light">
    <section class="">
        <ul uk-tab>
            <li><a href="#"><img class="uk-preserve-width uk-margin-small-right img1ProductSwitcher" src="./static/images/cajas (2).png" width="30" height="30" alt="">PRODUCTOS</a></li>
            <li><a href="#"><img class="uk-preserve-width uk-margin-small-right img2ProductSwitcher" src="./static/images/suministros.png" width="32" height="32" alt="">ENTRADAS</a></li>
        </ul>

        <ul class="uk-switcher uk-margin">
            <li>
                <section class="uk-background-secondary uk-padding uk-border-rounded" uk-filter="target: .js-filter">
                    <div>
                        <div class="uk-flex uk-flex-between container-filter" style="align-items: baseline;">
                            <div class="uk-flex uk-flex-wrap" style="align-items: baseline;">
                                <div class="uk-margin-right">
                                    <div class="uk-flex uk-flex-wrap">
                                        <div class="uk-margin formDelete">
                                            <form class="uk-search uk-search-default search-responsive-product">
                                                <span class="uk-search-icon-flip" uk-search-icon></span>
                                                <input class="uk-search-input searchProduct" type="search" placeholder="Buscar" aria-label="Search">
                                            </form>
                                        </div>
                                        <div class="uk-margin-left">
                                            <a href="InventarioPDF" target="_blank" class="uk-icon-link" uk-tooltip="title:Imprimir Inventario; delay: 500" uk-icon="icon: print; ratio: 1.5"></a>
                                            <a href="#modal-register-product" uk-toggle uk-tooltip="title:Añadir; delay: 500" class="uk-margin-small-left btn-modal-register">
                                                <img class="btn_agg" src="./static/images/btn_agg.png" alt="" width="35px">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <nav uk-dropnav="mode: click">
                                    <ul class="uk-subnav filter_product" uk-margin>
                                        <li class="uk-active" uk-filter-control><a href="#">TODO</a></li>
                                        <li>
                                            <a href="#">CATEGORIA <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav filter_category">
                                                    <!-- aqui se cargan las categorias con js -->
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">PROVEEDOR <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav filter_supplier">
                                                    <!-- aqui se cargan los proveedores con js -->
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">MARCA <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav filter_marca">

                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
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
                            <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small dataTable viewP" uk-grid>
                                <div class="container_marca_agua">
                                    <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
                                </div>
                                <div class="[email protected] uk-grid-large uk-flex-center dataTable2 container-target-product js-filter" uk-grid uk-height-match="target: > div > .uk-card">
                                    <!-- aqui se cargan las tarjetas de productos con js -->
                                </div>
                            </section>
                            <div class="uk-flex uk-flex-center">
                                <ul class="uk-pagination uk-margin-large-top">
                                    <li><a class="pag-btn-productos" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                                    <li><a class="pag-btn-productos" data-direccion="back">Previous</a></li>
                                    <li><a class="pag-btn-productos" data-direccion="next">Next</a></li>
                                    <li><a class="pag-btn-productos" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <div id="container-modals">
                    <!-- aqui se cargan los modales dinamicamente con js -->

                    <!-- *********************************modal de registro de productos********************************* -->

                    <div id="modal-register-product" uk-modal bg-close='false'>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default close" type="button" uk-close></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title">REGISTRAR PRODUCTO</h2>
                            </div>
                            <div class="uk-modal-body ">
                                <form id="formAggProduct" class="uk-grid-small" uk-grid method="POST" action="" enctype="multipart/form-data">
                                    <input type="text" name="tipo" value='producto' id="" style="display:none">
                                    <div class="uk-width-1-2">
                                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" required>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <input class="uk-input" type="text" placeholder="Descripción" aria-label="50" name="descripcion">
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <select id="selectCat" class="uk-select" id="form-stacked-select" name="categoria" required>
                                            <option value="" disabled selected>Categoria</option>
                                        </select>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <select id="selectUni" class="uk-select" id="form-stacked-select" name="unidad" required>
                                            <option value="" disabled selected>Unidad</option>

                                        </select>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <input class="uk-input" type="number" step="0.1" placeholder="precio_venta" aria-label="25" name="precio_venta" required>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <input class="uk-input" type="number" placeholder="Stock mínimo" aria-label="25" name="stock_min" required>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <input class="uk-input" type="number" placeholder="Stock maximo" aria-label="25" name="stock_max" required>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-margin-medium-right" for="">IVA</label>
                                        <label><input class="uk-radio" type="radio" name="IVA" value=0 checked> Exento</label>
                                        <label><input class="uk-radio" type="radio" name="IVA" value=1> No Exento</label>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <div uk-form-custom>
                                            <input type="file" accept="image/*" aria-label="Custom controls" name="imagen1">
                                            <button class="uk-button uk-button-default" type="button" tabindex="-1">Selecciona Imagen</button>
                                        </div>
                                    </div>
                                    <input type="submit" id="subirxd" style="display:none">
                                </form>
                            </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                                <label class="uk-button uk-button-secondary subir" type="submit" for="subirxd">Guardar</label>
                            </div>
                        </div>
                    </div>

                    <!-- *********************************modal de eliminar productos********************************* -->

                    <div id="eliminar_product" class="uk-flex-top uk-modal" uk-modal bg-close='false'>
                        <div class="uk-modal-dialog uk-margin-auto-vertical">
                            <div class="uk-modal-header uk-flex uk-flex-middle">
                                <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                                <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
                            </div>
                            <div class="uk-modal-body">
                                <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
                            </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                                <label class="uk-button uk-button-secondary subir" type="button" for="btn">Aceptar</label>
                                <form id="formDelete" action="" method="POST" style="display:none">
                                    <input type=number id="ValueInputDelete" name="ID">
                                    <input type=text value="producto" name="tipo">
                                    <input type=submit id="btn">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- *********************************modal de entradas productos********************************* -->
                    
                    <div id="product-entry" uk-modal bg-close='false'>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default close" type="button" uk-close></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title">DETALLES DE ENTRADA</h2>
                            </div>
                            <div class="uk-modal-body">
                                <form id="formLotes" class="uk-grid-small" uk-grid method="POST" action="">
                                    <input type="text" name="tipo" value="lote" style="display:none">
                                    <input type="text" name="ID" id="ValueIdEntry" style="display:none">
                                    <div class="uk-width-1-3@s">
                                        <select class="uk-select selectSupplier" id="form-stacked-select" name="proveedor" required>
                                            <!-- aqui cargar las opciones en js -->
                                        </select>
                                    </div>
                                    <div class="uk-width-1-3@s">
                                        <input class="uk-input" type="number" placeholder="Cantidad" aria-label="100" name="cantidad" required>
                                    </div>
                                    <div class="uk-width-1-3@s">
                                        <input class="uk-input" type="number" step="0.1" placeholder="precio_compra" aria-label="25" name="precio_compra" required>
                                    </div>
                                    <div class="uk-width-1-1@s uk-flex uk-flex-middle">
                                        <label for="" style="width: 265px;">Fecha adquisicion</label>
                                        <input class="uk-input" type="date" step="0.01" aria-label="25" name="fecha_c" required>
                                    </div>
                                    <div class="uk-width-1-1@s uk-flex uk-flex-middle">
                                        <label for="" style="width: 265px;">Fecha de vencimiento</label>
                                        <input class="uk-input" type="date" step="0.01" aria-label="25" name="fecha_v" required>
                                    </div>
                                    <input type="submit" id="subir" style="display:none">
                                </form>
                            </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                                <label class="uk-button uk-button-secondary subir" type="submit" for="subir">Guardar</label>
                            </div>
                        </div>
                    </div>

                </div>
            </li>

            
            <li>
                <section class="uk-flex container-entradas">
                    <article style="width: 840px;" class="uk-background-secondary uk-padding uk-border-rounded uk-margin-medium-bottom">
                        <form class="uk-search uk-search-default uk-margin-bottom" style="width: 100% !important;">
                            <input class="uk-search-input" type="search" placeholder="Buscar" aria-label="Search">
                        </form>
                        <ul uk-accordion>
                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#">
                                    <div class="uk-flex">
                                        <span class="uk-margin-small-right" uk-icon="icon: bookmark; ratio: 1.5"></span>
                                        <p class="uk-margin-remove uk-text-bold">MONTECARMELO</p>
                                    </div>
                                </a>
                                <div class="uk-accordion-content">
                                    <?php for ($i = 0; $i < 4; $i++) { ?>
                                        <h4 class="uk-margin-medium-left uk-margin-small-top uk-margin-small-bottom">
                                            <img class="img3ProductSwitcher" src="./static/images/cajas (2).png" width="30" alt="">
                                            <span class="uk-margin-small-left uk-text-bold">harina</span>
                                        </h4>
                                        <hr class="uk-margin-remove">

                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </article>
                    <article>
                        <div>
                            <section class="uk-light uk-grid-small uk-flex-center" uk-grid>
                                <div class="[email protected] uk-grid-medium uk-flex-center height_controller" uk-grid uk-height-match="target: > div > .uk-card">
                                    <?php for ($i = 0; $i < 6; $i++) { ?>
                                        <div>
                                            <div class="target_supplier uk-card uk-card-default uk-flex uk-padding-small uk-background-secondary uk-light uk-border-rounded">
                                                <div>
                                                    <div class="img_proveedor_container uk-border-rounded">
                                                        <img src="./static/images/btn_lote2.png" alt="" width="90px" />
                                                        <h5 class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-margin-small-bottom uk-text-center uk-text-bold">
                                                            ENTRADA NRO 1
                                                        </h5>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
                                                        <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center">
                                                            Nombre del producto
                                                        </h4>
                                                        <div>
                                                            <a href="#eliminar_supplier" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button uk-margin-small-right" uk-tooltip="title:Eliminar; delay: 500" type="button" style="border: none; cursor: pointer" type="button">
                                                                <span uk-icon="icon: trash"></span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />

                                                    <div class="Container-details-suppliers" style="width: 200px;">
                                                        <div class="uk-flex">
                                                            <h6 class="uk-margin-small">CANTIDAD</h6>
                                                            <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                                                Luis Garnica
                                                            </p>
                                                        </div>
                                                        <div class="uk-flex">
                                                            <h6 class="uk-margin-small">EXP</h6>
                                                            <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                                                J-5000000
                                                            </p>
                                                        </div>
                                                        <div class="uk-flex">
                                                            <h6 class="uk-margin-small">PRECIO COMPRA</h6>
                                                            <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                                                0000
                                                            </p>
                                                        </div>
                                                        <div class="uk-flex">
                                                            <div class="uk-margin-small-right">
                                                                <h6>ESTADO</h6>
                                                            </div>
                                                            <div>
                                                                <h6 class="uk-background-primary uk-margin-remove uk-text-center uk-border-rounded uk-text-bold state-entrys" style="width: 195px; padding: 2px 0px;">ACTIVO</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                            <?php include("../View/complementos/btn_pag.html"); ?>
                        </div>
                    </article>
                </section>
            </li>
        </ul>
    </section>


</main>
<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javascript/FuncionesGenerales.js"></script>
<script src="static/javascript/librerias/datatables.js"></script>
<script src="static/javascript/Ajax/product.js"></script>
<script src="static/javascript/funcionDataTable.js"></script>


</body>

</html>