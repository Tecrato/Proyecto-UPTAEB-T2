<?php require("View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-padding-remove-bottom">

    <section class="uk-background-secondary uk-padding uk-border-rounded uk-light" uk-filter="target: .js-filter">
        <div>
            <div class="uk-flex uk-flex-between" style="align-items: baseline;">
                <div class="uk-flex uk-flex-wrap" style="align-items: baseline;">
                    <div class="uk-margin-right">
                        <div class="uk-flex">
                            <div class="uk-margin formDelete">
                                <form class="uk-search uk-search-default search-responsive-product" action="" method="POST">
                                    <button class="uk-search-icon-flip" type="submit" uk-search-icon></button>
                                    <input id="SearchCustomer" class="uk-search-input" type="text" placeholder="Buscar" name="like_nombre" aria-label="Search">
                                </form>
                            </div>
                            <div class="uk-margin-left cont_btns_client-action">
                                <a id="registerCustomer" href="#agregar_client" uk-toggle uk-tooltip="title:Añadir Proveedor; delay: 500" class="uk-margin-small-left btn-agg_client invisible">
                                    <img class="btn_agg" src="./static/images/btn_agg.png" alt="" width="35px">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-margin-left container-view-order">
                    <div class="uk-width-auto uk-text-nowrap flechas">
                        <span class="uk-active" uk-filter-control="sort: data-name"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-down" aria-label="Sort ascending"></a></span>
                        <span uk-filter-control="sort: data-name; order: desc"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-up" aria-label="Sort descending"></a></span>
                    </div>
                </div>
            </div>
            
            <hr class="uk-margin-remove">

            <div>
                <section class="uk-light uk-padding uk-padding-remove-left uk-padding-remove-right uk-grid-small dataTable cont_target_client_controller" uk-grid>
                    <div class="container_marca_agua invisible">
                        <img class="marca_agua" src="static/images/logo_letras-minimarket.png" alt="">
                    </div>
                    <div class="[email protected] uk-grid-mediumy uk-flex-center dataTable2 height_controller cont_client_cards" uk-grid uk-height-match="target: > div > .uk-card">

                    </div>
                </section>
                <div class="uk-flex uk-flex-center">
                    <ul class="uk-pagination uk-margin-large-top">
                        <li><a class="pag-btn-clientes" data-direccion="start"><span class="uk-margin-small-right" uk-pagination-previous></span><span class="uk-margin-small-right" uk-pagination-previous></span></a></li>
                        <li><a class="pag-btn-clientes" data-direccion="back">Previous</a></li>
                        <li><a class="pag-btn-clientes" data-direccion="next">Next</a></li>
                        <li><a class="pag-btn-clientes" data-direccion="end"><span class="uk-margin-small-left" uk-pagination-next></span><span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- ****************** Modal de registro ****************** -->

        <div id="agregar_client" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h3 class="uk-modal-title modal_title_client">REGISTRO CLIENTES</h3>
                </div>
                <div class="uk-modal-body">
                    <form class="uk-grid-small uk-form-stacked form_client" uk-grid method="POST" action="" enctype="multipart/form-data">
                        <input type="text" name="tipo" value='cliente' style="display:none">
                        <input class="ValueInpUpdateClient" type="number" name="ID" style="display:none">

                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label">Nombre</label>
                            <div class="uk-form-controls">
                                <input class="uk-input inputNameUpdateClient" type="text" placeholder="Nombre" name="nombre" aria-label="100" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label">Apellido</label>
                            <div class="uk-form-controls">
                                <input class="uk-input inputLastNameUpdateClient" type="text" placeholder="Apellido" name="apellido" aria-label="50" pattern="([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label">Documento</label>
                            <div class="uk-form-controls">
                                <select class="uk-select inputT_DUpdateClient" id="form-stacked-select" name="documento" required>
                                    <option selected value="V">V</option>
                                    <option value="J">J</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label">Nro Documento</label>
                            <div class="uk-form-controls">
                                <input class="uk-input inputNroDcUpdateClient" type="text" placeholder="cedula" name="cedula" aria-label="50" pattern="^([\d]{1,2})\.?([\d]{3})\.?([\d]{3})$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label">Telefono</label>
                            <div class="uk-form-controls">
                                <input class="uk-input inputTLFNOUpdateClient" type="tel" id="tlfno_client" name="telefono" aria-label="50" pattern="^([\+\d]{2,4} ?)?([\d]{4}) ?\-?([\d]{3}) ?\-?([\d]{4})$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <label class="uk-form-label">Direccion</label>
                            <div class="uk-form-controls">
                                <input class="uk-input inputDirUpdateClient" type="text" placeholder="Dirección" name="direccion" aria-label="50" minlength="5" maxlength="200" required>
                            </div>
                        </div>
                        <input type="submit" id="subirC" style="display:none" required>
                    </form>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <label class="uk-button uk-button-secondary" type="button" for="subirC">Guardar</label>
                </div>
            </div>
        </div>


        <!-- **************************Modal de confirmacion de eliminacion************************** -->

        <div id="eliminar_cliente" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical">
                <div class="uk-modal-header uk-flex uk-flex-middle">
                    <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                    <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
                </div>
                <div class="uk-modal-body">
                    <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <form id="formDeleteClient" action="" method="POST">
                        <input type=number id="IdDelete_client" name="ID" style="display:none">
                        <input type=text value="cliente" name="tipo" style="display:none">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                        <button class="uk-button uk-button-secondary" type="submit">Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ****************** ****************** ****************** -->


    </section>

</main>







<script src="Plugins/build/js/intlTelInput.js"></script>
<script src="static/javascript/Ajax/client.js"></script>


</body>

</html>