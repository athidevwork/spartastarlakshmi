<?php
session_start();
$role=$_SESSION['role'];
 include("config_db1.php");
 $cmd=mysql_query("select bothprint from settings where role='$role'");
$sql=mysql_fetch_array($cmd);
if($sql['bothprint'] !=1)
{
echo '<script>alert("You could not access this page");window.top.close();</script>';
echo '<script>window.location.href="home.php"</script>';
exit();
}
?><html>
<head>
<style>

* {
	margin: 0;
	padding: 0;
}
html {
	background: #ddd;
}
body {
	margin: 1em 10%;
	padding: 1em 3em;
	font: 80%/1.4 tahoma, arial, helvetica, lucida sans, sans-serif;
	/*border: 1px solid #999;*/
	background: #FFF;
	position: relative; 
	min-height: 100%;
	height:auto;
}
table { page-break-inside:auto; width:100%; /*margin-left:05%; margin-right:05%;*/ margin-top:25px; }
tr    { page-break-inside:avoid; page-break-after:auto; text-align:center }
/*tbody:before {
    line-height:1em;
    content:"_";
    color:white;
    display:block;
}*/
@media print{
	body{
		margin:0;
	}
}
</style>
</head>
<body>
<div style="text-align:center">
<h1>SPARTA SOFTWARE SOLUTIONS</h1>
<h3>#16, Mahalingapuram Main Road, Opp. Brownstone Apts,</h3>
<h3>ICICI Bank Building, Second Floor, Mahalingapuram,</h3>
<h3>Nungambakkam, Chennai - 600 014.</h3>
<br />
</div>
<hr />
<?php
$pid= $_REQUEST['pid'];
$maxid = $_REQUEST['maxid'];
 date_default_timezone_set('Asia/Kolkata');
 include("config_db2.php");
	$query4 = "select * from patientdetails where patientid='$pid'";
	//echo $query4;
	$res4 = mysql_query($query4);
	$rs4 = mysql_fetch_array($res4);
