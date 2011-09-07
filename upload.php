<?php
	require_once('Connections/powermigrate.php');
	include("includes/common.php");
	require_once("includes/class.phpmailer.php");
	require_once("includes/class.smtp.php");
	header("Pragma: no-cache");
	header("Cache: no-cache");
?>	
<?php
	
	//initialize the session
	if (!isset($_SESSION)) {
	  session_start();
	}
	
//** Access **
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}	

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){																							
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}	

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_upload"])) && ($_POST["MM_upload"] == "form1") && array_key_exists('filename', $_POST)) 
{
	$error = array();
	
	$colname_Recordset1 = "-1";
	if (isset($_SESSION['MM_Username'])) {
	  $colname_Recordset1 = $_SESSION['MM_Username'];
	}
	
	$query_Recordset1 = sprintf("SELECT id, first_name, last_name, company_name FROM customers WHERE email = %s", 
		GetSQLValueString($colname_Recordset1, "text"));

	$Recordset1 = mysql_query($query_Recordset1, $powermigrate) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);			
	
	$id 			= $row_Recordset1['id'];
	$company_name 	= $row_Recordset1['company_name'];
	$fname 			= $row_Recordset1['first_name'];
	$lname 			= $row_Recordset1['last_name'];
	$uname			= $fname ." ".$lname;
	$appname 		= $_POST['application_name'];
	
	
		//Creating folder Structure
		$targetfolder 	= "uploads/";
		
		define('UPLOAD_DIR', $targetfolder);
		$file = str_replace(' ', '_', $_FILES['filename']['name']);


		$permitted = array('application/zip','application/x-zip-compressed','application/x-zip',
				  'multipart/x-zip','application/octet-stream','application/x-7z-compressed',
				  'application/x-alz','application/x-gzip','application/x-rar-compressed',
				  'application/x-compress','application/x-compressed');

		if (in_array($_FILES['filename']['type'], $permitted) && $_FILES['filename']['size'] <= 10485760) 
			{
				if ($_FILES["file"]["error"] > 0)
				{
					$error['error code'] = "Return Code: " . $_FILES["file"]["error"] . "<br />";
				}else
				{
					if (file_exists(UPLOAD_DIR . $file))
					  {
						$error['file already exists'] = $_FILES["file"]["name"] . " already exists. ";
					  }
					else
					  {
						$temp = $_FILES['filename']['tmp_name'];
						move_uploaded_file($temp,$targetfolder);
					  }
					if (is_uploaded_file) 
					{
						$_POST['custid']   		= $id; 
						$_POST['ticketno'] 		=  rand(1,100000); 
						$_POST['status'] 		=  "uploaded";           
						$_POST['temp'] 			=  $file;
						
	 $insertSQL = sprintf("INSERT INTO upload (custid, pb_version, db_vendor_version, services, target, filename, ticketno, application_name, status) 	VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['custid'], "int"),
						   GetSQLValueString($_POST['pb_version'], "text"),
						   GetSQLValueString($_POST['db_vendor_version'], "text"),
						   GetSQLValueString($_POST['services'], "text"),
						   GetSQLValueString($_POST['target'], "text"),
						   GetSQLValueString($_POST['temp'], "text"),
						   GetSQLValueString($_POST['ticketno'], "int"),
						   GetSQLValueString($_POST['application_name'], "text"),
						   GetSQLValueString($_POST['status'], "text"));
	
	  mysql_select_db($database_powermigrate, $powermigrate);
	  $Result1 = mysql_query($insertSQL, $powermigrate) or die(mysql_error());
						  $number = mysql_affected_rows();
						  $tem 			= $_POST['ticketno'];
						  $pbversion 	= $_POST['pb_version'];
						  $dbversion 	= $_POST['db_vendor_version'];
						  $services		= $_POST['services'];
						  $target		= $_POST['target'];
						  
						  if($number == 1)
						  {
							$mail             = new PHPMailer();
							
							$body = "Dear   $uname, <br/> <br/>
									 
									 Thank you for uploading your $appname on ModernizeNow. 
									 <br/> <br/>
									 
									 Your Reference Number is $tem. <br/><br/>
									 
									 You have selected the following options : <br/>
									
									 <ul>
										<li>Application Name			: $appname<li/>
										<li>PowerBuilder Version		: $pbversion<li/>
										<li>Database Vendor & Version	: $dbversion<li/>
										<li>Application Services		: $services<li/>
										<li>Target Technology			: $target<li/>
									 </ul><br/><br/>											 
									 
									 Within 48 hours, we will email a link to you where you can view and browse the migrated application.<br/> <br/>
									 
									 The SoftSol Team"; 
									 
							$mail->IsSMTP(); 
							$mail->SMTPDebug  = 1;                     
							$mail->SMTPAuth   = false;                  // enable SMTP authentication
							$mail->Host       = "relay-hosting.secureserver.net"; // sets the SMTP server
							//$mail->Host       = "mail.softsolindia.com"; // sets the SMTP server
							$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
							//$mail->Username	  = "amudunuri@softsolindia.com";
							//$mail->Password	  = "softsol@123";					
							$mail->SetFrom('modernize-register-notify@softsolindia.com', 'ModernizeNow');
							$mail->Subject    = "Confirmation on Uploading Code";
							$mail->MsgHTML($body);				
							$mail->AddAddress($_POST['email'], $_POST['first_name'].$_POST['last_name']);
							$Bcc = array('sakkiraju@softsolindia.com','amudunuri@softsolindia.com',
							'speddi@softsolindia.com','rbadugu@softsolindia.com'); 
							foreach ($Bcc as $value)
							{
								$mail->AddBCC($value,"");	 
							}				
							
							if(!$mail->Send()) {
								  $error['Mail Error'] =  "Mailer Error: " . $mail->ErrorInfo;
								} else {
									  $insertGoTo = "success.php?id=". $_POST['ticketno'];
									  if (isset($_SERVER['QUERY_STRING'])) {
										$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
										$insertGoTo .= $_SERVER['QUERY_STRING'];
									  }
									  header(sprintf("Location: %s", $insertGoTo));
								}				
						  }else{
							$error['record failed'] = "Record Insertion Failed";	 	
						  }								  
						  
					} else {
						$error['upload failed'] = "There was a problem while uploading $file\n";
					}
					  
				}
			}else{
				$error['Invalid File'] = 'Invalid File Type';
			}
	
}
?>
<?php include("header_new.php"); ?>
<script type="text/javascript">
 $(document).ready(function(){
	$("#form1").validate();
  });
