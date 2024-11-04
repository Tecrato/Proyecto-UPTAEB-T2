<?php

use FPDF as FPDF;
use Shtechnologyx\Pt3\Model\Entrada;
use Shtechnologyx\Pt3\Model\Detalle_entrada;

$id = $_GET['id'];
$d_entrada = new Detalle_entrada(id_entrada: $id);
$result2 = $d_entrada->b2();
$entrada = new Entrada($id);
$result1 = $entrada->search(0, 111111111)[0];


date_default_timezone_set('America/Caracas');
$fecha = new DateTime();
$res = $fecha->getTimestamp();
$time = time();
$hora = strtoupper(date('h:i A', $time));
$fecha2 = getdate($res);

// Creación del objeto de la clase heredada
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$pdf->Image('src/static/images/logo_m.png', 8, 8, 40);
$pdf->SetTextColor(25, 150, 40);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(250, 20, utf8_decode('FECHA: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year']), 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(270, 5, utf8_decode('ENTRADA NRO: ' . $result1['id']), 0, 0, 'C');


$pdf->Ln(25);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55, 10, utf8_decode('CODIGO: ' . $result1['codigo']), 0, 0, 'C');


$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(25, 150, 40);
$pdf->SetTextColor(255, 255, 255);

$pdf->Cell(190, 10, utf8_decode('INFORMACION'), 0, 0, 'C', 1);
$pdf->Ln(14);

$pdf->SetFillColor(25, 150, 40);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(85, 10, 'PROVEEDOR: ' . $result1['proveedor'], 0, 0, 'L', 0);
$pdf->Cell(85, 10, 'FECHA COMPRA: ' . $result1['fecha_compra'], 0, 0, 'L', 0);


$pdf->Ln(14);


$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(25, 150, 40);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(190, 10, utf8_decode('DETALLES'), 0, 0, 'C', 1);


$pdf->Ln(14);

$pdf->SetFont('Arial', '', 10);

$pdf->SetFillColor(228, 235, 240);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(25, 10, 'PRODUCTO', 0, 0, 'L', 0);
$pdf->Cell(35, 10, 'PRESENTACION', 0, 0, 'L', 0);
$pdf->Cell(35, 10, 'T.PRESENTACION', 0, 0, 'L', 0);
$pdf->Cell(25, 10, 'COMPRADO', 0, 0, 'L', 0);
$pdf->Cell(25, 10, 'EXISTENCIA', 0, 0, 'L', 0);
$pdf->Cell(25, 10, 'P. COMPRA', 0, 0, 'L', 0);
$pdf->Cell(30, 10, 'FECHA V.', 0, 1, 'L', 0);

foreach ($result2 as $value) {
    $pdf->Cell(25, 10, $value["producto"]. " ".$value["valor_unidad"]. " ".$value["unidad"]. " ".$value["marca"] , 0, 0, 'L',0);
    $pdf->Cell(35, 10, $value["empaquetado"], 0, 0, 'L',0);
    $pdf->Cell(35, 10, $value["tamaño_mercancia"], 0, 0, 'L',0);
    $pdf->Cell(25, 10, $value["cantidad"], 0, 0, 'L',0);
    $pdf->Cell(25, 10, $value["existencia"], 0, 0, 'L',0);
    $pdf->Cell(25, 10, $value["precio_compra"]. " Bs", 0, 0, 'L',0);
    $pdf->Cell(30, 10, $value["fecha_vencimiento"], 0, 1, 'L',0);
}





$pdf->Ln(70);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(10);
$pdf->Cell(110, 10, 'METODOS DE PAGO: EFECTIVO', 0, 0, 'L', 0);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(25, 150, 40);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(50, 10, 'TOTAL: 457 BS', 0, 0, 'C', 1);

$pdf->Output();