echo '<table border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
		<td>&nbsp;</td>
        <td><div style="text-align:right;">Date :</div></td>
        <td><div style="text-align:left;">'.date("d-M-Y").'</div></td>
      </tr>
      <tr>
        <td>Name :</td>
        <td><div style="text-align:left;">'.$rs4['patientsalutation'].' '.$rs4['patientname'].'</div></td>
        <td>&nbsp;</td><td>&nbsp;</td>
        <td><div style="text-align:right;">Age / Gender :</div></td>
        <td><div style="text-align:left;">'.$rs4['age'].' / '.$rs4['gender'].'</div></td>
      </tr></table>';
	  
	  

	$cmd = "select id, cast(datetime as date) as datetime,prescribed_by,diag_report,blood_report,radio_report,psychological,psychometric,other_report from investigation where patientid='$pid' and lower(concat(`diag_report`,`blood_report`,`radio_report`,`psychological`,`psychometric`,`other_report`)) like lower('%pending%')  order by datetime desc";
	
	$res = mysql_query($cmd);
	if(mysql_num_rows($res) != 0){	
		while($rs = mysql_fetch_array($res))
		{
		$diog=$rs['diag_report'];
		$blood=$rs['blood_report'];
		$radio=$rs['radio_report'];
		$psy=$rs['psychological'];
		$sycho=$rs['psychometric'];
		$other=$rs['other_report'];
		 $diog1=explode("<br />",$diog);
		 $blood1=explode("<br />",$blood);
		 $radio1=explode("<br />",$radio);
		 $psy1=explode("<br />",$psy);
		 $sycho1=explode("<br />",$sycho);
		 $oth1=explode("<br />",$other);
		
		
		 		
		
		echo '<br/><h3>Requsition Reports</h3> <br/><ul>';
										   
									$temp = preg_replace("/[^a-zA-Z 0-9]+/", "", $diog1 );
										$errors = array_filter($temp);
										$temp1 = preg_replace("/[^a-zA-Z 0-9]+/", "", $blood1);
										$errors1 = array_filter($temp1);
										$temp2 = preg_replace("/[^a-zA-Z 0-9]+/", "", $radio1);
										$errors2 = array_filter($temp2);
										$temp3 = preg_replace("/[^a-zA-Z 0-9]+/", "", $psy1);
										$errors3 = array_filter($temp3);
										$temp3 = preg_replace("/[^a-zA-Z 0-9]+/", "", $sycho1);
										$errors3 = array_filter($temp3);
										$temp5 = preg_replace("/[^a-zA-Z 0-9]+/", "", $oth1 );
										$errors5 = array_filter($temp5);

										if (!empty($errors)) {
										
										foreach($diog1 as $value)
										{  $x=explode("-",$value);
										$y=explode("~",$x[1]);
										$z=explode("@",$y[1]);
										
										
                                          echo'                                                           
                                               <li> <span class="contacts-title"><strong>'.$x[0].'</strong></span></li>
											'; } } 
											if (!empty($errors1)) {
										

										foreach($blood1 as $value)
										{  $x=explode("-",$value);
										$y=explode("~",$x[1]);
										$z=explode("@",$y[1]);
										
										
                                          echo'                                                           
                                               <li> <span class="contacts-title"><strong>'.$x[0].'</strong></span> </li>
											 '; } }
											
											
											if (!empty($errors2)) {
									

										foreach($radio1 as $value)
										{  $x=explode("-",$value);
										$y=explode("~",$x[1]);
										$z=explode("@",$y[1]);
										
										
                                          echo'                                      
                                                <li> <span class="contacts-title"><strong>'.$x[0].'</strong></span> </li>
											'; } } 
											if (!empty($errors3)) {
											

										foreach($psy1 as $value)
										{  $x=explode("-",$value);
										$y=explode("~",$x[1]);
										$z=explode("@",$y[1]);
										
										
                                          echo'                                                          
                                                <li> <span class="contacts-title"><strong>'.$x[0].'</strong></span> </li>
											 '; } }
											
											if (!empty($errors4)) {
											
										foreach($sycho1 as $value)
										{  $x=explode("-",$value);
										$y=explode("~",$x[1]);
										$z=explode("@",$y[1]);
										
										
                                          echo'                                                           
                                                <li> <span class="contacts-title"><strong>'.$x[0].'</strong></span> </li>
											 '; } }
											
											if (!empty($errors5)) {
											

										foreach($oth1 as $value)
										{  $x=explode("-",$value);
										$y=explode("~",$x[1]);
										$z=explode("@",$y[1]);
										
										
                                          echo'                                           
                                              <li>  <span class="contacts-title"><strong>'.$x[0].'</strong></span> </li>
											'; } }
											
											echo'</ul>                           
                                       ';
			
		}
		
	}
	
	$query5 = "select * from prescriptiondetail where id=".$maxid;
	$res5 = mysql_query($query5);
	if(mysql_num_rows($res5) != 0){
		echo '<table border="0" cellpadding="5" cellspacing="5"><tbody><tr>
				<th align="left">Drug Name</th>
				<th>Dosage</th>
				<th>Specification</th>
				<th>Frequency</th>
				<th>Route</th>				
				<th>Duration</th>
			</tr>';
		while($rs5 = mysql_fetch_array($res5)){
			echo "<tr>
				<td width='70%'><div style='text-align:left;'>".$rs5['drugname']."</div></td>
				<td width='5%'>".$rs5['dosage']."</td>
				<td width='5%'>".$rs5['specification']."</td>
				<td width='5%'>".$rs5['frequency']."</td>
				<td width='10%'>".$rs5['route']."</td>				
				<td width='5%'>".$rs5['duration']."</td>
				</tr>";
		}
/*		for($i=0;$i<=50;$i++){
			echo "<tr>
				<td>$i</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				</tr>";
		}
		echo '</tbody></table><br />';*/
	}
	mysql_close($db2);

	?>
	
	
	<script>
	print();
	window.opener.location.href = "home.php";
	close();
  </script>