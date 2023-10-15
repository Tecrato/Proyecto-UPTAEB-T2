<?php
    // Con este archivo se insertan objotes en tablas del SQL   mysqli_fetch_array()
    
    require('../../Model/Conexion.php');

    if ($_POST['tabla'] == "productos") {
        require('../../Model/Productos.php');
        $clase = new Producto();
    }
    elseif ($_POST['tabla'] == "proveedores") {
        require('../../Model/Proveedores.php');
        $clase = new Proveedor();
    }

    if (isset($_POST['like'])) {
        $result = $clase->search_like($_POST['input']);
    }
    else {
        $result = $clase->search_like($_POST['input']);
    }
    
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