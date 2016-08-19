<?php
include("config_db2.php");	
	
	$pid = $_REQUEST['pid'];			$age_sel = $_REQUEST['age_sel'];		$age1 = $_REQUEST['age1'];
		$age2 = $_REQUEST['age2'];			$gender = $_REQUEST['gender'];			$diagnosis = $_REQUEST['diagnosis'];
		$symptoms = $_REQUEST['symptoms'];	$medicalhist = $_REQUEST['medicalhist'];$familyhist = $_REQUEST['familyhist'];
		$psyhist = $_REQUEST['psyhist'];	$pershist = $_REQUEST['pershist'];
		//echo 'dfgdfg';
		 if($pid=="" && $age2=="" && $age1=="" && $gender=="Select" && $diagnosis=="" && $symptoms=="" && $medicalhist=="" && $familyhist=="" && $psyhist=="" && $pershist=="")
		{
		
$cmd = "select       				branch,patientid,patientsalutation,patientname,guardiansalutation,guardianname,age,gender,contactno,occupation,address,cast(time as date) as time from patientdetails";
			$res = mysql_query($cmd);
			$slno = 1;
			while($rs = mysql_fetch_array($res))
			{
				$pid = $rs['patientid'];
				$msg .= $rs['patientid'].'~'.$rs['patientid'].'~'.$rs['patientsalutation']." ".$rs['patientname'].'~'.$rs['guardiansalutation']." ".$rs['guardianname'].'~'.$rs['age'].'~'.$rs['gender'].'~'.$rs['contactno'].'~'.$rs['occupation'].'~'.$rs['address'].'~'.$rs['time'].'~'.$rs['pid'].'@';
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		}
	
		else if($pid != ""){
		
			$cmd = "select branch,patientid,patientsalutation,patientname,guardiansalutation,guardianname,age,gender,contactno,occupation,address,cast(time as date) as time from patientdetails where patientid = '$pid'";
			$res = mysql_query($cmd);
			$slno = 1;
			while($rs = mysql_fetch_array($res))
			{
				$pid = $rs['patientid'];
				$msg .= $rs['patientid'].'~'.$rs['patientid'].'~'.$rs['patientsalutation']." ".$rs['patientname'].'~'.$rs['guardiansalutation']." ".$rs['guardianname'].'~'.$rs['age'].'~'.$rs['gender'].'~'.$rs['contactno'].'~'.$rs['occupation'].'~'.$rs['address'].'~'.$rs['time'].'~'.$rs['pid'].'@';
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		}
		else {
		
        	$sql_cmd1 = ""; $sql_cmd2 = ""; $sql_cmd3 = "";
        // Patient Detail Table
		
			if ($age_sel != "Select") {
				if ($age_sel == "Between") {
					if ($age_sel != "" && $age1 != "")
						$sql_cmd1 = "p.age between " . $age1 . " and " . $age2;
					else {
						echo "Required field Missing!";
					}
				} else if ($age_sel == "Equal") {
					if ($age1 != "")
						$sql_cmd1 = "p.age = " . $age1;
					else {
					echo "Required field Missing!";
					}
				} else if ($age_sel == "Less than") {
					if ($age1 != "")
						$sql_cmd1 = "p.age < " . $age1;
					else {
					echo "Required field Missing!";
					}
				} else if ($age_sel =="Greater than") {
					if ($age1 != "")
						$sql_cmd1 = "p.age > " . $age1;
					else {
						echo "Required field Missing!";
					}
				}
			}
        	if ($gender != "Select") {
	            if ($sql_cmd1 == "") {
    	            if ($gender =="Male") {
	                    $sql_cmd1 = "p.gender='male'";
    	            } else {
	       	            $sql_cmd1 = "p.gender='female'";
            	    }
    	       	} else {
                	if ($gender =="Male") {
                 		$sql_cmd1 .= " and p.gender='male'";
                	} else {
                    	$sql_cmd1 .= " and p.gender='female'";
                	}
            	}
        	}
        // Complaint Table    
        	if ($diagnosis != "") {
            	$sql_cmd2 = "d.diagnosis like '%" . $diagnosis . "%'";
	        }
    	    if ($symptoms != "") {
        	    if ($sql_cmd2 == "") {
            	    $sql_cmd2 = "c.symptoms like '%" . $symptoms . "%'";
	            } else {
    	            $sql_cmd2 .= " and c.symptoms like '%" . $symptoms . "%'";
        	    }
        	}
        // Medical History Table
        	if ($medicalhist != "") {
            	$sql_cmd3 = "m.medicalhistory like '%" . $medicalhist . "<br />%'";
				//$med="inner join tbl_diagnosis d on p.patientid=d.patientid";
        	}
        	if ($familyhist != "") {
	            if ($sql_cmd3 == "") {
    	            $sql_cmd3 = "m.familyhistory like '%" . $familyhist . "<br />%'";
        	    } else {
            	    $sql_cmd3 .= " and m.familyhistory like '%" . $familyhist . "<br />%'";
            	}
        	}
	        if ($pershist != "") {
    	        if ($sql_cmd3 == "") {
        	        $sql_cmd3 = "m.personalhistory like '%" . $pershist . "<br />%'";
            	} else {
                	$sql_cmd3 .= " and m.personalhistory like '%" . $pershist . "<br />%'";
            	}
        	}
       		if ($psyhist != "") {
            	if ($sql_cmd3 == "") {
                	$sql_cmd3 = "m.psychiatrichistory like '%" . $psyhist . "<br />%'";
            	} else {
                	$sql_cmd3 .= " and m.psychiatrichistory like '%" . $psyhist . "<br />%'";
            	}
        	}

			if ($sql_cmd1 != "" && $sql_cmd2 != "" && $sql_cmd3 != "") {
				if($diagnosis != "") 
				$Query = "select distinct p.patientid from patientdetails p inner join complaints c on p.patientid=c.patientid inner join medicalhistory m on m.patientid=c.patientid inner join tbl_diagnosis d on p.patientid=d.patientid  where " . $sql_cmd1 . " and " . $sql_cmd2 . " and " . $sql_cmd3;
				else 
				$Query = "select distinct p.patientid from patientdetails p inner join complaints c on p.patientid=c.patientid inner join medicalhistory m on m.patientid=c.patientid where " . $sql_cmd1 . " and " . $sql_cmd2 . " and " . $sql_cmd3;
			} else if ($sql_cmd1 != "" && $sql_cmd2 != "" && $sql_cmd3 == "") {
			if($diagnosis != "")
				$Query = "select distinct p.patientid from patientdetails p inner join complaints c on p.patientid=c.patientid inner join tbl_diagnosis d on p.patientid=d.patientid where " . $sql_cmd1 . " and " . $sql_cmd2;
				else
				$Query = "select distinct p.patientid from patientdetails p inner join complaints c on p.patientid=c.patientid  where " . $sql_cmd1 . " and " . $sql_cmd2;
				
			} else if ($sql_cmd1 != "" && $sql_cmd2 == "" && $sql_cmd3 != "") {
			$Query = "select distinct p.patientid from patientdetails p inner join  medicalhistory m on m.patientid=p.patientid where " . $sql_cmd1 . " and " . $sql_cmd3;
			} else if ($sql_cmd1 == "" && $sql_cmd2 != "" && $sql_cmd3 != "") {
			if($diagnosis != "") 
		$Query = "select distinct c.patientid from patientdetails p inner join complaints c on p.patientid=c.patientid inner join medicalhistory m on m.patientid=c.patientid inner join tbl_diagnosis d on p.patientid=d.patientid where " . $sql_cmd2 . " and " . $sql_cmd3;
				else 
				$Query = "select distinct c.patientid from patientdetails p inner join complaints c on p.patientid=c.patientid inner join medicalhistory m on m.patientid=c.patientid where " . $sql_cmd2 . " and " . $sql_cmd3;
			} else if ($sql_cmd1 != "") {
				$Query = "select p.patientid from patientdetails p where " . $sql_cmd1;
			} else if ($sql_cmd2 != "") {
				if($diagnosis != "")
				$Query = "select d.patientid tbl_diagnosis d where " . $sql_cmd2;
				else
				$Query = "select c.patientid from complaints c where " . $sql_cmd2;
			} else if ($sql_cmd3 != "") {
				$Query = "select m.patientid from medicalhistory m where " . $sql_cmd3;
			}
			$slno = 1;
			//echo $Query;
			$res1 = mysql_query($Query);
			while($rs1 = mysql_fetch_array($res1))
			{
				$pid = $rs1['patientid'];
				$QueryS = "select branch, patientid, patientsalutation, patientname, guardiansalutation, guardianname, age, gender, contactno, occupation, address, cast(time as date) as time from patientdetails where patientid = '$pid'";
				$resS = mysql_query($QueryS);
				$rsS = mysql_fetch_array($resS);
				
				$msg .= $rsS['branch'].'~'.$rsS['patientid'].'~'.$rsS['patientsalutation']." ".$rsS['patientname'].'~'.$rsS['guardiansalutation']." ".$rsS['guardianname'].'~'.$rsS['age'].'~'.$rsS['gender'].'~'.$rsS['contactno'].'~'.$rsS['occupation'].'~'.$rsS['address'].'~'.$rsS['time'].'~'.$rsS['patientid'].'@';
				
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		}
		mysql_close($db2);
	
?>
     
