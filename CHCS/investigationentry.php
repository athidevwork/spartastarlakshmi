<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$inves=$_REQUEST['inves'];
$len=sizeof($inves);
//echo $len;
//$hed=$_REQUEST['hed'];
$patid=$_REQUEST['pid'];
$user = $_SESSION['username'];
//$date=date('Y-m-d');
include("config_db2.php");
$i=0;
foreach($inves as $inves => $key){
	include("config_db1.php");
	$cmd=mysql_query("select title from investigation where id ='$key[2]'");
	//echo "select title from investigation where id ='$key[2]'";
	$rs=mysql_fetch_array($cmd);
	$tbl=$rs['title'];
	
	$cmd1=mysql_query("select category,testadd from $tbl  where id ='$key[7]'");
	//echo "select category,testadd from $tbl where where id ='$key[7]'";
	mysql_close($db1);
	$rs1=mysql_fetch_array($cmd1);
	
	$test=$rs1['testadd'];
	$sub1=$rs1['category'];
	if($sub1==1)
	$sub=0;
	else
	$sub=1;


include("config_db2.php");
 	$sql = "INSERT INTO investigationreport (`id`,`patientid`,test, `created_by`,category,notes,complaint,sub) VALUES (NULL, '$patid','$key[7]', '$user', '$key[2]','$key[5]','$key[4]','$sub');"; 
	
	//echo $sql;
	mysql_query($sql);
	
	$id = mysql_insert_id();
	mysql_close($db2);
	//echo $id;
	include("config_db1.php");
	if($rs1['category']!=1){	
	//echo $rs1['category'];
	if($rs1['category']==3){
	$s=mysql_query("select * from sub_test where testid='$key[7]'");
	mysql_close($db1);
	
include("config_db2.php");
	while($fetch=mysql_fetch_array($s)) {
		
	$symid=$fetch['id'];
	//echo $symid;
		mysql_query("insert into investigationsub (inves_id,sym_id,category) values('$id','$symid',3)");
		//mysql_error();
	
			}
				//mysql_close($db2);
	}
	
	
	
	else if($rs1['category']==2){
	include("config_db1.php");
	$s=mysql_query("select * from $tbl where id IN($test)");
	//echo "select * from $tbl where id IN($test)";
	mysql_close($db1);
	while($fetch=mysql_fetch_array($s))	{
	$symid=$fetch['id'];
	
	if($fetch['category']==3) {
	
	include("config_db1.php");
	$s1=mysql_query("select * from sub_test where testid='$symid'");
	mysql_close($db1);
	
	
	
	
	while($fetch1=mysql_fetch_array($s1)) {
	$symid1=$fetch1['id'];
	include("config_db2.php");
		mysql_query("insert into investigationsub (inves_id,sub_cat,category,sym_id) values('$id','$symid1',3,'$symid')");
	
			}
			//mysql_close($db2);
		}else { include("config_db2.php");
	
		mysql_query("insert into investigationsub (inves_id,sym_id,category) values('$id','$symid',1)");
		}
		
	
		}
	}
}
	$i++;
	}
			//echo $sql;
			if($i==$len){
				mysql_close($db2);
				echo 'success';
			}
			else{
				mysql_close($db2);
				echo 'Error';		
			}
		//print_r($hed);
		
?>