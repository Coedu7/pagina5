<?php
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
		global $title;
		// Logo
		//$this->Image('logo.png',0,-10,75);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		// Calculamos ancho y posici�n del t�tulo.
		$w = $this->GetStringWidth($title)+6;
		$this->SetX((210-$w)/2);
		// Colores de los bordes, fondo y texto
		$this->SetDrawColor(85,112,144);
		$this->SetFillColor(125,189,245);
		$this->SetTextColor(21,86,159);
		// Ancho del borde (1 mm)
		$this->SetLineWidth(1);
		// T�tulo
		$this->Cell($w,9,$title,1,1,'C',true);
		// Salto de l�nea
		$this->Ln(10);
	// Ensure table header is printed
	parent::Header();
}
}

// Connect to database
$link = mysqli_connect('localhost','root','','concesionario');



$pdf = new PDF();

$title = 'Clientes registrados';
$pdf->SetTitle($title);

$pdf->AddPage();
// First table: output all columns
/* $pdf->Table($link,'SELECT * FROM `clientes`');
$pdf->AddPage(); */
// Second table: specify 3 columns
$pdf->AddCol('dni',25,'DNI','C');
$pdf->AddCol('nombre',30,'Nombre');
$prop = array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
$pdf->Table($link,'SELECT * FROM `clientes`',$prop);
$pdf->Output();
?>
