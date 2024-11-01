<?php
    use Shtechnologyx\Pt3\Model\Cliente;
    use Shtechnologyx\Pt3\Model\Proveedor;
    use Shtechnologyx\Pt3\Model\Registro_ventas;
    use Shtechnologyx\Pt3\Model\Bitacora;
    use Shtechnologyx\Pt3\Model\Producto;
    // Con este codigo se avanza o se retrocede la pagina en las pantallas

    $dir = $_GET['dir'];
    $page = intval($_GET['p']);
    $type = $_GET['type'];
    if (isset($_GET['n_p'])) {
        $pagination = $_GET['n_p'];
    } else {
        $pagination = 9;
    }

    if ($type == 'productos') {
        $vart = new Producto();
        $todos = $vart->COUNT();
    } elseif ($type == 'proveedores') {
        $vart = new Proveedor;
        $todos = $vart->COUNT();
    } elseif ($type == 'ventas') {
        $vart = new Registro_ventas();
        $todos = $vart->COUNT();
    } elseif ($type == 'bitacora') {
        $vart = new Bitacora();
        $todos = $vart->COUNT();
    }

    if ($dir === 'next' && $page < ceil($todos / $pagination)-1){
        $page = $page + 1;
    } elseif ($dir === 'back' && $page > 0) {
        $page = $page - 1;
    } elseif ($dir === 'start') {
        $page = 0;
    } elseif ($dir === 'end') {
        $page = ceil($todos/$pagination)-1;
    }
    
    echo $page;
?>