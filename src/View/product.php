<?php require("../View/complementos/header.php"); ?>

<style>
        /* Modificar el estilo de los SearchPanes para alinearlos en filas de 2 */
        .dtsp-searchPanes {
            width: 30%;
            flex-wrap: nowrap !important;
    justify-content: space-around !important;
    gap: 10% !important;
        }
    </style>
<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom main-Product uk-light">
    <section class="">
        <ul uk-tab>
            <li><a id="aProductos" class="itemSwitcher1" href="#"><img class="uk-preserve-width uk-margin-small-right img1ProductSwitcher" src="./static/images/cajas (2).png" width="30" height="30" alt="">PRODUCTOS</a></li>

            <?php if ($_SESSION['rol_num'] <= 1) { ?>
                <li><a id="aEntradas" class="itemSwitcher2" href="#"><img class="uk-preserve-width uk-margin-small-right img2ProductSwitcher" src="./static/images/suministros.png" width="32" height="32" alt="">ENTRADAS</a></li>
            <?php }; ?>
            <li><a id="aOtros" class="itemSwitcher3" href="#"><img class="uk-preserve-width uk-margin-small-right img4ProductSwitcher" src="./static/images/menu.png" width="32" height="32" alt="">OTROS</a></li>
        </ul>
        <div class="height_controller">
        </div>
        <ul class="uk-switcher uk-margin" data-uk-switcher="{swiping:false}">
            <li>
                <section class="uk-background-secondary uk-padding uk-border-rounded" uk-filter="target: .js-filter">
                    <div>
                        <div class="uk-flex uk-flex-between container-filter" style="align-items: baseline;">
                            <div class="uk-flex uk-flex-wrap cont_btns" style="align-items: baseline;">
                                <div class="uk-margin-right">
                                    <div class="uk-flex uk-flex-wrap">
                                        <div class="uk-margin formDelete">
                                            <form id="formSearch" class="uk-search uk-search-default search-responsive-product">
                                                <span class="uk-search-icon-flip" uk-search-icon></span>
                                                <input class="uk-search-input searchProductActive" type="search" placeholder="Buscar" aria-label="Search">
                                            </form>
                                        </div>
                                        <div class="uk-margin-left conts_btns_nav_product">
                                            <a id="iconReportInv" href="PDFInventario" class="uk-icon-link" uk-tooltip="title:Reporte Inventario; delay: 500" uk-icon="icon: file-pdf; ratio: 1.5"></a>
                                            <a id="registerProduct" href="#modal-register-product" uk-toggle uk-tooltip="title:Añadir; delay: 500" class="uk-margin-small-left btn-modal-register invisible">
                                                <img class="btn_agg" src="./static/images/btn_agg.png" alt="" width="35px">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <nav uk-dropnav="mode: click">
                                    <ul class="uk-subnav filter_product" uk-margin>
                                        <li id="productFilterAll" class="uk-active" uk-filter-control><a href="#">TODO</a></li>
                                        <li>
                                            <a id="productFilterCategory" href="#">CATEGORIA <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <form class="uk-search uk-search-default uk-margin-small-bottom">
                                                    <span uk-search-icon style="color: #999"></span>
                                                    <input class="uk-search-input input_placeholder filter_product" name="categoria" type="search" placeholder="Buscar" aria-label="" style="color: #999; border-color: #999;">
                                                </form>
                                                <ul class="uk-nav uk-dropdown-nav filter_category">
                                                    <!-- aqui se cargan las categorias con js -->
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a id="productFilterMarca" href="#">MARCA <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <form class="uk-search uk-search-default uk-margin-small-bottom">
                                                    <span uk-search-icon style="color: #999"></span>
                                                    <input class="uk-search-input input_placeholder filter_product" name="marca" type="search" placeholder="Buscar" aria-label="" style="color: #999; border-color: #999;">
                                                </form>
                                                <ul class="uk-nav uk-dropdown-nav filter_marca">

                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <div class="uk-flex uk-margin-left container-view-order">
                                <!-- <div class="uk-margin-right">
                                    <span class="uk-icon-link" id="list" uk-icon="icon: list; ratio: 1.3" style="cursor: pointer;"></span>
                                </div> -->
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

                    <!-- *********************************modal de registro de productos********************************* -->

                    <div id="modal-register-product" uk-modal bg-close='false'>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default close" type="button" uk-close></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title title_modal_reg_upd">REGISTRAR PRODUCTO</h2>
                            </div>
                            <div class="uk-modal-body ">
                                <form id="formAggProduct" class="uk-grid-small uk-form-stacked" uk-grid method="POST" action="" enctype="multipart/form-data">
                                    <input class="ValueInpUpdate" type="number" name="ID" style="display:none">
                                    <input type="text" name="tipo" value='producto' id="" style="display:none">
                                    <input type="text" name="old_img" value="" id="old_img" class="old_img" style="display:none">
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Nombre</label>
                                        <div class="uk-form-controls">
                                            <input class="NameUpdateProduct uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" pattern="([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Código</label>
                                        <div class="uk-form-controls">
                                            <input class="CodeUpdateProduct uk-input" type="text" placeholder="Código" aria-label="100" name="codigo" pattern="^\d{12}$" minlength="12" maxlength="12" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Marca</label>
                                        <div class="uk-form-controls">
                                            <select id="selectMar" class="uk-select MarcaUpdateProduct" id="form-stacked-select" name="marca" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Categoria</label>
                                        <div class="uk-form-controls">
                                            <select id="selectCat" class="uk-select" id="form-stacked-select" name="categoria" required>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Valor Uni.</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input ValorUnidadUpdateProduct" type="text" pattern="^([\d]){1,4}?$" name="valor_unidad" minlength="1" maxlength="4" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Unidad</label>
                                        <div class="uk-form-controls">
                                            <select id="selectUni" class="uk-select" id="form-stacked-select" name="unidad" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Metodo de ganancia</label>
                                        <div class="uk-form-controls">
                                            <select class="uk-select select_metodo_ganancia" name="algoritmo">
                                                <option value="0">MANUAL</option>
                                                <option value="1">PEPS</option>
                                                <option value="2">MEDIA PONDERADA</option>
                                                <option value="3">UEPS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Precio Venta</label>
                                        <div class="uk-form-controls">
                                            <input class="PVUpdateProduct uk-input" type="number" pattern="^([\d]){1,4}(.[\d]{1,2})?$" min="0.1" step="0.1" placeholder="precio_venta" aria-label="25" name="precio_venta" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Stock Minimo</label>
                                        <div class="uk-form-controls">
                                            <input class="SMMUpdateProduct uk-input" type="number" min="1" placeholder="Stock mínimo" aria-label="25" name="stock_min" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Stock Maximo</label>
                                        <div class="uk-form-controls">
                                            <input class="SMXUpdateProduct uk-input" type="number" min="1" placeholder="Stock maximo" aria-label="25" name="stock_max" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-margin-medium-right" for="">IVA</label>
                                        <label><input class="IVA_EUpdateProduct uk-radio" type="radio" name="IVA" value=0 checked> Exento</label>
                                        <label><input class="IVA_NEUpdateProduct uk-radio" type="radio" name="IVA" value=1> No Exento</label>
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
                                <label class="subir uk-button uk-button-secondary" type="submit" for="subirxd">Guardar</label>
                            </div>
                        </div>
                    </div>

                    <!-- *********************************modal de eliminar productos********************************* -->

                    <div id="eliminar_product" class="uk-flex-top uk-modal" uk-modal bg-close='false'>
                        <div class="uk-modal-dialog uk-margin-auto-vertical">
                            <div class="uk-modal-header uk-flex uk-flex-middle">
                                <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                                <h2 class="uk-modal-title uk-margin-remove-top modalDeleteTitle">ELIMINAR</h2>
                            </div>
                            <div class="uk-modal-body">
                                <p class="modalDeleteBody">Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
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

                    <!-- *********************************modal de detalles productos********************************* -->


                    <div id="modal-details-product" class="uk-flex-top" uk-modal bg-close='false'>
                        <div class="uk-modal-dialog uk-modal-body uk-border-rounded uk-margin-auto-vertical container-modal-detailProduct">
                            <button class="uk-modal-close-default close" type="button" uk-close></button>
                            <div>

                                <div class="uk-flex uk-flex-center uk-flex-wrap  container-detailProduct">
                                    <div class="uk-margin-small-right margin-img-detailPoduct">
                                        <!-- <img class="productDetailIMG" alt="" width="155px" style="height: 195px; object-fit: cover;">        -->
                                        <svg class="productDetailIMG" id="Bard">
                                        </svg>
                                    </div>
                                    <div class="container-stats-productDetail">
                                        <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                            <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2"></span>
                                                <h5 class="uk-margin-remove uk-text-bolder">NOMBRE</h5>
                                            </div>
                                            <div>
                                                <h5 class="productDetailName uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                                    ${item.nombre}</h5>
                                            </div>
                                        </div>
                                        <div class="uk-flex">
                                            <div>
                                                <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2" style="float: left;"></span>
                                                <h5 class="uk-margin-small-right uk-margin-remove-top uk-margin-remove-left uk-margin-remove-bottom uk-text-bolder" style="float: left;">MARCA</h5>
                                                <h5 class="productDetailmarca Description-item-productDetail uk-margin-remove Color-icon-detailProduct uk-text-bold uk-text-uppercase" style="width: 360px; line-height: 23px;">
                                                    ${item.marca}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                            <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2"></span>
                                                <h5 class="uk-margin-remove uk-text-bolder">CATEGORIA</h5>
                                            </div>
                                            <div>
                                                <h5 class="productDetailCategory uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                                    ${item.categoria}</h5>
                                            </div>
                                        </div>
                                        <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                            <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2"></span>
                                                <h5 class="uk-margin-remove uk-text-bolder">EXISTENCIA</h5>
                                            </div>
                                            <div>
                                                <h5 class="productDetailStock uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                                    ${item.stock}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                            <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2"></span>
                                                <h5 class="uk-margin-remove uk-text-bolder">PRECIO UNITARIO</h5>
                                            </div>
                                            <div>
                                                <h5 class="productDetailPV uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                                    ${item.precio_venta}
                                                    BS</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="uk-divider-icon Color-icon-detailProduct">

                                <div class="container-prov_details">
                                    <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-bottom">
                                        <span class="uk-margin-small-right Color-icon-detailProduct" uk-icon="icon: tag; ratio: 1.2"></span>
                                        <h5 class=" uk-text-bold uk-text-center uk-margin-remove">PROVEEDOR</h5>
                                    </div>
                                    <section class="uk-margin-small-bottom" style="height: 150px; overflow: auto;">
                                        <ul id="containerSupplierName" uk-accordion>

                                        </ul>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </li>

            <?php if ($_SESSION['rol_num'] <= 1) { ?>
                <li>

                    <main class="uk-background-secondary uk-padding uk-border-rounded" uk-filter="target: .js-filter; animation: fade">
                        <!-- container-filter sera el  que tenga todos los filtros de busqueda -->
                        <!-- <section class="container-filter">
                            <div class="uk-flex">
                                <div class="uk-margin">
                                    <form class="form_search_entrys uk-search uk-search-default" style="width: 250px;">
                                        <span class="uk-search-icon-flip" uk-search-icon></span>
                                        <input id="entrada" class="uk-search-input" type="search" placeholder="Buscar Entrada" aria-label="Search">
                                    </form>
                                </div>
                                <a href="#modal-full-entrys" uk-toggle class="uk-margin-left" uk-tooltip="title:Añadir Entrada; delay: 500">
                                    <img src="./static/images/btn_lote2.png" alt="" width="35px">
                                </a>
                            </div>
                            <div>
                                <nav uk-dropnav="mode: click">
                                    <ul class="uk-subnav uk-margin-remove" style="gap: 25px;">
                                        <li id="SupplierFilterAll" class="uk-active" uk-filter-control><a href="#">TODO</a></li>
                                        <li>
                                            <a id="SupplierFilterOne" href="#">PROVEEDORES <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav filter_prov_entry">
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a id="SupplierFilterProducts" href="#">PRODUCTOS <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav filter_prov_entry_product">

                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a id="s" href="#">FECHA <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav">

                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </section> -->


                        <!-- *********************************modal de entradas productos********************************* -->

                        <div id="product-entry" uk-modal bg-close='false'>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close-default close" type="button" uk-close></button>
                                <div class="uk-modal-header">
                                    <h2 class="uk-modal-title">DETALLES DE ENTRADA</h2>
                                </div>
                                <div class="uk-modal-body">
                                    <form id="formLotes" class="uk-grid-small uk-form-stacked" uk-grid method="POST" action="">
                                        <input type="text" name="tipo" value="lote" style="display:none">
                                        <input type="text" name="ID" id="ValueIdEntry" style="display:none">
                                        <div class="uk-width-1-3@s">
                                            <label class="uk-form-label">Proveedor</label>
                                            <div class="uk-form-controls">
                                                <select class="uk-select selectSupplier" id="form-stacked-select" name="proveedor" required>
                                                    <!-- aqui cargar las opciones en js -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-3@s">
                                            <label class="uk-form-label">Cantidad a comprar</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" type="number" placeholder="Cantidad" aria-label="100" name="cantidad" required>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-3@s">
                                            <label class="uk-form-label">Precio de compra</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" type="number" min="0.1" step="0.1" placeholder="precio_compra" aria-label="25" name="precio_compra" required>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-1@s uk-flex uk-flex-middle">
                                            <label for="" style="width: 265px;">Fecha adquisicion</label>
                                            <input class="uk-input" type="date" step="0.01" aria-label="25" name="fecha_c" value="<?php echo date('Y-m-d'); ?>" required>
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

                        <!-- **************************Modal para crear entradas nuevas************************** -->

                        <div id="modal-full-entrys" class="uk-modal-full" uk-modal>
                            <div class="uk-modal-dialog uk-background-secondary uk-light">
                                <button class="uk-modal-close-full uk-close-large uk-background-secondary" type="button" uk-close></button>
                                <div class="uk-grid-collapse uk-child-width-1-1@s" uk-grid>
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

                                                            <div class="uk-flex uk-flex-around uk-border-rounded uk-margin-bottom entrys_credit-cont" style="width: 172px; border: 1px solid #fff; padding: 3px;">
                                                                <label><input class="uk-checkbox check_entrys" type="checkbox"> CREDITO</label>
                                                            </div>

                                                            <div class="Plus-supplier uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-border-rounded">
                                                                <div id="Client-datails" class="uk-flex uk-flex-column uk-flex-center uk-flex-middle">
                                                                    <div class="uk-flex uk-flex-column uk-flex-middle uk-flex-center pointer" value="default">
                                                                        <h5 class="uk-text-bold uk-margin-remove">AÑADIR PROVEEDOR</h5>
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

                                                <div class="uk-flex uk-flex-column uk-flex-center uk-margin-medium-left" style="gap: 12px 0px;">
                                                    <div>
                                                        <label for="">Fecha de compra</label>
                                                        <input class="uk-input date_compra_entrys" type="date">
                                                    </div>
                                                    <div>
                                                        <label for="">Descripcion</label>
                                                        <textarea class="uk-textarea detalles-compra_entry" name="" id="" rows="4"></textarea>
                                                    </div>
                                                </div>

                                                <div class="uk-margin-medium-left cont_type_page">
                                                    <div class="container_config_fact uk-border-rounded">
                                                        <section style="width: 350px;">
                                                            <article class="uk-flex uk-flex-around" style="padding: 5px;">
                                                                <div class="name_MP">TIPO DE PAGO</div>
                                                                <div class="amount_MP">0.00 BS</div>
                                                            </article>
                                                            <hr class="uk-margin-remove">
                                                            <div class="Scroll_MP switcher_credit" style="height: 80%; overflow-y: auto;">

                                                                <form class="uk-form-horizontal formCredito_entrys uk-padding-small">
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

                                                <div class="uk-overflow-auto scroll_entrys" style="height: 280px;">
                                                    <table class="uk-table uk-table-divider uk-table-small">
                                                        <thead>
                                                            <tr>
                                                                <th class="uk-table-shrink">Prod</th>
                                                                <th class="uk-text-truncate">Tipo Mercancia</th>
                                                                <th class="uk-text-truncate">Tam. Mercancia</th>
                                                                <th class="uk-text-truncate">Cantidad</th>
                                                                <th class="uk-text-truncate">Fecha Venc.</th>
                                                                <th class="uk-text-truncate">Precio Mercancia</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="Product-detail-1">


                                                        </tbody>
                                                    </table>
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
                                                            <th class="uk-text-truncate">Prod</th>
                                                            <th class="uk-text-truncate ">Tipo Mercancia</th>
                                                            <th class="uk-text-truncate">Tam. Mercancia</th>
                                                            <th class="uk-text-truncate">Cantidad</th>
                                                            <th class="uk-text-truncate">Fecha Venc.</th>
                                                            <th class="uk-text-truncate">Precio</th>
                                                            <th class="uk-text-truncate">Total a pagar</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="Detail-product-fact">

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="cont_detail-venta uk-flex uk-flex-right uk-margin-medium-top">
                                                <div class="Container-fact-price" style="background-color: rgba(51, 51, 51, 0.288);">
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



                        <!-- conatainer_table contendra la tabla -->
                        <section>
                            <!-- <div class="uk-overflow-auto altura_table_entry ">
                                <table class="uk-table uk-table-divider uk-table-hover uk-light">
                                    <thead class="activeGood">
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>NOMBRE</th>
                                            <th>FECHA DE EXPIRACION</th>
                                            <th>PRECIO DE COMPRA</th>
                                            <th>ESTADO</th>
                                        </tr>
                                    </thead>
                                    <tbody class="js-filter cont_entry">

                                    </tbody>
                                </table>
                            </div>
                            <div class="uk-flex uk-flex-center">
                                <ul class="uk-pagination uk-margin-large-top">
                                    <li><a class="pag-btn-productos" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                                    <li><a class="pag-btn-productos" data-direccion="back">Previous</a></li>
                                    <li><a class="pag-btn-productos" data-direccion="next">Next</a></li>
                                    <li><a class="pag-btn-productos" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                                </ul>
                            </div> -->
                            <div>
                                <label for="min">Fecha mínima:</label>
                                <input type="text" id="min" name="min">
                                <label for="max">Fecha máxima:</label>
                                <input type="text" id="max" name="max">
                            </div>
                            <table id="miTabla" class="display">
                                
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Fecha de Vencimiento</th>
                                        <th>Precio de Compra</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Fecha de Vencimiento</th>
                                        <th>Precio de Compra</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- Inputs para el filtro de rango de fechas -->
                            
                        </section>
                    </main>



                    <script src="static/javascript/Ajax/entry.js" defer></script>
                </li>
            <?php }; ?>

            <!-- este es el nuevo item, contiene las marcas, categorias y unidades -->
            <li>
                <ul class="uk-subnav uk-subnav-pill uk-margin-medium-top uk-background-secondary uk-flex uk-flex-center" uk-switcher="connect: .switcher-container" style="padding: 10px;">
                    <li><a id="liMarcas" href="#">Marcas</a></li>
                    <li><a id="liUnidades" href="#">Unidades</a></li>
                    <li><a id="liCategorias" href="#">Categorias</a></li>
                </ul>
                <div class="uk-flex uk-flex-around uk-flex-wrap uk-aling-center">
                    <ul class="uk-switcher switcher-container uk-background-secondary uk-margin-medium-top uk-border-rounded" style="border: 1px solid #999;">
                        <li class="invisible li_cont_m">
                            <form id="FORM_MARCA" method="post" class="uk-form-horizontal uk-margin-large uk-padding">
                                <div class="uk-flex uk-flex-center uk-flex-middle uk-flex-middle uk-margin-medium-bottom" style="padding: 10px; background-color: #106733">
                                    <h4 style="margin: 0px;">
                                        <span uk-icon="icon: tag; ratio: 2"></span>
                                        REGISTRAR MARCA
                                    </h4>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                                    <div class="uk-form-controls">
                                        <input name="nombre" class="uk-input marca_name" id="form-horizontal-text" type="text" placeholder="Nombre de marca" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                                        <input type="text" name="tipo" value='marca' style="display:none">
                                    </div>
                                </div>
                                <hr>
                                <div class="uk-flex uk-flex-center uk-margin-medium-top">
                                    <button type="submit" class="uk-button uk-button-default">Guardar</button>
                                </div>
                            </form>
                        </li>
                        <li class="invisible li_cont_u">
                            <form id="FORM_UNIDAD" method="post" class="uk-form-horizontal uk-margin-large uk-padding">
                                <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-medium-bottom" style="padding: 10px; background-color: #106733">
                                    <h4 style="margin: 0px;">
                                        <span uk-icon="icon: tag; ratio: 2"></span>
                                        REGISTRAR UNIDAD
                                    </h4>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                                    <div class="uk-form-controls">
                                        <input name="nombre" class="uk-input nombre_unidad" id="form-horizontal-text" type="text" placeholder="Nombre de Unidad" pattern="^([A-Zñ+áéó]|[a-zñáéó]){1,}$" required>
                                        <input type="text" name="tipo" value='unidad' style="display:none">
                                    </div>
                                </div>
                                <hr>
                                <div class="uk-flex uk-flex-center uk-margin-medium-top">
                                    <button type="submit" class="uk-button uk-button-default">Guardar</button>
                                </div>
                            </form>
                        </li>
                        <li class="invisible li_cont_c">
                            <form id="FORM_CATEGORIA" method="post" class="uk-form-horizontal uk-margin-large uk-padding">
                                <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-medium-bottom" style="padding: 10px; background-color: #106733">
                                    <h4 style="margin: 0px;">
                                        <span uk-icon="icon: tag; ratio: 2"></span>
                                        REGISTRAR CATEGORIA
                                    </h4>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                                    <div class="uk-form-controls">
                                        <input name="nombre" class="uk-input categoria_name" id="form-horizontal-text" type="text" placeholder="Nombre de Categoria" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                                        <input type="text" name="tipo" value='categoria' style="display:none">
                                    </div>
                                </div>
                                <hr>
                                <div class="uk-flex uk-flex-center uk-margin-medium-top">
                                    <button class="uk-button uk-button-default">Guardar</button>
                                </div>
                            </form>
                        </li>
                    </ul>


                    <ul class="uk-switcher switcher-container uk-margin-medium-top uk-background-secondary uk-padding uk-border-rounded" style="border: 1px solid #999;">
                        <li style="height: 260px; overflow-y: auto; overflow-x: hidden;">
                            <table class="uk-table uk-table-divider" style="height: 100px;">
                                <thead>
                                    <tr>
                                        <th class="uk-table-expand"></th>
                                        <th class="uk-table-expand">#</th>
                                        <th class="uk-table-expand">Nombre</th>
                                        <th class="uk-table-expand">Acciones</th>
                                    </tr>
                                </thead>
                                <div class="uk-flex uk-flex-center uk-flex-middle" style="padding: 10px; background-color: rgb(0, 150, 64);">
                                    <h4 style="margin: 0px;">
                                        <span uk-icon="icon: list; ratio: 2"></span>
                                        MARCAS REGISTRADAS
                                    </h4>
                                </div>
                                <tbody id="TemplateMarca">

                                </tbody>
                            </table>
                        </li>
                        <li style="height: 260px; overflow-y: auto; overflow-x: hidden;">
                            <table class="uk-table uk-table-divider">
                                <thead>
                                    <tr>
                                        <th class="uk-table-expand"></th>
                                        <th class="uk-table-expand">#</th>
                                        <th class="uk-table-expand">Nombre</th>
                                        <th class="uk-table-expand">Acciones</th>
                                    </tr>
                                </thead>
                                <div class="uk-flex uk-flex-center uk-flex-middle" style="padding: 10px; background-color: rgb(0, 150, 64);">
                                    <h4 style="margin: 0px;">
                                        <span uk-icon="icon: list; ratio: 2"></span>
                                        UNIDADES REGISTRADAS
                                    </h4>
                                </div>
                                <tbody id="TemplateUnidad">

                                </tbody>
                            </table>
                        </li>
                        <li style="height: 260px; overflow-y: auto; overflow-x: hidden;">
                            <table class="uk-table uk-table-divider">
                                <thead>
                                    <tr>
                                        <th class="uk-table-expand"></th>
                                        <th class="uk-table-expand">#</th>
                                        <th class="uk-table-expand">Nombre</th>
                                        <th class="uk-table-expand">Acciones</th>
                                    </tr>
                                </thead>
                                <div class="uk-flex uk-flex-center uk-flex-middle" style="padding: 10px; background-color: rgb(0, 150, 64);">
                                    <h4 style="margin: 0px;">
                                        <span uk-icon="icon: list; ratio: 2"></span>
                                        CATEGORIAS REGISTRADAS
                                    </h4>
                                </div>
                                <tbody id="TemplateCategoria">

                                </tbody>
                            </table>
                        </li>
                    </ul>

                    <!-- MODALES PARA EDITAR Y ELIMINAR -->
                    <div>
                        <!-- *********************************modal de Editar********************************* -->

                        <div class="uk-flex-top" id="edit-U_M_C" uk-modal>
                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                <div class="uk-modal-header">
                                    <h2 class="uk-modal-title modal_title_rename"></h2>
                                </div>
                                <div class="uk-modal-body">
                                    <form id="form_edit-U-C-M" method="post" class="uk-form-horizontal uk-margin-large">
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="form-horizontal-text">Nombre</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input name_U-C-M_edit" name="nombre" id="form-horizontal-text" type="text" placeholder="Nombre de marca" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$">
                                                <input id="Edit_type" type="text" name="tipo" style="display:none">
                                                <input id="id_delete_edit-U-M-C" type="text" name="ID" style="display:none">
                                                <input type="submit" id="editar_U-M-C" style="display:none">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="uk-modal-footer uk-text-right">
                                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                                    <label class="subir uk-button uk-button-secondary" for="editar_U-M-C">Guardar</label>
                                </div>
                            </div>
                        </div>

                        <!-- *********************************modal de eliminar********************************* -->

                        <div id="eliminar-U_M_C" class="uk-flex-top uk-modal" uk-modal bg-close='false'>
                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                <div class="uk-modal-header uk-flex uk-flex-middle">
                                    <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                                    <h2 class="uk-modal-title uk-margin-remove-top modalDeleteTitle">ELIMINAR</h2>
                                </div>
                                <div class="uk-modal-body">
                                    <p class="modalDeleteBody">Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
                                </div>
                                <div class="uk-modal-footer uk-text-right">
                                    <form id="FORM-DELETE_U-M-C" action="post">
                                        <input type=number id="IDDeleteM-U-C" name="ID" style="display: none;">
                                        <input type=text id="IDTypeDeleteM-U-C" name="tipo" style="display: none;">
                                        <button class="uk-button uk-button-default uk-modal-close cancelar" type="button">Cancelar</button>
                                        <button class="uk-button uk-button-secondary" type="submit">Aceptar</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </li>

        </ul>
    </section>


</main>
<script src="static/javaScript/librerias/JsBardcode.js" defer></script>

<!-- <script src="static/javascript/funcionDataTable.js" defer></script> -->

<script src="static/javascript/Ajax/product.js" defer></script>
<script src="static/javascript/Ajax/unidades.js" defer></script>

<script src="static/javascript/Ajax/categorias.js" defer></script>
<script src="static/javascript/Ajax/marcas.js" defer></script>
<script src="static/javascript/librerias/dataTable/dataTables.js" defer></script>
<script src="static/javascript/librerias/dataTable/moment.min.js" defer></script>
<script src="static/javascript/librerias/dataTable/dataTables.dateTime.min.js" defer></script>
<script src="static/javascript/librerias/dataTable/dataTables.searchPanes.js" defer></script>
<script src="static/javascript/librerias/dataTable/searchPanes.dataTables.js" defer></script>
<script src="static/javascript/librerias/dataTable/dataTables.select.js" defer></script>
<script src="static/javascript/librerias/dataTable/select.dataTables.js" defer></script>




</body>

</html>