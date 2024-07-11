<?php

require('../Plugins/fpdf.php');
require('../Controller/funcs_ajax/print_MaxMin.php');

date_default_timezone_set('America/Caracas');
$fecha = new DateTime();
$res = $fecha->getTimestamp();
$fecha2 = getdate($res);


$graphic = $_POST['img'];
$tempFilePath = 'temp_chart.png';
file_put_contents($tempFilePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $graphic)));

// class PDF extends FPDF {
//     // Cabecera de página
//     function Header(){
//         // bordes de página
//         $this->SetFillColor(0, 130, 38);
//         $this->Rect(0, 0, 3, 300, 'F');
//         $this->Rect(294, 0, 3, 300, 'F');
//     }
// }

$pdf = new FPDF();
$pdf->AddPage("L");
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(120);
$pdf->SetTextColor(0, 130, 38);
$pdf->Cell(30, 30,$_POST['select'] == "min_ventas" ? 'PRODUCTOS MENOS VENDIDOS' : 'PRODUCTOS MAS VENDIDOS', 0, 0, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(200, 30, 'FECHA: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
$pdf->Image('../static/images/logo_m.png', 10, 10, 35);
$pdf->Ln(50);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetFillColor(0, 130, 38);
$pdf->Cell(138, 10, "GRAFICA", 0, 0, 'C', 1);
$pdf->Rect(147.5, 60, 1, 140, 'F');
$pdf->Cell(138, 10, "DETALLES", 0, 0, 'C', 1);
$pdf->Cell(150, 120, "", 0, 0, 'C', 0);
$pdf->Image($tempFilePath, 13, 65, 120, 120);

$pdf->Ln(15);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
foreach ($result as $variable) {
    $pdf->Cell(160);
    $pdf->Cell(120, 15, strtoupper($variable['nombre'] . " " . $variable['marca'])." DE ". $variable['unidad_valor'] . " " . $variable['unidad'] . "   ===>   ".$variable['cantidad']." VENTAS", 0, 1, 'L', 0);
}








$pdf->Output();



unlink($tempFilePath);
