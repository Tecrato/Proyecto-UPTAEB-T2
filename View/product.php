<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom">

    <section class="uk-flex uk-flex-center">
        <article class="uk-flex uk-flex-around cont-search uk-flex-middle uk-background-secondary Section-search">
            <div class="Section-search">
                <div class="uk-flex uk-flex-center uk-flex-middle">
                    <div class="uk-light">
                        <form class="uk-search uk-search-default">
                            <span uk-search-icon></span>
                            <input class="uk-search-input form-search uk-border-rounded" type="search" placeholder="Buscar" aria-label="Search">
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
                                    <li class="uk-margin-small-bottom"><strong>FILTRAR</strong></li>
                                    <li>
                                        <div class="uk-dark">
                                            <form>
                                                <div class="">
                                                    <div class="uk-flex uk-flex-middle">
                                                        <span class="uk-margin-small-right uk-text-bold">De</span>
                                                        <input class="uk-input" type="date" placeholder="100" aria-label="100">
                                                    </div>
                                                    <div class="uk-flex uk-flex-middle uk-margin-top">
                                                        <span class="uk-margin-small-right uk-text-bold">Hasta</span>
                                                        <input class="uk-input" type="date" placeholder="100" aria-label="100">
                                                    </div>
                                                </div>
                                                <div class="uk-margin-top">
                                                    <div class="uk-flex uk-flex-middle">
                                                        <span class="uk-margin-small-right uk-text-bold">Proveedor</span>
                                                        <select class="uk-select" id="form-stacked-select" name="distribuidor" required>
                                                            <option selected disabled>Proveedor</option>
                                                            <option>Option 01</option>
                                                            <option>Option 02</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="uk-margin-top">
                                                    <div>
                                                        <p class="uk-text-bold">Categoria</p>
                                                    </div>
                                                    <div class="">
                                                        <label for="name">Categoria 1</label>
                                                        <input type="radio" name="name" id="">
                                                        <br>
                                                        <label for="name">Categoria 2</label>
                                                        <input type="radio" name="name" id="">
                                                        <br>
                                                        <label for="name">Categoria 3</label>
                                                        <input type="radio" name="name" id="">
                                                        <br>
                                                        <label for="name">Categoria 4</label>
                                                        <input type="radio" name="name" id="">
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


                <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-left uk-margin-small-right uk-light cont_imprimir">
                    <a href="InventarioPDF" target="_blank" class="uk-icon-link" uk-tooltip="title:Imprimir Inventario; delay: 500">
                        <span uk-icon="icon: print; ratio: 1.7"></span>
                    </a>
                </div>

                <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-right">
                    <a class="btn-modal-register" href="#modal-register-product" uk-tooltip="title:Añadir; delay: 500">
                        <img class="btn_agg" src="static/images/btn_agg.png" alt="" width="38px">
                    </a>
                </div>
            </div>

        </article>
    </section>

    <!-- ****************** producto ****************** -->
    
    <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small uk-flex-center" uk-grid>
        <div class="container_marca_agua">
            <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
        </div>
        <div class="[email protected] uk-grid-large uk-flex-center height_controller container-target-product" uk-grid uk-height-match="target: > div > .uk-card">
            <!-- aqui se cargan las tarjetas de productos con js -->
        </div>
    </section>


    <div id="container-modals">
        <!-- aqui se cargan los modales dinamicamente con js -->
    </div>


    <!-- ****************** Botones de paginacion ****************** -->

    <?php include("../View/complementos/btn_pag.html"); ?>

</main>

<?php require("../View/complementos/footer.php");?>