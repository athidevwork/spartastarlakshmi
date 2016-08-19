<?php
session_start();
$role=$_SESSION['role'];
 include("config_db1.php");
 $cmd=mysql_query("select prescription from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['prescription'] !=1)
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
function get_labtype($lab_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
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
	function get_labtest_ref_range($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$normal='';
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select normal from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$normal=strtolower($lab_query_array['normal']);
		}
		return $normal;
	}

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
			$this->SetFont('Times','',12);
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
	
	include("config_db2.php");
 date_default_timezone_set('Asia/Kolkata'); 
	$maxid = $_REQUEST['maxid'];
	$pid = $_REQUEST['pid'];
	if($maxid =="")
	{
	$ex=mysql_query("select a.id,a.datetime,a.prescribed_by,b.symptoms from prescriptiondetail as a inner join complaints as b on b.maxid=a.id where a.patientid='$pid' order by a.slno desc limit 1");
	//echo "select a.id,a.datetime,a.prescribed_by,b.symptoms from prescriptiondetail as a inner join complaints as b on b.maxid=a.id where a.patientid='$pid' order by a.slno desc limit 1";
	$ex1=mysql_fetch_array($ex);
	$maxid=$ex1['id'];
	$name=$ex1['prescribed_by'];
	}else
	{
	//echo "select a.id,a.datetime,a.prescribed_by from prescriptiondetail as a where a.patientid='$pid' and a.id='$maxid' order by a.slno";	
	$ex=mysql_query("select a.id,a.datetime,a.prescribed_by from prescriptiondetail as a where a.patientid='$pid' and a.id='$maxid' order by a.slno desc limit 1");
	$ex1=mysql_fetch_array($ex);
	$name=$ex1['prescribed_by'];
	}
	
	$query4 = "select * from patientdetails where patientid='$pid'";
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);	
	
	mysql_close($db2);
		include("config_db1.php");
	$sd=mysql_query("select name from user_login where username='$name'");
	$pr=mysql_fetch_array($sd);
	$prname=$pr['name'];
	mysql_close($db1);
	
		include("config_db2.php");
	
	
	$pdf=new PDF_MemImage();
//$pdf=new PDF("P","in","A4");

$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "PRESCRIPTION " , '0', "C");
$pdf->Ln(.3);


