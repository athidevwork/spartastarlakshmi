<?php
	$billno = $_REQUEST['billno'];

	require('fpdf/fpdf.php');
	//include("config.php");
	
	class PDF extends FPDF {
	var $javascript; 
		var $n_js; 
	
	function IncludeJS($script) { 
			$this->javascript=$script; 
		} 
		function _putjavascript() { 
			$this->_newobj(); 
			$this->n_js=$this->n; 
			$this->_out('<<'); 
			$this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]'); 
			$this->_out('>>'); 
			$this->_out('endobj'); 
			$this->_newobj(); 
			$this->_out('<<'); 
			$this->_out('/S /JavaScript'); 
			$this->_out('/JS '.$this->_textstring($this->javascript)); 
			$this->_out('>>'); 
			$this->_out('endobj'); 
		} 
	function _putresources() { 
			parent::_putresources(); 
			if (!empty($this->javascript)) { 
				$this->_putjavascript(); 
			} 
		} 
	
		function _putcatalog() { 
			parent::_putcatalog(); 
			if (!empty($this->javascript)) { 
				$this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>'); 
			} 
		} 
		function Header() {
		    $this->SetFont('Times','',16);
		    $this->SetY(0.25);
	//		$this->Image("images/hycare.jpg", 2.25, .25, 4, .75);
//		    $this->SetY(1);
			$this->Image("images/NEWIMG.jpg", 2.90, 4, 4, 2);
		}
		function Footer() {
	//	    $this->Image("images/address.jpg", 2.30, 10.8, 4, .75);
		}
	}
$pdf=new PDF("P","in",array(9.8,12));
$pdf->AliasNbpages();
$pdf->SetMargins(0.5,0,1);
$pdf->AddPage();
	$pdf->SetAutoPageBreak(true);
	$pdf->SetY(0.25);
$pdf->SetFont('Times','B',20);

$pdf->MultiCell(8.6, 0.25, "MURUGAN PHARMACY" , '0', "C");
$pdf->SetFont('Times','B',16);
$pdf->MultiCell(8.6, 0.25, "(Unit of Murugan Hospitals)" , '0', "C");
$pdf->SetFont('Times','I',10);
$pdf->MultiCell(8.6, 0.25, "No:264/125,Kilpauk Garden Road" , '0', "C");
$pdf->MultiCell(8.6, 0.25, "Kilpauk,Chennai-600 010" , '0', "C");
$pdf->MultiCell(8.6, 0.25, "Phone:+91 44 2644 8989/26440519" , '0', "C");
$pdf->MultiCell(8.6, 0.25, "E-mail : muruganhospitals@gmail.com" , '0', "C");
$pdf->SetFont('Times','B',18);
$pdf->MultiCell(8.6, 0.25, "DL No  : 2501/MZII/20" , '0', "C");
$pdf->MultiCell(8.6, 0.26, "                2501/MZII/21" , '0', "C");

$pdf->Ln(.35);
include("config.php");
$cmd = mysql_query("SELECT datentime, patientname, drname, billno, paidamt FROM tbl_billing WHERE billno = $billno");
$rs = mysql_fetch_array($cmd);

$amount = $rs['paidamt'];
$pdf->SetFont('Times','',16);
$pdf->Cell(6, 0.25, "Patient Name   : ".$rs['patientname'], '0','0', "L");
$pdf->Cell(1.8, 0.25, "Date  : ".$rs['datentime'], '0','0', "L");
$pdf->Ln();
$pdf->Cell(6, 0.25, "Doctor's Name : ".$rs['drname'], '0','0', "L");
$pdf->Cell(1.8, 0.25, "Bill # : ".$rs['billno'], '0','0', "L");

$pdf->Ln(.35);

$i = 1;
$pdf->SetFont('Times','B',16);
$pdf->Cell(0.5, 0.25, "S.No", '1','0', "C");
$pdf->Cell(4, 0.25, "Particulars", '1','0', "C");
$pdf->Cell(0.6, 0.25, "Qty", '1','0', "C");
$pdf->Cell(1.2, 0.25, "Batch #", '1','0', "C");
$pdf->Cell(1, 0.25, "Expiry", '1','0', "C");

$pdf->Cell(1, 0.25, "Amount", '1','0', "C");
$pdf->Ln();
$pdf->SetFont('Times','',16);
$sql = mysql_query("SELECT * FROM tbl_billing_items WHERE billno = $billno AND status = 1");
while($r = mysql_fetch_array($sql)){

	$code = $r['code'];
	$q =  mysql_query("SELECT * FROM tbl_productlist WHERE id = $code");
	$r1 = mysql_fetch_array($q);
//	$desc = substr($r1['stocktype'],0,3) . '. ' .$r1['productname'];
	$desc = $r1['productname'];
		
	$expirydate = implode("/",array_reverse(explode("-",$r['expirydate'])));
	$expirydate = substr($expirydate,3);
		
	$pdf->Cell(0.5, 0.25, $i++, 'L','0', "C");
	$pdf->Cell(4, 0.25, $desc, 'L','0', "L");
	$pdf->Cell(0.6, 0.25, $r['qty'], 'L','0', "C");
	$pdf->Cell(1.2, 0.25, $r['batchno'], 'L','0', "C");
	$pdf->Cell(1, 0.25, $expirydate, 'L','0', "C");
	
	$pdf->Cell(1, 0.25, $r['amount'], 'LR','0', "C");
	
	$pdf->Ln();
}
$b =  mysql_query("SELECT * FROM tbl_billing WHERE billno =".$rs['billno']);
	$r2 = mysql_fetch_array($b);
	$pdf->Cell(7.3, 0.25, 'Total Amount  ', '1','0', "R");
$pdf->Cell(1, 0.25, $r2['netamt'], '1','0', "C");
$pdf->Ln();
if($discount!=0){
	$pdf->Cell(7.3, 0.25, 'Discount Amount  ', '1','0', "R");
$pdf->Cell(1, 0.25, $r2['discount'], '1','0', "C");
$pdf->Ln();

$pdf->Cell(7.3, 0.25, 'Total Amount  ', '1','0', "R");
$pdf->Cell(1, 0.25, $r2['totalamt'], '1','0', "C");
$pdf->Ln(.35);
}
$pdf->MultiCell(7.8, 0.25, "Thank You. Get Well Soon." , '0', "C");
$pdf->MultiCell(7.8, 0.25, "" , '0', "C");
$pdf->IncludeJS("print('true');");
	$pdf->Output();
?>
