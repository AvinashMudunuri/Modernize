<?php 
	require_once('Connections/powermigrate.php'); 
	include("includes/common.php");
?>
<?php


$colname_confirmation = "-1";
if (isset($_GET['confirmcode'])) {
  $colname_confirmation = $_GET['confirmcode'];
}
mysql_select_db($database_powermigrate, $powermigrate);
$query_confirmation = sprintf("SELECT * FROM customers WHERE passkey = %s", GetSQLValueString($colname_confirmation, "text"));
$confirmation = mysql_query($query_confirmation, $powermigrate) or die(mysql_error());
$row_confirmation = mysql_fetch_assoc($confirmation);
$totalRows_confirmation = mysql_num_rows($confirmation);

if($totalRows_confirmation == 1){
	
	$update_confirmation_SQL = sprintf("UPDATE customers SET isactive = '1' WHERE passkey = %s", GetSQLValueString($colname_confirmation, "text"));
	$update_confirmation = mysql_query($update_confirmation_SQL, $powermigrate);
	$updateRow_confirmation = mysql_fetch_assoc($update_confirmation);
	$totalRows_updated = mysql_num_rows($update_confirmation);
	}else{
			die(mysql_error());
		}

?>
<?php include("header.php");?>
	<div id="main-content">
	   <div style="margin:3%; padding:5%;height:auto;">
       		
            <ul style="line-height:20px">
                	<li style="font-size:15px; line-height:20px"><br />
                    	Congratulations, <?php echo $row_confirmation['first_name']; ?>!  
                        Your account is now activated and you can begin using SoftSol's industry 
                        leading instant PowerBuilder migration tools.  
                    </li>
                    
                    <li style="font-size:15px;color:#1F497d; line-height:25px"><br />
                    	<?php 
							if (!isset($_SESSION)) {
								session_start();
							}
							$loginStrGroup = "";
							$MM_redirectLoginSuccess = "details.php";
							if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
							//declare two session variables and assign them
							$_SESSION['MM_Username'] 	= $row_confirmation['email'];
							$_SESSION['MM_UserGroup'] 	= $loginStrGroup;
							$_SESSION['MM_fname']	 	= $row_confirmation['first_name']; 
							$_SESSION['MM_lname'] 		= $row_confirmation['last_name'];
							header("Location: " . $MM_redirectLoginSuccess );
						?>
                       <div align="center"> 
                        <input type="button" value="Continue" style="margin:5px;color:#085299;
                font-weight:bold" onclick="location.href='details.php'" /></div>
                    </li>
                    
                </ul>
       </div>
    </div>
<?php include("footer.php");?>
<?php
mysql_free_result($confirmation);
mysql_free_result($update_confirmation);
?>
