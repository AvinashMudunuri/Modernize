<?php 
	require_once('Connections/powermigrate.php'); 
	include("includes/common.php");
	require_once("includes/class.phpmailer.php");
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_forgot"])) && ($_POST["MM_forgot"] == "form1")) {
	$error = array();
	
	$colname_forgotPassword = "-1";
	if (isset($_POST['email'])) {
	  $colname_forgotPassword = $_POST['email'];
	}
	if (!$error) 
	{
		mysql_select_db($database_powermigrate, $powermigrate);
		$query_forgotPassword = sprintf("SELECT * FROM customers WHERE email = %s", GetSQLValueString($colname_forgotPassword, "text"));
		$forgotPassword = mysql_query($query_forgotPassword, $powermigrate) or die(mysql_error());
		$row_forgotPassword = mysql_fetch_assoc($forgotPassword);
		$totalRows_forgotPassword = mysql_num_rows($forgotPassword);
		
		if($totalRows_forgotPassword != 1)
		{
			$error['email'] 	= $_POST['email'] . ' is not present in our database. Please Verify again';
		}else{
				$mail             = new PHPMailer();
				
				$fname 		= $row_forgotPassword['first_name'];
				$lname 		= $row_forgotPassword['last_name'];
				$passkey	= $row_forgotPassword['passkey'];
				
				$body = "Dear   $fname $lname, <br/> <br/>
						 
						 This email was sent automatically by eBay in response to your request to recover your password.<br/> 
						 This is done for your protection; only you, the recipient of this email can take the next step in the 
						 password recover process. <br/><br/>
						 
						 To reset your password and access your account copy and paste the following link into the 
						 address bar of your browser:<br/><br/>
						 
						 http://localhost:8080/PM/changeSecretPassword.php?confirmcode=$passkey <br/><br/>
						 
						 If you did not forget your password, please ignore this email.<br/><br/>
						 
						 This request was made from:<br/>
						 
						 IP address	: " .$_SERVER['REMOTE_ADDR'] . "<br/> 
						 ISP host	:  ";
						 
						 
				$mail->IsSMTP(); 
				$mail->SMTPDebug  = 1;                     
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				//$mail->Host       = "relay-hosting.secureserver.net"; // sets the SMTP server
				$mail->Host       = "mail.softsolindia.com"; // sets the SMTP server
				$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
				$mail->Username	  = "amudunuri@softsolindia.com";
				$mail->Password	  = "softsol@123";					
				$mail->SetFrom('modernize-register-notify@softsolindia.com', 'ModernizeNow');
				$mail->Subject    = "Forgotten Password";
				$mail->MsgHTML($body);				
				$mail->AddAddress($_POST['email'], $_POST['first_name'].$_POST['last_name']);
				
				if(!$mail->Send()) {
					  $error['Mailer Error'] = "Mailer Error: " . $mail->ErrorInfo;
					} else {
							$insertGoTo = "checkYourMail.php?email=".$_POST['email'];
						  if (isset($_SERVER['QUERY_STRING'])) {
							$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
							$insertGoTo .= $_SERVER['QUERY_STRING'];
						  }
						  header(sprintf("Location: %s", $insertGoTo));
					}			
		}
	}
}
?>
<?php include("header.php"); ?>
<script type="text/javascript">
 $(document).ready(function(){
	$("#form1").validate();
  });
</script>
<div id="main-content">
	<div id="forgot" align="center" style="width:40%; height:200px;margin-left:30%;margin-right:30%;margin-top:10px">
   			<br />
            <h1 align="center" class="bluehead18recharge">Forgot Password</h1>
            <br />
            <hr />
            <br />
			<p class="head14Grey" align="center">
            	Please Enter your Email-Id to Send your New Password:
            </p>
            <br />
            <form action="" method="post" name="form1" id="form1">
                <table align="center">
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right" style="color:#1f497d;font-weight:bold">
                                     Enter your Email:<em>*</em></td>
        			 <td><input type="text" name="email" id="emailid" size="32" class="required email" /></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">&nbsp;</td>
                      <td>
                      <input type="submit" name="submit" value=" Submit " id="btnsubmit" style="margin-top:5px;color:#085299;font-weight:bold"/>
                     </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="left">
                            <span id="msgbox" style="display:none;color:#F00;font-weight:bold"></span>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="MM_forgot" value="form1" />
           </form>
           <br />
           <div class="error" style="width:500px;color:#1f497d;font-weight:bold;text-wrap:normal" align="center">
			  <?php
                    if (isset($error)) {
                    echo '<ul>';
                    foreach ($error as $alert) {
                        echo "<li class='warning'>$alert</li>\n";
                    }
                        echo '</ul>';
                    }
                ?>
	      </div>
    </div>	
</div>
<?php include("footer.php"); ?>
<?php
mysql_free_result($forgotPassword);
?>
