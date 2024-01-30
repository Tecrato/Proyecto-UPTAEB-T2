<?php

$fecha = strtotime($row['fecha']);
$dia =  date('d/m/Y', $fecha);
?>
<div>
<div class="target-detail-fact uk-card uk-card-default uk-padding-small uk-background-secondary uk-light uk-border-rounded" style="width: 280px; background-color: #333;">
    <div class="cont1_tar_fact" style="background-color: #333;">
        <div class="uk-flex uk-flex-middle uk-flex-between">
            <div class="uk-flex uk-flex-middle">
                <img class="uk-margin-small-right" src="static/images/logo_m.png" alt="" width="50PX">
                <h3 class="uk-margin-remove uk-text-bolder">#<?php echo $row['id']; ?></h3>
            </div>
            <div>
                <a class="ImprBtn" href="Detalles_factura?id=<?php echo $row['id']; ?>" uk-tooltip="title:Imprimir; delay: 500">
                	<span class="uk-margin-small-right uk-icon-button" uk-icon="icon: print"></span>
                </a>
                <?php if ($_SESSION['rol'] == 'Administrador') { ?>
                <a href="#modal-borrar<?php echo $row['id']; ?>" uk-toggle uk-tooltip="title:Eliminar; delay: 500" class="uk-icon-button uk-margin-small-right" uk-icon="trash"></a>
            
                <?php }; ?>
            </div>

            <?php if ($_SESSION['rol'] == 'Administrador') { ?>

            <!-- **************************Modal de confirmacion de eliminacion************************** -->

            <div id="modal-borrar<?php echo $row['id']; ?>" class="uk-flex-top" uk-modal>
                <div class="uk-modal-dialog uk-margin-auto-vertical">
                    <div class="uk-modal-header uk-flex uk-flex-middle">
                        <span class="uk-margin-small-right" uk-icon="icon: warning ; ratio: 2"></span>
                        <h2 class="uk-modal-title uk-margin-remove-top">ELIMINAR</h2>
                    </div>
                    <div class="uk-modal-body">
                        <p>Deseas eliminar este registro para siempre? No podras recuperlo mas adelante</p>
                    </div>


                    <form action="Controller/funcs/borrar_cosas.php" method="POST" style="display:none">
                        <input type=number value="<?php echo $row['id']; ?>" name="ID" style="display:none">
                        <input type=text value="ventas" name="tipo" style="display:none">
                        <button type="submit" id="btn-borrar<?php echo $row['id']; ?>">Aceptar</button>
                    </form>


                    <div class="uk-modal-footer uk-text-right">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                        <label class="uk-button uk-button-secondary" type="button" for="btn-borrar<?php echo $row['id']; ?>">Aceptar</label>
                    </div>

                </div>
            </div>
            <?php }; ?>

        </div>
        <!-- ****************************************************************************** -->

        <hr class="uk-margin-remove divider">

        <section>
            <div>
                <div>
                    <div>
                        <p class="uk-text-meta uk-margin-remove">N∘_OPERACIÓN: <b class="uk-text-success"><?php echo $row['id']; ?></b></p>
                        <hr class="uk-margin-remove divider-2">

                        <p class="uk-text-meta uk-margin-remove">FECHA: <b class="uk-text-success"><?php echo $dia; ?></b></p>

                        <hr class="uk-margin-remove divider-2">

                        <p class="uk-text-meta uk-margin-remove">CLIENTE: <b class="uk-text-success"><?php echo $row['nom_cliente']; ?> <?php echo $row['apell_cliente']; ?></b></p>

                        <hr class="uk-margin-remove divider-2">

                        <p class="uk-text-meta uk-margin-remove">VENDEDOR: <b class="uk-text-success"><?php echo $row['vendedor']; ?></b></p>

                        <hr class="uk-margin-remove divider-2">

                        <p class="uk-text-meta uk-margin-remove">
                        	ESTADO FACTURA: <b class="state-fact uk-text-emphasis">PAGADO</b>
                        </p>

                        <hr class="uk-margin-remove divider-2">

                        <p class="uk-text-meta uk-margin-remove">TOTAL FACTURA: <b class="uk-text-success"><?php echo $row['monto_final']; ?> BS</b></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>