<?php
// Con este archivo se insertan objotes en tablas del SQL   mysqli_fetch_array()

require('../../Model/Conexion.php');
require('../../Model/Productos.php');
require('../../Model/Facturas.php');
require('../../Model/Registro de ventas.php');

if ($_POST['TYPE'] == 'TRG_FACT') {
    $clase = new Registro_ventas();
    $result = $clase->search_target_fact();

    $lista = array();
    for ($i = 0; $i < count($result); $i++) {
        $row = $result[$i];
        array_push($lista, $row);
    };
    $json = [
        'lista' => $lista
    ];
    $json = json_encode($json);
    echo ($json);
} elseif ($_POST['TYPE'] == 'PRODUCT_FACT_TABLE') {
    $clase = new Producto();
    $result = $clase->search_Product_RegistroVentas();

    $lista = array();
    for ($i = 0; $i < count($result); $i++) {
        $row = $result[$i];
        array_push($lista, $row);
    };
    $json = [
        'lista' => $lista
    ];
    $json = json_encode($json);
    echo ($json);
}
