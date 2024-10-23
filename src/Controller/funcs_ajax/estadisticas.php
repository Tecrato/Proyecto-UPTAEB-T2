<?php
    require('../../Model/Conexion.php');
    require('../../Model/Usuarios.php');
    include("../funcs/verificar.php");
    require('../../Model/Estadisticas.php');

    $clase = new Estadisticas();

    if ($_POST['select'] == 'ratio_ventas') {
        $result = $clase->ratio_ventas();
    }
    else if ($_POST['select'] == 'total_productos_categoria') {
        $result = $clase->total_productos_categoria();
    }
    else if ($_POST['select'] == 'total_stock_categoria') {
        $result = $clase->total_stock_categoria();
    }
    else if ($_POST['select'] == 'max_ventas') {
        $result = $clase->max_ventas();
    }
    else if ($_POST['select'] == 'min_ventas') {
        $result = $clase->min_ventas();
    }
    else if ($_POST['select'] == 'clientes_frecuentes') {
        $result = $clase->clientes_frecuentes();
    }
    else if ($_POST['select'] == 'proveedor_de_una_entrada') {
        $result = $clase->search_proveedor_from_product($_POST['id_producto']);
    }
    else if ($_POST['select'] == 'valor_total_inventario') {
        $result = $clase->ValorTotalInventario();
    }
    else if ($_POST['select'] == 'ganancia_mensuales') {
        $result = $clase->ganancias_mensuales();
    }
    else if ($_POST['select'] == 'valor_inventario_mes') {
        $result = $clase->valor_inventario_mes();
    }
    else if ($_POST['select'] == 'coste_productos_vendidos') {
        $result = $clase->coste_productos_vendidos();
    }
    else if ($_POST['select'] == 'rotacion_inventario') {
        $result = $clase->rotacion_inventario();
    }
    else if ($_POST['select'] == 'filter_year') {
        $result = $clase->filter_year_ganancias($_POST['year']);
    }
    else if ($_POST['select'] == 'filter_week') {
        $result = $clase->filter_week_ganancias($_POST['init'], $_POST['finish']);
    }
    else if ($_POST['select'] == 'filter_max_anio') {
        $result = $clase->filter_max_anio($_POST['year']);
    }
    else if ($_POST['select'] == 'filter_max_mes-anio') {
        $result = $clase->filter_max_anio_mes($_POST['year'], $_POST['month']);
    }
    else if ($_POST['select'] == 'filter_min_anio') {
        $result = $clase->filter_min_anio($_POST['year']);
    }
    else if ($_POST['select'] == 'filter_min_mes-anio') {
        $result = $clase->filter_min_anio_mes($_POST['year'], $_POST['month']);
    }

    $json = ['lista'=> $result];
    $json = json_encode($json);
    echo($json);

// SELECT p.id, p.nombre, ((SELECT SUM(b.cantidad) FROM entradas as b WHERE id_producto=p.id)-(SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id)) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id) as ratio_ventas FROM productos as p
// SELECT p.id, p.nombre, 1-((SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id)) as ratio_ventas FROM productos as p

// SELECT p.id, p.nombre, 1-((SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id)) as ratio_ventas FROM productos as p; 

// CREATE VIEW ratio_ventas as SELECT p.id, p.nombre, 1-((SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id)) as ratio_ventas FROM productos as p  where p.active=; 

?>