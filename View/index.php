<?php require("../View/complementos/header.php"); ?>

<main class="Bg-Main-home2">
<!-- <h2 class="uk-text-bolder uk-light uk-margin-remove-bottom uk-padding uk-padding-remove-bottom">BIENVENIDO USUARIO</h2> -->
<div class="uk-margin uk-heading-line uk-text-left uk-margin-remove-bottom uk-padding uk-padding-remove-bottom">
    <h2 class="uk-text-bolder uk-text-uppercase uk-light">BIENVENIDO USUARIO</h2>
</div>

    <div class="[email protected] uk-grid-small uk-flex-wrap uk-flex-center uk-padding-small" uk-grid>
        <div class="uk-width-1-2 uk-margin-medium-top Card-items">
            <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">
                <article>
                    <h2>Stats</h2>
                    <p>Bienvenido, estos son los niveles actuales de productos</p>
                </article>
                    <?php for ($i=0; $i < count($categoria); $i++){ 
                        $row = $categoria[$i];

                        echo '<hr class="uk-divide">
                        <section class="uk-flex uk-flex-center uk-flex-wrap section-home uk-margin-medium-top uk-margin-medium-bottom">
                            <article class="uk-flex uk-flex-center Container-stats">
                                <span class="uk-margin-medium-right" uk-icon="icon: check; ratio: 3.5"></span>
                                <div>
                                    <h3>'.$row['nombre'].'</h3>
                                    <p>'.$row['maximo_stock'].'</p>
                                </div>
                            </article>';
                    }?>
                <!-- <hr class="uk-divide">
                <section class="uk-flex uk-flex-center uk-flex-wrap section-home uk-margin-medium-top uk-margin-medium-bottom">
                    <article class="uk-flex uk-flex-center Container-stats">
                        <span class="uk-margin-medium-right" uk-icon="icon: check; ratio: 3.5"></span>
                        <div>
                            <h3>150</h3>
                            <p>Cesta basica</p>
                        </div>
                    </article>
                    <article class="uk-flex uk-flex-center Container-stats">
                        <span class="uk-margin-medium-right" uk-icon="icon: check; ratio: 3.5"></span>
                        <div>
                            <h3>10</h3>
                            <p>Charcuteria</p>
                        </div>
                    </article>
                    <article class="uk-flex uk-flex-center Container-stats">
                        <span class="uk-margin-medium-right" uk-icon="icon: check; ratio: 3.5"></span>
                        <div>
                            <h3>55</h3>
                            <p>Aseo Personal</p>
                        </div>
                    </article>
                    <article class="uk-flex uk-flex-center Container-stats">
                        <span class="uk-margin-medium-right" uk-icon="icon: check; ratio: 3.5"></span>
                        <div>
                            <h3>150</h3>
                            <p></p>
                        </div>
                    </article> -->
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
                            <?php for ($i=0; $i < count($result); $i++) { 
                                    $row = $result[$i]; 
                                    echo '
                                <tr>
                                    <td><img class="uk-preserve-width uk-border-circle" src="./static/images/logo_m.png" width="48" height="48" alt=""></td>
                                    <td>'.$row['nombre'].'</td>
                                    <td>'.$row['precio_venta'].'</td>

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
                    <h3 class="uk-text-center uk-text-bold">PRODUCTOS MAS VENDIDOS</h3>
                    <hr class="uk-margin-remove">
                </div>
                <?php  for ($i=0; $i < count($MasV); $i++)  {  
                        $row = $MasV[$i];
                    echo '
                    <section class="uk-flex uk-flex-around uk-margin-medium-top">

                        <article>
                            <img class="uk-preserve-width uk-border-circle" src="./static/images/logo_m.png" width="60" height="60" alt="">
                            <span class="uk-text-lead uk-text-bold uk-margin-left">'.$row['nombre'].'</span>
                        </article>
                        <article>
                            <h3 class="uk-text-bolder" style="font-size: 33px;">'.$row['total_vendido'].'</h3>
                        </article>
                    </section>';
                } ?>
            </div>
        </div>

        <div class="uk-width-1-2 uk-margin-medium-top Card-items">
            <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">
                <div>
                    <h3 class="uk-text-center uk-text-bold">PRODUCTOS MENOS VENDIDOS</h3>
                    <hr class="uk-margin-remove">
                </div>
                <?php  for ($i=0; $i < count($MenosV); $i++){ 
                    $row = $MenosV[$i];
                    echo'
                    <section class="uk-flex uk-flex-around uk-margin-medium-top">

                        <article>
                            <img class="uk-preserve-width uk-border-circle" src="./static/images/logo_m.png" width="60" height="60" alt="">
                            <span class="uk-text-lead uk-text-bold uk-margin-left">'.$row['nombre'].'</span>
                        </article>
                        <article>
                            <h3 class="uk-text-bolder" style="font-size: 33px;">'.$row['total_vendido'].'</h3>
                        </article>
                    </section>
                ';} ?>
            </div>
        </div>
    </div>
</main>

<script src="static/javaScript/librerias/jquery.js"></script>
<script src="static/javascript/ChangeColor.js"></script>

</body>
</html>