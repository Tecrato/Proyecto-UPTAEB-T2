<?php
require("../Model/Conexion.php");
require_once('../Model/Cajas.php');


$clase = new Caja($_GET['C']);

$metodos = $clase->totalMetodosPago();
$detalles = $clase->DetallesCierreCaja();
$totalCierre = $clase->TotalCierreCaja();