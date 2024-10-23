<?php

require_once("../../../vendor/autoload.php");
// require('../../Model/Conexion.php');
require('../../Model/Usuarios.php');
include("../funcs/verificar.php");
// require('../../Plugins/fpdf.php');

use Shtechnologyx\Pt3\Model\Estadisticas;

// require('../../Model/Estadisticas.php');

$clase = new Estadisticas();

$max = isset($_POST['max']) ? $_POST['max'] : null;
$min = isset($_POST['min']) ? $_POST['min'] : null;
$select = isset($_POST['select']) ? $_POST['select'] : null;
$date = isset($_POST['date']) ? $_POST['date'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';
$weekStart = isset($_POST['weekStart']) ? $_POST['weekStart'] : '';
$weekEnd = isset($_POST['weekEnd']) ? $_POST['weekEnd'] : '';
$graphic = isset($_POST['img']) ? $_POST['img'] : '';

if ($max == 'Año') {
    $result = $clase->filter_max_anio(substr($date, 0, 4));
} elseif ($max == 'mes_anio') {
    $result = $clase->filter_max_anio_mes(substr($date, 0, 4), substr($date, 5, 10));
} elseif ($min == 'Año') {
    $result = $clase->filter_min_anio(substr($date, 0, 4));
} elseif ($min == 'mes_anio') {
    $result = $clase->filter_min_anio_mes(substr($date, 0, 4), substr($date, 5, 10));
} elseif ($select == 'min_ventas') {
    $result = $clase->min_ventas();
} elseif ($select == 'ratio_ventas') {
    $result = $clase->ratio_ventas();
} elseif ($select == 'filter_year') {
    $result = $clase->filter_year_ganancias($year);
} elseif ($select == 'filter_week_ganancias') {
    $result = $clase->filter_week_ganancias($weekStart, $weekEnd);
} elseif ($select == 'rotacion_inventario') {
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
$pdf->Cell(90);
$pdf->SetTextColor(0, 130, 38);

if ($max == 'Año' || $max == "mes_anio") {
    $pdf->SetFont('Arial', 'B', 22);
    $pdf->Cell(20, 30, utf8_decode('PRODUCTOS MÁS VENDIDOS'), 0, 0, 'C', 0);
    $pdf->SetX(90);
    $pdf->Cell(30, 50, $max == 'Año' ? 'Periodo: (' . substr($date, 0, 4) . ')' : 'Periodo: (' . substr($date, 0, 4) . '/' . substr($date, 5, 10) . ')', 0, 0, 'C', 0);
} else if ($min == 'Año' || $min == "mes_anio") {
    $pdf->SetFont('Arial', 'B', 22);
    $pdf->Cell(20, 30, utf8_decode('PRODUCTOS MENOS VENDIDOS'), 0, 0, 'C', 0);
    $pdf->SetX(90);
    $pdf->Cell(30, 50, $min == 'Año' ? 'Periodo: (' . substr($date, 0, 4) . ')' : 'Periodo: (' . substr($date, 0, 4) . '/' . substr($date, 5, 10) . ')', 0, 0, 'C', 0);
}
else if ($select == "ratio_ventas") {
    $pdf->Cell(30, 30, 'RATIO DE VENTAS', 0, 0, 'C', 0);
} 
else if ($select == "filter_year") {
    $pdf->SetFont('Arial', 'B', 22);
    $pdf->Cell(30, 30, 'GANANCIAS/PERDIDAS ANUALES', 0, 0, 'C', 0);
    $pdf->SetX(90);
    $pdf->Cell(30, 50, 'Periodo: (' . $year . ')', 0, 0, 'C', 0);
} 
else if ($select == "filter_week_ganancias") {
    $pdf->SetFont('Arial', 'B', 25);
    $pdf->Cell(55, 30, 'GANANCIAS/PERDIDAS SEMANALES', 0, 0, 'C', 0);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetX(90);
    $pdf->Cell(30, 50, 'Periodo: (' . $weekStart . ' - ' . $weekEnd . ')', 0, 0, 'C', 0);
} 
else if ($select == "rotacion_inventario") {
    $pdf->Cell(30, 30, 'ROTACIÓN DEL INVENTARIO', 0, 0, 'C', 0);
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(260, 10, 'FECHA DEL REPORTE: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../../static/images/logo_m.png', 10, 10, 35);
$pdf->Ln(40);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 18);
$pdf->SetFillColor(0, 130, 38);
$pdf->Cell(275, 10, "GRAFICA", 0, 0, 'C', 1);
$pdf->Image($tempFilePath, 13, 65, 270, 140);
$pdf->Ln(160);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetTextColor(255, 255, 255);
$pdf->Ln(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(275, 10, "DESCRIPCION", 0, 0, 'C', 1);
$pdf->Ln(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 30);
$pdf->SetFont('Arial', '', 10);



if ($max == 'Año' || $max == 'mes_anio') {
    foreach ($result as $variable) {
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(40, 15, $variable[1] . " " . $variable[4] . " " . $variable[2] . " " . $variable[3], 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 15);
        $pdf->Cell(205, 15, ".........................................................................................................................................", 0, 0, 'L', 0);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(120, 15, $variable[5] . " Unidades", 0, 1, 'L', 0);
    }
} else if ($min == 'Año' || $min == 'mes_anio') {
    foreach ($result as $variable) {
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(40, 15, $variable[1] . " " . $variable[4] . " " . $variable[2] . " " . $variable[3], 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 15);
        $pdf->Cell(205, 15, ".........................................................................................................................................", 0, 0, 'L', 0);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(120, 15, $variable[5] . " Unidades", 0, 1, 'L', 0);
    }
} else if ($select == "ratio_ventas") {
    foreach ($result as $variable) {
        $pdf->Cell(150);
        $pdf->Cell(120, 15, strtoupper($variable['nombre'] . " " . $variable['marca']) . " DE " . $variable['unidad_valor'] . " " . $variable['unidad'] . "   ===>   SE VENDIO EL " . floatval($variable['ratio_ventas']) * 100 . " % ", 0, 1, 'L', 0);
    }
} else if ($select == "filter_year") {

    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetDrawColor(255, 255, 255);

    $pdf->Cell(23, 9.5, "Enero", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Febrero", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Marzo", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Abril", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Mayo", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Junio", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Julio", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Agosto", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Septiembre", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Octubre", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Noviembre", 1, 0, 'C', 1);
    $pdf->Cell(23, 9.5, "Diciembre", 1, 1, 'C', 1);

    $pdf->SetTextColor(0, 0, 0);

    $pdf->Cell(23, 9.5, $result[0][0] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][1] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][2] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][3] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][4] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][5] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][6] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][7] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][8] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][9] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][10] . " Bs", 1, 0, 'C', 0);
    $pdf->Cell(23, 9.5, $result[0][11] . " Bs", 1, 1, 'C', 0);
} else if ($select == "rotacion_inventario") {
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
                    $pdf->Cell(120, 9.5, $key . " ==> " . "   Coste P. Vendidos Bs " . $variable[$key] . "   V. Total Inventario Bs " .  $variable2[$key] . "   Rotacion " . $variable3[$key], 0, 1, 'L', 0);
                }
            }
        }
    }
} else if ($select == "filter_week_ganancias") {
    foreach ($result as $variable) {
        $pdf->SetFont('Arial', 'B', 15);

        $pdf->Cell(40, 15, "SEMANA " . $variable[0], 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 15);

        $pdf->Cell(205, 15, ".........................................................................................................................................", 0, 0, 'L', 0);
        $pdf->SetFont('Arial', 'B', 15);

        $pdf->Cell(120, 15, $variable[1] . " Bs", 0, 1, 'L', 0);
    }
}


$pdf->Output();
unlink($tempFilePath);
