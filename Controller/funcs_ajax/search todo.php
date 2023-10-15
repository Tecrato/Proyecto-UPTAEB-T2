<?php
    // Con este archivo se insertan objotes en tablas del SQL   mysqli_fetch_array()
    
    require('../../Model/Conexion.php');
    require('../../Model/Productos.php');
    $result = new Producto();
    $result = $result->search();
    $lista_productos=array();

    while ($row = $result->fetch_assoc()) {
        array_push($lista_productos, $row);
    };
    $json = [
        'lista_productos'=> $lista_productos
    ];
    $json = json_encode($json);
    echo($json);
    
?>