<?php 
	require_once('Connections/powermigrate.php'); 
	include("includes/common.php");
?>
<?php

$colname_Recordset1 = "-1";
if (isset($_GET['username'])) {
  $colname_Recordset1 = $_GET['username'];
}
mysql_select_db($database_powermigrate, $powermigrate);
$query_Recordset1 = sprintf("SELECT * FROM customers WHERE username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $powermigrate) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
session_start();
$_SESSION['MM_Username']	= $_GET['username'];
$_SESSION['MM_fname'] 		= $row_Recordset1['first_name'];
$_SESSION['MM_lname'] 		= $row_Recordset1['last_name'];
$_SESSION['MM_UserGroup']	= "";

?>
<?php
include("Connections/powermigrate.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Softsol</title>
    <link href="css/base.css" 	   rel="stylesheet" media="screen" />
    <link href="css/homeStyle.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.validate.js"></script> 
    <script>
						
	</script>
	<script type="text/javascript">
    function checkCheckBox(f)
	{
		if (f.agree.checked == false )
		{
			alert("Please accept the terms and conditions");
			return false;
		}else
		return true;
    }
    //-->
    </script>    
     <style>
		label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
	</style>
</head>
<body>
    <div id="container">
        <div id="content">
            <div id="header">
                 <div id="logofull">
                	<div id="logo"></div>
                </div>
                <div id="logocurve" >
                     <img height="100" width="50" border="0" alt="" src="images/logocurve.gif"/> 
                 </div>
              <div style="width:570px;height:100px;float:left">
	           	  <div style="width:100%;height:58px;float:left">
                   		<div id="welcomeuser">
                        	<span class="headinglog">Welcome, <?php echo $row_Recordset1['first_name'];?> 
								<?php echo $row_Recordset1['last_name']; ?></span>
                                <a href="<?php echo $logoutAction ?>">
                                	<img src="images/b_logout.jpg" align="absbottom" border="0" style="padding-top:3px; padding-right:5px"/>
                                 </a>

                        </div> 	
                   </div>
                   <div style="width:100%;height:42px;float:left;background:url(images/logo_navbg.jpg) repeat-x">
                    	<ul id="nav">
                                <li class="top">
                                    <a class="top_link" href="details.php"><span style="float: left;">HOME</span></a>
                                </li>
                                <li class="top">
                                    <a class="top_link" href="#"><span style="float: left;">ABOUT</span></a>
                                </li>
                                <li class="top">
                                    <a class="top_link" href="solutions.php"><span style="float: left;">SOLUTIONS</span></a>
                                    <ul class="sub">
                                    	<li><a href="PB2J.php" class="fly">PowerBuilder 2 JSF</a></li>
                                        <li><a href="PB2N.php" class="fly">PowerBuilder 2 DotNet</a></li>
                                        <li><a href="ProjectApproach.php" class="fly">Project Approach</a></li>
									</ul>	
                                </li>
                                <li class="top">
                                    <a class="top_link" href="faq.php"><span style="float: left;">FAQ</span></a>
                                </li>
                                <li class="top">
                                    <a class="top_link thickbox" href="contactus.php" title="Contact Us">
                                    	<span style="float: left;">CONTACT US</span></a>
                                </li>
                            </ul>
                	</div>
                 </div>
            </div>
<div id="main-content">
	<div align="center" style="width:50%; height:auto;margin-left:30%;margin-right:30%;margin-top:10px">
        <br />
        <h1 align="center" class="bluehead18recharge">Thank You For Registering With ModernizeNow</h1>
        <br />
        <hr />
        <br />
        <p class="head14Grey" align="center">
            Details of Your Registration:
        </p>
        <br />
		<table width="92%" height="250"  align="center" cellpadding="15" cellspacing="15" >
            <tr valign="baseline" style="background:#edf7d4">
              <td align="left" nowrap="nowrap" style="color:#085299;font-weight:bold">User Name:</td>
              <td align="left" ><?php echo $row_Recordset1['username']; ?></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="left" style="color:#085299;font-weight:bold">First Name:</td>
              <td align="left"><?php echo $row_Recordset1['first_name']; ?></td>
            </tr>
            <tr valign="baseline" style="background:#edf7d4">
              <td align="left" style="color:#085299;font-weight:bold">Last Name:</td>
              <td align="left"><?php echo $row_Recordset1['last_name']; ?></td>
            </tr>
            <tr valign="baseline">
              <td align="left" style="color:#085299;font-weight:bold">E-Mail:</td>
              <td align="left"><?php echo $row_Recordset1['email']; ?></td>
            </tr>
            <tr valign="baseline" style="background:#edf7d4">
              <td nowrap="nowrap" align="left" style="color:#085299;font-weight:bold">Phone:</td>
              <td align="left" ><?php echo $row_Recordset1['phone']; ?></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="left" style="color:#085299;font-weight:bold">Company Name:</td>
              <td align="left"><?php echo $row_Recordset1['company_name']; ?></td>
            </tr>
          </table>
<br /><br />
         <div align="left">
            <h1 class="bluehead18recharge" align="center">Try our Conversion Tool</h1>
            <hr />
            <br />
             <p style="font-style:normal;color:#333;font-size:13px;padding-left:10px;line-height:18px">
               Click the button below to upload a PowerBuilder application for conversion.  
            You will be asked a few questions about the application and your preferences for the target platform.  
            Within 48 hours, we will email a link to you where you can view and browse the migrated application. 
            </p>
            <br />
            <div  align="center">
			<?php
              if (!isset($_SESSION)) {
                 session_start();
              }
              $loginUsername	=	$row_Recordset1['username'];
              $_SESSION['MM_Username'] = $loginUsername;
          	?>             
              <input type="button" value="Upload Your Code" style="margin-top:5px;color:#085299;
            font-weight:bold" onClick="location.href='upload.php'" />
            </div>        
  		</div>   
     </div>       
</div>
<?php include("footer.php");?>          
<?php
mysql_free_result($Recordset1);
?>
