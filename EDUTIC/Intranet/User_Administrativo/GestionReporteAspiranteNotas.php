<?php 
    include '../services/AspiranteServicios.php';
    $aspiranteGestion = new AspiranteServicios();
    



require('../services/fpdf/fpdf.php');




class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    
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
    $this->Cell(100,10,'Reporte Aspirantes Notas',1,0,'C');
    // Line break
    $this->Ln(15);

    $this->Cell(35,10,"Nivel",1,0,'C',0);
    $this->Cell(35,10,"Nombre",1,0,'C',0);
    $this->Cell(35,10,"Apellido",1,0,'C',0);
    $this->Cell(35,10,"Calificacion",1,0,'C',0);;
    $this->Cell(35,10,"Estado",1,1,'C',0);
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



$result = $aspiranteGestion->mostrarAspiranteCalificacione();        

$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

while($row = $result->fetch_assoc())
{
    $pdf->Cell(35,10,$row ["COD_NIVEL_EDUCATIVO"],1,0,'C',0);
    $pdf->Cell(35,10,$row ["NOMBRE"],1,0,'C',0);
    $pdf->Cell(35,10,$row ["APELLIDO"],1,0,'C',0);
    $pdf->Cell(35,10,$row ["CALIFICACION"],1,0,'C',0);;
    $pdf->Cell(35,10,$row ["ESTADO"],1,1,'C',0);;
}

$pdf->Output();
?>

