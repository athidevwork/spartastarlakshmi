<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$role=$_SESSION['role'];

 include("config_db1.php");
 $cmd=mysql_query("select billing from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['billing'] !=1)
{
echo '<script>alert("You could not access this page");</script>';
echo '<script>window.location.href="home.php"</script>';
exit();
}


$img=mysql_query("select * from print_image where id=1");
$row = mysql_fetch_array($img); 
$image = $row['header'];
$foot = $row['footer']; 
//echo "<img src=\"data:image/jpeg;base64,".base64_encode($image)."\" />";

require('fpdf/fpdf.php');

class VariableStream{
	var $varname;
	var $position;
	function stream_open($path, $mode, $options, &$opened_path){
		$url = parse_url($path);
		$this->varname = $url['host'];
		if(!isset($GLOBALS[$this->varname])){
			trigger_error('Global variable '.$this->varname.' does not exist', E_USER_WARNING);
			return false;
		}
		$this->position = 0;
		return true;
	}
	function stream_read($count){
		$ret = substr($GLOBALS[$this->varname], $this->position, $count);
		$this->position += strlen($ret);
		return $ret;
	}
	function stream_eof(){
		return $this->position >= strlen($GLOBALS[$this->varname]);
	}

	function stream_tell(){
		return $this->position;
	}

	function stream_seek($offset, $whence){
		if($whence==SEEK_SET){
			$this->position = $offset;
			return true;
		}
		return false;
	}
	function stream_stat(){
		return array();
	}
}

	class PDF_MemImage extends FPDF {
	//global $image;
		function Header() {
			$this->SetFont('arial','',12);
			$this->SetY(0.25);
			$this->MemImage($GLOBALS['image'], 0.7, .25, 7, 1);
			$this->SetY(1);
		}
		function Footer() {
		$this->MemImage($GLOBALS['foot'], .7, 10.4, 7, 1);
		}
		function PDF_MemImage($orientation='P', $unit='in', $format='A4'){
			$this->FPDF($orientation, $unit, $format);
			stream_wrapper_register('var', 'VariableStream');
		}
		function MemImage($data, $x=null, $y=null, $w=0, $h=0, $link=''){
			//Display the image contained in $data
			$v = 'img'.md5($data);
			$GLOBALS[$v] = $data;
			$a = getimagesize('var://'.$v);
			if(!$a)
				$this->Error('Invalid image data');
			$type = substr(strstr($a['mime'],'/'),1);
			$this->Image('var://'.$v, $x, $y, $w, $h, $type, $link);
			unset($GLOBALS[$v]);
		}	
		function GDImage($im, $x=null, $y=null, $w=0, $h=0, $link=''){
			//Display the GD image associated to $im
			ob_start();
			imagepng($im);
			$data = ob_get_clean();
			$this->MemImage($data, $x, $y, $w, $h, $link);
		}
	}
	function get_lab_det1($lab_det,$lab_det1)
{
		include("config_db1.php");
	$ex=mysql_query("select * from $lab_det1 where id = '$lab_det'");
	$ex1=mysql_fetch_array($ex);
	$sym=$ex1['sym'];
	return $sym;
	}
	include("config_db2.php");
	$ex=mysql_query("select * from billing where bill_no = '$billnumber' order by id asc");
	$ex1=mysql_fetch_array($ex);
	$maxid=$ex1['id'];
	$pid = $ex1['patientid'];
	$date = $ex1['created_at'];
	$fees = $ex1['fees'];
	$pay = $ex1['pay'];
	//$id = $ex1['id'];
	
	$bal=mysql_query("select sum(fees-pay) as bal from billing where id < $maxid and patientid = '$pid'");
	$result=mysql_fetch_array($bal);
	$balance=$result['bal'];
	$bal=$balance + $fees - $pay;
	//echo $bal;
	$query4 = "select * from patientdetails where patientid='$pid'";
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);	
	
	
$pdf=new PDF_MemImage();
//$pdf=new PDF("P","in","A4");

$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "BILL DETAILS" , '0', "C");
$pdf->Ln(.3);
$pdf->Cell(1.1, 0.25, "Bill Number   :",'0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(4.3, 0.25, $billnumber, '0', "L");
$pdf->SetFont('arial','B',12);
$pdf->Cell(4, 0.25, "Date : ".date("d-M-Y" ,strtotime($date)), '0', "R");
$pdf->Ln(.4);


$pdf->Cell(.7, 0.25, "Name   :", '0', "L");

$pdf->Cell(0.55, 0.25, $rs4['patientsalutation'], '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(1.6, 0.25, $rs4['patientname'], '0', "L");
$pdf->SetFont('arial','B',12);
$pdf->Cell(1.9, 0.25, 'Age / Gender  :', '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(1.1, 0.25, $rs4['age'].'  /  '.$rs4['gender'], '0', "L");
$pdf->Ln(.8);

$pdf->SetFont('arial','B',12);
$pdf->Cell(.6, 0.25, '', '', "C");
$pdf->Cell(.5, 0.25, 'S.No', '1', 'C');
$pdf->Cell(4, 0.25, 'DESCRIPTION', '1', 'C');
$pdf->Cell(1, 0.25, 'FEES', '1',  "C");
$pdf->Ln(.3);
$pdf->SetFont('arial','',12);
 $query5 = "select * from patientlabdetails where patient_id='$patientid'";
	$res5 = mysql_query($query5);
	$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'LAB-BILL', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		$lab_det=$rs5['lab_full_det'];
				$lab_det1=$rs5['lab_det'];
				$pdf->SetFont('arial','',12);

	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, $rs5['lab_det']."(".($rs5['lab_full_det']).")", '0', 'C');
$pdf->Cell(1, 0.25, $rs5['fees'], '0', "C");
$pdf->Ln(.3);
	 $fees+=$rs5['fees'];
	}}
 $query5 = "select * from billing_content where bill_no=".$billnumber;
	$res7 = mysql_query($query5);
	$i=1;
		if(mysql_num_rows($res7) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'OTHER-BILL', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	while($rs5 = mysql_fetch_array($res7)){
						$pdf->SetFont('arial','',12);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, $rs5['description'], '0', 'C');
$pdf->Cell(1, 0.25, $rs5['fees'], '0', "C");
$pdf->Ln(.3);
		$fees1+=$rs5['fees'];
		$fees_tot=$fees1+$fees;
}
	$query5 = "select * from ip_patientadv where patientid='$patientid' and  bill_number=".$billnumber;
	$res7 = mysql_query($query5);
	$i=1;
		if(mysql_num_rows($res7) != 0){
				while($rs5 = mysql_fetch_array($res7)){
			$adv_amt=$rs5['advance_amt'];
	$pdf->Ln(.3);
	$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Advance Amount  :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($adv_amt,2), '0', 'R');
	$pdf->Ln(.3);
		}}
	
	$pdf->Ln(.3);
	$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Total Amount  :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($fees,2), '0', 'R');
	$pdf->Ln(.3);
	
	//$pdf->SetFont('arial','',12);
	if($balance !="0" || $balance !="" || $balance !="NULL") {
	$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Old Balance   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, $balance, '0', 'R');
		$pdf->Ln(.3);
		}
	$pdf->SetFont('arial','B',12);	
	$pdf->Cell(5.1, 0.25, 'Pay Amount   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, $pay, '0', 'R');
		$pdf->Ln(.3);
		$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Balance Amount   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, $bal, '0', 'R');
		$pdf->Ln(.3);
}
//$pdf->MemImage($image, 5, 10.5,2,.5); 
$pdf->Output();
ob_flush();
?>


