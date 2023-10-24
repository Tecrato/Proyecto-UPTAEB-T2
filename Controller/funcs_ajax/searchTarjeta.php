<?php

require('../../Model/Conexion.php');
require('../../Model/Productos.php');

$clase = new Producto();
$result = $clase->search_target();


    $lista=array();

    while ($row = $result->fetch_assoc()) {
        array_push($lista, $row);
    };
    $json = [
        'lista'=> $lista
    ];
    $json = json_encode($json);
    echo($json);
