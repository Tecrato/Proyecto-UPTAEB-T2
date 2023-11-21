<?php

    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }




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