<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$role=$_SESSION['role'];
include("config_db1.php");
$img=mysql_query("select * from print_image where id=1");
$row = mysql_fetch_array($img); 
$image = $row['header'];
$foot = $row['footer']; 
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

 $sampleno=$_REQUEST['sampleno'];
 	include("config_db2.php");
	 $cmd_lab_sample_query = mysql_query("select id,patient_id,ip_id,labsampleno,sampletesttitle,sampletestsubtitle,sampleapprover,sampleapproverdesign,datereq,datecollect,datereportgen from lab_testsample_ip WHERE labsampleno='$sampleno' order by id desc limit 1");
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
			$cmd_ip_pat_query = mysql_query("select * from patientdetails WHERE patientid='$pat_id' limit 1");
			$cmd_ip_pat_array = mysql_fetch_array($cmd_ip_pat_query);
			$patientname = $cmd_ip_pat_array['patientsalutation'].' '.$cmd_ip_pat_array['patientname'];
			$age = $cmd_ip_pat_array['age'];
			$gender = $cmd_ip_pat_array['gender'];
			
		}
		
	
	//$report_id = $pid.$ip_pid.date('d-m-YH-i-s');
	$pdf=new PDF_MemImage();
$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "LAB REPORT DETAILS" , '0', "C");
$pdf->Ln(.3);

$pdf->SetFont('arial','',10);
$pdf->Cell(1, 0, "Patient ID", '0', "L");
$pdf->SetFont('arial','B',10);
$pdf->Cell(2, 0, ': '.$pat_id, '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(1.1, 0, 'SAMPLE NO', '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(1.1, 0, ': '.$labsampleno, '0', "L");
$pdf->Ln(.2);
$pdf->Cell(1, 0, "Name", '0', "L");
$pdf->SetFont('arial','B',10);
$pdf->Cell(2, 0, ': '.$patientname, '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(1.1, 0, 'Date Requested', '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(1.1, 0, ': '.$datereq, '0', "L");
$pdf->Ln(.2);
$pdf->SetFont('arial','',10);
$pdf->Cell(1, 0, 'AGE', '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(2, 0, ': '.$age, '0', "L");
$pdf->Cell(1.1, 0, 'Date Collected', '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(1.1, 0, ': '.$datecollect, '0', "L");

$pdf->Ln(.2);
$pdf->Cell(1, 0, "SEX   :", '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(2, 0, ': '.$gender, '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(1.1, 0, 'Reported Date', '0', "L");
$pdf->SetFont('arial','',10);
$pdf->Cell(1.1, 0, ': '.$datereportgen, '0', "L");
$pdf->Ln(.2);
$pdf->MultiCell(8, 0, '------------------------------------------------------------------------------------------------------------------------', '0', 'L');
$pdf->Ln(0);
$pdf->Cell(2, 0.25, 'Investigation', '0', 'C');
$pdf->Cell(2, 0.25, 'Result', '0',  "C");
$pdf->Cell(2, 0.25, 'Reference Range', '0',  "C");
$pdf->Ln(0.3);
$pdf->MultiCell(8, 0, '------------------------------------------------------------------------------------------------------------------------', '0', 'L');
$pdf->SetFont('arial','BU',10);
$pdf->Cell(2, 0.25, ucfirst($sampletesttitle), '0', 'C');
$pdf->Ln(.3);
$pdf->Cell(2, 0.25, ucfirst($sampletestsubtitle), '0', 'C');
$pdf->Ln(.3);
$pdf->SetFont('arial','',10);	
	//$cmd_lab_details_repor_tquery = mysql_query("UPDATE lab_details_ip SET report_id='$report_id' where id IN ($ids)");
	$cmd_lab_details_query = mysql_query("select * from lab_details_ip where labsampleno='$sampleno'");
	
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
			
		$pdf->Cell(2, 0.25, $reports, '0', "C");
		$pdf->Cell(1, 0.25, $lab_test_ref_range, '0', "C");
		$pdf->Ln(.3);
		
		
	}
	}
	
	$pdf->Ln(.3);
	$pdf->Ln(.3);
	$pdf->SetFont('arial','',10);
	$pdf->MultiCell(3, 0, "** End of Report **", '0', 'R');
	$pdf->Ln(.3);
	$pdf->Ln(.3);
	$pdf->SetFont('arial','B',10);
$pdf->MultiCell(5, 0, $sampleapprover, '0', 'R');
$pdf->MultiCell(5, 0.25, $sampleapproverdesign, '0', 'R');
$pdf->Ln(.3);
// $pdf->Output();
$imgg='<div style="text-align:center"><img src="img/cards/paypal.png" /></div>';
$html = '<h3 style="text-align:center">LAB REPORT DETAILS</h3>
<table>
<tbody>
<tr>
<td>Patient ID</td>
<td style="width:300px;">'.$pat_id.'</td>
<td>SAMPLE NO</td>
<td >'.$labsampleno.'</td>

</tr>

<tr>
<td>Name</td>
<td>'.$patientname.'</td>
<td>Date Requested</td>
<td>'.$datereq.'</td>
</tr>
<tr>
<td>AGE</td>
<td>'.$age.'</td>
<td>Date Collected</td>
<td>'.$datecollect.'</td>
</tr>
<tr>
<td>SEX</td>
<td>'.$gender.'</td>
<td>Reported Date</td>
<td>'.$datereportgen.'</td>
</tr>
</tbody>
</table>
<hr/>
<div><div style="width:40%;float:left">Investigation</div><div style="width:40%;float:left">Result</div><div style="width:20%;float:left">Ref Range</div></div>
<hr/>
<b><u>'.$sampletesttitle.'</u></b><br>
<b><u>'.$sampletestsubtitle.'</u></b>';
include("config_db2.php");
$cmd_lab_details_query = mysql_query("select * from lab_details_ip where labsampleno='$sampleno'");
	
	$i=1;
	if(mysql_num_rows($cmd_lab_details_query) != 0){
		$html .= '<table>
<tbody>';
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
			$lab_test_type = $lab_test_type;
		else
			$lab_test_type =$lab_test_type.'-'.$lab_test_name;
			
			
		$pdf->Cell(2, 0.25, $reports, '0', "C");
		$pdf->Cell(1, 0.25, $lab_test_ref_range, '0', "C");
		$pdf->Ln(.3);
		$html .= '<tr>
<td style="width:10px;">'.$lab_test_type.'</td>
<td style="width:500px;padding-left:20px;">'.$reports.'</td>
<td >'.$lab_test_ref_range.'</td></tr>';
		
		
		}
		$html .= '</tbody>
</table>';
	}
	
	$html .= '<hr/>
<div style="padding-left:80%;"><b><u>'.$sampleapprover.'</u></b><br>
<b><u>'.$sampleapproverdesign.'</u></b></div>';

 include("mpdf/mpdf.php");

$mpdf=new mPDF(); 

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
ob_flush();
?>