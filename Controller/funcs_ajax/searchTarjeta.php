<?php

    require('../../Model/Conexion.php');
    require('../../Model/Productos.php');

    $clase = new Producto();
    $result = $clase->search_targeta();


    $lista=array();

    for ($i=0; $i < count($result); $i++) { 
        $row = $result[$i];
        array_push($lista, $row);
    }
    $json = [
        'lista'=> $lista
    ];
    $json = json_encode($json);
    echo($json);