</script>
<div id="main-content">
<?php 
	if (!isset($_SESSION)) {
  		session_start();
	}
	$user_id 	= $_SESSION['MM_Username'];
	$fname		= $_SESSION['MM_fname'];
	$lname 		= $_SESSION['MM_lname'];
?>	
	<div align="center" style="width:60%; height:auto;margin-left:20%;margin-right:20%;margin-top:10px">
        <br />
        <h1 align="center" class="bluehead18recharge">PowerBuilder Application Information</h1>
        <br />
        <hr />
        <br />
	<div class="error" style="width:500px" align="center">
          <?php
                if (isset($error)) {
                echo '<ul>';
                foreach ($error as $alert) {
                    echo "<li class='warning'>$alert</li>\n";
                }
                    echo '</ul>';
                }
            ?>
      </div><br />
	
                     
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
      <table align="center" border="0" cellpadding="0" cellspacing="0">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" style="color:#085299;font-weight:bold">
            Application Name:<em>*</em></td>
          <td align="left"><input type="text" name="application_name" value="" size="32" class="required" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" style="color:#085299;font-weight:bold">PowerBuilder Version:<em>*</em></td>
          <td align="left">
          		<select id="pbversion" name="pb_version">
					<option value="" selected="selected">Select the PowerBuilder Version</option>                    
                    <option value="PowerBuilder 9">PowerBuilder V9.0</option>
                    <option value="PowerBuilder 10">Power Builer V10.0</option>
                    <option value="PowerBuilder 11">Power Builer V11.0</option>
                    <option value="PowerBuilder 12">Power Builer V12.0</option>
                 </select>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" style="color:#085299;font-weight:bold">
            Database Vendor &amp; Version:<em>*</em></td>
          <td align="left"><input type="text" name="db_vendor_version" value="" size="32" class="required" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" style="color:#085299;font-weight:bold">Application Services:<em>*</em></td>
          <td valign="baseline" align="left">
              <table width="297" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><input name="services" type="radio" value="cost estimation" checked="checked" />
                    Cost Estimation</td>
                   <td><input type="radio" name="services" value="sample conversion" />
                    Sample Conversion</td> 
                </tr>
              </table>
          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" style="color:#085299;font-weight:bold">Target Technology:<em>*</em></td>
          <td valign="baseline">
          <table align="left" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><input name="target" type="radio" value="Java" checked="checked" />
                Java</td>
              <td><input type="radio" name="target" value=".Net" />
                .Net</td>
            </tr>
          </table>
         </td>
        </tr>                                    
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" style="color:#085299;font-weight:bold">Filename:<em>*</em></td>
          <td align="left">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <input type="file" name="filename" id="filename" class="required"/>
           </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" style="color:#085299;font-weight:bold"></td>
          <td align="left" style="color:#F00;font-weight:bold">
               Max File Size 10MB
           </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td align="left">
          <input type="submit" name="filename" id="filename" value="Upload" 
             style="margin-top:5px;color:#085299;font-weight:bold"/>
         </td>
        </tr>
      </table>
      <input type="hidden" name="temp" value="" />
      <input type="hidden" name="custid" value="" />
      <input type="hidden" name="cname" value="" />
      <input type="hidden" name="ticketno" value="" />
      <input type="hidden" name="status" value="" />
      <input type="hidden" name="MM_upload" value="form1" />
   </form>
   <p>&nbsp;</p>        
     </div>   
</div>	
<?php
	include("footer.php");
?>

                    