$pdf->Cell(1, 0.25, "Patient ID   :", '0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.92, 0.25, $pid, '0', "L");
$pdf->SetFont('Times','B',12);
$pdf->Cell(1.1, 0.25, 'Date  :', '0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.1, 0.25, $ex1['datetime'], '0', "L");
$pdf->Ln(.3);
//$pdf->Cell(.32, 0.25, $rs4['patientsalutation'], '1', "L");
$pdf->Cell(1, 0.25, "Name   :", '0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.92, 0.25, $rs4['patientsalutation'].'. '.$rs4['patientname'], '0', "L");
$pdf->SetFont('Times','B',12);
$pdf->Cell(1.1, 0.25, 'Age / Gender  :', '0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.1, 0.25, $rs4['age'].'  /  '.$rs4['gender'], '0', "L");
$pdf->Ln(.3);

$pdf->Ln(.3);
$query5 = "select * from prescriptiondetail where id=".$maxid;
	$res5 = mysql_query($query5);
	
	$pdf->SetFont('Times','B',12);
if(mysql_num_rows($res5) != 0){

$pdf->Cell(3, 0.25, 'Drug Name', '1', 'C');
$pdf->Cell(0.8, 0.25, 'Dosage', '1', "C");
$pdf->Cell(1, 0.25, 'Spcification', '1', "C");
$pdf->Cell(.9, 0.25, 'Frequency', '1', "C");
$pdf->Cell(.7, 0.25, 'Route', '1', "C");
$pdf->Cell(.7, 0.25, 'Duration', '1', "C");
$pdf->Ln(.25);
$pdf->SetFont('Times','',12);
while($rs5 = mysql_fetch_array($res5)){
	$labsample_ids = $rs5['labsampleno'];
$pdf->Cell(3, 0.25, $rs5['tablet'], '1', 'C');
$pdf->Cell(0.8, 0.25, $rs5['dosage'], '1', "C");
$pdf->Cell(1, 0.25, $rs5['specification'], '1', "C");
$pdf->Cell(.9, 0.25, $rs5['frequency'], '1', "C");
$pdf->Cell(.7, 0.25, $rs5['route'], '1', "C");
$pdf->Cell(.7, 0.25, $rs5['duration'], '1', "C");
$pdf->Ln(.25);

	}
	$pdf->Ln(.3);
}

if(!empty($labsample_ids) && $labsample_ids !='undefined'){
include("config_db2.php");

	 $cmd_lab_sample_query = mysql_query("select id,patient_id,ip_id,labsampleno,sampletesttitle,sampletestsubtitle,sampleapprover,sampleapproverdesign,datereq,datecollect,datereportgen,createby from lab_testsample_ip WHERE id IN ($labsample_ids) order by id desc");
	
if(mysql_num_rows($cmd_lab_sample_query) > 0){
 $pdf->SetFont('arial','BU',10);
$pdf->Cell(4, 0.25, 'Investigation Requested', '0', 'C');
$pdf->Ln(.3);

	 while($cmd_lab_sample_array = mysql_fetch_array($cmd_lab_sample_query)){
			$pat_id = $cmd_lab_sample_array['patient_id'];
			$ip_id = $cmd_lab_sample_array['ip_id'];
			$labsampleno = $cmd_lab_sample_array['labsampleno'];
			$sampletesttitle = $cmd_lab_sample_array['sampletesttitle'];
			$sampletestsubtitle = $cmd_lab_sample_array['sampletestsubtitle'];
			$sampleapprover = $cmd_lab_sample_array['sampleapprover'];
			$sampleapproverdesign = $cmd_lab_sample_array['sampleapproverdesign'];
			$datereq = $cmd_lab_sample_array['datereq'];
			$datecollect = $cmd_lab_sample_array['datecollect'];
			$datereportgen = $cmd_lab_sample_array['datereportgen'];
			$createby = ucwords($cmd_lab_sample_array['createby']);
			include("config_db2.php");
			$cmd_ip_pat_query = mysql_query("select * from patientdetails WHERE patientid='$pid' limit 1");
			$cmd_ip_pat_array = mysql_fetch_array($cmd_ip_pat_query);
			$patientname = $cmd_ip_pat_array['patientsalutation'].' '.$cmd_ip_pat_array['patientname'];
			$age = $cmd_ip_pat_array['age'];
			$gender = $cmd_ip_pat_array['gender'];
			
		
	

$pdf->SetFont('arial','BU',10);
if(!empty($sampletesttitle)){
$pdf->Cell(2, 0.25, ucfirst($sampletesttitle), '0', 'C');
$pdf->Ln(.3);
}
if(!empty($sampletestsubtitle)){
$pdf->Cell(2, 0.25, ucfirst($sampletestsubtitle), '0', 'C');
$pdf->Ln(.3);
}
$pdf->SetFont('arial','',10);	
	//$cmd_lab_details_repor_tquery = mysql_query("UPDATE lab_details_ip SET report_id='$report_id' where id IN ($ids)");
	$cmd_lab_details_query = mysql_query("select * from lab_details_ip where labsampleno='$labsampleno'");
	
	$i=1;
	if(mysql_num_rows($cmd_lab_details_query) != 0){
	while($cmd_lab_details_array = mysql_fetch_array($cmd_lab_details_query)){
		
		$id=$cmd_lab_details_array['id'];
		$bill_number=$cmd_lab_details_array['bill_number'];
		$lab_id = $cmd_lab_details_array['lab_id'];
		$lab_sub_id = $cmd_lab_details_array['lab_sub_id'];
		$lab_test_type = ucfirst(get_labtype($lab_id));
		$lab_test_name = get_labtest($lab_id,$lab_sub_id);
		$lab_test_ref_range = get_labtest_ref_range($lab_id,$lab_sub_id);
		$reports = $cmd_lab_details_array['reports'];
		$notes = $cmd_lab_details_array['notes'];
					
		if(empty($lab_test_name) && $lab_test_name =='')
			$pdf->Cell(2, 0.25,$lab_test_type, '0', 'C');
		else
			$pdf->Cell(2, 0.25,$lab_test_type.'-'.$lab_test_name, '0', 'C');
			
		//$pdf->Cell(2, 0.25, $reports, '0', "C");
		//$pdf->Cell(1, 0.25, $lab_test_ref_range, '0', "C");
		
		$pdf->Ln(.3);
		$pdf->MultiCell(8, 0, '------------------------------------------------------------------------------------------------------------------------', '0', 'L');
		
	}
	}
	 }
	}
}
$pdf->Ln(.3);
$pdf->SetFont('Times','B',12);
$pdf->MultiCell(6.3, 0.25, "Prescribed By, " , '0', "R");

$pdf->SetFont('Times','',12);
$pdf->MultiCell(6.1, 0.25, "Dr.".$prname."", '0', "R");
$pdf->Output();
?>

