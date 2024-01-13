<?php
require('../Plugins/fpdf.php');
// require('../Controller/funcs_ajax/search_factura.php');

// if ($_POST['TYPE'] == 'DETAIL-USER-FACT') {
    $user = array();
    foreach ($_POST as $key) {
        foreach ($key as $key2) {
            // print_r($key2['nombre']);
            $user = array(
                'vendedor' => $key2['vendedor'],
                'nombre' => $key2['nombre'],
                'metodo_pago' => $key2['metodo_pago'],
                'id' => $key2['id'],
                'fecha' => $key2['fecha'],
                'cedula' => $key2['cedula'],
                'apellido' => $key2['apellido'],
            );
        }
    }

    print_r($user["vendedor"]);
// }

// var_dump($json);

// foreach ($algo as $key) {
//     foreach ($key as $key2) {
//         print_r($key2['nombre']);
//     }
// }



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
// bordes de página_____________________________________________________________________________________________
$this->SetFillColor(0, 130, 38);
$this->Rect(0, 0, 3, 300, 'F');
$this->Rect(206.9, 0, 3, 300, 'F');
}

}

// Creación del objeto de la clase heredada


$pdf = new PDF();


$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);


// Cabecera de página_____________________________________________________________________________________________
// Logo
$pdf->Image('../static/images/logo_m.png',20,15,30);
// Arial bold 15
$pdf->SetFont('Arial','',12);
// Movernos a la derecha
$pdf->Cell(145);
$pdf->Cell(30,10,'Nro - 11',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(80);
//COLOR TEXTO
$pdf->SetTextColor(0, 130, 38);
// Título
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'VARIEDADES EL POLY C.A',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->SetFont('Arial','',8);
$pdf->Cell(30,10,'RIF',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(30,10,utf8_decode('DIRECCIÓN'),0,0,'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(30,10,utf8_decode('TELEFONO'),0,0,'C');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(30,10,utf8_decode('CORREO'),0,0,'C');



$pdf->Ln(15);
$pdf->SetTextColor(50, 50, 50);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(115);
$pdf->Cell(30,10,utf8_decode('FECHA: 00/00/0000'),0,0,'C');
$pdf->Cell(5);
$pdf->Cell(30,10,utf8_decode('HORA: 12.00 PM'),0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(78);
$pdf->Cell(30,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'),0,0,'C');

$pdf->Ln(7);


// Datos del cliente_____________________________________________________________________________________________
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(80);
$pdf->Cell(30,10,utf8_decode('DATOS DEL CONSUMIDOR'),0,0,'C');
$pdf->Ln(10);
$pdf->SetTextColor(50, 50, 50);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25);
$pdf->Cell(30,10,utf8_decode('NOMBRE CLIENTE: JUAN ANDRES'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(7.8);
$pdf->Cell(30,10,utf8_decode('RIF: 30000000'),0,0,'C');
$pdf->Ln(7);
$pdf->Cell(78);
$pdf->Cell(30,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'),0,0,'C');
$pdf->Ln(10);

// Datos del producto_____________________________________________________________________________________________

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(10);
$pdf->Cell(15,10,'CANT',0,0,'C',0);
$pdf->Cell(95,10,utf8_decode('DESCRIPCIÓN'),0,0,'C',0);
$pdf->Cell(25,10,'VALOR UNIT',0,0,'C',0);
$pdf->Cell(30,10,'VALOR TOTAL',0,1,'C',0);


$fila = 5;

for ($i=0; $i < $fila; $i++) { 

    if ($i % 2 == 0) {
        $pdf->SetFillColor(255,255,255);
    } else {
        $pdf->SetFillColor(230,230,230);
    }

    $pdf->SetFont('Arial','',10);

    $pdf->Cell(10);
    $pdf->Cell(15,10,'10',0,0,'C',1);
    $pdf->Cell(95,10,utf8_decode('Harina pan'),0,0,'C',1);
    $pdf->Cell(25,10,'20.00',0,0,'C',1);
    $pdf->Cell(30,10,'200.00',0,1,'C',1);
}

$pdf->Ln(5);
$pdf->Cell(78);
$pdf->Cell(30,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'),0,0,'C');
$pdf->Ln(10);


// Datos del total a pagar_____________________________________________________________________________________________

$pdf->SetFont('Arial','',10);

$pdf->Cell(120);
$pdf->Cell(15,10,'SUBTOTAL Bs',0,0,'C',0);

$pdf->Cell(15);
$pdf->Cell(15,10,'100',0,0,'C',0);

$pdf->Ln(7);

$pdf->Cell(124.5);
$pdf->Cell(15,10,'IVA Bs',0,0,'R',0);

$pdf->Cell(11);
$pdf->Cell(15,10,'100',0,0,'C',0);

$pdf->Ln(9);

$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225,225,225);
$pdf->Cell(117);
$pdf->SetX(120);
$pdf->Cell(30,10,'TOTAL Bs',0,0,'R',1);
$pdf->Cell(35.5,10,'100',0,0,'C',1);

$pdf->Ln(12);


// DETALLES del total a pagar_____________________________________________________________________________________________
$pdf->SetTextColor(50, 50, 50);
$pdf->SetFont('Arial','',10);
$pdf->Cell(78);
$pdf->Cell(30,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------'),0,0,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(20);
$pdf->Cell(30,10,utf8_decode('FORMA DE PAGO: EFECTIVO'),0,0,'C');
$pdf->Cell(30);
$pdf->Cell(30,10,utf8_decode('VENDEDOR: LUCAS MERLO'),0,0,'C');

 // Posición: a 1,5 cm del final
 $pdf->SetY(-15);
 // Arial italic 8
 $pdf->SetFont('Arial','I',8);
 // Número de página
 // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

$pdf->Output();
$pdf2->Output();
?>