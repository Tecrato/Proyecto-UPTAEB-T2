<?php 
    require('../Model/Conexion.php');
    require('../Model/Clientes.php');
    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }

    $result = new Cliente;
    $result = $result->search();

    // n:$num

    include('../View/client.php');
    echo '<script>var type_page = "cliente";</script>';
?>