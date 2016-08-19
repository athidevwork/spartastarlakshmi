<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$role=$_SESSION['role'];

 include("config_db1.php");
 $cmd=mysql_query("select billingip from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['billingip'] !=1)
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
	function get_dept_name1($id)
{include("config_db1.php");
					$cmd_ser1 = "select * from department_creation where id='$id'";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1))
					{
								$name=$rs_ser1['department_names'];
                     }
                                return $name;

}
function get_consult_name1($id)
{include("config_db1.php");
					$cmd_ser2 = "select * from doctor_creation where id='$id'";
					$res_ser2 = mysql_query($cmd_ser2);
					while($rs_ser2 = mysql_fetch_array($res_ser2)){
								$name=$rs_ser2['doctor_name'];
                                }
                                return $name;
}
function get_visit_name1($id)
{include("config_db1.php");
					$cmd_ser3 = "select * from visit_creation where id='$id'";
					$res_ser3 = mysql_query($cmd_ser3);
					while($rs_ser3 = mysql_fetch_array($res_ser3)){
								$name=$rs_ser3['visit_name'];
                                $vtypes=$rs_ser3['vtypes'];
                                }
                                return $name."/".$vtypes;

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
			 $sql1 = "SELECT * FROM inv_patient WHERE patientid='$uid' order by id DESC LIMIT 1";
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
	$ex=mysql_query("select * from billing where patientid ='$patientid' and ip_id !='' AND balance='1' order by id asc LIMIT 1");
	$ex1=mysql_fetch_array($ex);
	$maxid=$ex1['id'];
	$pid = $ex1['patientid'];
	$date = $ex1['created_at'];
	$fees_tot_amt = $ex1['fees'];
	$pay = $ex1['pay'];
	$balance_amt=$ex1['bal_amt'];
	$old_bal = $ex1['old_balance'];
	$bal=$ex1['bal_amt'];
	//$advance_amount=$ex1['advance_amount'];
	$advance_balance=$ex1['advance_balance'];
	$return_amt=$ex1['return_amt'];
	
	
	$query4 = "select * from patientdetails where patientid='$patientid'";
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);	
	
	
$pdf=new PDF_MemImage();
$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "IP INTERMEDIATE BILL DETAILS" , '0', "C");
$pdf->Ln(.3);
$pdf->SetFont('arial','',12);
$pdf->Cell(1.1, 0.25, "Bill No",'0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(3, 0.25, ": Not the final bill", '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(4, 0.25, "Date : ".date("d-M-Y " ,time()), '0', "R");
$pdf->Ln(.3);


$pdf->Cell(1.1, 0.25, "Name", '0', "L");

$pdf->Cell(0.6, 0.25, ": ".$rs4['patientsalutation'], '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(2.4, 0.25, $rs4['patientname'], '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(1.2, 0.25, 'Age / Gender  :', '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(1.1, 0.25, $rs4['age'].'  /  '.$rs4['gender'], '0', "L");
$pdf->Ln(.3);

$pdf->Cell(1.1, 0.25, "UHID ",'0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(3, 0.25, ": ".$patientid, '0', "L");
//$pdf->SetFont('arial','',12);
//$pdf->Cell(4, 0.25, "IP No : ".$ip_id, '0', "R");
$pdf->Ln(.4);

$pdf->SetFont('arial','B',12);
$pdf->Cell(.6, 0.25, '', '', "C");
$pdf->Cell(.5, 0.25, 'S.No', '1', 'C');
$pdf->Cell(4, 0.25, 'DESCRIPTION', '1', 'C');
$pdf->Cell(1, 0.25, 'FEES', '1',  "C");
$pdf->Ln(.3);
$pdf->SetFont('arial','',12);
/*ROOM CHARGES*/

	$pat_ip_id = get_pat_ip_id($patientid);
	
	
	$query5 = "select * from room_bill_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	
	 
	$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'Room Rent', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				$pdf->SetFont('arial','',12);

	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
$pdf->Cell(4, 0.25, 'Room No('.get_room_name($rs5['room_id']).')', '0', 'C');
$pdf->Ln(.3);
$pdf->SetFont('arial','',8);
$pdf->Cell(1.1, 0.25, '', '0', "C");

if ($rs5['to_time']==''){
  date_default_timezone_set('Asia/Calcutta');
 $rs5['to_time']= date('Y-m-d');
 $r1= date('Y-m-d H:i:s');
$qrl=strtotime($r1);

$qr2=strtotime($rs5['from_time']);
$no_of_day = floor(abs($qrl - $qr2) / 86400);

$a = date('A', $qr2);
$b= date('A', strtotime($r1));




//$NoOfdays = strtotime($r1)->diff($rs5['from_time'])->format("%a"); 
 
if ($rs5['fees_amount']==0){


$roomId=get_room_name($rs5['room_id']);
$costQuery = "select rate from room_no where room='".$roomId."'";
	$costval = mysql_query($costQuery);
	while($cost = mysql_fetch_array($costval)){
	 $fees=$cost['rate'];
	}
	if($a=='AM' && $b=='PM')

{
	  $rs5['fees_amount']=(($no_of_day+1))*$fees;
	
	}
	elseif($a=='PM' && $b=='AM')

{
	if ($no_of_day==0){
         
		$no_of_day=1; 
      }

	
	 $rs5['fees_amount']=(($no_of_day+1))*$fees;
	
	}	elseif($a=='PM' && $b=='PM')

{


	$rs5['fees_amount']=(abs((($no_of_day+1)-.5)))*$fees;
	
	
	}elseif($a=='AM' && $b=='AM')

{
	$rs5['fees_amount']=(abs((($no_of_day+1)-.5)))*$fees;
	}
}




	}

//$pdf->Cell(4, 0.25, 'From :'.date("d-M-Y " ,strtotime($rs5['from_time'])).' To: '.date("d-M-Y " ,strtotime($rs5['to_time'])).', '0', 'C');
$pdf->Cell(4, 0.25,'From :'.date("d-M-Y " ,strtotime($rs5['from_time'])).'   To: '.date("d-M-Y " ,strtotime($rs5['to_time'])), '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, number_format($rs5['fees_amount'],2), '0', "C");
$pdf->Ln(.3);
	 $count+=$rs5['fees_amount'];
	}
	
	}
	/* DUTY DOCTOR*/
	$pat_ip_id = get_pat_ip_id($patientid);
	$query5 = "select ef from clinical_history where patient_id='$patientid';";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Duty Doctor Fees', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				//$pdf->SetFont('arial','',12);

	//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, 'Room No('.get_room_name($rs5['room_id']).')', '0', 'C');
//$pdf->Ln(.3);
//$pdf->SetFont('arial','',8);
//$pdf->Cell(1.1, 0.25, '', '0', "C");
//$pdf->Cell(4, 0.25,'From :'.$rs5['from_time'].'   To: '.$rs5['to_time'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, number_format($rs5['fees_amount'],2), '0', "C");
//$pdf->Ln(.3);
	 $count6+=$rs5['ef'];
	}
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($count6,2),'0', "C");
	$pdf->Ln(.3);

	}
	
	/*NURSING CHARGES*/
	/* DUTY DOCTOR*/
	$pat_ip_id = get_pat_ip_id($patientid);
	$query5 = "select oc from clinical_history where patient_id='$patientid';";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Nursing Charges', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				//$pdf->SetFont('arial','',12);

	//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, 'Room No('.get_room_name($rs5['room_id']).')', '0', 'C');
