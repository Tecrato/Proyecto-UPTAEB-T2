<?php
require("./../Model/Conexion.php");
require('./../Model/Facturas.php');

// WTF amigo

$clase = new Factura(isset($_GET['d']) ? $_GET['d'] : 1);

$result = $clase->search_detailsFact();

$lista = array();

$lista = [
    'vendedor' => $result['vendedor'],
    'nombre' => $result['nombre'],
    'metodo_pago' => $result['metodo_pago'],
    'id' => $result['id'],
    'fecha' => $result['fecha'],
    'cedula' => $result['cedula'],
    'apellido' => $result['apellido'],
];

$amount = $clase->search_mountFact();
$resultAmount = array();
foreach ($amount as $i) {
    $resultAmount = array(
        'subtotal' => $i['subtotal'],
        'monto_final' => $i['monto_final'],
        'IVA' => $i['IVA'],
    );
}

$product = $clase->search_ProductFact();
    