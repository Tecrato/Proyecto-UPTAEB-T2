<?php
    require('Model/Conexion.php');
    require('Model/Usuarios.php');
    include("Controller/funcs/verificar.php");
    

    include('Model/Productos.php');
    include('Model/Clientes.php');
    include('Model/Proveedores.php');
    include('Model/Registro de ventas.php');

    $result = new Producto(active:1);
    $result = $result->search(limite: 5,order: ' id DESC');

    $cliente = new Cliente();
    $cliente = $cliente->COUNT();

    $proveedor = new Proveedor();
    $proveedor = $proveedor->COUNT();

    $factura = new Registro_ventas();
    $factura = $factura->COUNT();

    include('View/index.php');



?>