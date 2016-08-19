<?php
	$title = $_REQUEST['tit'];
	$regname = $_REQUEST['name'];			$regname = mysql_escape_string($regname);
	$gender = $_REQUEST['gender'];
	
	$dob = $_REQUEST['dob'];
	$x = explode('/',$dob);
	$dob = $x[2] . '-' . $x[1] . '-' . $x[0];
	
	$designation = $_REQUEST['pres'];		$designation = mysql_escape_string($designation);
	$oaddress = $_REQUEST['cladd'];				$oaddress = mysql_escape_string($oaddress);
	$ostate = $_REQUEST['state'];					$ostate = mysql_escape_string($ostate);
	$opincode = $_REQUEST['pin'];				$opincode = mysql_escape_string($opincode);
	$ophone = $_REQUEST['tebuss'];					
	$raddress = $_REQUEST['add'];				$raddress = mysql_escape_string($raddress);
	$rstate = $_REQUEST['state1'];					$rstate = mysql_escape_string($rstate);
	$rpincode = $_REQUEST['pin1'];				$rpincode = mysql_escape_string($rpincode);
	$rphone = $_REQUEST['tehome'];					
	$emailid = $_REQUEST['email'];				$emailid = mysql_escape_string($emailid);
	$regno = $_REQUEST['regno'];					$regno = mysql_escape_string($regno);
	
	$issuedate = $_REQUEST['datee'];
	$x = explode('/',$issuedate);
	$issuedate = $x[2] . '-' . $x[1] . '-' . $x[0];
	
	$issueplace = $_REQUEST['place'];			$issueplace = mysql_escape_string($issueplace);
	$institution1 = $_REQUEST['int1'];		$institution1 = mysql_escape_string($institution1);
	$degree1 = $_REQUEST['qul1'];				$degree1 = mysql_escape_string($degree1);
	$institution2 = $_REQUEST['int2'];		$institution2 = mysql_escape_string($institution2);
	$degree2 = $_REQUEST['qul2'];				$degree2 = mysql_escape_string($degree2);
	$othermembership = $_REQUEST['othermember'];	$othermembership = mysql_escape_string($othermembership);
	$honours = $_REQUEST['awd'];				$honours = mysql_escape_string($honours);
	$lifemember = $_REQUEST['lifemember'];		


	if (!empty($_FILES["btnPhoto"]["name"])) {
		$photo = addslashes(file_get_contents($_FILES['btnPhoto']['tmp_name']));
	}else
		$photo = "";
		
	if (!empty($_FILES["btnSign"]["name"])) {
		$sign = addslashes(file_get_contents($_FILES['btnSign']['tmp_name']));
	}else
		$sign = "";
	
	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

	include("config.php");		
	$cmd = "INSERT INTO tbl_registration (id, title, regname, gender, dob, designation, oaddress, ostate, opincode, raddress, rstate, rpincode, rphone, ophone, emailid, regno, issuedate, issueplace, institution1, degree1, institution2, degree2, othermembership, honours, lifemember, photo, sign, datentime, status, txnid, txnstatus, txtamount) VALUES (NULL, '$title', '$regname', '$gender', '$dob', '$designation', '$oaddress', '$ostate', '$opincode', '$raddress', '$rstate', '$rpincode', '$rphone', '$ophone', '$emailid', '$regno', '$issuedate', '$issueplace', '$institution1', '$degree1', '$institution2', '$degree2', '$othermembership', '$honours', '$lifemember', '{$photo}', '{$sign}', CURRENT_TIMESTAMP, '8', '$txnid', '', '')";
	if(mysql_query($cmd)){
		$MERCHANT_KEY = "3JBhm7";
		$SALT = "GlWWTtdu";
		$PAYU_BASE_URL = "https://secure.payu.in";
		$amount = 5000;
		
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		
		$hash_string = "3JBhm7|".$txnid."|".$amount."|DFSI Membership|".$regname."|".$emailid."|||||||||||";
	
		$hash_string .= $SALT;
		$hash = strtolower(hash('sha512', $hash_string));
		$action = $PAYU_BASE_URL . '/_payment';
	}else{
		die( "Error Code : " . mysql_errno());
	}
?>
<html>
  <head>
  <script>
    function submitPayuForm() {
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onLoad="submitPayuForm()">
  <center><label>Redirecting to Payment site, please do not refresh this page.</label></center>
    <img src="ajax-loader.gif" style="position: absolute; top: 50%; left: 50%; width: 500px; height: 500px; margin-top: -250px; margin-left: -250px;" />
<form action="<?php echo $action; ?>" method="post" name="payuForm" style="display:none;">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo $amount; ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo $regname; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo $emailid; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo $rphone; ?>" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo">DFSI Membership</textarea></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="http://diabeticfootsocietyofindia.org/success.php" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="http://diabeticfootsocietyofindia.org/failure.php" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>
      </table>
    </form>
  </body>
</html>