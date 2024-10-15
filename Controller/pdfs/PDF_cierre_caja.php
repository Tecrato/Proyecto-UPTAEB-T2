<?php
require("../../Model/Conexion.php");
require('../../Model/Usuarios.php');
include("../funcs/verificar.php");
require('../../Plugins/fpdf.php');
require('../../Model/Cajas.php');



$clase = new Caja($_GET['id_caja']);

$metodos = $clase->totalMetodosPago();
$detalles = $clase->search();

//CABECERA DEL INVENTARIO__________________________________________________________________________________

class PDF extends FPDF{
    // Cabecera de página
    function Header(){
        // Logo
        // $this->Image('./Image/LogoM.png', 15, 8, 33);

        // $this->SetX(50);
        $this->Image('../../static/images/inventario2-1-1.png', 0, 0, 210);
        // Arial bold 15

    }
}

date_default_timezone_set('America/Caracas');
$fecha = new DateTime();
$res = $fecha->getTimestamp();
$time = time();
$hora = strtoupper(date('h:i A', $time));
$fecha2 = getdate($res);


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 17);
// Movernos a la derecha
// Título
$pdf->Ln(10);
$pdf->Cell(30);
$pdf->SetTextColor(25, 150, 40);
$pdf->Cell(30, 30, 'CIERRE DE CAJA Nro.' . $detalles[0]["id"], 0, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(155, 10, 'USUARIO: ' . $detalles[0]["nombre"], 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(300, 10, 'FECHA DE IMPRESION: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(271, 10, 'HORA ' . $hora, 0, 0, 'C');

// Salto de línea
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(78);
$pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');


$pdf->Ln(7);
$pdf->Cell(35, 12, 'USUARIO: ', 0, 0, 'C');
$pdf->Cell(2, 12, $detalles[0]["nombre"], 0, 0, 'C');
$pdf->Cell(40);
$pdf->Cell(25, 12, 'FECHA:  ', 0, 0, 'C');
$pdf->Cell(30, 12, $detalles[0]["fecha"], 0, 0, 'C');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(48, 12, 'VALOR INICIAL:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(2, 12, $detalles[0]["monto_inicial"] . " Bs", 0, 0, 'C');
$pdf->Cell(34);
$pdf->Cell(14, 12, 'ESTADO:  ', 0, 0, 'C');
$pdf->Cell(25, 12, $detalles[0]["estado"] == 1 ? 'CERRADA' : "ABIERTA", 0, 0, 'C');
$pdf->Ln(9);




$pdf->Cell(78);
$pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(78);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 12, 'CUADRE DE CAJA', 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(78);
$pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');
$pdf->Ln(8);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(60);
foreach ($metodos as $variable) {
    $pdf->Cell(25, 12, strtoupper($variable['nombre']), 0, 0, 'C');
}
// $pdf->Cell(20, 12, 'EFECTIVO', 0, 0, 'C');
// $pdf->Cell(20, 12, 'DIVISA', 0, 0, 'C');
// $pdf->Cell(20, 12, 'TRANSFERENCIA', 0, 0, 'C');
// $pdf->Cell(20, 12, 'PAGO M.', 0, 0, 'C');
// $pdf->Cell(20, 12, 'BIOPAGO', 0, 0, 'C');
// $pdf->Cell(20, 12, 'PUNTO DE V.', 0, 0, 'C');

$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 12, 'INGRESOS', 0, 0, 'C');
$pdf->Cell(30);
$pdf->SetFont('Arial', '', 8);
foreach ($metodos as $variable) {
    $pdf->Cell(25, 12, $variable['nombre'] == "Divisa" ? number_format(strtoupper($variable['monto']), 2, '.', '') . " $" : number_format(strtoupper($variable['monto']), 2, '.', '') . " Bs", 0, 0, 'C');
}
// $pdf->Cell(20, 12, '0.00', 0, 0, 'C');
// $pdf->Cell(20, 12, '0.00', 0, 0, 'C');
// $pdf->Cell(20, 12, '0.00', 0, 0, 'C');
// $pdf->Cell(20, 12, '0.00', 0, 0, 'C');
// $pdf->Cell(20, 12, '0.00', 0, 0, 'C');
// $pdf->Cell(20, 12, '0.00', 0, 0, 'C');
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(24, 12, 'TOTAL', 0, 0, 'C');
$pdf->Cell(10, 12, number_format($detalles[0]['total_cierre'], 2, '.', '') . " Bs", 0, 0, 'C');

$pdf->Ln(8);


$pdf->Cell(40, 12, 'TOTAL CREDITO', 0, 0, 'C');
$pdf->Cell(10, 12, number_format($detalles[0]['monto_credito'], 2, '.', ''). " $", 0, 0, 'C');
$pdf->Ln(8);
$pdf->Cell(55, 12, 'TOTAL CIERRE DE CAJA', 0, 0, 'C');
$pdf->Cell(10, 12, number_format($detalles[0]['total_cierre'], 2, '.', '') + $detalles[0]["monto_inicial"] . " Bs", 0, 0, 'C');
// $pdf->Ln(10);
// $pdf->Cell(78);
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(30, 12, 'DETALLES DEL CUADRE DE CAJA', 0, 0, 'C');

// $pdf->Ln(15);

// $pdf->Cell(70, 12, 'INGRESOS EN EFECTIVO', 0, 0, 'C');
// $pdf->Ln(15);

// $pdf->SetFont('Arial', '', 10);
// for ($i = 0; $i < 2; $i++) {
//     $pdf->Cell(15);
//     $pdf->MultiCell(90, 5, 'PAGO DE VENTA DE ALEJANDRO VARGAS EL 1/11/2022 POR FACTURAS Nro. 01', 0, 'L', false);
//     $pdf->Cell(300, -15, '10.50', 0, 0, 'C');
//     $pdf->Ln(5);
// }


// $pdf->Cell(25);
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(30, 12, 'TOTAL', 0, 0, 'C');
// $pdf->Cell(80);
// $pdf->Cell(30, 12, '150.00', 0, 0, 'C');


// $pdf->SetFont('Arial', '', 10);
// $pdf->Ln(8);
// $pdf->Cell(78);
// $pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');
// $pdf->Ln(2);


// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Ln(10);
// $pdf->Cell(10);
// $pdf->Cell(70, 12, 'INGRESOS EN TRANSFERENCIA', 0, 0, 'C');
// $pdf->Ln(15);

// $pdf->SetFont('Arial', '', 10);

// for ($i = 0; $i < 2; $i++) {
//     $pdf->Cell(15);
//     $pdf->MultiCell(90, 5, 'PAGO DE VENTA DE ALEJANDRO VARGAS EL 1/11/2022 POR FACTURAS Nro. 01', 0, 'L', false);
//     $pdf->Cell(300, -15, '10.50', 0, 0, 'C');
//     $pdf->Ln(5);
// }

// $pdf->Cell(25);
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(30, 12, 'TOTAL', 0, 0, 'C');
// $pdf->Cell(80);
// $pdf->Cell(30, 12, '150.00', 0, 0, 'C');



$pdf->Output();