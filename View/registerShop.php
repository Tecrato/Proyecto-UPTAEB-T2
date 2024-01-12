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
            <?php for ($i=0; $i < 1; $i++) { ?>
            <div>
                <div class="target-detail-fact uk-card uk-card-default uk-padding-small uk-background-secondary uk-light uk-border-rounded"
                    style="width: 300px;">
                    <div class="uk-background-secondary">
                        <div class="uk-flex uk-flex-middle uk-flex-between">
                            <div class="uk-flex uk-flex-middle">
                                <img class="uk-margin-small-right" src="static/images/logo_m.png" alt="" width="50PX">
                                <h3 class="uk-margin-remove uk-text-bolder">#
                                    <?php echo "$i"?>
                                </h3>
                            </div>
                            <div class="">
                                <a class="ImprBtn" href="Detalles_factura"
                                    uk-tooltip="title:Imprimir; delay: 500"><span
                                        class="uk-margin-small-right uk-icon-button" uk-icon="icon: print"></span></a>
                                <a href="#modal-center" uk-toggle uk-tooltip="title:Eliminar; delay: 500"
                                    class="uk-icon-button uk-margin-small-right" uk-icon="trash"></a>
                            </div>


                            <!-- **************************Modal de confirmacion de eliminacion************************** -->

                            <div id="modal-center" class="uk-flex-top" uk-modal>
                                <div class="uk-modal-dialog uk-margin-auto-vertical">

                                    <div class="uk-modal-header uk-flex uk-flex-middle">
                                        <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                                        <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
                                    </div>
                                    <div class="uk-modal-body">
                                        <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante
                                        </p>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button class="uk-button uk-button-default uk-modal-close"
                                            type="button">Cancelar</button>
                                        <button class="uk-button uk-button-secondary" type="button">Aceptar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- ****************************************************************************** -->

                        <hr class="uk-margin-remove divider">

                        <section>
                            <div>
                                <div>
                                    <div>
                                        <p class="uk-text-meta uk-margin-remove">N∘_OPERACIÓN: <b
                                                class="uk-text-success">001</b>
                                        </p>
                                        <hr class="uk-margin-remove divider-2">
                                        <p class="uk-text-meta uk-margin-remove">FECHA: <b
                                                class="uk-text-success">10/7/2023</b></p>
                                        <hr class="uk-margin-remove divider-2">
                                        <p class="uk-text-meta uk-margin-remove">CLIENTE: <b
                                                class="uk-text-success">Carlos
                                                Merlo</b></p>
                                        <hr class="uk-margin-remove divider-2">
                                        <p class="uk-text-meta uk-margin-remove">VENDEDOR: <b
                                                class="uk-text-success">JUAN</b></p>
                                        <hr class="uk-margin-remove divider-2">
                                        <p class="uk-text-meta uk-margin-remove">ESTADO FACTURA: <b
                                                class="state-fact uk-text-emphasis">PAGADO</b></p>
                                        <hr class="uk-margin-remove divider-2">
                                        <p class="uk-text-meta uk-margin-remove">TOTAL FACTURA: <b
                                                class="uk-text-success">100
                                                BS</b></p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>



    <div class="Paginacion uk-flex uk-flex-center">
        <ul class="uk-pagination">
            <li><a href="#"><span class="uk-margin-small-right" uk-pagination-previous></span> Previous</a></li>
            <li><a href="#">Next <span class="uk-margin-small-left" uk-pagination-next></span></a></li>
        </ul>
    </div>
</main>


<?php require("../View/complementos/footer.php"); ?>
