<?php require("../View/complementos/header.php"); ?>

<main>
<div class="[email protected] uk-grid-small uk-flex-wrap uk-flex-center" uk-grid>
    <div class="uk-width-1-2 uk-margin-large-top Card-items">
        <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">
            <article>
                <h2>Stats</h2>
                <p>Bienvenido, estos son los niveles actuales de productos</p>
            </article>
            <hr class="uk-divide">
            <section class="uk-flex uk-flex-center uk-flex-wrap section-home uk-margin-large-top uk-margin-large-bottom" >
                <article class="uk-flex uk-flex-center Container-stats">
                    <span class="uk-margin-medium-right" uk-icon="icon: check; ratio: 3.5"></span>
                    <div>
                        <h3 id="nose">0.0</h3>
                        <p>Precio Dolar Paralelo</p>
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
                </article>
            </section>
            <hr class="uk-divide">
            <div class="uk-flex uk-flex-center ">
                <a class="uk-button uk-button-default uk-margin-medium-top" href="#">Ver más</a>
            </div>
        </div>
    </div>





    <div class="uk-width-1-3 uk-margin-large-top">
        <div class="uk-card uk-card-default uk-card-body uk-background-secondary uk-light">Item</div>
    </div>
</div> 
</main>


<?php require("../View/complementos/footer.php"); ?>
<script>
var respuesta
$.ajax({
    url:"https://exchangemonitor.net/ajax/widget-unique",
    data: {"country":"ve","type":"enparalelovzla"},
    success: response => {
        console.log(response.price)
        respuesta = response
        document.getElementById('nose').innerHTML = JSON.parse(response).price
    }
})

</script>