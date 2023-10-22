<?php require ("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom">

    <section class="uk-flex uk-flex-center">

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

            <div class="uk-flex uk-flex-center uk-flex-middle Options-nav">

                <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-right">
                    <a href="#agregar_client" uk-toggle uk-tooltip="title:Añadir Proveedor; delay: 500">
                        <img class="btn_agg" src="static/images/btn_agg_cliente.png" alt="" width="40px">
                    </a>
                </div>

                <!-- ****************** Modal de registro ****************** -->

                <div id="agregar_client" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">REGISTRO CLIENTES</h3>
                        </div>
                        <div class="uk-modal-body">
                            <form class="uk-grid-small" uk-grid method="POST" action="Controller/funcs/agregar_cosas.php" enctype="multipart/form-data">
                            <input type="text" name="tipo" value='Cliente' id="" style="display:none">
                            <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Nombre" aria-label="100">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Apellido" aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <select class="uk-select" id="form-stacked-select" name="Documento" required>
                                        <option selected disabled>Documento</option>
                                        <option>V</option>
                                        <option>J</option>
                                        <option>E</option>
                                    </select>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="cedula"
                                        aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Telefono"
                                        aria-label="50">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" placeholder="Dirección"
                                        aria-label="50">
                                </div>
                                <input type="submit" id="subirC" style="display:none">
                            </form>
                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                                <label class="uk-button uk-button-secondary" type="button" for="subirC">Guardar</label>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>

        </article>

    </section>




    <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small uk-flex-center" uk-grid>
        <div class="container_marca_agua invisible">
            <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
        </div>
        <div class="[email protected] uk-grid-large uk-flex-center height_controller" uk-grid
            uk-height-match="target: > div > .uk-card">
          
      
            <div>
                <div class="target_supplier uk-card uk-card-default uk-flex uk-padding-small uk-background-secondary uk-light uk-border-rounded"
                    style="width: 370px;">
                    <div>
                        <div class="img_proveedor_container uk-border-rounded">
                            <img src="static/images/undraw_profile_2.svg" alt="" width="120px" />
                            <h5
                                class="uk-margin-remove-left uk-margin-remove-right uk-margin-small-top uk-margin-small-bottom uk-text-center">
                                Jose Nose
                            </h5>
                        </div>
                    </div>

                    <div>
                        <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-small-bottom">
                            <h4 class="uk-margin-remove-bottom uk-margin-right uk-text-center">
                                DATOS
                            </h4>
                            <div>
                                <a href="#modificar_client" uk-toggle uk-tooltip="title:Editar; delay: 500"
                                    class="uk-icon-button uk-margin-small-right" type="button"
                                    style="border: none; cursor: pointer">
                                    <span uk-icon="icon: file-edit"></span>
                                </a>
                                <a href="#eliminar_supplier" uk-toggle uk-tooltip="title:Eliminar; delay: 500"
                                    class="uk-icon-button uk-margin-small-right" uk-tooltip="title:Eliminar; delay: 500"
                                    type="button" style="border: none; cursor: pointer" type="button">
                                    <span uk-icon="icon: trash"></span>
                                </a>
                            </div>
                        </div>

                        <hr class="uk-margin-bottom uk-margin-remove-top hr_supplier" />

                        <div class="Container-details-suppliers" style="width: 200px;">
                            <div class="uk-flex">
                                <h6 class="uk-margin-small">Documento</h6>
                                <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                    500000000
                                </p>
                            </div>
                            <div class="uk-flex">
                                <h6 class="uk-margin-small">Telefono</h6>
                                <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-text-meta">
                                    0000000000000
                                </p>
                            </div>
                            <div class="">
                                <h6 class="uk-margin-small-right uk-margin-remove-bottom" style="float: left;">Direccion
                                </h6>
                                <p class="uk-margin-small uk-margin-small-left uk-margin-remove-top uk-margin-remove-left uk-text-meta"
                                    style="width: 185px; line-height: 23px;">
                                    carrera 10, entre 15 y 17, sector matica de rosa
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </section>

    <!-- ****************** Modal de modificacion ****************** -->

    <div id="modificar_client" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">EDITAR CLIENTES</h3>
            </div>
            <div class="uk-modal-body">
                <form class="uk-grid-small" uk-grid>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Apellido" aria-label="50">
                    </div>
                    <div class="uk-width-1-2@s">
                        <select class="uk-select" id="form-stacked-select" name="categoria" required>
                            <option selected disabled>Documento</option>
                            <option>V</option>
                            <option>J</option>
                            <option>E</option>
                        </select>
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Numero de documento" aria-label="50">
                    </div>
                </form>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <button class="uk-button uk-button-secondary" type="button">Guardar</button>
            </div>
        </div>
    </div>

    <!-- **************************Modal de confirmacion de eliminacion************************** -->

    <div id="eliminar_supplier" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header uk-flex uk-flex-middle">
                <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
            </div>
            <div class="uk-modal-body">
                <p>
                    Deseas eliminar este registro para siempre? No podras recuperlo mas
                    adelante
                </p>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">
                    Cancelar
                </button>
                <button class="uk-button uk-button-secondary" type="button">
                    Aceptar
                </button>
            </div>
        </div>
    </div>

    <!-- ****************************************************************************** -->

    <!-- ****************** Botones de paginacion ****************** -->
    
    <?php include ("../View/complementos/btn_pag.html"); ?>
</main>




<?php require("../View/complementos/footer.php"); ?>