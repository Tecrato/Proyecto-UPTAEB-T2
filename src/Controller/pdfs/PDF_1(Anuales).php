<?php

use Shtechnologyx\Pt3\Model\Estadisticas;
use Shtechnologyx\Pt3\Controller\pdfs\InterpretadorGananciasPerdidas;

$clase = new Estadisticas();
$inter = new interpretadorGananciasPerdidas;


$year = isset($_POST['year']) ? $_POST['year'] : '';

$result = $clase->filter_year_ganancias($year);

date_default_timezone_set('America/Caracas');
$fecha = new DateTime();
$res = $fecha->getTimestamp();
$fecha2 = getdate($res);


$graphic = $_POST['img'];
$tempFilePath = 'temp_chart.png';
file_put_contents($tempFilePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $graphic)));
class Hola extends FPDF
{
    function AgregarMes($mes, $interpretacion)
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(10);
        $this->Cell(0, 10, $mes, 0, 1, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(10);
        $this->MultiCell(0, 8, "------- " . utf8_decode($interpretacion), 0, 'L');
        $this->Ln(2);
    }

    function AgregarResumen($resumen)
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 25, 'Resumen Anual', 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 8, utf8_decode($resumen), 0, 'L');
        $this->Ln(50);
    }
}

$meses = [
    'Enero' => $result[0][0],
    'Febrero' => $result[0][1],
    'Marzo' => $result[0][2],
    'Abril' => $result[0][3],
    'Mayo' => $result[0][4],
    'Junio' => $result[0][5],
    'Julio' => $result[0][6],
    'Agosto' => $result[0][7],
    'Septiembre' => $result[0][8],
    'Octubre' => $result[0][9],
    'Noviembre' => $result[0][10],
    'Diciembre' => $result[0][11]
];

$interpretePorMes = [];
foreach ($meses as $mes => $monto) {
    $interpretePorMes[$mes] = $inter->interpretarMes($mes, $monto);
}
$resumen = $inter->interpretarAnual($meses);

// Crear el PDF
$pdf = new Hola();
$pdf->AddPage();
// Encabezado del PDF
$pdf->Image('src/static/images/logo_m.png', 10, 10, 32);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(320, 10, 'FECHA DEL REPORTE: ' . $fecha2['mday'] . '/' . $fecha2['mon'] . '/' . $fecha2['year'], 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(85);
$pdf->SetTextColor(0, 130, 38);
$pdf->SetFont('Arial', 'B', 22);
$pdf->Cell(30, 30, 'GANANCIAS/PERDIDAS ANUALES', 0, 0, 'C', 0);
$pdf->SetX(90);
$pdf->Cell(30, 50, 'Periodo: (' . $year . ')', 0, 0, 'C', 0);
$pdf->Ln(40);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(15);
$pdf->Cell(80, 10, "MES", 1, 0, 'C');
$pdf->Cell(80, 10, "GANANCIA/PERDIDA", 1, 1, 'C');
foreach ($meses as $mes) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(15);
    $pdf->Cell(80, 10, key($meses), 1, 0, 'C');
    $pdf->Cell(80, 10, $mes, 1, 1, 'C');
}

$pdf->SetFont('Arial', 'B', 18);

$pdf->Cell(80);
$pdf->Cell(30, 30, 'ANALISIS', 0, 0, 'C', 0);


$pdf->Ln(20);


// Agregar interpretaciones de cada mes al PDF

// Agregar resumen al PDFd
foreach ($interpretePorMes as $mes => $interpretacion) {
    $pdf->AgregarMes($mes, $interpretacion);
}
$pdf->AgregarResumen($resumen);
// $pdf = new FPDF();
// $pdf->AddPage("L");

$pdf->SetFont('Arial', 'B', 16);
// $pdf->SetFont('Arial', '', 10);
// $pdf->SetTextColor(255, 255, 255);
// $pdf->SetFont('Arial', 'B', 18);
// $pdf->SetFillColor(0, 130, 38);
$pdf->Cell(200, 10, "GRAFICA", 0, 0, 'C', 0);
$pdf->Ln(20);    
$pdf->Image($tempFilePath, null, null, 190, 80);
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



// $pdf->SetTextColor(255, 255, 255);
// $pdf->SetDrawColor(255, 255, 255);

// $pdf->Cell(23, 9.5, "Enero", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Febrero", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Marzo", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Abril", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Mayo", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Junio", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Julio", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Agosto", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Septiembre", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Octubre", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Noviembre", 1, 0, 'C', 1);
// $pdf->Cell(23, 9.5, "Diciembre", 1, 1, 'C', 1);

// $pdf->SetTextColor(0, 0, 0);

// $pdf->Cell(23, 9.5, $result[0][0] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][1] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][2] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][3] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][4] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][5] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][6] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][7] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][8] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][9] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][10] . " Bs", 1, 0, 'C', 0);
// $pdf->Cell(23, 9.5, $result[0][11] . " Bs", 1, 1, 'C', 0);



$pdf->Output();
unlink($tempFilePath);
