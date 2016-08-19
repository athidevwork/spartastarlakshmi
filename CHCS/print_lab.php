<?php
session_start();
$role=$_SESSION['role'];
 include("config_db1.php");
 $cmd=mysql_query("select print_lab from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['print_lab'] !=1)
{
echo '<script>alert("You can not access this page");</script>';
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
	
	include("config_db2.php");
 	date_default_timezone_set('Asia/Kolkata'); 
	$date = $_REQUEST['day'];
	$pid = $_REQUEST['pid'];
	
	
	include("config_db2.php");
	$query4 = "select * from patientdetails where patientid='$pid'";
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);	
	mysql_close($db2);
	
	
	
	
		include("config_db2.php");
	
	
	$pdf=new PDF_MemImage();
//$pdf=new PDF("P","in","A4");

$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "LAB REPORT " , '0', "C");
$pdf->Ln(.3);

$pdf->Cell(1.1, 0.25, "",'0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(4.3, 0.25, $billnumber, '0', "L");
$pdf->SetFont('Times','B',12);
$pdf->Cell(4, 0.25, "Date : ".date("d-M-Y" ,strtotime($date)), '0', "R");
$pdf->Ln(.4);
$pdf->Cell(.7, 0.25, "Name   :", '0', "L");
//$pdf->Cell(.32, 0.25, $rs4['patientsalutation'], '1', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.92, 0.25, $rs4['patientsalutation'].'. '.$rs4['patientname'], '0', "L");
$pdf->SetFont('Times','B',12);
$pdf->Cell(1.1, 0.25, 'Age / Gender  :', '0', "L");
$pdf->SetFont('Times','',12);
$pdf->Cell(1.1, 0.25, $rs4['age'].'  /  '.$rs4['gender'], '0', "L");
$pdf->Ln(.7);

//echo $ex1['symptoms'];
include("config_db2.php");
$catcheck="";
//$catcheck1="";
if($date !="") {
		$ex=mysql_query("SELECT * 
		FROM  `investigationreport` WHERE sendlab=1 and bill_no !='' and cast(datetime as date)='$date' and patientid='$pid' order by category,test asc");
	while($ex1=mysql_fetch_array($ex)) {
	$name=$ex1['lab_atten_by'];
	$sub=$ex1['sub'];
	$invesid=$ex1['id'];
	//$sid=
	$tblcat=$ex1['category'];
	$idforsym=$ex1['test'];
	
	mysql_close($db2);
		include("config_db1.php");
		
		
	$cmd =mysql_query("select title from investigation where id='$tblcat'");
	$rs1=mysql_fetch_array($cmd);
	$tbl=$rs1['title'];
	
	if($tblcat !=$catcheck) {
	$pdf->SetFont('Times','B',12);
	$pdf->MultiCell(6.3, 0.25, $tbl." Test" , '0', "C");
	$pdf->Ln(.3);
	}
	$catcheck=$tblcat;
	mysql_close($db1);
		include("config_db2.php");
	if($sub==1) {
	
	$cmd1 = "select a.category as cat,a.sym_id,a.sub_cat,a.result,a.id,a.inves_id from investigationsub as a  where a.inves_id='$invesid' order by a.sym_id asc";
	
	$res1=mysql_query($cmd1);
	mysql_close($db2);
		include("config_db1.php");

	$dum="";
  $dum1="";
  $i=1;
	while($rs1 = mysql_fetch_array($res1)){
	
		$cat=$rs1['cat'];
		$result=$rs1['result'];
		$sym_id=$rs1['sym_id'];
		$subcatid=$rs1['sub_cat'];
		$subid=$rs1['id'];
	
	
	$sql1=mysql_query("select sym,normal from $tbl where id='$sym_id'");
	$getsym=mysql_fetch_array($sql1);
	
	if($cat==3) {
	$dum=$sym_id;
	//echo $dum.'<br />';
	//echo $dum1.'<br />';
	if($dum != $dum1) {
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(.2, 0.25, '', '0', "R");
	$pdf->Cell(4.1, 0.25, $getsym['sym'], '0', "R");
	$pdf->Ln(.3);
	
	}
	$cmd2=mysql_query("select sym,testid,normal from sub_test where category='$tblcat' and id='$subcatid'");
	$fd=mysql_fetch_array($cmd2);
	
	
	$pdf->SetFont('Times','',12);
	$pdf->Cell(1.1, 0.25, '', '0', "L");
	$pdf->Cell(2.1, 0.25, $fd['sym'], '0', "L");
	$pdf->Cell(.1, 0.25, ':', '0', "L");
	$pdf->Cell(1.7, 0.25, $result, '0', "L");
	$pdf->Cell(1.1, 0.25,$fd['normal'], '0', "L");
	$pdf->Ln(.3);	
					
					
	$dum1=$dum;	
			}
			else {
				
			$pdf->SetFont('Times','B',12);	
		$pdf->Cell(.2, 0.25, '', '0', "R");
		
	$pdf->Cell(2.1, 0.25, $getsym['sym'], '0', "L");
	$pdf->SetFont('Times','',12);
	$pdf->Cell(.9, 0.25, '', '0', "L");
	$pdf->Cell(.1, 0.25, ':', '0', "L");
	$pdf->Cell(1.7, 0.25, $result, '0', "L");
	$pdf->Cell(1.1, 0.25,$getsym['normal'], '0', "L");
	$pdf->Ln(.3);
		/*	echo "<tr>		
					<td>".$i++."</td>
					<td>".$getsym['sym']."</td>
					<td contenteditable='true'></td>
				
					<td>".$getsym['normal']."</td>
					<td style ='display:none;'>".$subid."</td>";*/
					
					
		}
		//$name=$rs1['patientname'];
	}
	/*echo " </tbody>
                </table>
				</center>";*/

		}else {
		//mysql_close($db2);
		include("config_db1.php");
		$sql1=mysql_query("select sym,normal from $tbl where id='$idforsym'");
		//echo "select sym,normal from $tbl where id='$idforsym'";
		$getsym=mysql_fetch_array($sql1);
		$pdf->SetFont('Times','B',12);	
		$pdf->Cell(.2, 0.25, '', '0', "R");
		
	$pdf->Cell(2.1, 0.25, $getsym['sym'], '0', "L");
	$pdf->SetFont('Times','',12);
	$pdf->Cell(.9, 0.25, '', '0', "L");
	$pdf->Cell(.1, 0.25, ':', '0', "L");
	$pdf->Cell(1.7, 0.25, $ex1['complaint'], '0', "L");
	$pdf->Cell(1.1, 0.25,$getsym['normal'], '0', "L");
	$pdf->Ln(.3);
		
		
		
		}
		 
	
	}
 }

 include("config_db1.php");
	$sd=mysql_query("select name from user_login where username='$name'");
	//echo "select name from user_login where username='$name'";
	$pr=mysql_fetch_array($sd);
	$prname=$pr['name'];
	mysql_close($db1);
	
 $pdf->SetFont('Times','B',12);
$pdf->MultiCell(6.3, 0.25, " Lab Technician , " , '0', "R");

$pdf->SetFont('Times','',12);
$pdf->MultiCell(6.1, 0.25, "Dr.".$prname."", '0', "R");
$pdf->Output();
?>

