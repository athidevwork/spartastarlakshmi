<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$role=$_SESSION['role'];

 include("config_db1.php");
 $cmd=mysql_query("select billingop from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['billingop'] !=1)
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
	
	    $billnumber = $_REQUEST['billnumber'];
		$patientid = $_REQUEST['patientid'];
		$balance =0;

	//$pid = $_REQUEST['pid'];
	$ex=mysql_query("select * from billing where patientid ='$patientid' and ip_id ='' AND balance='1' order by id asc LIMIT 1");
	$ex1=mysql_fetch_array($ex);
	$maxid=$ex1['id'];
	$pid = $ex1['patientid'];
	$date = $ex1['created_at'];
	$fees_res = $ex1['fees'];
	$pay = $ex1['pay'];
	$balance=$ex1['bal_amt'];
	//$id = $ex1['id'];
	
	//echo $bal;
	 $query4 = "select * from patientdetails where patientid='$patientid'";
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);	
	
	$pdf=new PDF_MemImage();
$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "OP INTERMEDIATE BILL DETAILS" , '0', "C");
$pdf->Ln(.3);
$pdf->Cell(1, 0.25, "Patient ID",'0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(3, 0.25, ": ".$patientid, '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(4, 0.25, "Date : ".date("d-M-Y H:i:s"), '0', "R");
$pdf->Ln(.4);


$pdf->Cell(1, 0.25, "Name", '0', "L");

$pdf->Cell(0.4, 0.25, ": ".$rs4['patientsalutation'], '0', "L");
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
   //$query5 = "select * from patientlabdetails where patient_id='$pid' and bill_number='$billnumber'";
   function get_labtype($lab_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=$inves_query_array['title'];
		
		return $lab_title;
	}
	function get_labtest($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$sym='';
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select sym from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$sym=strtolower($lab_query_array['sym']);
		}
		return $sym;
	}
   
   $query5 = "select id,patient_id,ip_id,labsampleno,sampletesttitle,sampletestsubtitle,sampleapprover,sampleapproverdesign,datereq,datecollect,datereportgen,testtotalamt from lab_testsample_ip where  patient_id='$patientid' AND ip_id ='' AND paid_status !=1 AND bill_queue ='1' AND bill_number=''";
	$res5 = mysql_query($query5);
	$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'LAB-DETAIL', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		$labsampleno=$rs5['labsampleno'];
		$pdf->SetFont('arial','',12);
		$pdf->Cell(.6, 0.25, '', '0', "C");
		$pdf->Cell(.5, 0.25, $i++, '0', 'C');
		$pdf->Cell(4, 0.25, $rs5['labsampleno'], '0', 'C');
		$pdf->Ln(.3);
		include("config_db2.php");
		$labquery5 = "select lab_id,lab_sub_id,fees from lab_details_ip where labsampleno='$labsampleno'";
		$labres5 = mysql_query($labquery5);
		while($labres5_array = mysql_fetch_array($labres5)){	
		$pdf->SetFont('arial','',10);
		$pdf->Cell(.6, 0.25, '', '0', "C");
		$pdf->Cell(.5, 0.25, '', '0', 'C');
		$pdf->Cell(4, 0.25, get_labtype($labres5_array['lab_id']).'-'.get_labtest($labres5_array['lab_id'],$labres5_array['lab_sub_id']), '0', 'C');
		$pdf->SetFont('arial','',12);
		$pdf->Cell(1, 0.25, number_format($labres5_array['fees'],2), '0', "C");
		$pdf->Ln(.3);
		}
				

	

	 $fees+=$rs5['testtotalamt'];
	}}
	include("config_db2.php");
	$query5 = "select * from services_details where patient_id='$patientid' AND paid_status !=1 AND bill_queue ='1' and bill_number =''";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'SERVICE-BILL', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		$lab_det=$rs5['lab_full_det'];
				$lab_det1=$rs5['lab_det'];
				$pdf->SetFont('arial','',12);

	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
$pdf->Cell(4, 0.25, $rs5['service_name'], '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, number_format($rs5['total_count'],2), '0', "C");
$pdf->Ln(.3);
	 $fees+=$rs5['total_count'];
	}}
	include("config_db2.php");
	$query5 = "select * from fees_detailsip where patient_id='$patientid' and paid_status !='1' AND ip_id=''";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'OTHER-BILL-DETAIL', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		        	
				$pdf->SetFont('arial','',12);

	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
$pdf->Cell(4, 0.25, $rs5['description'], '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, $rs5['fees'], '0', "C");
$pdf->Ln(.3);
	 $fees+=$rs5['fees'];
	}}
	

	
		$pdf->Ln(.3);
	$pdf->SetFont('arial','',12);
	$pdf->Cell(5.1, 0.25, 'Current Bill amount (C)  :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($fees,2), '0', 'R');
	$pdf->Ln(.3);

	//$pdf->SetFont('arial','',12);
	if($balance !="0" || $balance !="" || $balance !="NULL") {
		$pdf->SetFont('arial','',12);
		$pdf->Cell(5.1, 0.25, 'Old Balance (O)   :', '0','0', 'R');
		$pdf->SetFont('arial','',12);
		$pdf->Cell(1, 0.25, number_format($balance,2), '0', 'R');
	}
	
	$pdf->Ln(.3);
		$bal1 = $fees + $balance;
		$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Due Amount (D) (C+B)   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($bal1,2), '0', 'R');
		$pdf->Ln(.3);

//$pdf->MemImage($image, 5, 10.5,2,.5); 
$pdf->Output();
?>


