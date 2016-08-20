<?php
ob_start ();
session_start ();
date_default_timezone_set ( 'Asia/Kolkata' );
$role = $_SESSION ['role'];
include ("config_db1.php");
$img = mysql_query ( "select * from print_image where id=1" );
$row = mysql_fetch_array ( $img );
$image = $row ['header'];
$foot = $row ['footer'];
function get_labtype($lab_id_arg) {
	include ("config_db1.php");
	// Retrieve lab test main title from investigation table
	$inves_query = mysql_query ( "select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1" );
	$inves_query_array = mysql_fetch_array ( $inves_query );
	$lab_title = strtolower ( $inves_query_array ['title'] );
	
	return $lab_title;
}
function get_labtest($lab_id_arg, $lab_sub_id_arg) {
	include ("config_db1.php");
	// Retrieve lab test main title from investigation table
	$inves_query = mysql_query ( "select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1" );
	$inves_query_array = mysql_fetch_array ( $inves_query );
	$lab_title = strtolower ( $inves_query_array ['title'] );
	
	// Lab sub title query to get fee details using title as table from investiogation
	$sym = '';
	if (! empty ( $lab_sub_id_arg )) {
		$lab_query = mysql_query ( "select sym from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1" );
		$lab_query_array = mysql_fetch_array ( $lab_query );
		$sym = strtolower ( $lab_query_array ['sym'] );
	}
	return $sym;
}
function get_labtest_ref_range($lab_id_arg, $lab_sub_id_arg) {
	include ("config_db1.php");
	// Retrieve lab test main title from investigation table
	$inves_query = mysql_query ( "select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1" );
	$inves_query_array = mysql_fetch_array ( $inves_query );
	$lab_title = strtolower ( $inves_query_array ['title'] );
	
	// Lab sub title query to get fee details using title as table from investiogation
	$normal = '';
	if (! empty ( $lab_sub_id_arg )) {
		$lab_query = mysql_query ( "select normal from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1" );
		$lab_query_array = mysql_fetch_array ( $lab_query );
		$normal = strtolower ( $lab_query_array ['normal'] );
	}
	return $normal;
}
require ('fpdf/fpdf.php');

$sampleno = $_REQUEST ['sampleno'];
include ("config_db2.php");
$cmd_lab_sample_query = mysql_query ( "select id,patient_id,ip_id,labsampleno,sampletesttitle,sampletestsubtitle,sampleapprover,sampleapproverdesign,datereq,datecollect,datereportgen from lab_testsample_ip WHERE labsampleno='$sampleno' order by id desc limit 1" );
while ( $cmd_lab_sample_array = mysql_fetch_array ( $cmd_lab_sample_query ) ) {
	$pat_id = $cmd_lab_sample_array ['patient_id'];
	$ip_id = $cmd_lab_sample_array ['ip_id'];
	$labsampleno = $cmd_lab_sample_array ['labsampleno'];
	$sampletesttitle = $cmd_lab_sample_array ['sampletesttitle'];
	$sampletestsubtitle = $cmd_lab_sample_array ['sampletestsubtitle'];
	$sampleapprover = $cmd_lab_sample_array ['sampleapprover'];
	$sampleapproverdesign = $cmd_lab_sample_array ['sampleapproverdesign'];
	$datereq = $cmd_lab_sample_array ['datereq'];
	$datecollect = $cmd_lab_sample_array ['datecollect'];
	$datereportgen = $cmd_lab_sample_array ['datereportgen'];
	$cmd_ip_pat_query = mysql_query ( "select * from patientdetails WHERE patientid='$pat_id' limit 1" );
	$cmd_ip_pat_array = mysql_fetch_array ( $cmd_ip_pat_query );
	$patientname = $cmd_ip_pat_array ['patientsalutation'] . ' ' . $cmd_ip_pat_array ['patientname'];
	$age = $cmd_ip_pat_array ['age'];
	$gender = $cmd_ip_pat_array ['gender'];
}

$imgg = '<div style="text-align:center"><img src="img/cards/paypal.png" /></div>';
$html = '<h3 style="text-align:center">LAB REPORT DETAILS</h3>
<table>
<tbody>
<tr>
<td>Patient ID</td>
<td style="width:300px;">' . $pat_id . '</td>
<td>SAMPLE NO</td>
<td >' . $labsampleno . '</td>

</tr>

<tr>
<td>Name</td>
<td>' . $patientname . '</td>
<td>Date Requested</td>
<td>' . $datereq . '</td>
</tr>
<tr>
<td>AGE</td>
<td>' . $age . '</td>
<td>Date Collected</td>
<td>' . $datecollect . '</td>
</tr>
<tr>
<td>SEX</td>
<td>' . $gender . '</td>
<td>Reported Date</td>
<td>' . $datereportgen . '</td>
</tr>
</tbody>
</table>
<hr/>
<div>
		<div style="width:22%;float:left">Lab Investigation</div>
		<div style="width:22%;float:left">Result</div>
		<div style="width:22%;float:left">Reference Range</div>
		<div style="width:22%;float:left">Comments</div>
</div>
<hr/>
<b><u>' . $sampletesttitle . '</u></b><br>
<b><u>' . $sampletestsubtitle . '</u></b>';
include ("config_db2.php");
$cmd_lab_details_query = mysql_query ( "select * from lab_details_ip where labsampleno='$sampleno'" );

$i = 1;
if (mysql_num_rows ( $cmd_lab_details_query ) != 0) {
	$html .= '<table>
<tbody>';
	while ( $cmd_lab_details_array = mysql_fetch_array ( $cmd_lab_details_query ) ) {
		
		$id = $cmd_lab_details_array ['id'];
		$bill_number = $cmd_lab_details_array ['bill_number'];
		$lab_id = $cmd_lab_details_array ['lab_id'];
		$lab_sub_id = $cmd_lab_details_array ['lab_sub_id'];
		$lab_test_type = ucfirst ( get_labtype ( $lab_id ) );
		$lab_test_name = get_labtest ( $lab_id, $lab_sub_id );
		$lab_test_ref_range = get_labtest_ref_range ( $lab_id, $lab_sub_id );
		$reports = $cmd_lab_details_array ['reports'];
		$notes = $cmd_lab_details_array ['notes'];
		
		if (empty ( $lab_test_name ) && $lab_test_name == '')
			$lab_test_type = $lab_test_type;
		else
			$lab_test_type = $lab_test_type . '-' . $lab_test_name;
		
		$html .= '<tr>
<td style="width:10%">' . $lab_test_type . '</td>
<td style="width:50%;padding-left:20px;">' . $reports . '</td>
<td style="width:10%">' . $lab_test_ref_range . '</td>
<td style="width:10%">' . $notes . '</td>
</tr>';
	}
	$html .= '</tbody>
</table>';
}

$html .= '<hr/>
<div style="padding-left:80%;"><b><u>' . $sampleapprover . '</u></b><br>
<b><u>' . $sampleapproverdesign . '</u></b></div>';
$html = utf8_encode ( $html );
include ("mpdf/mpdf.php");

$mpdf = new mPDF ();

$mpdf->WriteHTML ( $html );
$mpdf->Output ();
exit ();
ob_flush ();
?>