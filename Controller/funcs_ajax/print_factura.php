<?php
require("../Model/Conexion.php");
require_once('../Model/Facturas.php');

$clase = new Factura(isset($_GET['d']) ? $_GET['d'] : 40);
$result = $clase->search_detailsFact();
$lista = array();
$lista = [
    'vendedor' => $result['vendedor'],
    'nombre' => $result['nombre'],
    'id' => $result['id'],
    'fecha' => $result['fecha'],
    'cedula' => $result['cedula'],
    'apellido' => $result['apellido'],
    'documento' => $result['documento'],
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

$pagos = $clase->search_pagos();