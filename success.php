<?php 
require_once('Connections/powermigrate.php');
require_once("includes/common.php");
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "User";
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
?>
<?php
$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_powermigrate, $powermigrate);
$query_Recordset1 = sprintf("SELECT * FROM upload WHERE ticketno = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $powermigrate) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php include("header_new.php"); ?>
	<div id="main-content">
	 	<div align="center" style="width:50%; height:auto;margin-left:30%;margin-right:20%;margin-top:10px">
            <br />
            <h1 align="center" class="bluehead18recharge">Successfully Uploaded your Application</h1>
            <br />
            <hr />
            <br />
			<p class="head14Grey" align="center">
            	Details of Your Uploaded Application:
            </p>
            <br />
            <table width="90%" height="250" align="center" cellpadding="15" cellspacing="15" >
                <tr valign="baseline" style="background:#edf7d4">
                  <td align="left" nowrap="nowrap" style="color:#085299;font-weight:bold">Application Name:</td>
                  <td align="left" ><?php echo $row_Recordset1['application_name']; ?></td>
                </tr>
                <tr valign="baseline" bgcolor="lightgrey">
                  <td  align="left" nowrap="nowrap" style="color:#085299;font-weight:bold">PowerBuilder Version:</td>
                  <td align="left" ><?php echo $row_Recordset1['pb_version']; ?></td>
                </tr>
                <tr valign="baseline" style="background:#edf7d4">
                  <td nowrap="nowrap" align="left" style="color:#085299;font-weight:bold">Database Vendor &amp; Version:</td>
                  <td align="left"><?php echo $row_Recordset1['db_vendor_version']; ?></td>
                </tr>
                <tr valign="baseline" bgcolor="lightgrey">
                  <td align="left" style="color:#085299;font-weight:bold">Application Services:</td>
                  <td align="left"><?php echo $row_Recordset1['services']; ?></td>
                </tr>
                <tr valign="baseline" style="background:#edf7d4">
                  <td align="left" style="color:#085299;font-weight:bold">Target Technology:</td>
                  <td align="left"><?php echo $row_Recordset1['target']; ?></td>
                </tr>
                <tr valign="baseline" bgcolor="lightgrey">
                  <td nowrap="nowrap" align="left" style="color:#085299;font-weight:bold">Ticket No:</td>
                  <td align="left"><?php echo $row_Recordset1['ticketno']; ?></td>
                </tr>
              </table>
<br />
              <br />
              <div align="center" style="width:150px;height:50px;margin-left:30%">
                <input type="button" value="  Back  " style="margin-top:5px;color:#085299;
                         font-weight:bold" onClick="location.href='details.php'" />
              </div>               	
        </div> 
	</div>
<?php include("footer.php"); ?>
<?php
mysql_free_result($Recordset1);
?>
