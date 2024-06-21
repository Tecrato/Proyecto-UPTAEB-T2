<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2 uk-padding uk-light">

    <section class="uk-flex uk-flex-center uk-margin-medium Gap Wraper">
        
        <div id="inventoryValue" class="uk-width-1-2@s uk-background-secondary Card-grafic">
            <div class="titleReport">
                <h2 class="Bg-Grafic-title">Valor total del inventario</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li>
                                            <button  id="GenReport">Imprimir</button>
                                            <!-- <a href="" uk-icon="icon: file-pdf">Generar reporte</a> -->
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <canvas id="inventoryChart"></canvas>
        </div>
        

        <div id="monthlyEntries" class="uk-width-1-2@s uk-background-secondary Card-grafic">
            <div class="titleReport">
                <h2 class="Bg-Grafic-title">Entradas mensuales (BS)</h2>
                <div class="Item_generate-report">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li><a href="#" uk-icon="icon: file-pdf">Generar reporte</a></li>
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
                                        <li><a href="#" uk-icon="icon: file-pdf">Generar reporte</a></li>
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
                                        <li><a href="#" uk-icon="icon: file-pdf">Generar reporte</a></li>
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
                                        <li><a href="#" uk-icon="icon: file-pdf">Generar reporte</a></li>
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
<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javaScript/graphicsController.js"></script>
<script src="static/javascript/ChangeColor.js"></script>

</body>

</html>