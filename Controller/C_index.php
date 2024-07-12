<?php
    require('../Model/Conexion.php');
    require('../Model/Usuarios.php');
    include("./funcs/verificar.php");
    // include('../View/index.php');
    if (isset($_GET['p'])){
        $num = $_GET['p'];
    }else {
        $num = 0;
    }
    include('../Model/Productos.php');
    include('../Model/Clientes.php');
    include('../Model/Proveedores.php');
    include('../Model/Registro de ventas.php');
    $result = new Producto;
    $result = $result->search_RecienAgregado();
    $cliente = new Cliente();
    $cliente = $cliente->COUNT();
    $proveedor = new Proveedor();
    $proveedor = $proveedor->COUNT();
    $factura = new Registro_ventas();
    $factura = $factura->COUNT();
    include('../View/index.php');



?>