<?php
    require('../Model/Conexion.php');
    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }
    require('../Model/Proveedores.php');
    $result = new Proveedor;
    $result = $result->search(n:$num);
    include('../View/proveedores.php');
    echo '<script>var num_page = '.$_GET['p'].';</script>';
    echo '<script>var type_page = "proveedores";</script>';
?>