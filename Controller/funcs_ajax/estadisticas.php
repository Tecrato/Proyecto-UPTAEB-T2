<?php
    include("../funcs/verificar.php");
    require('../../Model/Conexion.php');
    require('../../Model/Estadisticas.php');

    $clase = new Estadisticas();

    if ($_GET['select'] == 'ratio_ventas') {
        $result = $clase->ratio_ventas();
    }
    else if ($_GET['select'] == 'total_productos_categoria') {
        $result = $clase->total_productos_categoria();
    }
    else if ($_GET['select'] == 'total_stock_categoria') {
        $result = $clase->total_stock_categoria();
    }
    else if ($_GET['select'] == 'max_ventas') {
        $result = $clase->max_ventas();
    }
    else if ($_GET['select'] == 'min_ventas') {
        $result = $clase->min_ventas();
    }
    else if ($_GET['select'] == 'clientes_frecuentes') {
        $result = $clase->clientes_frecuentes();
    }

    $json = ['lista'=> $result];
    $json = json_encode($json);
    echo($json);

// SELECT p.id, p.nombre, ((SELECT SUM(b.cantidad) FROM entradas as b WHERE id_producto=p.id)-(SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id)) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id) as ratio_ventas FROM productos as p
// SELECT p.id, p.nombre, 1-((SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id)) as ratio_ventas FROM productos as p

// SELECT p.id, p.nombre, 1-((SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id)) as ratio_ventas FROM productos as p; 

// CREATE VIEW ratio_ventas as SELECT p.id, p.nombre, 1-((SELECT SUM(c.existencia) FROM entradas as c WHERE id_producto=p.id) / (SELECT SUM(a.cantidad) FROM entradas as a WHERE id_producto=p.id)) as ratio_ventas FROM productos as p  where p.active=; 

?>