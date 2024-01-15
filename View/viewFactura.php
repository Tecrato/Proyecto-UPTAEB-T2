<?php require('complementos/header.php')?>



   <div class="uk-flex uk-padding-small uk-padding-remove-left uk-padding-remove-right">

                            <!-- ****************************menu de navegacion**************************** -->


        <div class="uk-width-1-4@s uk-light container_fact">
            <div class="uk-flex uk-flex-center container_fact_filter">
                <div class="uk-margin">
                    <form class="uk-search uk-search-default filterSearch">
                        <span class="uk-search-icon-flip" uk-search-icon></span>
                        <input class="uk-search-input" type="search" placeholder="Buscar" aria-label="Search">
                    </form>
                </div>

                <div class="uk-margin-medium-left">
                    <a href="#" class="uk-icon-button" uk-icon="settings"></a>
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
                <iframe class="iframe" src="FacturaPDF" frameborder="0"></iframe>
            </div>
        </div>
        
   </div>

<?php require('complementos/footer.php')?>