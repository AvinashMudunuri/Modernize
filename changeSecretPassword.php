<?php 
	require_once('Connections/powermigrate.php'); 
	include("includes/common.php");
?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_change"])) && ($_POST["MM_change"] == "form1")) 
{
	$error = array();
	$colname_Recordset1 = "-1";
	if (isset($_GET['confirmcode'])) {
	  $colname_Recordset1 = $_GET['confirmcode'];
	}
	mysql_select_db($database_powermigrate, $powermigrate);
	$query_Recordset1 = sprintf("SELECT * FROM customers WHERE passkey = %s AND isactive = '1' ", GetSQLValueString($colname_Recordset1, "text"));
	$Recordset1 = mysql_query($query_Recordset1, $powermigrate);
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	
	if($totalRows_Recordset1 == 1)
	{
		$temp_password 	= sha1($_POST['password']);
		$temp_email 	= $row_Recordset1['email'];

		$update_password_SQL = sprintf("UPDATE customers SET password = %s, last_updated = NOW() WHERE email = %s", 			
				GetSQLValueString($temp_password, "text"), 
				GetSQLValueString($temp_email, "text"));
		$update_password = mysql_query($update_password_SQL, $powermigrate);
		$updateRow_password = mysql_fetch_assoc($update_password);
		$totalRows_password = mysql_num_rows($update_password);
		
		$updateGoTo = "index.php";
		header(sprintf("Location: %s", $updateGoTo));	
		
	}else{
		$error['link'] 		= "Please Verify the Link";
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
	<div id="forgot" align="center" style="width:40%; height:300px;margin-left:30%;margin-right:30%;margin-top:10px">
   			<br />
            <h1 align="center" class="bluehead18recharge">Select Your New Password</h1>
            <br />
            <hr />
            <form action="" method="post" name="form1" id="form1">
                <table align="center">
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right" style="color:#1f497d;font-weight:bold">
                                     New password:<em>*</em></td>
        			 <td><input type="password" name="password" size="32" id="password" 
                                    class="required password" minlength="6"  /></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right" style="color:#1f497d;font-weight:bold">
                                     </td>
        			 <td style="text-wrap:normal; line-height:15px">
                     	Your password must be at least six characters  and at most fifteen characters, 
                    with any combination of letters and numbers.
                     </td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right" style="color:#1f497d;font-weight:bold">
                                    Re-enter new password:<em>*</em></td>
        			 <td><input type="password" name="password-confirm" size="32" class="required password" 
                                        equalTo="#password" minlength="6" /></td>
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
                <input type="hidden" name="MM_change" value="form1" />
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
mysql_free_result($Recordset1);
?>
