<?php 
    include("./funcs/verificar.php");
    require('../Model/Conexion.php');
    require('../Model/Clientes.php');


    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }

    $result = new Cliente;
    $result = $result->search(n:$num,limite:9);


    include('../View/client.php');
?>