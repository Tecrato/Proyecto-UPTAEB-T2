<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-light">

    <section class="uk-flex uk-flex-center uk-margin-medium Gap Wraper">

        <div id="inventoryValue" class="uk-width-1-2@s uk-background-secondary Card-grafic">
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
        </div>


        <div id="monthlyEntries" class="uk-width-1-2@s uk-background-secondary Card-grafic">
            <div class="titleReport">
                <h2 class="Bg-Grafic-title">Ganancias mensuales (BS)</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>
                                            <form id="formPDF2" action="Estadisticas_PDF" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="img" id="imgGanancia_png">
                                                <input type="hidden" name="select" value="ganancia">
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
    </section>


    <section class="uk-flex uk-flex-center uk-margin-medium ">
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
                                                <input type="hidden" name="select" value="rotacion">
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
            <canvas class="Grafic-2" id="inventoryRotationChart"></canvas>
        </div>
    </section>


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
                                                <input type="hidden" name="img" id="imgMax_png">
                                                <input type="hidden" name="select" value="max_ventas">
                                                <input type="submit" id="GenReport" value="Imprimir" style="display: none;">
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
                                                <input type="hidden" name="img" id="imgMin_png">
                                                <input type="hidden" name="select" value="min_ventas">
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
            <canvas id="menosVendidosChart" height=170px></canvas>
        </div>
    </section>

</main>
<script src="static/javaScript/librerias/chart.umd.js"></script>
<script src="static/javaScript/graphicsController.js"></script>


</body>

</html>