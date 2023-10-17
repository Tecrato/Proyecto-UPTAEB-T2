<?php
    require('../Model/Conexion.php');
    require('../Model/Productos.php');
    require('../Model/Proveedores.php');
    require('../Model/Categorias.php');
    require('../Model/Unidades.php');


    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }

    function pasar_a_option($busqueda){
        $var = "";

        while ($row = $busqueda->fetch_assoc()) {
            $var = $var.'<option value="'.$row["id"].'">'.$row["nombre"].'</option>';
        }
        return $var;
    }
    function buscar_proveedores_cantidad($id){
        $clase_detalles = new Proveedor();
        $resultado = $clase_detalles->search_detalles_producto($id);

        $texto = "";
        while ($row = $resultado->fetch_assoc()) {
            echo '<section class="uk-margin-small-bottom" style="height: 150px; overflow: auto;">
                    <ul uk-accordion>

                        
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
                </section>';
        }
        return $texto;
    }

    $clase = new Producto();
    $result = $clase->search(n:$num);

    $clase = new Proveedor();
    $result2 = $clase->search();
    $list_proveedores = pasar_a_option($result2);

    $clase = new Categoria();
    $result2 = $clase->search();
    $list_categorias = pasar_a_option($result2);

    $clase = new Unidad();
    $result2 = $clase->search();
    $list_unidades = pasar_a_option($result2);


    $var_proveedores = pasar_a_option($result2);

    

    include('../View/product.php');

    echo '<script>var num_page = '.$num.';</script>';
    echo '<script>var type_page = "productos";</script>';
    
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 3){
            echo "<script>UIkit.notification({message: '<span>El producto ya esta siendo utilizado.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 1){
            echo "<script>UIkit.notification({message: '<span>A ocurrido un error con la imagen.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 2){
            echo "<script>UIkit.notification({message: '<span>Extencion de imagen inválidq.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 4){
            echo "<script>UIkit.notification({message: '<span>No se ha podido almacenar la imagen.</span>' , status:'error'})</script>";   
        } elseif ($_GET['error'] == 5){
            echo "<script>UIkit.notification({message: '<span>Tamaño limite exedido.</span>' , status:'error'})</script>";   
        }
    }
    
?>