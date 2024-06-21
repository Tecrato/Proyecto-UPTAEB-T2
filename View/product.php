<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom main-Product uk-light">
    <section class="">
        <ul uk-tab>
            <li><a id="aProductos" class="itemSwitcher1" href="#"><img class="uk-preserve-width uk-margin-small-right img1ProductSwitcher" src="./static/images/cajas (2).png" width="30" height="30" alt="">PRODUCTOS</a></li>
            <li><a id="aEntradas" class="itemSwitcher2" href="#"><img class="uk-preserve-width uk-margin-small-right img2ProductSwitcher" src="./static/images/suministros.png" width="32" height="32" alt="">ENTRADAS</a></li>
            <li><a id="aOtros" class="itemSwitcher3" href="#"><img class="uk-preserve-width uk-margin-small-right img4ProductSwitcher" src="./static/images/menu.png" width="32" height="32" alt="">OTROS</a></li>
            <li><a id="aProductsDesct" class="itemSwitcher4" href="#"><img class="uk-preserve-width uk-margin-small-right img5ProductSwitcher" src="./static/images/papelera-de-reciclaje.png" width="32" height="32" alt="">PRODUCTOS DESACTIVADOS</a></li>
        </ul>

        <ul class="uk-switcher uk-margin">
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
                                        <div class="uk-margin-left">
                                            <a id="iconReportInv" href="InventarioPDF" target="_blank" class="uk-icon-link" uk-tooltip="title:Reporte Inventario; delay: 500" uk-icon="icon: file-pdf; ratio: 1.5"></a>
                                            <a id="registerProduct" href="#modal-register-product" uk-toggle uk-tooltip="title:Añadir; delay: 500" class="uk-margin-small-left btn-modal-register">
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
                                                <ul class="uk-nav uk-dropdown-nav filter_category">
                                                    <!-- aqui se cargan las categorias con js -->
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a id="productFilterMarca" href="#">MARCA <span uk-drop-parent-icon></span></a>
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
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Nombre</label>
                                        <div class="uk-form-controls">
                                            <input class="NameUpdateProduct uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" pattern="([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@s">
                                        <label class="uk-form-label">Código</label>
                                        <div class="uk-form-controls">
                                            <input class="CodeUpdateProduct uk-input" type="text" placeholder="Código" aria-label="100" name="codigo" pattern="^\d{12}$" minlength="12" maxlength="12"  autocomplete="off"required>
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
                                    <div class="uk-width-1-3@s">
                                        <label class="uk-form-label">Precio Venta</label>
                                        <div class="uk-form-controls">
                                            <input class="PVUpdateProduct uk-input" type="number" pattern="^([\d]){1,4}(.[\d]{1,2})?$" min="0.1" step="0.1" placeholder="precio_venta" aria-label="25" name="precio_venta" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3@s">
                                        <label class="uk-form-label">Stock Minimo</label>
                                        <div class="uk-form-controls">
                                            <input class="SMMUpdateProduct uk-input" type="number" min="1" placeholder="Stock mínimo" aria-label="25" name="stock_min" required>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3@s">
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


            <li>
                <div class="height_controller">
                    <main class="uk-background-secondary uk-padding uk-border-rounded" uk-filter="target: .js-filter; animation: fade">
                        <!-- container-filter sera el  que tenga todos los filtros de busqueda -->
                        <section class="container-filter">
                            <div>
                                <nav uk-dropnav="mode: click">
                                    <ul class="uk-subnav uk-margin-remove" style="gap: 25px;">
                                        <li id="SupplierFilterAll" class="uk-active" uk-filter-control><a href="#">TODO</a></li>
                                        <li>
                                            <a id="SupplierFilterOne" href="#">PROVEEDORES <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav filter_prov_entry">
                                                    <!-- aqui se cargan los proveedores con js -->
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
                                    </ul>
                                </nav>
                            </div>

                            <!-- input_search sera el contenedor del input tipo search -->
                            <div class="uk-margin">
                                <form class="form_search_entrys uk-search uk-search-default" style="width: 500px;">
                                    <span class="uk-search-icon-flip" uk-search-icon></span>
                                    <input id="entrada" class="uk-search-input" type="search" placeholder="Buscar Entrada" aria-label="Search">
                                </form>
                            </div>
                        </section>

                        <!-- conatainer_table contendra la tabla -->
                        <section>
                            <div class="uk-overflow-auto altura_table_entry">
                                <table class="uk-table uk-table-divider uk-table-hover">
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

                                        <!-- tbody, donde se generaran los tr y td con programacion -->
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
                            </div>
                        </section>
                    </main>

                </div>

            </li>



            <!-- este es el nuevo item, contiene las marcas, categorias y unidades -->
            <li>
                <ul class="uk-subnav uk-subnav-pill uk-margin-medium-top uk-background-secondary uk-flex uk-flex-center" uk-switcher="connect: .switcher-container" style="padding: 10px;">
                    <li><a id="liMarcas" href="#">Marcas</a></li>
                    <li><a id="liUnidades" href="#">Unidades</a></li>
                    <li><a id="liCategorias" href="#">Categorias</a></li>
                </ul>
                <div class="uk-flex uk-flex-around uk-flex-wrap">
                    <ul class="uk-switcher switcher-container uk-background-secondary uk-margin-medium-top uk-border-rounded" style="border: 1px solid #999;">
                        <li>
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
                        <li>
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
                        <li>
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
                                                <input id="SearchProductsOff" class="uk-search-input searchProductNotActive" type="search" placeholder="Buscar" aria-label="Search">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <nav uk-dropnav="mode: click">
                                    <ul class="uk-subnav filter_product" uk-margin>
                                        <li class="uk-active" uk-filter-control><a id="productOffFilterAll" href="#">TODO</a></li>
                                        <li>
                                            <a id="productOffFilterCategory" href="#">CATEGORIA <span uk-drop-parent-icon></span></a>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav uk-dropdown-nav filter_category">
                                                    <!-- aqui se cargan las categorias con js -->
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a id="productOffFilterMarca" href="#">MARCA <span uk-drop-parent-icon></span></a>
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
                            <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small viewP" uk-grid>
                                <div class="container_marca_agua container_marca_agua2">
                                    <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
                                </div>
                                <div class="[email protected] uk-grid-large uk-flex-center cont_product_desactive height_controller2 js-filter" uk-grid uk-height-match="target: > div > .uk-card">
                                    <!-- aqui se cargan las tarjetas de productos con js -->
                                </div>
                            </section>
                            <div class="uk-flex uk-flex-center">
                                <ul class="uk-pagination uk-pagination2 uk-margin-large-top">
                                    <li><a class="pag-btn-productos" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                                    <li><a class="pag-btn-productos" data-direccion="back">Previous</a></li>
                                    <li><a class="pag-btn-productos" data-direccion="next">Next</a></li>
                                    <li><a class="pag-btn-productos" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </li>
        </ul>
    </section>


</main>
<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javaScript/librerias/JsBardcode.js"></script>
<script src="static/javascript/FuncionesGenerales.js"></script>
<script src="static/javascript/Ajax/product.js"></script>
<script src="static/javascript/Ajax/entry.js"></script>
<script src="static/javascript/Ajax/unidades.js"></script>
<script src="static/javascript/Ajax/categorias.js"></script>
<script src="static/javascript/Ajax/marcas.js"></script>
<script src="static/javascript/funcionDataTable.js"></script>




</body>

</html>