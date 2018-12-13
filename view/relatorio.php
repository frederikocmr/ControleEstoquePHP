<?php

require('../util/fpdf/mysql_table.php');

class PDF extends PDF_MySQL_Table {
    private $titulo;
    function Header() {
        $this->titulo = $_GET['titulo'];
        $this->SetFont('Arial', '', 18);
        $this->Cell(0, 6, $this->titulo, 0, 1, 'C');
        $this->Ln(10);
        parent::Header();
    }

}



$link = mysqli_connect('localhost', 'root', '', 'controleestoque');

$pdf = new PDF();
$pdf->AddPage();

$pdf->Table($link, 'select * from movimentacao');

$pdf->Output();
?>
