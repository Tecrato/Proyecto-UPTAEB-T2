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
               <?php for ($i=0; $i < 3; $i++) { ?> 
                <article>
                    <div class="uk-flex uk-flex-between uk-flex-middle uk-background-secondary Target_factura" id=<?php echo $i ?>>
                        <div class="uk-flex uk-flex-middle uk-margin-medium-right">
                            <div class="uk-margin-small-right">
                                <img src="static/images/logo_m.png" alt="" width="60px">
                            </div>
                            <div class="uk-flex uk-flex-column uk-flex-center">
                                <h6 class="uk-margin-remove text_fact_info">Nombre del cliente</h6>
                                <h6 class="uk-margin-remove text_fact_info">N_factura</h6>
                                <h6 class="uk-margin-remove text_fact_info status_fact">Pagada</h6>
                            </div>
                        </div>
                        <div>
                            <div>  
                                <h4 class="uk-margin-remove uk-text-right uk-text-bold">BS  300</h4>
                                <p class="uk-margin-remove uk-text-meta text_fact_date">00/00/0000</p>
                            </div>
                        </div>
                    </div>
                </article>
                 <?php } ?>
            </div>
           
        </div>


        <div class="uk-width-1-1@s uk-light  uk-padding-small">
            <div class="uk-flex uk-flex-between">
                <h3 class="uk-text-bold">N_FACTURA</h3>
                    <nav class="Nav1" uk-dropnav="mode: click">
                        <ul class="uk-subnav uk-margin-remove uk-padding-remove">
                            <li>
                                <!-- <a href="#">
                                    <span class="uk-icon uk-margin-small-right" uk-icon="icon: more; ratio: 1.5"></span>
                                </a> -->
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
                    </nav>           
            </div>

            <div class="uk-background-secondary uk-padding-small uk-border-rounded">
                <iframe class="iframe" src="./View/FacturaPDF.php" frameborder="0"></iframe>
            </div>
        </div>
        
   </div>

<?php require('complementos/footer.php')?>