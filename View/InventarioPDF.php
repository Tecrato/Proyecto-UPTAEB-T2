<?php

require('../Plugins/fpdf.php');


//CABECERA DEL INVENTARIO__________________________________________________________________________________

$pdf = new FPDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(18, 151, 64);
$pdf->SetX(5);
$pdf->SetY(31);
// $pdf->Cell(180,0.3,'',0,0,'C',1);
$pdf->Image('../static/images/logo_m.png',15,11,19);
$pdf->SetTextColor(16, 103, 51);
$pdf->SetFont('Arial','B',16);
$pdf->SetY(10);
$pdf->SetX(30);
$pdf->Cell(50,18,'INVENTARIO',0,0,'C',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(200,18,'20/11/2023',0,0,'C',0);

$pdf->Ln(15);

//CABECERA DEL TOTAL DEL VALOR DEL INVENTARIO__________________________________________________________________________________

$pdf->SetTextColor(255, 255, 255);
$pdf->SetY(35);
$pdf->SetX(80);
$pdf->SetFillColor(16, 103, 51);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,10,'TOTAL',1,0,'C',1);

$pdf->SetY(35);
$pdf->SetX(120);
$pdf->SetFillColor(16, 103, 51);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(84,10,'1000.00 BS',1,0,'C',1);

//CABECERA DE LOS NOMBRES DE LAS COLUMNAS__________________________________________________________________________________

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(18, 151, 64);
$pdf->SetY(45);
$pdf->SetX(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,10,'ID',0,0,'C',1);
$pdf->Cell(45,10,utf8_decode('DESCRIPCIÓN'),0,0,'C',1);
$pdf->Cell(20,10,'LOTE',0,0,'C',1);
$pdf->Cell(20,10,'ENTRADAS',0,0,'C',1);
$pdf->Cell(20,10,'SALIDAS',0,0,'C',1);
$pdf->Cell(30,10,'EXISTENCIA',0,0,'C',1);
$pdf->Cell(30,10,'COSTO UNITARIO',0,0,'C',1);
$pdf->Cell(24,10,'TOTAL',0,1,'C',1);

$pdf->Ln(3);

//FILAS DEL INVENTARIO__________________________________________________________________________________
$pdf->SetTextColor(0, 0, 0);
$fila = 6;
for ($i = 1; $i <= $fila; $i++) { 

    
    if ($i % 2 == 0) {
        $pdf->SetFillColor(255,255,255);
    } else {
        $pdf->SetFillColor(230,230,230);
    }

    $pdf->SetX(5);
    $pdf->Cell(10,10,$i,0,0,'C',1);
    $pdf->Cell(45,10,utf8_decode('Queso Blanco'),0,0,'C',1);
    $pdf->Cell(20,10,'1',0,0,'C',1);
    $pdf->Cell(20,10,'10',0,0,'C',1);
    $pdf->Cell(20,10,'5',0,0,'C',1);
    $pdf->Cell(30,10,'5',0,0,'C',1);
    $pdf->Cell(30,10,'10 bs',0,0,'C',1);
    $pdf->Cell(24,10,'1000 bs',0,1,'C',1);
}
$pdf->Output();

?>

