<?php
    // Con este archivo se buscan datos de ciertas maneras, dependiendo de lo que pase como "randomnautica"
    
    require('../../Model/Conexion.php');
    include("../funcs/verificar.php");

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
     

    if ($_POST['randomnautica'] == "productos") {
        require('../../Model/Productos.php');
        $clase = new Producto(
            id:(isset($_POST['ID']) ? $_POST['ID'] : null),
            marca:(isset($_POST['marca']) ? $_POST['marca'] : null),
            nombre:(isset($_POST['nombre']) ? $_POST['nombre'] : null),
            active:(isset($_POST['active']) ? $_POST['active'] : 1),
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "entradas") {
        require('../../Model/Entradas.php');
        $clase = new Entrada(
            id_producto: isset($_POST['id_producto']) ? $_POST['id_producto']: null,
            id_proveedor: isset($_POST['id_proveedor']) ? $_POST['id_proveedor']: null,
            active:(isset($_POST['active']) ? $_POST['active'] : 1));
    }
    elseif ($_POST['randomnautica'] == "proveedores") {
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(
            like:(isset($_POST['like']) ? $_POST['like'] : '')
        );
    }
    elseif ($_POST['randomnautica'] == "clientes") {
        require('../../Model/Clientes.php');
        $clase = new Cliente(
            like_nombre:(isset($_POST['like_nombre']) ? $_POST['like_nombre'] : ''),
            like_cedula:(isset($_POST['like_cedula']) ? $_POST['like_cedula'] : ''),
        );
    }
    elseif ($_POST['randomnautica'] == "categorias") {
        require('../../Model/Categorias.php');
        $clase = new Categoria();
    }
    elseif ($_POST['randomnautica'] == "unidades") {
        require('../../Model/Unidades.php');
        $clase = new Unidad();
    }
    elseif ($_POST['randomnautica'] == "ventas") {
        require('../../Model/Registro de ventas.php');
        $clase = new Registro_ventas();
    }

    if (isset($_POST['subFunction'])) {
        if ($_POST['subFunction'] == 'proveedor_de_una_entrada') {
            $result = $clase->search_proveedor_from_product();
        } else if ($_POST['subFunction'] == 'marca') {
            $result = $clase->search_marca();
        }
    }
    else {
        $result = $clase->search(n:$n,limite:$limite);
    }


    $json = [
        'lista'=> $result
    ];
    $json = json_encode($json);
    echo($json);
?>