<?php

require('../Plugins/fpdf.php');
require('../Controller/funcs/searchInventario.php');


//CABECERA DEL INVENTARIO__________________________________________________________________________________

class PDF extends FPDF
{
    function Header()
    {
        // $this->Image('../static/images/inventario2.png',0,0,210);
        $this->Image('../static/images/inventario2-1-1.png',0,0,210);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(18, 151, 64);
$pdf->SetX(5);
$pdf->SetY(31);
// $pdf->Cell(180,0.3,'',0,0,'C',1);
// $pdf->Image('../static/images/inventario2.png',0,0,210);
$pdf->SetTextColor(16, 103, 51);
$pdf->SetFont('Arial','B',17);
$pdf->SetY(10);
$pdf->SetX(19);
$pdf->Cell(50,18,'INVENTARIO',0,0,'C',0);
$pdf->SetFont('Arial','B',12);

$fecha = new DateTime();
$res = $fecha->getTimestamp();
$fecha2 = getdate($res);

$pdf->Cell(200,18,$fecha2['mday'].'/'.$fecha2['mon'].'/'.$fecha2['year'],0,0,'C',0);

$pdf->Ln(15);

//CABECERA DEL TOTAL DEL VALOR DEL INVENTARIO__________________________________________________________________________________

$pdf->SetTextColor(255, 255, 255);
$pdf->SetY(35);
$pdf->SetX(72);
$pdf->SetFillColor(16, 103, 51);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,'TOTAL',1,0,'C',1);
$pdf->SetY(35);
$pdf->SetX(112);
$pdf->SetFillColor(16, 103, 51);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(84,10,$result2->fetch_assoc()['Total'].' Bs',1,0,'C',1);

//CABECERA DE LOS NOMBRES DE LAS COLUMNAS__________________________________________________________________________________

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(18, 151, 64);
$pdf->SetY(45);
$pdf->SetX(17);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,10,'ID',0,0,'C',1);
$pdf->Cell(45,10,utf8_decode('DESCRIPCIÓN'),0,0,'C',1);
$pdf->Cell(20,10,'ENTRADAS',0,0,'C',1);
$pdf->Cell(20,10,'SALIDAS',0,0,'C',1);
$pdf->Cell(30,10,'EXISTENCIA',0,0,'C',1);
$pdf->Cell(30,10,'COSTO UNITARIO',0,0,'C',1);
$pdf->Cell(24,10,'TOTAL',0,1,'C',1);

$pdf->Ln(3);

//FILAS DEL INVENTARIO__________________________________________________________________________________
$pdf->SetTextColor(0, 0, 0);

for ($i=1; $i <= $result->num_rows; $i++) { 

    // if ($i % 2 == 0) {
    //     $pdf->SetFillColor(230,230,230);
    // } else {
    //     $pdf->SetFillColor(255,255,255);
    // }
    $row = $result->fetch_assoc();

    $pdf->SetX(17);
    $pdf->Cell(10,10,$row['id'],0,0,'C',0);
    $pdf->Cell(45,10,$row['descripcion'],0,0,'C',0);
    $pdf->Cell(20,10,$row['entradas'],0,0,'C',0);
    $pdf->Cell(20,10,$row['salidas'],0,0,'C',0);
    $pdf->Cell(30,10,$row['existencia'],0,0,'C',0);
    $pdf->Cell(30,10,$row['precio_venta'].' Bs',0,0,'C',0);
    $pdf->Cell(24,10,$row['Total'].' Bs',0,1,'C',0);
}
$pdf->Output();
?>


