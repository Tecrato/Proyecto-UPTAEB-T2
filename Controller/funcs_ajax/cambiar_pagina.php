<?php
    require('../../Model/Conexion.php');
    // Con este codigo se avanza o se retrocede la pagina en las pantallas

    $dir = $_GET['dir'];
    $page = intval($_GET['p']);
    $type = $_GET['type'];
    if (isset($_GET['n_p'])) {
        $pagination = $_GET['n_p'];
    } else {
        $pagination = 9;
    }

    if ($type == 'productos') {
        require('../../Model/Productos.php');
        $vart = new Producto;
        $todos = $vart->COUNT();
    } elseif ($type == 'proveedores') {
        require('../../Model/Proveedores.php');
        $vart = new Proveedor;
        $todos = $vart->COUNT();
    } elseif ($type == 'ventas') {
        require('../../Model/Registro de ventas.php');
        $vart = new Registro_ventas();
        $todos = $vart->COUNT();
    }

    if ($dir === 'next' && $page < ceil($todos / $pagination)-1){
        $page = $page + 1;
    } elseif ($dir === 'back' && $page > 0) {
        $page = $page - 1;
    } elseif ($dir === 'start') {
        $page = 0;
    } elseif ($dir === 'end') {
        $page = ceil($todos/$pagination)-1;
    }
    // echo $_GET['p'];
    echo $page;
?>