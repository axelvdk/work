<?php
	//if(!isset($_SESSION)) session_start();
	ini_set("session.auto_start", 0);
	require_once($_SERVER['DOCUMENT_ROOT'].'/managers/salonManager.php');
	require_once("fpdf/fpdf.php");
	// if(file_exists('fpdf/fpdf.php')) echo "existe"; else echo "existe pas";
	$salonManager = new SalonManager();
	// $result = $salonManager->selectFilleByIdSalon($_SESSION['id_salon']);
	$dataFacturation = $salonManager->selectFilleByIdSalonFacturation($_SESSION['id_salon']);
	
class PDF extends FPDF
{
// En-tête
	function Header()
	{
		//  Logo:
	   // $this->Image('img/eskort.jpg');
		// Police Arial gras 15
		$this->SetFont('Arial','B',15);
		// Décalage à droite
		$this->Cell(80);
		// Titre
		$month = date(m);
		switch($month)
		{
			case "01" : $month_str = utf8_encode("Janvier"); break;
			case "02" : $month_str = utf8_encode("Février"); break;
			case "03" : $month_str = utf8_encode("Mars"); break;
			case "04" : $month_str = utf8_encode("Avril"); break;
			case "05" : $month_str = utf8_encode("Mai"); break;
			case "06" : $month_str = utf8_encode("Juin"); break;
			case "07" : $month_str = utf8_encode("Juillet"); break;
			case "08" : $month_str = utf8_encode("Août"); break;
			case "09" : $month_str = utf8_encode("Septembre"); break;
			case "10" : $month_str = utf8_encode("Octobre"); break;
			case "11" : $month_str = utf8_encode("Novembre"); break;
			case "12" : $month_str = utf8_encode("Decembre"); break;
		}
		$this->Cell(60,20,'Facture du mois de '.utf8_decode($month_str),0,0,'C');
		// Saut de ligne
		$this->Ln(20);
	}

	// Pied de page
	function Footer()
	{
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont('Arial','I',8);
		// Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

// Instanciation de la classe dérivée


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->image('img/logo-facture.png');
$pdf->SetFont('Times','',12);

for($i=0;$i<=count($dataFacturation);$i++)
{
    $pdf->Cell(0,10,'Nom '.$dataFacturation[$i]['nom']." <strong>= 80 euros</strong>",0,1);
}
	$pdf->Cell(0,10, 'Total : '.(count($dataFacturation)*80).' euros',0,1);
	
$pdf->Output();

?>

