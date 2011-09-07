<?php 
	require_once('Connections/powermigrate.php');
	include("includes/common.php");
?>	
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
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
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_powermigrate, $powermigrate);
$query_Recordset1 = sprintf("SELECT id, first_name, last_name FROM customers WHERE email = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $powermigrate) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$_SESSION['MM_fname'] = $row_Recordset1['first_name'];
$_SESSION['MM_lname'] = $row_Recordset1['last_name'];

$_POST['custid'] = $row_Recordset1['id'];
$colname_Recordset2 = "-1";
if (isset($_POST['custid'])) {
  $colname_Recordset2 = $_POST['custid'];
}
mysql_select_db($database_powermigrate, $powermigrate);
$query_Recordset2 = sprintf("SELECT custid, services, target, ticketno, application_name, status FROM upload WHERE custid = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $powermigrate) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


?>
<?php include("header_new.php");?>
<div id="main-content">
	<div style="margin:5%; padding:5%;height:auto;">
    	<h1 class="bluehead18recharge" style="padding-left:5px">Status of Uploaded PowerBuilder Applications</h1>
        <hr />
        <br />
        <table class="poptable" cellpadding="0" cellspacing="0">
    	<thead>
        	<tr>
				<th>Application Name</th>
                <th>Ticket No</th>
                <th>Target Technoogy</th>
                <th>Services</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
			 <?php do { ?>
                <tr align="left">
                  <td><?php echo $row_Recordset2['application_name']; ?></td>
                  <td><?php echo $row_Recordset2['ticketno']; ?></td>
                  <td><?php echo $row_Recordset2['target']; ?></td>
                  <td><?php echo $row_Recordset2['services']; ?></td>
                  <td><?php echo $row_Recordset2['status']; ?></td>
                </tr>
             <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>        	
        </tbody>
    </table>
    <br />
     <div class="upload-block">
        <h1 class="bluehead18recharge">Try our Conversion Tool</h1>
        <hr />
        <br />
         <p style="font-style:normal;color:#000;font-size:13px;padding-left:10px;line-height:18px">
            Click the button below to upload a PowerBuilder application for conversion.  
            You will be asked a few questions about the application and your preferences for the target platform.  
            Within 48 hours, we will email a link to you where you can view and browse the migrated application. 
        </p>
        <br />
        <div align="center" style="padding:10px">
          <input type="button" value="Upload Your Code" style="margin-top:5px;color:#085299;
                font-weight:bold" onclick="location.href='upload.php'" />
        </div>        
  	</div>   
    </div>
</div>    
<?php include("footer.php"); ?> 
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
?>
