<?php require("View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-light">

    <section class="uk-flex uk-flex-center uk-margin-medium Gap Wraper">

        <!-- <div id="inventoryValue" class="uk-width-1-2@s uk-background-secondary Card-grafic">
            <div class="titleReport">
                <h2 class="Bg-Grafic-title">Ratio de ventas</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>
                                            <form id="formPDF1" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="img" id="imgRatio_png">
                                                <input type="hidden" name="select" value="ratio_ventas">
                                                <button class="btn_pdf" uk-icon="icon: file-pdf" type="submit">Generar reporte</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <canvas id="ratioChart"></canvas>
        </div> -->

        <div id="monthlyEntries" class="uk-width-1-2@s uk-background-secondary Card-grafic">
            <div class="titleReport">
                <h2 class="Bg-Grafic-title">Ganancias/Perdidas anuales (BS)</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>
                                            <form action="">
                                                <div class="uk-flex uk-flex-middle" id="filter-year-controll">
                                                    <h5 class="uk-margin-remove-bottom" style="color: #000 !important; width: 50px;">Año: </h5>
                                                    <input class="uk-input uk-form-width-small" style="color: #000 !important; border-color: #999 !important;" type="number" name="" id="">
                                                    <button type="button" class="uk-button uk-button-default uk-margin-small-left btn-filter-year" style="color: #000 !important; border-color: #999 !important;">APLICAR</button>
                                                </div>
                                            </form>

                                            <form class="uk-margin-medium-top uk-flex uk-flex-center" id="formPDF2" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="img" id="imgGanancia_png">
                                                <input type="hidden" name="select" value="filter_year">
                                                <input id="year" type="hidden" name="year">
                                                <input type="submit" value="Imprimir" style="display: none;">
                                                <button class="btn_pdf" uk-icon="icon: file-pdf" type="submit">Generar reporte</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <canvas id="gananciasChart"></canvas>
        </div>

        <div id="" class="uk-width-1-2@s uk-background-secondary Card-grafic">
            <div class="titleReport">
                <h2 class="Bg-Grafic-title">Ganancias/Perdidas semanales (BS)</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>
                                            <form action="">
                                                <div class="uk-flex uk-flex-middle" id="filter-week-controll">
                                                    <h5 class="uk-margin-remove-bottom" style="color: #000 !important; width: 30px;">De: </h5>
                                                    <input class="uk-input uk-form-width-small uk-margin-small-right" style="color: #000 !important; border-color: #999 !important;" type="date">
                                                    <h5 class="uk-margin-remove-bottom uk-margin-remove-top" style="color: #000 !important; width: 50px;">Hasta: </h5>
                                                    <input class="uk-input uk-form-width-small" style="color: #000 !important; border-color: #999 !important;" type="date">
                                                    <button type="button" class="uk-button uk-button-default uk-margin-small-left btn-filter-week" style="color: #000 !important; border-color: #999 !important;">APLICAR</button>
                                                </div>
                                            </form>

                                            <form class="uk-margin-medium-top uk-flex uk-flex-center" id="formPDF2-1" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="img" id="imgGananciaWeek_png">
                                                <input type="hidden" name="weekStart" id="weekStart">
                                                <input type="hidden" name="weekEnd" id="weekEnd">
                                                <input type="hidden" name="select" value="filter_week_ganancias">
                                                <input type="submit" value="Imprimir" style="display: none;">
                                                <button class="btn_pdf" uk-icon="icon: file-pdf" type="submit">Generar reporte</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <canvas id="gananciasChartWeek"></canvas>
        </div>


    </section>


    <!-- <section class="uk-flex uk-flex-center uk-margin-medium ">
        <div id="inventoryRotation" class="uk-width-1-1@s uk-padding uk-background-secondary card-graphics2">
            <div class="titleReport">
                <h2 class="Bg-Grafic-title">Rotación del inventario</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>
                                            <form id="formPDF3" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="img" id="imgRotacion_png">
                                                <input type="hidden" name="select" value="rotacion_inventario">
                                                <button class="btn_pdf" uk-icon="icon: file-pdf" type="submit">Generar reporte</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <canvas class="Grafic-2" id="inventoryRotationChart"></canvas>
        </div>
    </section> -->


    <section class="uk-flex uk-flex-center uk-margin-medium Wraper Gap">

        <div id="MostSelledProducts" class="uk-width-1-2@s  uk-background-secondary Card-grafic">
            <div class="titleReport titleReport2">
                <h2 class="Bg-Grafic-title">Productos más vendidos</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>

                                            <form id="formPDF4" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <h5 style="color: #000 !important;">Filtrar: </h5>
                                                <div class="uk-margin-bottom">
                                                    <label for="filter"> Año</label>
                                                    <input class="filter-max-type" type="radio" name="max" value="Año" checked>
                                                    <label for="filter"> Mes/Año</label>
                                                    <input class="filter-max-type" type="radio" name="max" value="mes_anio">
                                                </div>

                                                <div class="uk-flex uk-flex-middle">
                                                    <h5 class="uk-margin-remove-bottom" style="color: #000 !important; width: 55px;">FECHA: </h5>
                                                    <input class="uk-input uk-form-width-small" type="month" style="color: #000 !important; border-color: #999 !important;">
                                                    <button type="button" class="uk-button uk-button-default uk-margin-small-left filter-max" style="color: #000 !important; border-color: #999 !important;">APLICAR</button>
                                                </div>

                                                <div class="uk-flex uk-flex-center uk-margin-top">
                                                    <input type="hidden" name="img" id="imgMax_png">
                                                    <input id="date_enviroment" type="hidden" name="date">
                                                    <input type="submit" id="GenReport" value="Imprimir" style="display: none;">
                                                    <button class="btn_pdf" uk-icon="icon: file-pdf" type="submit">Generar reporte</button>
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

            <canvas id="masVendidosChart" height=170px></canvas>
        </div>

        <div id="LeastSelledProducts" class="uk-width-1-2@s uk-background-secondary Card-grafic">
            <div class="titleReport titleReport2">
                <h2 class="Bg-Grafic-title">Productos menos vendidos</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>

                                            <form id="formPDF5" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <h5 style="color: #000 !important;">Filtrar: </h5>
                                                <div class="uk-margin-bottom">
                                                    <label for="filter"> Año</label>
                                                    <input class="filter-min-type" type="radio" name="min" value="Año" checked>
                                                    <label for="filter"> Mes/Año</label>
                                                    <input class="filter-min-type" type="radio" name="min" value="mes_anio">
                                                </div>

                                                <div class="uk-flex uk-flex-middle">
                                                    <h5 class="uk-margin-remove-bottom" style="color: #000 !important; width: 55px;">FECHA: </h5>
                                                    <input class="uk-input uk-form-width-small" type="month" style="color: #000 !important; border-color: #999 !important;">
                                                    <button type="button" class="uk-button uk-button-default uk-margin-small-left filter-min" style="color: #000 !important; border-color: #999 !important;">APLICAR</button>
                                                </div>

                                                <div class="uk-flex uk-flex-center uk-margin-top">
                                                    <input type="hidden" name="img" id="imgMin_png">
                                                    <input id="date_enviroment_min" type="hidden" name="date">
                                                    <input type="submit" id="GenReport" value="Imprimir" style="display: none;">
                                                    <button class="btn_pdf" uk-icon="icon: file-pdf" type="submit">Generar reporte</button>
                                                </div>
                                            </form>

                                            <!-- <form class="uk-flex uk-flex-center" id="formPDF5" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="img" id="imgMin_png">
                                                <input type="hidden" name="select" value="min_ventas">
                                                <button class="btn_pdf" uk-icon="icon: file-pdf" type="submit">Generar reporte</button>
                                            </form> -->
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <canvas id="menosVendidosChart" height=170px></canvas>
        </div>

    </section>

</main>
<script src="static/javaScript/librerias/chart.umd.js"></script>
<script src="static/javaScript/graphicsController.js"></script>


</body>

</html>