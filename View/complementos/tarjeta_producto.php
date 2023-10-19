<?php
echo '
<div>
    <div class="uk-card uk-card-default uk-padding-small uk-background-secondary uk-light uk-border-rounded">
        <article class="uk-margin-small-bottom uk-inline">
            <div uk-lightbox>
                <a href="Media/imagenes/'.$row['imagen'].'" data-caption="'.$row['nombre'].'">
                    <img src="Media/imagenes/'.$row['imagen'].'" alt="" class="img_product">
                </a>
            </div>
            
            <div class="uk-position-top-right uk-position-small">
                <a href="#modal-details-product'.$row['id'].'" uk-toggle>
                    <span class="Bg-info" uk-icon="icon: info; ratio: 1.5"></span>
                </a>
            </div>
        </article>
        <div class="uk-flex uk-flex-between">
            <div>
                <h4 class="uk-margin-remove uk-text-bolder uk-text-truncate" style="width: 115px;">'.$row['nombre'].'</h4>
                <p class="uk-margin-remove uk-text-meta">Existencia: <b class="uk-text-success">'.$clase_Producto->search_stock($row['id']).'</b></p>
            </div>
            <div class="uk-flex uk-flex-middle uk-margin-small-left">
                <a href="#Producto-modificar'.$row['id'].'" uk-toggle><span class="uk-margin-small-right uk-icon-button" uk-icon="icon: file-edit"></span></a>
                <a href="#eliminar_product'.$row['id'].'" uk-toggle><span class="uk-icon-button" uk-icon="icon: trash"></span></a>
                <div class="uk-margin-small-left">
                    <a href="#product-date'.$row['id'].'" uk-toggle uk-tooltip="title:AÑADIR PRODUCTO; delay: 500">
                        <img class="btn_agg" src="static/images/boton.png" alt="" width="38px">
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- ************************************ Modal de Detalles de producto ************************************ -->

    <div id="modal-details-product'.$row['id'].'" class="uk-flex-top" uk-modal>
            <div
                class="uk-modal-dialog uk-modal-body uk-border-rounded uk-margin-auto-vertical container-modal-detailProduct">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div>

                    <div class="uk-flex uk-flex-center uk-flex-wrap  container-detailProduct">
                        <div class="uk-margin-small-right margin-img-detailPoduct">
                            <img src="Media/imagenes/'.$row['imagen'].'" alt="" width="155px"
                                style="height: 195px; object-fit: cover;">
                        </div>
                        <div class="container-stats-productDetail">
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">NOMBRE</h5>
                                </div>
                                <div>
                                    <h5
                                        class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        '.$row['nombre'].'</h5>
                                </div>
                            </div>
                            <div class="uk-flex">
                                <div>
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2" style="float: left;"></span>
                                    <h5 class="uk-margin-small-right uk-margin-remove-top uk-margin-remove-left uk-margin-remove-bottom uk-text-bolder"
                                        style="float: left;">DESCRIPCIÓN</h5>
                                    <h5 class="Description-item-productDetail uk-margin-remove Color-icon-detailProduct uk-text-bold uk-text-uppercase"
                                        style="width: 360px; line-height: 23px;">
                                        '.$row['descripcion'].'
                                    </h5>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">CATEGORIA</h5>
                                </div>
                                <div>
                                    <h5
                                        class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        '.$row['id_categoria'].'</h5>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">EXISTENCIA</h5>
                                </div>
                                <div>
                                    <h5
                                        class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        '.$clase_Producto->search_stock($row['id']).'
                                    </h5>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle" style="height: 45px;">
                                <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                    <span class="uk-margin-small-right Color-icon-detailProduct"
                                        uk-icon="icon: tag; ratio: 1.2"></span>
                                    <h5 class="uk-margin-remove uk-text-bolder">PRECIO UNITARIO</h5>
                                </div>
                                <div>
                                    <h5
                                        class="uk-margin-remove uk-text-emphasis Color-icon-detailProduct uk-text-bold uk-text-uppercase">
                                        '.$row['precio_venta'].'
                                        BS</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="uk-divider-icon Color-icon-detailProduct">

                    <div>
                        <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-bottom">
                            <span class="uk-margin-small-right Color-icon-detailProduct"
                                uk-icon="icon: tag; ratio: 1.2"></span>
                            <h5 class=" uk-text-bold uk-text-center uk-margin-remove">PROVEEDOR</h5>
                        </div>

                        ';
                        // buscar_proveedores_cantidad($row['id']);
                        $clase_detalles = new Proveedor();
                        $resultado3 = $clase_detalles->search();

                        for ($u=0; $u < $resultado3->num_rows and $resultado3->num_rows > 0; $u++) { 
                            $row2 = $resultado3->fetch_assoc();
                            echo '
                            <section class="uk-margin-small-bottom" style="height: 150px; overflow: auto;">
                                <ul uk-accordion>

                                        
                                    <li class="uk-text-uppercase">
                                        <a class="uk-accordion-title uk-text-bold uk-text-default" href="#"
                                            style="color: #106733;">
                                            <span uk-icon="icon:bookmark; ratio: 1.5"></span>
                                            '.$row2['nombre'].'
                                        </a>
                                        <div class="uk-accordion-content">';
                                        $clase_nose = new Lote();
                                        $resultado4 = $clase_nose->search_with_producto_and_proveedor($row['id'],$row2['id']);

                                        for ($o=0; $o < $resultado4->num_rows; $o++) { 
                                            $row3 = $resultado4->fetch_assoc();

                                            echo ' 
                                            <div class="uk-flex uk-flex-center uk-flex-middle">
                                                <article class="tag_modal-detailProduct uk-margin-small-right">
                                                    <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                        <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                                            style="color: #fff; padding: 2px;">
                                                            LOTE Nro '.$row3["id"].'</h6>
                                                    </div>
                                                </article>
                                                <article class="tag_modal-detailProduct-2">
                                                    <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                        <span class="uk-margin-small-right icon" style="color: #fff;"
                                                            uk-icon="icon: star; ratio: 1.2"></span>
                                                        <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product"
                                                            style="color: #fff;">
                                                            CANTIDAD</h6>
                                                        <h6 class="uk-margin-small-left uk-margin-remove-right uk-margin-remove-top uk-margin-remove-bottom uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                                            style="color: #fff;">'.$row3["cantidad"].'</h6>
                                                    </div>
                                                </article>
                                                <article class="tag_modal-detailProduct uk-margin-small-left">
                                                    <div class="uk-flex uk-flex-middle uk-margin-small-right">
                                                        <span class="uk-margin-small-right icon" style="color: #fff;"
                                                            uk-icon="icon: calendar; ratio: 1.2"></span>
                                                        <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product"
                                                            style="color: #fff;">
                                                            EXP</h6>
                                                        <h6 class="uk-margin-small-left uk-margin-remove-right uk-margin-remove-top uk-margin-remove-bottom uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                                            style="color: #fff;">'.$row3["fecha_vencimiento"].'</h6>
                                                    </div>
                                                </article>
                                            </div>
                                            <hr>
                                            ';
                                            }
                                            echo '
                                        </div>
                                    </li>
                                    <hr>
                                </ul>
                            </section>';
                        }
        
                        echo '

                    </div>

                </div>
            </div>
        </div>


