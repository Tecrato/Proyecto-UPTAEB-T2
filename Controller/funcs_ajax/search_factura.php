<?php
    // Con este archivo se insertan objotes en tablas del SQL   mysqli_fetch_array()
    
    require('../../Model/Conexion.php');

    if ($_POST['randomnautica'] == "productos") {
        require('../../Model/Productos.php');
        $clase = new Producto();
    }

    $result = $clase->search_luis();
    
    $lista=array();

    while ($row = $result->fetch_assoc()) {
        array_push($lista_productos, $row);
    };
    $json = [
        'lista'=> $lista
    ];
    $json = json_encode($json);
    echo($json);
?>