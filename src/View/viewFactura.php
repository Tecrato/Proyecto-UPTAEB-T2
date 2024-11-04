<?php require('complementos/header.php') ?>



<div class="uk-flex uk-padding-small uk-padding-remove-left uk-padding-remove-right">

    <!-- ****************************menu de navegacion**************************** -->


    <div class="uk-width-1-4@s uk-light container_fact">
        <div class="uk-flex uk-flex-center container_fact_filter">
            <div class="uk-margin">
                <form class="uk-search uk-search-default filterSearch">
                    <span class="uk-search-icon-flip" uk-search-icon></span>
                    <input class="uk-search-input search_viewFact" type="search" placeholder="Buscar" aria-label="Search">
                </form>
            </div>
            <div class="uk-inline">
                <button class="uk-icon-button uk-margin-small-left" uk-icon="settings" type="button"></button>
                <div uk-dropdown="mode: click">
                    <form class="FORM_DATE_WIEWFACT">
                        <div class="uk-margin-small-top">
                            <div class="uk-flex uk-flex-middle uk-margin-small-top">
                                <span class="uk-margin-small-right uk-text-bold">De</span>
                                <input class="uk-input" type="date" placeholder="100" aria-label="100" style="color: #999; border-color: #999;">
                            </div>
                            <div class="uk-flex uk-flex-middle uk-margin-top">
                                <span class="uk-margin-small-right uk-text-bold">Hasta</span>
                                <input class="uk-input" type="date" placeholder="100" aria-label="100" style="color: #999; border-color: #999;">
                            </div>
                        </div>
                        <div class="uk-margin-top">
                            <div class="uk-flex uk-flex-center">
                                <input class="uk-button uk-button-secondary" type="submit" value="APLICAR">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>




        <div class="Contanier_fact_item">
            <!-- aqui cargan las tarjetas con sus detalles -->
        </div>

    </div>


    <div class="uk-width-1-1@s uk-light  uk-padding-small">
        <div class="uk-flex uk-flex-between">
            <h3 class="uk-text-bold n_factura">N_FACTURA </h3>
            <!-- <nav class="Nav1" uk-dropnav="mode: click">
                        <ul class="uk-subnav uk-margin-remove uk-padding-remove">
                            <li>
                                
                                <a href="" class="uk-icon-button" uk-icon="more"></a>
                                <div class="uk-dropdown uk-border-rounded">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>
                                            <a class="uk-padding-remove-vertical" href="#">
                                                <span class="uk-margin-small-right" uk-icon="file-edit"></span>
                                                <p>Editar</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="uk-padding-remove-vertical" href="#">
                                                <span class="uk-margin-small-right" uk-icon="trash"></span>
                                                <p>Eliminar</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>            -->
        </div>

        <div class="uk-background-secondary uk-padding-small uk-border-rounded">
            <iframe class="iframe" src="PDFFactura" frameborder="0"></iframe>
        </div>
    </div>

</div>

<script src="src/static/javascript/Ajax/viewFactura.js"></script>


</body>

</html>