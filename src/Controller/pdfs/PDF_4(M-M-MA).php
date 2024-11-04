<?php

use FPDF as FPDF;
use Shtechnologyx\Pt3\Controller\pdfs\InterpretadorProductos;
use Shtechnologyx\Pt3\Model\Estadisticas;

$clase = new Estadisticas();
$interpretador = new InterpretadorProductos();

$max = isset($_POST['max']) ? $_POST['max'] : null;
$min = isset($_POST['min']) ? $_POST['min'] : null;
$date = isset($_POST['date']) ? $_POST['date'] : '';
$graphic = isset($_POST['img']) ? $_POST['img'] : '';

if ($min == 'Año') {
    $result = $clase->filter_min_anio(substr($date, 0, 4));
} elseif ($min == 'mes_anio') {
    $result = $clase->filter_min_anio_mes(substr($date, 0, 4), substr($date, 5, 10));
}

date_default_timezone_set('America/Caracas');
$fecha = new DateTime();
$res = $fecha->getTimestamp();
$fecha2 = getdate($res);
$tempFilePath = 'temp_chart.png';
file_put_contents($tempFilePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $graphic)));

$productos = array_map(function ($producto) {
    return [
        'nombre' => $producto['nombre'] . " " . $producto['unidad_valor'] . " " . $producto['unidad'] . " " . $producto['marca'],
        'cantidad' => $producto['cantidad']
    ];
}, $result);

class PDFReporte extends FPDF
{
    function cuerpo($interpretacion)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, utf8_decode($interpretacion));
        $this->Ln(1);
    }
}
$interpretador = new InterpretadorProductos();
$interpretacion = $interpretador->interpretarProductos($productos);
$interpretacion .= $interpretador->interpretarPromedio($productos);

$pdf = new PDFReporte();
$pdf->AddPage();

$pdf->Image('src/static/images/logo_m.png', 10, 10, 32);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(320, 10, 'FECHA DEL REPORTE: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(85);
$pdf->SetTextColor(0, 130, 38);
// $pdf->SetX(90);
$pdf->SetFont('Arial', 'B', 22);
$pdf->Cell(20, 30, utf8_decode('PRODUCTOS MENOS VENDIDOS'), 0, 0, 'C', 0);
$pdf->SetX(90);
$pdf->Cell(30, 50, $max == 'Año' ? 'Periodo: (' . substr($date, 0, 4) . ')' : 'Periodo: (' . substr($date, 0, 4) . '/' . substr($date, 5, 10) . ')', 0, 0, 'C', 0);

$pdf->Ln(40);

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(90, 10, utf8_decode('PRODUCTOS MENOS VENDIDOS'), 1, 0, 'C', 0);
$pdf->Cell(90, 10, utf8_decode('CANTIDAD'), 1, 1, 'C', 0);
foreach ($productos as $producto) {
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell(90, 15, $producto['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(90, 15, $producto['cantidad'] . " Unidades", 1, 1, 'C', 0);
}
$pdf->Ln(5);
$pdf->cuerpo($interpretacion);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(190, 10, "GRAFICA", 0, 0, 'C', 0);
$pdf->Ln(5);
$pdf->SetX(50);
$pdf->Image($tempFilePath, null, null, 90, 90);

$pdf->Output();

unlink($tempFilePath);