//$pdf->Ln(.3);
//$pdf->SetFont('arial','',8);
//$pdf->Cell(1.1, 0.25, '', '0', "C");
//$pdf->Cell(4, 0.25,'From :'.$rs5['from_time'].'   To: '.$rs5['to_time'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, number_format($rs5['fees_amount'],2), '0', "C");
//$pdf->Ln(.3);
	 $count7+=$rs5['oc'];
	}
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($count7,2),'0', "C");
	$pdf->Ln(.3);

	}
	
	/*SERVICES CHARGES*/
	 $query5 = "select total_count from services_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Hospital Service Charges', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		//$lab_det=$rs5['lab_full_det'];
			//	$lab_det1=$rs5['lab_det'];
				//$pdf->SetFont('arial','',12);

	//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, $rs5['service_name'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, number_format($rs5['total_count'],2), '0', "C");
//$pdf->Ln(.3);
	 $counts+=$rs5['total_count'];
	}
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($counts,2),'0', "C");
	$pdf->Ln(.3);
	}
	
		/* OT/ PROCEDURE CHARGES*/

	 $query5 = "select total_count from procedure_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25,$i++, '0', 'C');
$pdf->Cell(4, 0.25, 'OT Charges', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		//		$pdf->SetFont('arial','',12);

	//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, $rs5['procedure_name'].'/'.$rs5['duration'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, number_format($rs5['total_count'],2), '0', "C");
//$pdf->Ln(.3);
	 $count2+=$rs5['total_count'];
		}
		
		$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($count2,2),'0', "C");
	$pdf->Ln(.3);
	}
	//echo $patientid;
	
	
		/* physio*/
	include("config_db2.php");
	$query5 = "select * from sitting_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Procedure Charges', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				
