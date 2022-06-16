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
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 2,18);


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
    $this->Image($tempDir.''.$filename.'.png',-6,1,0);
    // Police Arial gras 15
    $this->SetFont('Arial','B',8);
    // Décalage à droite
	$this->Ln(2);
    $this->Cell(28);
    // Titre
    $this->Cell(-35,-15,'SHAWN\'S FLEA MARKET',0,0,'C');	
	$this->Ln(5);
	$this->Cell(7);
    // Titre
    //$this->Cell(0,0,'Vendor: ',0,0,'C');
	$this->Cell(-12,-17,$vendor,0,0,'C');
			// Saut de lign2

    //$this->Ln(3);
	//§this->Cell(5);
	$this->SetFont('Arial','B',20);
	$this->Ln(6);
	$this->Cell(45);
    $this->Cell(-25,-26,'$ '.$price,0,0,'C');
	$this->SetFont('Arial','B',12);
	//$this->Cell(0,0,'$ '.$price,0,0,'C');
	// Saut de lign2
	$this->SetFont('Arial','B',12);
	//$this->Ln(3);
	//$this->Cell(25);
	//$this->Cell(0,0,'Description:',0,0,'C');
	$this->Ln(-6);
	$this->Cell(10);
	$this->multicell(38,5,$description,0,'C',0);


}


}

// Instanciation de la classe dérivée
$pdf = new PDF('L','mm',array(60,30));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

		$pdf->Output();







}if(isset($_POST['download']) ) {
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
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 2,18);


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
    $this->Image($tempDir.''.$filename.'.png',-6,1,0);
    // Police Arial gras 15
    $this->SetFont('Arial','B',8);
    // Décalage à droite
	$this->Ln(2);
    $this->Cell(28);
    // Titre
    $this->Cell(-35,-15,'SHAWN\'S FLEA MARKET',0,0,'C');	
	$this->Ln(5);
	$this->Cell(7);
    // Titre
    //$this->Cell(0,0,'Vendor: ',0,0,'C');
	$this->Cell(-12,-17,$vendor,0,0,'C');
			// Saut de lign2

    //$this->Ln(3);
	//§this->Cell(5);
	$this->SetFont('Arial','B',20);
	$this->Ln(6);
	$this->Cell(45);
    $this->Cell(-25,-26,'$ '.$price,0,0,'C');
	$this->SetFont('Arial','B',12);
	//$this->Cell(0,0,'$ '.$price,0,0,'C');
	// Saut de lign2
	$this->SetFont('Arial','B',12);
	//$this->Ln(3);
	//$this->Cell(25);
	//$this->Cell(0,0,'Description:',0,0,'C');
	$this->Ln(-6);
	$this->Cell(10);
	$this->multicell(38,5,$description,0,'C',0);


}


}

// Instanciation de la classe dérivée
$pdf = new PDF('L','mm',array(60,30));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

		$pdf->Output('D');







}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
	<title>Barcode Maker</title>
	<link rel="icon" href="" type="">
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="libs/style.css">
	<script src="libs/navbarclock.js"></script>
	<style>
	h1{
	    text-align: center;
	    margin-bottom:40px;
	}
	    .input-field {
                width: 50%;
            }
    label{
        font-size:20px;
    }  
    .form-control {
        padding: 30px 12px;
        font-size:20px;
    }
    .btn {
    padding: 10px 31px;
    font-size: 18px;
    }
    .btn-primary, .btn-primary:visited {
    background-color: #000000;
    color: #ffffff;
    border-color: #000000;
    transition: 0.4s;
}
.form-control:focus {
    border-color: #2425258a;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(49 53 55 / 60%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(46 47 49 / 51%);
}

@media (min-width: 768px) and (max-width: 1024px) {
  
   	h1{
	    text-align: center;
	    margin-bottom:60px;
	    font-size:95px;
	}
	    .input-field {
                width: 90%;
            }
    label{
        font-size:55px;
    }  
    .form-control {
        padding: 60px 0px 60px 30px;
        font-size:50px;
    }
    .btn {
    padding: 25px 70px;
    font-size: 50px;
    }
    .groupBtn{
        margin-top:40px;
    }
    .form-group {
    margin-bottom: 50px;
    }
  
}
@media (min-width: 481px) and (max-width: 767px) {
  
  h1{
	    text-align: center;
	    margin-bottom:60px;
	    font-size:95px;
	}
	    .input-field {
                width: 90%;
            }
    label{
        font-size:55px;
    }  
    .form-control {
        padding: 60px 0px 60px 30px;
        font-size:50px;
    }
    .btn {
    padding: 25px 70px;
    font-size: 50px;
    }
    .groupBtn{
        margin-top:40px;
    }
    .form-group {
    margin-bottom: 50px;
    }
  
}

	</style>
	
	
	</head>
	<body onload="startTime()">
		<div class="myoutput">
			<div class="input-field">
				<h1>Barcode Maker</h1>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
					<div class="form-group">
						<label>Vendor</label>
						<input type="text" class="form-control" name="vendor"  placeholder="Enter Vendor" value="<?php echo @$vendor; ?>" required />
					</div>
					<div class="form-group">
						<label>Decription</label>
						<input type="text" class="form-control" maxlength="45" name="description" placeholder="Enter Description" value="<?php echo @$description; ?>" />
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="text" class="form-control" name="price" value="<?php echo @$price; ?>" required pattern="[0-9 .]+" placeholder="Enter Price"></textarea>
					</div>
					
					<div class="form-group groupBtn">
						<input type="submit" value="Generate" name="submit" class="btn btn-primary submitBtn" margin:0;" />
						
						<input type="submit" value="Download" name="download" class="btn btn-primary submitBtn" margin:0;" />
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
