<?php
require("../../Model/Conexion.php");
require('../../Model/Usuarios.php');
include("../funcs/verificar.php");
require('../../Plugins/fpdf.php');
require('../../Model/Facturas.php');
require('../../Model/Registro de ventas.php');
require('../../Model/Pagos.php');

$clase2 = new Registro_ventas(isset($_GET['id']) ? $_GET['id'] : null);
$result = $clase2->search()[0];

$clase = new Factura(id_registro_ventas:isset($_GET['id']) ? $_GET['id'] : null);
$product = $clase->search_ProductFact();

$clase3 = new Pago(id_venta:isset($_GET['id']) ? $_GET['id'] : null);
$pagos = $clase3->search();



$fecha = strtotime($result['fecha']);
$hora = strtoupper(date('h:i a', $fecha));
$dia =  date('d/m/Y', $fecha);


class PDF extends FPDF {
    // Cabecera de página
    function Header(){
        // bordes de página
        $this->SetFillColor(0, 130, 38);
        $this->Rect(0, 0, 3, 300, 'F');
        $this->Rect(206.9, 0, 3, 300, 'F');
    }
}

// Creación del objeto de la clase heredada


$pdf = new PDF();


$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);


// Cabecera de página_____________________________________________________________________________________________
// Logo
$pdf->Image('../../static/images/logo_m.png', 20, 15, 30);
// Arial bold 15
$pdf->SetFont('Arial', '', 12);
// Movernos a la derecha
$pdf->Cell(145);
$pdf->Cell(30, 10, 'Nro - ' . $result['id'], 0, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(80);
//COLOR TEXTO
$pdf->SetTextColor(0, 130, 38);
// Título
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'VARIEDADES EL POLY C.A', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 10, 'RIF', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('DIRECCIÓN'), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('TELEFONO'), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('CORREO'), 0, 0, 'C');



$pdf->Ln(15);
$pdf->SetTextColor(50, 50, 50);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(115);
$pdf->Cell(30, 10, utf8_decode('FECHA: ' . $dia), 0, 0, 'C');
$pdf->Cell(5);
$pdf->Cell(30, 10, utf8_decode('HORA: ' . $hora), 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(78);
$pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');

$pdf->Ln(7);


// Datos del cliente_____________________________________________________________________________________________
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('DATOS DEL CONSUMIDOR'), 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetTextColor(50, 50, 50);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(7.5);
$pdf->Cell(80, 10, utf8_decode('CLIENTE: ' . strtoupper($result['cliente_nombre'] . " " . $result['cliente_apellido'])), 0, 0, 'L');
$pdf->Ln(6);
$pdf->Cell(7.5);
$pdf->Cell(50, 10, utf8_decode('RIF: ' .$result['cliente_documento']. $result['cliente_cedula']), 0, 0, 'L');
$pdf->Ln(7);
$pdf->Cell(78);
$pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');
$pdf->Ln(10);

// Datos del producto_____________________________________________________________________________________________

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(10);
$pdf->Cell(15, 10, 'CANT', 0, 0, 'C', 0);
$pdf->Cell(95, 10, utf8_decode('DESCRIPCIÓN'), 0, 0, 'C', 0);
$pdf->Cell(25, 10, 'VALOR UNIT', 0, 0, 'C', 0);
$pdf->Cell(30, 10, 'VALOR TOTAL', 0, 1, 'C', 0);


$fila = 0;

foreach ($product as $p) {
    $fila++;

    if ($fila % 2 == 0) {
        $pdf->SetFillColor(255, 255, 255);
    } else {
        $pdf->SetFillColor(230, 230, 230);
    }

    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell(10);
    $pdf->Cell(15, 10, $p['cantidad'], 0, 0, 'C', 1);
    $pdf->Cell(95, 10, utf8_decode($p['descripcion']), 0, 0, 'C', 1);
    $pdf->Cell(25, 10, number_format($p['valor_unit'], 2, '.', ''), 0, 0, 'C', 1);
    $pdf->Cell(30, 10, number_format($p['Total'],2, '.', ''), 0, 1, 'C', 1);
}
$pdf->Ln(5);
$pdf->Cell(78);
$pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');
$pdf->Ln(10);


// Datos del total a pagar_____________________________________________________________________________________________

$pdf->SetFont('Arial', '', 10);

$pdf->Cell(120);
$pdf->Cell(15, 10, 'SUBTOTAL Bs', 0, 0, 'C', 0);

$pdf->Cell(15);
$pdf->Cell(15, 10, round($result['monto_final']-$result['IVA'], 2), 0, 0, 'C', 0);

$pdf->Ln(7);

$pdf->Cell(124.5);
$pdf->Cell(15, 10, 'IVA Bs', 0, 0, 'R', 0);

$pdf->Cell(11);
$pdf->Cell(15, 10, $result['IVA'], 0, 0, 'C', 0);

$pdf->Ln(9);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->Cell(117);
$pdf->SetX(120);
$pdf->Cell(30, 10, 'TOTAL Bs', 0, 0, 'R', 1);
$pdf->Cell(35.5, 10, $result['monto_final'], 0, 0, 'C', 1);

$pdf->Ln(12);


// DETALLES del total a pagar_____________________________________________________________________________________________
$pdf->SetTextColor(50, 50, 50);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(78);
$pdf->Cell(30, 10, utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(10);
$pdf->Cell(30, 10, utf8_decode('FORMAS DE PAGO:'), 0, 0, 'C');
$pdf->Cell(30);
$pdf->Cell(30, 10, utf8_decode('VENDEDOR: ' . strtoupper($result['vendedor'])), 0, 0, 'C');
$pdf->Ln(10);
foreach ($pagos as $pago) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(13);
    $pdf->Cell(15, 10, strtoupper($pago['metodo']), 0, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($pago['monto']), 0, 1, 'C', 0);
    // $pdf->Cell(25, 10, $p['valor_unit'], 0, 0, 'C', 1);
    // $pdf->Cell(30, 10, $p['Total'], 0, 1, 'C', 1);
}


// Posición: a 1,5 cm del final
$pdf->SetY(-15);
// Arial italic 8
$pdf->SetFont('Arial', 'I', 8);
// Número de página
// $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

$pdf->Output();
$pdf2->Output();
