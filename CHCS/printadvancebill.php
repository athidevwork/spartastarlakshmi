<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$role=$_SESSION['role'];

 include("config_db1.php");
 $cmd=mysql_query("select billing_ip from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['billing'] !=0)
{
echo '<script>alert("You could not access this page");</script>';
echo '<script>window.location.href="home.php"</script>';
exit();
}
$img=mysql_query("select * from print_image where id=1");
$row = mysql_fetch_array($img); 
$image = $row['header'];
$foot = $row['footer']; 
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
	function get_room_name($room)
  {
	  		include("config_db1.php");
    $sql2="select * from  room_no where id='$room'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	  {
	   $room=$rsdata2['room'];
  		}
  return $room;
  }
  function get_pat_ip_id($uid){
  include("config_db2.php");
			 $sql1 = "SELECT * FROM inv_patient WHERE patientid='$uid'";
					$result = mysql_query($sql1);
					$inv_pat_id ='';
					if(mysql_num_rows($result) != 0){
						$rs = mysql_fetch_array($result);
						$inv_pat_id = $rs['inv_pat_id'];
					}
					return $inv_pat_id;
  }

	include("config_db2.php");
	
	$bill_number = $_REQUEST['bill_number'];
	$patientid = $_REQUEST['patient_id'];
	
	$ex=mysql_query("select * from billing where patientid ='$patientid' and bill_no='$bill_number' order by id asc");
	$ex1=mysql_fetch_array($ex);
	$maxid=$ex1['id'];
	$pid = $ex1['patientid'];
	$date = $ex1['created_at'];
	$fees_tot_amt = $ex1['fees'];
	$pay = $ex1['pay'];
	$balance_amt=$ex1['balance_amt'];
	//echo "select sum(pay) as pay,sum(fees) as fees from billing_ip where id < $maxid and patientid = '$pid' and bill_no='$bill_number'";
	 $bal=mysql_query("select sum(pay) as pay,sum(fees) as fees from billing_ip where patientid = '$pid' and bill_no='$bill_number'");
	 if($bal === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
	$result=mysql_fetch_array($bal);
	$pays=$result['pay'];
	$fees1=$result['fees'];
	$balance=$fees1-$pays;
	$bal=$balance + $fees - $pay;
	
	$old_bal_query = mysql_query("select balance_amt from billing_ip where patientid = '$pid' order by id desc limit 1,1 ");
	$old_bal_query_array =  mysql_fetch_array($old_bal_query);
	$old_bal = $old_bal_query_array['balance_amt'];
	
	$query4 = "select * from patientdetails where patientid='$pid'";
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);	
	
	
$pdf=new PDF_MemImage();
$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "ADVANCE BILL DETAILS" , '0', "C");
$pdf->Ln(.3);
$pdf->Cell(1.1, 0.25, "Bill Number",'0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(3, 0.25, ": ".$bill_number, '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(4, 0.25, "Date : ".date("d-M-Y H:i:s" ,strtotime($date)), '0', "R");
$pdf->Ln(.4);


$pdf->Cell(1, 0.25, "Name", '0', "L");

$pdf->Cell(0.6, 0.25, ": ".$rs4['patientsalutation'], '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(2.5, 0.25, $rs4['patientname'], '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(1.2, 0.25, 'Age / Gender  :', '0', "L");
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
 $query5 = "select * from ip_patientadv where patientid='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	$i=1;
			if(mysql_num_rows($res5) != 0){
	while($rs5 = mysql_fetch_array($res5)){
		
		$lab_det=$rs5['lab_full_det'];
				$lab_det1=$rs5['lab_det'];
				$pdf->SetFont('arial','',12);

	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.6, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, $rs5['description'], '0', 'C');
$pdf->Cell(1, 0.25, $rs5['advance_amt'], '0', "C");
$pdf->Ln(.3);
	 //$fees2+=$rs5['fees'];
	 $pay = $rs5['advance_amt'];
	}}
	
	$pdf->SetFont('arial','B',12);	
	$pdf->Cell(5.2, 0.25, ' Amount Paid   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($pay,2), '0', 'R');
		
$pdf->Output();
ob_flush();
?>


