
	
<section class="uk-margin-small-bottom" style="height: 150px; overflow: auto;">
    <ul uk-accordion>

        
        $var_proveedores
        <li class="uk-text-uppercase">
            <a class="uk-accordion-title uk-text-bold uk-text-default" href="#"
                style="color: #106733;">
                <span uk-icon="icon:bookmark; ratio: 1.5"></span>
                Montecarmelo
            </a>
            <div class="uk-accordion-content">

                <div class="uk-flex uk-flex-center uk-flex-middle">
                    <article class="tag_modal-detailProduct uk-margin-small-right">
                        <div class="uk-flex uk-flex-middle uk-margin-small-right">
                            <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                style="color: #fff; padding: 2px;">
                                LOTE Nro </h6>
                        </div>
                    </article>
                    <article class="tag_modal-detailProduct-2">
                        <div class="uk-flex uk-flex-middle uk-margin-small-right">
                            <span class="uk-margin-small-right icon" style="color: #fff;"
                                uk-icon="icon: star; ratio: 1.2"></span>
                            <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product"
                                style="color: #fff;">
                                '.$row["stock"].'</h6>
                            <h6 class="uk-margin-small-left uk-margin-remove-right uk-margin-remove-top uk-margin-remove-bottom uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                style="color: #fff;">10</h6>
                        </div>
                    </article>
                    <article class="tag_modal-detailProduct uk-margin-small-left">
                        <div class="uk-flex uk-flex-middle uk-margin-small-right">
                            <span class="uk-margin-small-right icon" style="color: #fff;"
                                uk-icon="icon: calendar; ratio: 1.2"></span>
                            <h6 class="uk-margin-remove uk-text-bolder textTag_detail-Product"
                                style="color: #fff;">
                                EXP</h6>
                            <h6 class="uk-margin-small-left uk-margin-remove-right uk-margin-remove-top uk-margin-remove-bottom uk-text-bolder textTag_detail-Product uk-text-uppercase"
                                style="color: #fff;">'.$row["fecha_vencimiento"].'</h6>
                        </div>
                    </article>
                </div>
                <hr>
            

            </div>
        </li>
        <hr>
    </ul>
</section>
?>