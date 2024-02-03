<?php
    include("./funcs/verificar.php");
    include("./funcs/verificar_admin.php");
    require('../Model/Conexion.php');
    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }
    require('../Model/Proveedores.php');
    $result = new Proveedor(
        like:(isset($_GET['like']) ? $_GET['like'] : ''),
    );
    $result = $result->search(n:$num);

    include('../View/proveedores.php');
    echo '<script>var page = '.$num.';</script>';
?>