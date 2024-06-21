<?php
    include("./funcs/verificar.php");
    // include('../View/index.php');
    require('../Model/Conexion.php');
    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }
    include('../Model/Productos.php');
    $result = new Producto;
    $result = $result->search_RecienAgregado();

    // $categoria = new Producto;
    // $categoria = $categoria->stock_segun_categorias();

    // $MasV = new Producto;
    // $MasV = $MasV->search_MasVendidos();

    // $MenosV = new Producto;
    // $MenosV = $MenosV->search_MenosVendidos();
    include('../View/index.php');



?>