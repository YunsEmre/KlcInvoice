<?php
require_once ('fpdf/fpdf.php');

class PDF extends FPDF
{
  function Header()
    {
      //$this->Image('logo.png',10,8,33);
      $this->SetFont('Helvetica','B',15);
      $this->SetXY(50, 10);
      $this->Cell(0,10,'This is a header',1,0,'C');
     }

  function Footer()
    {
      $this->SetXY(100,-15);
      $this->SetFont('Helvetica','I',10);
      $this->Write (5, 'This is a footer');
    }
}

$pdf=new PDF();
$pdf->AddPage();
ob_clean();
$pdf->Output('example2.pdf','D');
?>