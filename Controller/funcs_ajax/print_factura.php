<?php


require("./../Model/Conexion.php");
require('./../Model/Facturas.php');

if (isset($_GET['d'])) {
    $clase = new Factura();
    $result = $clase->search_detailsFact($_GET['d']);

    $lista = array();
    foreach ($result as $i) {
        $lista = array(
            'vendedor' => $i['vendedor'],
            'nombre' => $i['nombre'],
            'metodo_pago' => $i['metodo_pago'],
            'id' => $i['id'],
            'fecha' => $i['fecha'],
            'cedula' => $i['cedula'],
            'apellido' => $i['apellido'],
        );
    }

    $amount = $clase->search_mountFact($_GET['d']);
    $resultAmount = array();
    foreach ($amount as $i) {
        $resultAmount = array(
            'subtotal' => $i['subtotal'],
            'monto_final' => $i['monto_final'],
            'IVA' => $i['IVA'],
        );
    }

    $product = $clase->search_ProductFact($_GET['d']);
    

} else {
    $clase = new Factura();
    $result = $clase->search_detailsFact(8);

    $lista = array();
    foreach ($result as $i) {
        $lista = array(
            'vendedor' => $i['vendedor'],
            'nombre' => $i['nombre'],
            'metodo_pago' => $i['metodo_pago'],
            'id' => $i['id'],
            'fecha' => $i['fecha'],
            'cedula' => $i['cedula'],
            'apellido' => $i['apellido'],
        );
    }

    $amount = $clase->search_mountFact(8);
    $resultAmount = array();
    foreach ($amount as $i) {
        $resultAmount = array(
            'subtotal' => $i['subtotal'],
            'monto_final' => $i['monto_final'],
            'IVA' => $i['IVA'],
        );
    }

    $product = $clase->search_ProductFact(8);

}
