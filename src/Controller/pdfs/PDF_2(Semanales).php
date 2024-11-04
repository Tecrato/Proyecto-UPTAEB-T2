<?php

use Shtechnologyx\Pt3\Model\Estadisticas;
use Shtechnologyx\Pt3\Controller\pdfs\InterpretadorGananciasPerdidas;

$clase = new Estadisticas();
$inter = new interpretadorGananciasPerdidas;

$weekStart = isset($_POST['weekStart']) ? $_POST['weekStart'] : '';
$weekEnd = isset($_POST['weekEnd']) ? $_POST['weekEnd'] : '';
$graphic = isset($_POST['img']) ? $_POST['img'] : '';
$result = $clase->filter_week_ganancias($weekStart, $weekEnd);

date_default_timezone_set('America/Caracas');
$fecha = new DateTime();
$res = $fecha->getTimestamp();
$fecha2 = getdate($res);
$tempFilePath = 'temp_chart.png';
file_put_contents($tempFilePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $graphic)));
class Hola extends FPDF
{
    function AgregarSemana($semana, $interpretacion)
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(10);
        $this->Cell(0, 10, "Semana " . $semana, 0, 1, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(10);
        $this->MultiCell(0, 8, "------- " . utf8_decode($interpretacion), 0, 'L');
        $this->Ln(2);
    }

    function AgregarResumen($resumen)
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 25, 'Resumen', 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 8, utf8_decode($resumen), 0, 'L');
        $this->Ln(50);
    }
}

$semanas = [];
foreach ($result as $variable) {
    $semanas[$variable[0]] = $variable[1];
}
$interpretePorSemana = [];
foreach ($semanas as $semana => $monto) {
    $interpretePorSemana[$semana] = $inter->interpretarSemana($semana, $monto);
}

$resumenSemanal = $inter->interpretarSemanalmente($semanas);

$pdf = new Hola();
$pdf->AddPage();
$pdf->Image('src/static/images/logo_m.png', 10, 10, 32);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(320, 10, 'FECHA DEL REPORTE: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(85);
$pdf->SetTextColor(0, 130, 38);
$pdf->SetFont('Arial', 'B', 22);
$pdf->Cell(30, 30, 'GANANCIAS/PERDIDAS SEMANALES', 0, 0, 'C', 0);
$pdf->SetX(90);
$pdf->Cell(30, 50, 'Periodo: (' . $weekStart . ' - ' . $weekEnd . ')', 0, 0, 'C', 0);
$pdf->Ln(40);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(15);
$pdf->Cell(80, 10, "SEMANA", 1, 0, 'C');
$pdf->Cell(80, 10, "GANANCIA/PERDIDA", 1, 1, 'C');
foreach ($semanas as $semana => $monto) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(15);
    $pdf->Cell(80, 10, "Semana " . $semana, 1, 0, 'C');
    $pdf->Cell(80, 10, $monto, 1, 1, 'C');
}

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(80);
$pdf->Cell(30, 30, 'ANALISIS', 0, 0, 'C', 0);
$pdf->Ln(20);

foreach ($interpretePorSemana as $semana => $interpretacion) {
    $pdf->AgregarSemana($semana, $interpretacion);
}

$pdf->AgregarResumen($resumenSemanal);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, "GRAFICA", 0, 0, 'C', 0);
$pdf->Ln(20);    
$pdf->Image($tempFilePath, null, null, 190, 80);


// $pdf = new FPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial', 'B', 30);
// $pdf->Cell(90);
// $pdf->SetTextColor(0, 130, 38);

// $pdf->SetFont('Arial', 'B', 25);
// $pdf->Cell(55, 30, 'GANANCIAS/PERDIDAS SEMANALES', 0, 0, 'C', 0);
// $pdf->SetFont('Arial', 'B', 16);
// $pdf->SetX(90);
// $pdf->Cell(30, 50, 'Periodo: (' . $weekStart . ' - ' . $weekEnd . ')', 0, 0, 'C', 0);

// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(260, 10, 'FECHA DEL REPORTE: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
// $pdf->SetFont('Arial', '', 10);
// $pdf->Image('src/static/images/logo_m.png', 10, 10, 35);
// $pdf->Ln(40);
// $pdf->SetTextColor(255, 255, 255);
// $pdf->SetFont('Arial', 'B', 18);
// $pdf->SetFillColor(0, 130, 38);
// $pdf->Cell(275, 10, "GRAFICA", 0, 0, 'C', 1);
// $pdf->Image($tempFilePath, 13, 65, 270, 140);
// $pdf->Ln(160);
// $pdf->SetFont('Arial', '', 12);
// $pdf->SetTextColor(0, 0, 0);

// $pdf->SetTextColor(255, 255, 255);
// $pdf->Ln(40);
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(275, 10, "DESCRIPCION", 0, 0, 'C', 1);
// $pdf->Ln(20);
// $pdf->SetTextColor(0, 0, 0);
// $pdf->SetFont('Arial', 'B', 30);
// $pdf->SetFont('Arial', '', 10);

// foreach ($result as $variable) {
//     $pdf->SetFont('Arial', 'B', 15);

//     $pdf->Cell(40, 15, "SEMANA " . $variable[0], 0, 0, 'L', 0);
//     $pdf->SetFont('Arial', '', 15);

//     $pdf->Cell(205, 15, ".........................................................................................................................................", 0, 0, 'L', 0);
//     $pdf->SetFont('Arial', 'B', 15);

//     $pdf->Cell(120, 15, $variable[1] . " Bs", 0, 1, 'L', 0);
// }


$pdf->Output();
unlink($tempFilePath);
