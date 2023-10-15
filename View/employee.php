<?php require ("../View/complementos/header.php"); ?>

<main class="Bg-Main-home uk-padding">

<section class="uk-background-secondary uk-margin-small-top uk-light uk-flex uk-flex-around uk-flex-middle Section-search">
        <div class=" uk-flex uk-flex-center uk-flex-middle">
            <form class="uk-search uk-search-default form-search">
                <a href="" uk-search-icon></a>
                <input class="uk-search-input uk-border-pill " type="search" placeholder="Buscar..." aria-label="Search">
            </form>
        </div>
        <div class="uk-flex uk-flex-center uk-flex-middle">
            <a href="#modal-sections" uk-toggle uk-tooltip="title:Añadir; delay: 500">
                <img src="./Image/Boton.png" alt="" width="50px">
            </a>
        </div>

                           <!-- ****************** Modal de registro ****************** -->

        <div  id="modal-sections" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h3 class="uk-modal-title">Registro de empleados</h3>
                </div>
            <div class="uk-modal-body ">
                <form class="uk-grid-small" uk-grid>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Apellido" aria-label="50">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Cédula" aria-label="50">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="email" placeholder="Correo electrónico" aria-label="25">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Número de teléfono" aria-label="25">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Dirección" aria-label="25">
                    </div>
                </form>
            </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <button class="uk-button uk-button-secondary" type="button">Guardar</button>
                </div>
            </div>
        </div>
    </section>

<div class="uk-overflow-auto uk-margin-medium">
<table class="uk-table uk-table-middle uk-table-divider uk-light">
    <thead>
        <tr>
            <th>#</th>
            <th class="uk-width-small">Nombre</th>
            <th>Apellido</th>
            <th>Cédula</th>
            <th>Correo Electrónico</th>
            <th>Dirección</th>
            <th>Número de teléfono</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i=1; $i <= 6; $i++) { ?>
        <tr>
            <td><?php echo "$i"?></td>
            <td>Luis</td>
            <td>Garnica</td>
            <td>000000000000</td>
            <td>correoejemplo@gmail.com</td>
            <td>Direccion de ejemplo</td>
            <td>D000000000000</td>
            <td>

                <a href="#modal-modificar-empleado" uk-toggle uk-tooltip="title:Editar; delay: 500" class="uk-icon-button uk-margin-small-right" type="button" style=" border: none; cursor: pointer;">
                    <span uk-icon="icon: file-edit"></span>
                </a>


                                    <!-- ****************** Modal de modificacion ****************** -->


        <div  id="modal-modificar-empleado" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h3 class="uk-modal-title">modificar</h3>
                </div>
            <div class="uk-modal-body ">
                <form class="uk-grid-small" uk-grid>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Nombre" aria-label="100">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Apellido" aria-label="50">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Cédula" aria-label="50">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="email" placeholder="Correo Electrónico" aria-label="25">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Número de teléfono" aria-label="25">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="Dirección" aria-label="25">
                    </div>
                </form>
            </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <button class="uk-button uk-button-secondary" type="button">Guardar</button>
                </div>
            </div>
        </div>


                <a class="uk-icon-button uk-margin-small-right" uk-tooltip="title:Eliminar; delay: 500"type="button" style=" border: none; cursor: pointer;" type="button">
                    <span uk-icon="icon: trash"></span>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
    <div class="Paginacion uk-flex uk-flex-center">
        <ul class="uk-pagination">
            <li><a href="#"><span class="uk-margin-small-right" uk-pagination-previous></span> Previous</a></li>
            <li><a href="#">Next <span class="uk-margin-small-left" uk-pagination-next></span></a></li>
        </ul>
    </div>
</main>




<?php require("../View/complementos/footer.php"); ?>