<!-- **************************Modal de confirmacion de eliminacion************************** -->

<div id="eliminar_product'.$row['id'].'" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">

        <div class="uk-modal-header uk-flex uk-flex-middle">
            <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
            <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
        </div>
        <div class="uk-modal-body">
            <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <label class="uk-button uk-button-secondary" type="button" for="btn-el-'.$row['id'].'">Aceptar</label>
            <form action="Controller/funcs/borrar_cosas.php" method="POST" style="display:none">
                <input type=number value="'.$row['id'].'" name="ID">
                <input type=text value="producto" name="tipo">
                <input type=submit id="btn-el-'.$row['id'].'">
            </form>
        </div>
    </div>
</div>


        <!-- ************************************ Modal de Modificar producto ************************************ -->

<div id="Producto-modificar'.$row['id'].'" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">MODIFICAR</h2>
        </div>

    	<div class="uk-modal-body">
			<form class="uk-grid-small" uk-grid method="POST" action="Controller/funcs/modificar_cosas.php" enctype="multipart/form-data">
                <input type="text" name="tipo" value="producto" id="" style="display:none">
                <input type=number value="'.$row['id'].'" name="ID" style="display:none">
                <div class="uk-width-1-2">
                    <input class="uk-input" type="text" placeholder="Nombre" aria-label="100" name="nombre" value="'.$row['nombre'].'" required>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="Descripción" aria-label="50" name="descripcion" value="'.$row['descripcion'].'">
                </div>
                <div class="uk-width-1-2@s">
                    <select class="uk-select" id="form-stacked-select" name="categoria" selectedIndex=2 required>
                        '.$list_categorias.'
                    </select>
                </div>
                <div class="uk-width-1-2@s">
                    <select class="uk-select" id="form-stacked-select" name="unidad" required>
                        '.$list_unidades.'
                    </select>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="number" step="0.1" placeholder="precio_venta" aria-label="25" name="precio_venta" value="'.$row['precio_venta'].'" required>
                </div>
                <div class="uk-width-1-3@s">
                    <input class="uk-input" type="number" placeholder="Stock mínimo" aria-label="25" name="stock_min" value="'.$row['stock_min'].'" required>
                </div>
                <div class="uk-width-1-3@s">
                    <input class="uk-input" type="number" placeholder="Stock maximo" aria-label="25" name="stock_max" value="'.$row['stock_max'].'" required>
                </div>
                <div class="uk-width-1-2@s">
                    <label class="uk-margin-medium-right" for="">IVA</label>
                    <label><input class="uk-radio" type="radio" name="IVA" value=0 checked> Exento</label>
                    <label><input class="uk-radio" type="radio" name="IVA" value=1> No Exento</label>
                </div>
                <div class="uk-width-1-1">
                    <div uk-form-custom>
                        <input type="file" accept="image/*" aria-label="Custom controls" name="imagen1">
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">Selecciona Imagen</button>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <button class="uk-button uk-button-secondary" type="submit">Guardar</button>
                </div>
            </form>
    	</div>
    </div>
</div>

        <!-- ************************************ Modal de Agg datos al producto ************************************ -->

<div id="product-date'.$row['id'].'" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detalles del lote</h2>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" uk-grid method="POST" action="Controller/funcs/agregar_cosas.php">
                <input type="text" name="tipo" value="lote" style="display:none">
                <input type="text" name="ID" value="'.$row['id'].'" style="display:none">
                <div class="uk-width-1-2@s">
                    <select class="uk-select" id="form-stacked-select" name="proveedor" required>
                        '.$list_proveedores.'
                        
                    </select>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="number" placeholder="Cantidad" aria-label="100" name="cantidad" required>
                </div>
                <div class="uk-width-1-2@s">
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
                <input type="submit" id="subir'.$row['id'].'" style="display:none">
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <label class="uk-button uk-button-secondary" type="submit" for="subir'.$row['id'].'">Guardar</label>
        </div>
    </div>
</div>

</div>
';
?>