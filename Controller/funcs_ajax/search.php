<?php
    // Con este archivo se buscan datos de ciertas maneras, dependiendo de lo que pase como "randomnautica"
    
    require('../../Model/Conexion.php');

    if (isset($_POST['limite'])) {
        $limite = $_POST['limite'];
    }
    else {
        $limite = 9;
    }
    if (isset($_POST['n']) and $_POST['n'] != "") {
        $n = $_POST['n'];
    }
    else {
        $n = 0;
    }
     

    if ($_POST['randomnautica'] == "productos" or $_POST['randomnautica'] == "tarjeta_productos" or $_POST['randomnautica'] == "productos_factura") {
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
    elseif ($_POST['randomnautica'] == "tarjeta_productos") {
        $result = $clase->search_targeta($n,$limite);
    }
    elseif ($_POST['randomnautica'] == "productos_factura") {
        $result = $clase->search_luis();
    }
    else {
        $result = $clase->search(n:$n);
    }
    // limite:$limite
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
?>