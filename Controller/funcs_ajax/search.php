<?php
    // Con este archivo se buscan datos de ciertas maneras, dependiendo de lo que pase como "randomnautica"
    
    require('../../Model/Conexion.php');
    include("../funcs/verificar.php");

    if (isset($_GET['limite'])) {
        $limite = $_GET['limite'];
    }
    else {
        $limite = 9;
    }
    if (isset($_GET['n']) and $_GET['n'] != "") {
        $n = $_GET['n'];
    }
    else {
        $n = 0;
    }
     

    if ($_GET['randomnautica'] == "productos") {
        require('../../Model/Productos.php');
        $clase = new Producto(
            id:(isset($_GET['ID']) ? $_GET['ID'] : null),
            nombre:(isset($_GET['nombre']) ? $_GET['nombre'] : null),
            active:(isset($_GET['active']) ? $_GET['active'] : 1),
            like:(isset($_GET['like']) ? $_GET['like'] : '')
        );
    }
    elseif ($_GET['randomnautica'] == "entradas") {
        require('../../Model/Entradas.php');
        $clase = new Entrada(
            id_producto: isset($_GET['id_producto']) ? $_GET['id_producto']: null,
            id_proveedor: isset($_GET['id_proveedor']) ? $_GET['id_proveedor']: null,
            active:(isset($_GET['active']) ? $_GET['active'] : 1));
    }
    elseif ($_GET['randomnautica'] == "proveedores") {
        require('../../Model/Proveedores.php');
        $clase = new Proveedor(
            like:(isset($_GET['like']) ? $_GET['like'] : '')
        );
    }
    elseif ($_GET['randomnautica'] == "clientes") {
        require('../../Model/Clientes.php');
        $clase = new Cliente(
            like_nombre:(isset($_GET['like_nombre']) ? $_GET['like_nombre'] : ''),
            like_cedula:(isset($_GET['like_cedula']) ? $_GET['like_cedula'] : ''),
        );
    }
    elseif ($_GET['randomnautica'] == "categorias") {
        require('../../Model/Categorias.php');
        $clase = new Categoria();
    }
    elseif ($_GET['randomnautica'] == "unidades") {
        require('../../Model/Unidades.php');
        $clase = new Unidad();
    }
    elseif ($_GET['randomnautica'] == "marcas") {
        require('../../Model/Marcas.php');
        $clase = new Marca();
    }
    elseif ($_GET['randomnautica'] == "ventas") {
        require('../../Model/Registro de ventas.php');
        $clase = new Registro_ventas();
    }

    if (isset($_GET['subFunction'])) {
        if ($_GET['subFunction'] == 'proveedor_de_una_entrada') {
            $result = $clase->search_proveedor_from_product();
        } else if ($_GET['subFunction'] == 'marca') {
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