//$pdf->SetFont('arial','',12);
//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, $rs5['type_name'].'- '.$rs5['sitting'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, number_format($rs5['total_count'],2), '0', "C");
//$pdf->Ln(.3);
	 $countp+=$rs5['total_count'];
	}
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($countp,2),'0', "C");
	$pdf->Ln(.3);
	}	
/*OTHER CHARGES*/
	include("config_db2.php");
   $query5 = "select * from fees_detailsip where patient_id='$patientid' and  bill_number='$bill_number'";
	$res7 = mysql_query($query5);
	//$i=1;
	$fees5 =0;
		if(mysql_num_rows($res7) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Other Charges', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	while($rs5 = mysql_fetch_array($res7)){
	//					$pdf->SetFont('arial','',12);
		//				$fees1=$rs5['fees'];
	//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, $rs5['description'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, $fees1, '0', "C");
//$pdf->Ln(.3);
		 $fees5+=$rs5['fees'];
}
$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($fees5,2),'0', "C");
	$pdf->Ln(.3);
		}	
		
	/*LAB CHARGES*/
 $query5 = "select testtotalamt from lab_testsample_ip where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Investigation-Charges', '0', 'C');

	
	
	while($rs5 = mysql_fetch_array($res5)){
		// $labsampleno=$rs5['labsampleno'];
		// $pdf->SetFont('arial','',12);
		// $pdf->Cell(.6, 0.25, '', '0', "C");
		// $pdf->Cell(.5, 0.25, $i++, '0', 'C');
		// $pdf->Cell(4, 0.25, $rs5['labsampleno'], '0', 'C');
		// $pdf->Ln(.3);
		// include("config_db2.php");
		// $labquery5 = "select lab_id,lab_sub_id,fees from lab_details_ip where labsampleno='$labsampleno'";
		// $labres5 = mysql_query($labquery5);
		// while($labres5_array = mysql_fetch_array($labres5)){	
		// $pdf->SetFont('arial','',10);
		// $pdf->Cell(.6, 0.25, '', '0', "C");
		// $pdf->Cell(.5, 0.25, '', '0', 'C');
		// $pdf->Cell(4, 0.25, get_labtype($labres5_array['lab_id']).'-'.get_labtest($labres5_array['lab_id'],$labres5_array['lab_sub_id']), '0', 'C');
		// $pdf->SetFont('arial','',12);
		// $pdf->Cell(1, 0.25, number_format($labres5_array['fees'],2), '0', "C");
		// $pdf->Ln(.3);
		// $fees2+=$labres5_array['fees'];
		// }
				
	

	$fees2+=$rs5['testtotalamt'];
	

	 
	}
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($fees2,2),'0', "C");
	$pdf->Ln(.3);
	
	}
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	

/* END OF SHORT BILL DESCRIPTION*/

