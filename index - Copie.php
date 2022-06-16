<?php
$f = "visit.php";
if(!file_exists($f)){
	touch($f);
	$handle =  fopen($f, "w" ) ;
	fwrite($handle,0) ;
	fclose ($handle);
}

include('libs/phpqrcode/qrlib.php');

function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}

if(isset($_POST['submit']) ) {
	$tempDir = 'temp/';
	$vendor = $_POST['vendor'];
	$description =  $_POST['description'];
	$price = $_POST['price'];
	$discount = 0;
	$qty = 1;
	$filename = $_POST['vendor'];
	$codeContents = $vendor."\t".$description."\t".$price."\t".$qty."\t".$discount."\t\t";
	define('IMAGE_WIDTH',300);
	define('IMAGE_HEIGHT',300);
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 3,6);


require('fpdf.php');

class PDF extends FPDF
{
// En-tête
function Header()
{
	$filename = $_POST['vendor'];
	$tempDir = 'temp/';
	$vendor = $_POST['vendor'];
	$description =  $_POST['description'];
	$price = $_POST['price'];
	$discount = 0;
	$qty = 1;
    // Logo
    $this->Image($tempDir.''.$filename.'.png',0,0,30);
    // Police Arial gras 15
    $this->SetFont('Arial','B',8);
    // Décalage à droite
    $this->Cell(23);
    // Titre
    $this->Cell(0,0,'Shawn\'s Flea Market',0,0,'C');	
	$this->Ln(5);
	$this->Cell(5);
    // Titre
    $this->Cell(0,0,'Vendor: ',0,0,'C');
	$this->Cell(3,0,$vendor,0,0,'C');
			// Saut de lign2

    $this->Ln(3);
	$this->Cell(5);
    $this->Cell(0,0,'Price:',0,0,'C');
	$this->SetFont('Arial','B',12);
	$this->Cell(0,0,'$ '.$price,0,0,'C');
	// Saut de lign2
	    $this->SetFont('Arial','B',8);
	$this->Ln(3);
	$this->Cell(25);
	$this->Cell(0,0,'Description:',0,0,'C');
	$this->Ln(2);
	$this->Cell(16);
	$this->multicell(35,3,$description,0,'C',0);


}


}

// Instanciation de la classe dérivée
$pdf = new PDF('L','mm',array(60,30));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Output();





}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
	<title>QR Code Generator</title>
	<link rel="icon" href="" type="">
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="libs/style.css">
	<script src="libs/navbarclock.js"></script>
	</head>
	<body onload="startTime()">
		<div class="myoutput">
			<div class="input-field">
				<h3>QRCode Generator</h3>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
					<div class="form-group">
						<label>Vendor</label>
						<input type="text" class="form-control" name="vendor" style="width:20em;" placeholder="Enter Vendor" value="<?php echo @$vendor; ?>" required />
					</div>
					<div class="form-group">
						<label>Decription</label>
						<input type="text" class="form-control" maxlength="45" name="description" style="width:20em;" placeholder="Enter Description" value="<?php echo @$description; ?>" />
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="text" class="form-control" name="price" style="width:20em;" value="<?php echo @$price; ?>" required pattern="[0-9 .]+" placeholder="Enter your Price"></textarea>
					</div>
					
					<div class="form-group">
						<input type="submit" value="Generate" name="submit" class="btn btn-primary submitBtn" style="width:20em; margin:0;" />
					</div>
				</form>
			</div>
			<?php
			if(!isset($filename)){
				$filename = "author";
			}
			?>


		</div>
	</body>
</html>
