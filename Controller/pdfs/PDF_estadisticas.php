<?php

require('../../Model/Conexion.php');
require('../../Model/Usuarios.php');
include("../funcs/verificar.php");
require('../../Plugins/fpdf.php');

require('../../Model/Estadisticas.php');

$clase = new Estadisticas();


if ($_POST['select'] == 'max_ventas') {
    $result = $clase->max_ventas();
} else if ($_POST['select'] == 'min_ventas') {
    $result = $clase->min_ventas();
} else if ($_POST['select'] == 'ratio_ventas') {
    $result = $clase->ratio_ventas();
} else if ($_POST['select'] == 'ganancia') {
    $result = $clase->ganancias_mensuales();
} else if ($_POST['select'] == 'rotacion_inventario') {
    $result = $clase->coste_productos_vendidos();
    $result2 = $clase->valor_inventario_mes();
    $result3 = $clase->rotacion_inventario();
}
date_default_timezone_set('America/Caracas');
$fecha = new DateTime();
$res = $fecha->getTimestamp();
$fecha2 = getdate($res);


$graphic = $_POST['img'];
$tempFilePath = 'temp_chart.png';
file_put_contents($tempFilePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $graphic)));

$pdf = new FPDF();
$pdf->AddPage("L");
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(120);
$pdf->SetTextColor(0, 130, 38);

if ($_POST['select'] == "min_ventas") {
    $pdf->Cell(30, 30, 'PRODUCTOS MENOS VENDIDOS', 0, 0, 'C', 0);
} else if ($_POST['select'] == "max_ventas") {
    $pdf->Cell(30, 30, utf8_decode('PRODUCTOS MÁS VENDIDOS'), 0, 0, 'C', 0);
} else if ($_POST['select'] == "ratio_ventas") {
    $pdf->Cell(30, 30, 'RATIO DE VENTAS', 0, 0, 'C', 0);
} else if ($_POST['select'] == "ganancia") {
    $pdf->Cell(30, 30, 'GANANCIAS MENSUALES', 0, 0, 'C', 0);
} else if ($_POST['select'] == "rotacion_inventario") {
    $pdf->Cell(30, 30, 'ROTACIÓN DEL INVENTARIO', 0, 0, 'C', 0);
}

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(200, 30, 'FECHA: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
$pdf->Image('../../static/images/logo_m.png', 10, 10, 35);
$pdf->Ln(50);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetFillColor(0, 130, 38);
$pdf->Cell(138, 10, "GRAFICA", 0, 0, 'C', 1);
$pdf->Rect(147.5, 60, 1, 140, 'F');
$pdf->Cell(138, 10, "DETALLES", 0, 0, 'C', 1);
$pdf->Cell(150, 120, "", 0, 0, 'C', 0);
$pdf->Image($tempFilePath, 13, 80, 120, 120);

$pdf->Ln(15);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);

if ($_POST['select'] == "min_ventas" || $_POST['select'] == "max_ventas") {
    foreach ($result as $variable) {
        $pdf->Cell(160);
        $pdf->Cell(120, 15, strtoupper($variable['nombre'] . " " . $variable['marca']) . " DE " . $variable['unidad_valor'] . " " . $variable['unidad'] . "   ===>   " . $variable['cantidad'] . " VENTAS", 0, 1, 'L', 0);
    }
} else if ($_POST['select'] == "ratio_ventas") {
    foreach ($result as $variable) {
        $pdf->Cell(150);
        $pdf->Cell(120, 15, strtoupper($variable['nombre'] . " " . $variable['marca']) . " DE " . $variable['unidad_valor'] . " " . $variable['unidad'] . "   ===>   SE VENDIO EL " . floatval($variable['ratio_ventas']) * 100 . " % ", 0, 1, 'L', 0);
    }
} else if ($_POST['select'] == "ganancia") {
    $meses = array_keys($result[0]);
    $numeros = array_keys($result[0]);
    $meses = array_filter($meses, function ($key) {
        return is_string($key) && !is_numeric($key);
    });

    foreach ($result as $variable) {
        foreach ($meses as $key) {
            $pdf->Cell(150);
            $pdf->Cell(120, 9.5, $key . "   ============>   " . $variable[$key] . " Bs", 0, 1, 'L', 0);
        }
    }
} else if ($_POST['select'] == "rotacion_inventario") {
    $meses = array_keys($result[0]);
    $numeros = array_keys($result[0]);
    $meses = array_filter($meses, function ($key) {
        return is_string($key) && !is_numeric($key);
    });
    $pdf->SetFont('Arial', '', 10);

    foreach ($result2 as $variable) {
        foreach ($result as $variable2) {
            foreach ($result3 as $variable3) {
                foreach ($meses as $key) {
                    $pdf->Cell(140);
                    $pdf->Cell(120, 9.5, $key. " ==> ". "   Coste P. Vendidos Bs " . $variable[$key] . "   V. Total Inventario Bs ".  $variable2[$key]. "   Rotacion ". $variable3[$key], 0, 1, 'L', 0);
                }
            }
        }

    }
}


$pdf->Output();
unlink($tempFilePath);
