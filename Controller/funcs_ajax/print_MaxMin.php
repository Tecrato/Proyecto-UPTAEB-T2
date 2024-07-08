<?php
require("../Model/Conexion.php");
require('../Model/Estadisticas.php');



$clase = new Estadisticas();

if ($_POST['select'] == 'total_productos_categoria') {
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
else if ($_POST['select'] == 'valor_total_inventario') {
    $result = $clase->ValorTotalInventario();
}