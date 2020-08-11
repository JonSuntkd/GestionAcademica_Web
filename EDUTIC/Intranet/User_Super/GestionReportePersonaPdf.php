<?php 
    include '../services/ReportesServicios.php';
    $reportePersona = new ReporteServicios();
    



require('../services/fpdf/fpdf.php');




class PDF extends FPDF
{
// Page header
function Header()
{
    $this->Image('../assets/img/logolobo.png',10,0,40);
    $this->Image('../assets/img/logolobo.png',145,0,40);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(33);
    // Title
    $this->Cell(110,10,'Unidad Educativa "Oswaldo Guayasamin"',1,0,'C');
    
    $this->Ln(15);
    // Title
    $this->Cell(38);
    $this->Cell(100,10,'Reporte Persona',1,0,'C');
    // Line break
    $this->Ln(15);

    $this->Cell(60,10,"Apellido",1,0,'C',0);
    $this->Cell(60,10,"Nombre",1,0,'C',0);
    $this->Cell(30,10,"Cedula",1,0,'C',0);
    $this->Cell(40,10,"Telefono",1,1,'C',0);;
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}



$result = $reportePersona->persona();        

$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

while($row = $result->fetch_assoc())
{
    $pdf->Cell(60,10,$row ["APELLIDO"],1,0,'C',0);
    $pdf->Cell(60,10,$row ["NOMBRE"],1,0,'C',0);
    $pdf->Cell(30,10,$row ["CEDULA"],1,0,'C',0);
    $pdf->Cell(40,10,$row ["TELEFONO"],1,1,'C',0);
}

$pdf->Output();
?>