//$pdf->AddPage();


			$fees_tot=$fees2+$fees5+$count2+$counts+$countp+$count+$count6+$count7;
			
	if(empty($advance_amount))
		$advance_amount=0;
	if(empty($old_bal))
		$old_bal=0;
		
		
		/* PRINT ADVANCE AMOUNT*/
		if ($advance_amount!=0)
		{
	//$pdf->Ln(.3);
	$pdf->SetFont('arial','',12);
	$pdf->Cell(5.1, 0.25, 'Advance Amount (A)  :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($advance_amount,2), '0', 'R');
	$pdf->Ln(.3);
	}
	
	/*PRINT OLD BALANCE*/
	if($old_bal!=0)
	{
	$pdf->SetFont('arial','',12);
	$pdf->Cell(5.1, 0.25, 'Old Balance (OB)   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($old_bal,2), '0', 'R');
		$pdf->Ln(.3);
		}
		
		/*TOTAL BILL AMOUNT*/
		$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Current Bill amount (T)   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($fees_tot,2), '0', 'R');
		$pdf->Ln(.3);
		if($old_bal!=0)
		{
	$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Total Amount (T) (OB+CB)  :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($fees_tot_amt,2), '0', 'R');
	$pdf->Ln(.3);
	
	}
		$plusmn = '&plusmn;';
	$pdf->SetFont('arial','B',12);	
	$pdf->Cell(5.1, 0.25, 'Paid Amount (P)    :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($pay,2), '0', 'R');
		$pdf->Ln(.3);
		
		if($pay!=$fees_tot_amt){
		$pdf->SetFont('arial','',12);
	$pdf->Cell(5.1, 0.25, 'Amount Due (D) (T-P)  :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($balance_amt,2), '0', 'R');
		$pdf->Ln(.3);
		}
		if(empty($advance_balance))
		$advance_balance=0;
		if($fees_tot_amt<$advance_amount){
			$pdf->SetFont('arial','',12);
	$pdf->Cell(5.1, 0.25, 'Remaining Advance(RA)(A-T)   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($advance_balance,2), '0', 'R');
		$pdf->Ln(.3);
		}
	if($return_amt > 0){
	$pdf->SetFont('arial','B',12);
	$pdf->Cell(5.1, 0.25, 'Amount Returned   :', '0','0', 'R');
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($return_amt,2), '0', 'R');
		$pdf->Ln(.3);
	}
	
	
	
	/* BILL SUMMARY*/
	$pdf->SetMargins(1,1,1);
$pdf->AddPage();
	//$pdf->AddPage();
	//$pdf->SetAutoPageBreak(true);
	
	$pdf->SetFont('arial','',12);
$pdf->Ln(.4);
$pdf->MultiCell(6.3, 0.25, "IP Bill Summary" , '0', "C");
$pdf->Ln(.3);
$pdf->Cell(1.1, 0.25, "Bill No",'0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(3, 0.25, ":Not the final bill", '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(4, 0.25, "Date : ".date("d-M-Y " ,time()), '0', "R");$pdf->Ln(.3);


$pdf->Cell(1.1, 0.25, "Name", '0', "L");

$pdf->Cell(0.6, 0.25, ": ".$rs4['patientsalutation'], '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(2.4, 0.25, $rs4['patientname'], '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(1.2, 0.25, 'Age / Gender  :', '0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(1.1, 0.25, $rs4['age'].'  /  '.$rs4['gender'], '0', "L");
$pdf->Ln(.3);

$pdf->Cell(1.1, 0.25, "UHID ",'0', "L");
$pdf->SetFont('arial','',12);
$pdf->Cell(3, 0.25, ": ".$patientid, '0', "L");
//$pdf->SetFont('arial','',12);
//$pdf->Cell(4, 0.25, "IP No : ".$ip_id, '0', "R");
$pdf->Ln(.4);

$pdf->SetFont('arial','B',12);
$pdf->Cell(.6, 0.25, '', '', "C");
$pdf->Cell(.5, 0.25, 'S.No', '1', 'C');
$pdf->Cell(4, 0.25, 'DESCRIPTION', '1', 'C');
$pdf->Cell(1, 0.25, 'FEES', '1',  "C");
$pdf->Ln(.3);
$pdf->SetFont('arial','',12);

/*ROOM CHARGES*/

	$pat_ip_id = get_pat_ip_id($patientid);
	
	
	$query5 = "select * from room_bill_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	
	 
	$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'Room Rent', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				$pdf->SetFont('arial','',12);

	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
$pdf->Cell(4, 0.25, 'Room No('.get_room_name($rs5['room_id']).')', '0', 'C');
$pdf->Ln(.3);
$pdf->SetFont('arial','',8);
$pdf->Cell(1.1, 0.25, '', '0', "C");

if ($rs5['to_time']==''){
  date_default_timezone_set('Asia/Calcutta');
 $rs5['to_time']= date('Y-m-d');
 $r1= date('Y-m-d H:i:s');
$qrl=strtotime($r1);

$qr2=strtotime($rs5['from_time']);
$no_of_day = floor(abs($qrl - $qr2) / 86400);

//$newDateTime = date('A', strtotime($r1));
$a = date('A', $qr2);
$b = date('A', strtotime($r1));




//$NoOfdays = strtotime($r1)->diff($rs5['from_time'])->format("%a"); 
 
if ($rs5['fees_amount']==0){


$roomId=get_room_name($rs5['room_id']);
$costQuery = "select rate from room_no where room='".$roomId."'";
	$costval = mysql_query($costQuery);
	while($cost = mysql_fetch_array($costval)){
	 $fees=$cost['rate'];
	}
	if($a=='AM' && $b=='PM')

{
	  $rs5['fees_amount']=(($no_of_day+1))*$fees;
	
	}
	elseif($a=='PM' && $b=='AM')

{
	if ($no_of_day==0){
         
		$no_of_day=1; 
      }

	
	 $rs5['fees_amount']=(($no_of_day+1))*$fees;
	
	}	elseif($a=='PM' && $b=='PM')

{


	$rs5['fees_amount']=(abs((($no_of_day+1)-.5)))*$fees;
	
	
	}elseif($a=='AM' && $b=='AM')

{
	$rs5['fees_amount']=(abs((($no_of_day+1)-.5)))*$fees;
	}
}



	}

//$pdf->Cell(4, 0.25, 'From :'.date("d-M-Y " ,strtotime($rs5['from_time'])).' To: '.date("d-M-Y " ,strtotime($rs5['to_time'])).', '0', 'C');
$pdf->Cell(4, 0.25,'From :'.date("d-M-Y " ,strtotime($rs5['from_time'])).'   To: '.date("d-M-Y " ,strtotime($rs5['to_time'])), '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, number_format($rs5['fees_amount'],2), '0', "C");
$pdf->Ln(.3);
	 $count+=$rs5['fees_amount'];
	}
	
	}
	
	
	/* DUTY DOCTOR*/
	
	$pat_ip_id = get_pat_ip_id($patientid);
	$query5 = "select ef from clinical_history where patient_id='$patientid';";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Duty Doctor Fees', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				//$pdf->SetFont('arial','',12);

	//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, 'Room No('.get_room_name($rs5['room_id']).')', '0', 'C');
//$pdf->Ln(.3);
//$pdf->SetFont('arial','',8);
//$pdf->Cell(1.1, 0.25, '', '0', "C");
//$pdf->Cell(4, 0.25,'From :'.$rs5['from_time'].'   To: '.$rs5['to_time'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, number_format($rs5['fees_amount'],2), '0', "C");
//$pdf->Ln(.3);
	 $count8+=$rs5['ef'];
	}
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($count8,2),'0', "C");
	$pdf->Ln(.3);

	}
	
	/*NURSING CHARGES*/
	/* DUTY DOCTOR*/
	$pat_ip_id = get_pat_ip_id($patientid);
	$query5 = "select oc from clinical_history where patient_id='$patientid';";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->Cell(4, 0.25, 'Nursing Charges', '0', 'C');
//$pdf->Cell(1, 0.25, '' ,'0', "C");
//$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				//$pdf->SetFont('arial','',12);

	//$pdf->Cell(.6, 0.25, '', '0', "C");
//$pdf->Cell(.5, 0.25, $i++, '0', 'C');
//$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, 'Room No('.get_room_name($rs5['room_id']).')', '0', 'C');
//$pdf->Ln(.3);
//$pdf->SetFont('arial','',8);
//$pdf->Cell(1.1, 0.25, '', '0', "C");
//$pdf->Cell(4, 0.25,'From :'.$rs5['from_time'].'   To: '.$rs5['to_time'], '0', 'C');
//$pdf->SetFont('arial','',12);
//$pdf->Cell(1, 0.25, number_format($rs5['fees_amount'],2), '0', "C");
//$pdf->Ln(.3);
	 $count9+=$rs5['oc'];
	}
	$pdf->SetFont('arial','',12);
	$pdf->Cell(1, 0.25, number_format($count9,2),'0', "C");
	$pdf->Ln(.3);

	}
	
	/*DETAILED SERVICE CHARGES*/
	include("config_db2.php");
	$query5 = "select * from services_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	//$sdate=  "select created_date from services_details where patient_id='$patientid' and bill_number='$bill_number'";
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25,'', '0', 'C');
$pdf->Cell(4, 0.25, 'Hospital Service Charges','', '0', 'L');
$pdf->Ln(.2);

	
	while($rs5 = mysql_fetch_array($res5)){
		
		$lab_det=$rs5['lab_full_det'];
			$lab_det1=$rs5['lab_det'];
				$pdf->SetFont('arial','',12);

	

$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
//$pdf->Cell(4, 0.25, $rs5['created_date'], '0', 'C');
$pdf->Cell(4, 0.25, $rs5['service_name'], '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, number_format($rs5['total_count'],2), '0', "C");
$pdf->Ln(.2);
$pdf->SetFont('arial','',8);
$pdf->Cell(1.1, 0.25, '', '0', "C");
$pdf->Cell(4, 0.25, 'Date ('.date("d-M-Y " ,strtotime($rs5['created_date'])).')', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	 $count+=$rs5['total_count'];
	}
	//$pdf->SetFont('arial','',12);
	//$pdf->Cell(1, 0.25, number_format($count,2),'0', "C");
	//$pdf->Ln(.3);
	}
	/*DETAILED OT/ PROCDURE CHARGES*/	
	
	 $query5 = "select * from procedure_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'OT Charges', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		$pdf->SetFont('arial','',12);

	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
$pdf->Cell(4, 0.25, $rs5['procedure_name'].'/'.$rs5['duration'], '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, number_format($rs5['total_count'],2), '0', "C");
$pdf->Ln(.2);
$pdf->SetFont('arial','',8);
$pdf->Cell(1.1, 0.25, '', '0', "C");
$pdf->Cell(4, 0.25, 'Date ('.date("d-M-Y " ,strtotime($rs5['created_date'])).')', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	 $count2+=$rs5['total_count'];
		}
		
		//$pdf->SetFont('arial','',12);
	//$pdf->Cell(1, 0.25, number_format($count2,2),'0', "C");
	//$pdf->Ln(.3);
	}
	
	/* PROCEDURE*/
	include("config_db2.php");
	$query5 = "select * from sitting_details where patient_id='$patientid' and bill_number='$bill_number'";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'Procedure Charges', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	while($rs5 = mysql_fetch_array($res5)){
		
		
				
$pdf->SetFont('arial','',12);
$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
$pdf->Cell(4, 0.25, $rs5['type_name'].'- '.$rs5['sitting'], '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, number_format($rs5['total_count'],2), '0', "C");
$pdf->Ln(.3);
	 $count+=$rs5['total_count'];
	}}
	

	/*OTHER CHARGES*/
	include("config_db2.php");
   $query5 = "select * from fees_detailsip where patient_id='$patientid' and  bill_number='$bill_number'";
	$res7 = mysql_query($query5);
	//$i=1;
	$fees5 =0;
		if(mysql_num_rows($res7) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'Other Charges', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	while($rs5 = mysql_fetch_array($res7)){
						$pdf->SetFont('arial','',12);
						$fees1=$rs5['fees'];
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, $i++, '0', 'C');
$pdf->SetFont('arial','',10);
$pdf->Cell(4, 0.25, $rs5['description'], '0', 'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(1, 0.25, $fees1, '0', "C");
$pdf->Ln(.3);
		 $fees5+=$rs5['fees'];
}
		}	
		
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
 $query5 = "select * from lab_testsample_ip where patient_id='$patientid' AND paid_status !=1 AND bill_queue ='1' AND bill_number=''";
	$res5 = mysql_query($query5);
	//$i=1;
			if(mysql_num_rows($res5) != 0){
$pdf->SetFont('arial','B',10);
	$pdf->Cell(.6, 0.25, '', '0', "C");
$pdf->Cell(.5, 0.25, '', '0', 'C');
$pdf->Cell(4, 0.25, 'Investigation Charges', '0', 'C');
$pdf->Cell(1, 0.25, '' ,'0', "C");
$pdf->Ln(.3);
	
	
	while($rs5 = mysql_fetch_array($res5)){
		$labsampleno=$rs5['labsampleno'];
		$pdf->SetFont('arial','',10);
		$pdf->Cell(.6, 0.25, '', '0', "C");
		$pdf->Cell(.5, 0.25, $i++, '0', 'C');
		
		$pdf->Cell(4, 0.25, $rs5['labsampleno'], '0', 'C');
		$pdf->Ln(.3);
		$pdf->SetFont('arial','',8);
$pdf->Cell(1.1, 0.25, '', '0', "C");

	$pdf->Cell(4, 0.25, 'Date ('.date("d-M-Y " ,strtotime($rs5['datecollect'])).')', '0', 'C');
//$pdf->Cell(4, 0.25, 'Date ('.$rs5['datecollect'].')', '0', 'C');

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
		$fees2+=$labres5_array['fees'];
		}
			//$pdf->Addpage();		
	//$pdf->SetAutoPageBreak(true);
	

	 
	}}
	
		

$pdf->Output();
ob_flush();
?>


