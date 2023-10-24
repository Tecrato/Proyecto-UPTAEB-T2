<?php
    // Con este archivo se insertan objotes en tablas del SQL   mysqli_fetch_array()
    
    require('../../Model/Conexion.php');

    if (isset($_POST['limite']) and $_POST['like'] != "") {
        $limite = $_POST['limite'];
    }
    else {
        $limite = 9;
    }
     

    if ($_POST['randomnautica'] == "productos") {
        require('../../Model/Productos.php');
        $clase = new Producto();
    }
    elseif ($_POST['randomnautica'] == "stock_producto") {
        require('../../Model/Productos.php');
        $clase = new Producto();
        echo $clase->search_stock($_POST['ID']);
        die();
    }
    elseif ($_POST['randomnautica'] == "proveedores") {
        require('../../Model/Proveedores.php');
        $clase = new Proveedor();
    }
    elseif ($_POST['randomnautica'] == "clientes") {
        require('../../Model/Clientes.php');
        $clase = new Cliente();
    }elseif ($_POST['randomnautica'] == "categoria") {
        require('../../Model/Categorias.php');
        $clase = new Categoria();
    }
    elseif ($_POST['randomnautica'] == "unidad") {
        require('../../Model/Unidades.php');
        $clase = new Unidad();
    }

    if (isset($_POST['like']) and $_POST['like'] != "") {
        $result = $clase->search_like($_POST['like']);
    }
    elseif ((isset($_POST['ID']) and $_POST['ID'] != "")){
        $result = $clase->search($_POST['ID']);
    }
    else {
        $result = $clase->search();
    }
    // limite:$limite
    $lista=array();

    while ($row = $result->fetch_assoc()) {
        array_push($lista, $row);
    };
    $json = [
        'lista'=> $lista
    ];
    $json = json_encode($json);
    echo($json);
?>