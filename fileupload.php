<?php
	header("Pragma: no-cache");
	header("Cache: no-cache");
?>
<?php
// define a constant for the maximum filename size
define ('MAX_FILE_SIZE', 10000000);

if (array_key_exists('filename', $_POST))
{
  // define constant for filename folder
  	$ftp_server = "modernizenow.com"; 
	$conn_id = ftp_connect($ftp_server); 
	
	// login with username and password 
	$ftp_user_name = "modernize"; 
	$ftp_user_pass = "Password1"; 
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
	ftp_pasv($conn_id, true); 
	// check connection 
	if ((!$conn_id) || (!$login_result))
		{ 
			echo "FTP connection has failed!"; 
			 echo "<br>";
			echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
			exit; 
		} else
		{ 
			echo "Connected to $ftp_server, for user $ftp_user_name";
			$targetfolder = "uploads";
			ftp_chdir($conn_id,$targetfolder);
			$company_name1 = "Soft";
			$uname = "sample";
			$appname = "Dell";
			echo "test1";
			echo "<br/>";
			echo is_dir($targetfolder);
			echo pathinfo("/uploads/Soft/sample/Dell/Appendix A.zip");
			$company_name = "/uploads/".$company_name1;
			if (file_exists("/uploads/Soft/sample/Dell/adine_kirnberg.zip")) 
			{
				echo "The file $company_name exists";
				ftp_chdir($conn_id,$company_name);
				if (file_exists($uname))
				{
					ftp_chdir($conn_id,$uname);
					ftp_mkdir($conn_id,$appname);
					ftp_chdir($conn_id,$appname);	
				} else
				{
					ftp_mkdir($conn_id,$uname);
					ftp_chdir($conn_id,$uname);
					ftp_mkdir($conn_id,$appname);
					ftp_chdir($conn_id,$appname);	
					$targetfolder = ftp_pwd($conn_id);
				}
			} else 
			{
				 echo "<br>";
				echo "The file $company_name does not exist";
				ftp_mkdir($conn_id,$company_name);
				ftp_chdir($conn_id,$company_name);
				ftp_mkdir($conn_id,$uname);
				ftp_chdir($conn_id,$uname);
				ftp_mkdir($conn_id,$appname);
				ftp_chdir($conn_id,$appname);
				$targetfolder = ftp_pwd($conn_id);
				echo "<br/>";
				echo $targetfolder;
			}
			
		} 
	
  define('UPLOAD_DIR', $targetfolder);
  // replace any spaces in original filename with underscores
  echo "<br/>";
  echo "hi";
  echo "<br/>";
  echo "test" .$_FILES['filename']['name'];
  echo "<br/>";
  echo "<br/>";
  $file = str_replace(' ', '_', $_FILES['filename']['name']);
  // create an array of permitted MIME types
  echo $file;
  $permitted = array('application/zip','application/x-zip-compressed','application/x-zip',
				  'multipart/x-zip','application/octet-stream','application/x-7z-compressed',
				  'application/x-alz','application/x-gzip','application/x-rar-compressed',
				  'application/x-compress','application/x-compressed');
  // filename if file is OK
   echo "<br>";
  echo $_FILES['filename']['type'];
  echo "<br>";
  echo $permitted;									
  echo $_FILES['filename']['size'];
   echo "<br>";
  if (in_array($_FILES['filename']['type'], $permitted)
      && $_FILES['filename']['size'] > 0 
      && $_FILES['filename']['size'] <= MAX_FILE_SIZE) {
				if ($_FILES["filename"]["error"] > 0)
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
						
						$fp = fopen($temp, 'r');
							$success = ftp_fput($conn_id, $file, $fp, FTP_BINARY);
							ftp_close($conn_id);
						fclose($fp);
					  }
					if ($success == 1) 
					{
						$_POST['custid']   		= $row_Recordset1['id']; 
						$_POST['ticketno'] 		=  rand(1,100000); 
						$_POST['status'] 		=  "uploaded";           
						$_POST['temp'] 			=  $file;
						
						$insertSQL = sprintf("INSERT INTO upload (custid, pb_version, db_vendor_version, services, 
						target, filename, ticketno, application_name, status) 	VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['custid'], "int"),
						   GetSQLValueString($_POST['pb_version'], "text"),
						   GetSQLValueString($_POST['db_vendor_version'], "text"),
						   GetSQLValueString($_POST['services'], "text"),
						   GetSQLValueString($_POST['target'], "text"),
						   GetSQLValueString($_POST['temp'], "text"),
						   GetSQLValueString($_POST['ticketno'], "int"),
						   GetSQLValueString($_POST['application_name'], "text"),
						   GetSQLValueString($_POST['status'], "text"));

						  $Result1 				= mysql_query($insertSQL, $powermigrate) or die(mysql_error());
						  $Result_Recordset1 	= mysql_fetch_assoc($Result1);
						  $affected_rows 		= mysql_affected_rows($Result1);
						  
						  
						  $tem 			= $_POST['ticketno'];
						  $pbversion 	= $_POST['pb_version'];
						  $dbversion 	= $_POST['db_vendor_version'];
						  $services		= $_POST['services'];
						  $target		= $_POST['target'];
						  
						  if($affected_rows == 1)
						  {
							$mail             = new PHPMailer();
							
							$body = "Dear   $uname, <br/> <br/>
									 
									 Thank you for uploading your $appname on ModernizeNow. 
									 <br/> <br/>
									 
									 Your Reference Number is $tem. <br/><br/>
									 
									 You have selected the following options : <br/>
									
									 <ul>
										<li>Application Name			: $appname<li>
										<li>PowerBuilder Version		: $pbversion<li>
										<li>Database Vendor & Version	: $dbversion<li>
										<li>Application Services		: $services<li>
										<li>Target Technology			: $target<li>
									 </ul><br/><br/>											 
									 
									 Within 48 hours, we will email a link to you where you can view and browse the migrated application.<br/> 
									 
									 The SoftSol Team"; 
									 
							$mail->IsSMTP(); 
							$mail->SMTPDebug  = 1;                     
							$mail->SMTPAuth   = true;                  // enable SMTP authentication
							//$mail->Host       = "relay-hosting.secureserver.net"; // sets the SMTP server
							$mail->Host       = "mail.softsolindia.com"; // sets the SMTP server
							$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
							$mail->Username	  = "amudunuri@softsolindia.com";
							$mail->Password	  = "softsol@123";					
							$mail->SetFrom('modernize-register-notify@softsolindia.com', 'ModernizeNow Registration');
							$mail->Subject    = "ModernizeNow Account Activation Mail";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
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
<form action="" method="post" enctype="multipart/form-data" name="filename" id="filename">
<p>
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
  <label for="image">Upload Code:</label>
  <input type="file" name="filename" id="filename" />
</p>
<p>
  <input type="submit" name="filename" id="filename" value="Upload" />
</p>
</form>
</body>
</html>
