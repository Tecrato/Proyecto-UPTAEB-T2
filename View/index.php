<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2">
    <!-- <h2 class="uk-text-bolder uk-light uk-margin-remove-bottom uk-padding uk-padding-remove-bottom">BIENVENIDO USUARIO</h2> -->
    <div class="uk-margin uk-heading-line uk-text-left uk-margin-remove-bottom uk-padding uk-padding-remove-bottom">
        <h2 class="uk-text-bolder uk-text-uppercase uk-light">BIENVENIDO <?php echo $_SESSION['user_name']; ?></h2>
    </div>

    <div class="[email protected] uk-grid-small uk-flex-wrap uk-flex-center uk-padding-small" uk-grid>

        <div class="uk-width-1-1 uk-margin-medium-top uk-light">
            <div class="[email protected] uk-grid-small uk-flex-wrap uk-flex-center uk-padding-small" uk-grid>
                <div class="uk-width-1-4@s">
                    <a href="" class="uk-car uk-flex uk-flex-between uk-flex-middle uk-card-default uk-card-body uk-background-secondary uk-light">
                        <article>
                            <h2 id="aaa" class="uk-margin-remove-top">0.00</h2>
                            <p class="uk-margin-remove-bottom">GANANCIAS</p>
                        </article>
                        <article>
                            <span uk-icon="icon: dolar; ratio: 5"></span>
                        </article>
                    </a href="">
                </div>

                <div class="uk-width-1-4@s">
                    <a href="Clientes" class="uk-link-reset uk-car uk-flex uk-flex-between uk-flex-middle uk-card-default uk-card-body uk-background-secondary uk-light">
                        <article>
                            <h2 class="uk-margin-remove-top"><?php echo $cliente; ?></h2>
                            <p class="uk-margin-remove-bottom">CLIENTES</p>
                        </article>
                        <article>
                            <span uk-icon="icon: users; ratio: 4"></span>
                        </article>
                    </a>
                </div>

                <div class="uk-width-1-4@s">
                    <a href="Proveedores" class="uk-link-reset uk-car uk-flex uk-flex-between uk-flex-middle uk-card-default uk-card-body uk-background-secondary uk-light">
                        <article>
                            <h2 class="uk-margin-remove-top"><?php echo $proveedor; ?></h2>
                            <p class="uk-margin-remove-bottom">PROVEEDORES</p>
                        </article>
                        <article>
                            <span uk-icon="icon: bookmark; ratio: 4"></span>
                        </article>
                    </a>
                </div>

                <div class="uk-width-1-4@s">
                    <a href="Ventas" class="uk-link-reset uk-car uk-flex uk-flex-between uk-flex-middle uk-card-default uk-card-body uk-background-secondary uk-light">
                        <article>
                            <h2 class="uk-margin-remove-top"><?php echo $factura; ?></h2>
                            <p class="uk-margin-remove-bottom">FACTURAS</p>
                        </article>
                        <article>
                            <span uk-icon="icon: factura; ratio: 4"></span>
                        </article>
                    </a>
                </div>

            </div>
        </div>

        <div class="uk-width-1-2 uk-margin-medium-top Card-items">
            <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">
                <article>
                    <h2>Stats</h2>
                    <p>Bienvenido, estos son los niveles actuales de productos</p>
                </article>
                <hr class="uk-divide">
                <section class="uk-flex uk-flex-center uk-flex-wrap section-home uk-margin-medium-top uk-margin-medium-bottom cont-stats-index">
                                    

                </section>
                <hr class="uk-divide">
                <div class="uk-flex uk-flex-center ">
                    <a class="uk-button uk-button-default uk-margin-small-top" href="/Proyecto-UPTAEB-T2/Productos">Ver más</a>
                </div>
            </div>
        </div>

        <div class="uk-width-1-2 uk-margin-medium-top padding Card-items">
            <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">
                <h3>Productos recientemente agregados</h3>
                <hr class="uk-margin-remove">
                <div>
                    <table class="uk-table">
                        <thead>
                            <tr>
                                <th>
                                    <p class="uk-text-bold uk-margin-remove">Imagen</p>
                                </th>
                                <th>
                                    <p class="uk-text-bold uk-margin-remove">NOMBRE</p>
                                </th>
                                <th>
                                    <p class="uk-text-bold uk-margin-remove">Precio</p>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($result); $i++) {
                                $row = $result[$i];
                                echo '
                                <tr>
                                    <td><img class="uk-preserve-width uk-border-circle" src="./Media/imagenes/' . $row['imagen'] . '" style="width: 48px; height: 48px; object-fit: cover;" alt=""></td>
                                    <td>' . $row['nombre'] . '</td>
                                    <td>' . $row['precio_venta'] . ' BS'. '</td>

                                </tr>';
                            } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="uk-width-1-2 uk-margin-medium-top Card-items">
            <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">
                <div>
                    <h3 class="uk-text-center uk-text-bold">VALOR TOTAL INVENTARIO</h3>
                    <hr class="uk-margin-remove">
                </div>

            <canvas id="inventoryChart"></canvas>
            </div>
        </div>

        <div class="uk-width-1-2 uk-margin-medium-top Card-items">
            <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">
                <div>
                    <div class="titleReport">
                        <h3 class="uk-text-center uk-text-bold">CLIENTES FRECUENTES DEL MES</h3>
                        <div class="Item_generate-report">
                            <nav uk-dropnav="mode: click">
                                <ul class="uk-subnav">
                                    <li>
                                        <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                        <div class="uk-dropdown">
                                            <ul class="uk-nav uk-dropdown-nav">
                                                <li>
                                                    <form action="">
                                                        <div class="uk-flex uk-flex-middle" id="filter-clientsTop-controll">
                                                            <h5 class="uk-margin-remove-bottom" style="color: #000 !important; width: 30px;">De: </h5>
                                                            <input class="uk-input uk-form-width-small uk-margin-small-right" style="color: #000 !important; border-color: #999 !important;" type="date">
                                                            <h5 class="uk-margin-remove-bottom uk-margin-remove-top" style="color: #000 !important; width: 50px;">Hasta: </h5>
                                                            <input class="uk-input uk-form-width-small" style="color: #000 !important; border-color: #999 !important;" type="date">
                                                            <button type="button" class="uk-button uk-button-default uk-margin-small-left btn-filter-clientsTop" style="color: #000 !important; border-color: #999 !important;">APLICAR</button>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- <hr class="uk-margin-remove"> -->
                </div>
 
                <table class="uk-table uk-table-divider">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>CLIENTE</th>
                            <th>COMPRAS</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_clientes_frecuentes">

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</main>

<script src="static/javaScript/librerias/chart.umd.js"></script>
<script src="static/javascript/Ajax/index.js"></script>


</body>

</html>