<?php
session_start();
$role=$_SESSION['role'];
 include("config_db1.php");
 $cmd=mysql_query("select print_request from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['print_request'] !=1)
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
	$pid= $_REQUEST['pid'];
 date_default_timezone_set('Asia/Kolkata');
 include("config_db2.php");
	$query4 = "select * from patientdetails where patientid='$pid'";
	//echo $query4;
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);
$pdf=new PDF_MemImage();
//$pdf=new PDF("P","in","A4");

$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "REQUISITION DETAILS" , '0', "C");
$pdf->Ln(.3);
$pdf->Cell(1.1, 0.25, "   ",'0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(4.3, 0.25, '', '0', "L");
$pdf->SetFont('Times','B',12);
$pdf->Cell(4, 0.25, "Date : ".date("d-M-Y" ), '0', "R");
$pdf->Ln(.4);
$pdf->Cell(.7, 0.25, "Name   :", '0', "L");

//$pdf->Cell(.32, 0.25, $rs4['patientsalutation'], '0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.92, 0.25, $rs4['patientsalutation'].'. '.$rs4['patientname'], '0', "L");
$pdf->SetFont('Times','B',12);
$pdf->Cell(1.1, 0.25, 'Age / Gender  :', '0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.1, 0.25, $rs4['age'].'  /  '.$rs4['gender'], '0', "L");
$pdf->Ln(.8);
$cmd =mysql_query("select id, cast(datetime as date) as datetime,test,complaint,notes,category,created_by from investigationreport where patientid='$pid' and lower(`complaint`) like lower('%pending%')   order by datetime desc");
if(mysql_num_rows($cmd) != 0){	
	$i=1;
		while($rs = mysql_fetch_array($cmd))
		{
		
		$pdf->Cell(0.2, 0.25, $i++ .')', '0', "L");
		$pdf->Cell(1.1, 0.25, $rs['test'], '0', "L");
		$pdf->Ln(.3);
										
           }
	}
//$pdf->MemImage($image, 5, 10.5,2,.5); 
$pdf->Output();
?>

