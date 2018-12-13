<?php
require('../util/fpdf/mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'Relatorio - Controle de Estoque',0,1,'C');
	$this->Ln(10);
	parent::Header();
}
}

$link = mysqli_connect('localhost','root','','controleestoque');

$pdf = new PDF();
$pdf->AddPage();

$pdf->Table($link,'select * from movimentacao');

$pdf->Output();
?>
