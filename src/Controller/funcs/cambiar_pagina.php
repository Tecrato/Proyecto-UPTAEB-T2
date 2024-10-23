<?php

namespace Shtechnologyx\Pt3\Controller\funcs;
require('../../../vendor/autoload.php');

    require('../../Model/Conexion.php');
    // Con este codigo se avanza o se retrocede la pagina en las pantallas

    use Shtechnologyx\Pt3\Model\Producto;
    use Shtechnologyx\Pt3\Model\Entrada;
    use Shtechnologyx\Pt3\Model\Proveedor;
    use Shtechnologyx\Pt3\Model\Cliente;
    use Shtechnologyx\Pt3\Model\Registro_ventas;


    $dir = $_GET['dir'];
    $page = intval($_GET['p']);
    $type = $_GET['type'];
    $pagination = isset($_GET['n_p']) ?intval($_GET['n_p']) : 9;
    $active = isset($_GET['active']) ?intval($_GET['active']) : 1;

    if ($type == 'productos') {
        $vart = new Producto;
        $todos = $vart->COUNT();
    }
    if ($type == 'entradas') {
        $vart = new Entrada;
        $todos = $vart->COUNT();
    } 
    elseif ($type == 'proveedores') {
        $vart = new Proveedor;
        $todos = $vart->COUNT();
    }
    elseif ($type == 'clientes') {
        $vart = new Cliente;
        $todos = $vart->COUNT();
    }
    elseif ($type == 'ventas') {
        $vart = new Registro_ventas();
        $todos = $vart->COUNT();
    }

    if ($dir == 'next' && $page < ceil($todos / $pagination)-1){
        $page = $page + 1;
    } elseif ($dir == 'back' && $page > 0) {
        $page = $page - 1;
    } elseif ($dir == 'start') {
        $page = 0;
    } elseif ($dir == 'end') {
        $page = ceil($todos/$pagination)-1;
    }
    
    header('Location:../../'.ucfirst($type).'?p='.$page);
?>