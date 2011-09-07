<?php 
	require_once('Connections/powermigrate.php'); 
	require_once("includes/common.php");
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO contacts (company_name, contact_name, job_title, telephone, email, comments) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['company_name'], "text"),
                       GetSQLValueString($_POST['contact_name'], "text"),
                       GetSQLValueString($_POST['job_title'], "text"),
                       GetSQLValueString($_POST['telephone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));

  mysql_select_db($database_powermigrate, $powermigrate);
  $Result1 = mysql_query($insertSQL, $powermigrate) or die(mysql_error());
  SendContactUsMail($_POST['company_name'], $_POST['contact_name'], $_POST['job_title'], $_POST['telephone'], $_POST['email'], $_POST['comments']);	
  $insertGoTo = "successpage.php?cname=".$_POST['contact_name'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php include("header.php");?>
<script type="text/javascript">
 $(document).ready(function(){
	$("#form1").validate();
  });
</script>
<div id="main-content">
	<div style="margin:10%; padding:2%;height:auto;">
    	<h1 class="bluehead18recharge" style="padding-left:5px">Contact Us</h1>
        <hr />
        <div style="float:left; width:450px; height:auto;margin:15px;">
          <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="left">
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">Company Name:<em>*</em></td>
                <td><input type="text" name="company_name" class="required" value="" size="25" /></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">Contact Name:<em>*</em></td>
                <td><input type="text" name="contact_name" value="" class="required" size="25" /></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">Job Title:<em>*</em></td>
                <td><input type="text" name="job_title" value="" class="required" size="25" /></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">Telephone:<em>*</em></td>
                <td><input type="text" name="telephone" value="" class="required phone" size="25" /></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">Email:<em>*</em></td>
                <td><input type="text" name="email" value="" class="required email" size="25" /></td>
              </tr>
              <tr valign="middle">
                <td nowrap="nowrap" align="center" valign="top">Comments:</td>
                <td><textarea name="comments" cols="15" style="width:300px" wrap="virtual"  dir="ltr"></textarea></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">&nbsp;</td>
                <td align="left" ><input type="submit" value="Submit" style="margin-top:5px;color:#085299;font-weight:bold" /></td>
              </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1" />
          </form>
          <p>&nbsp;</p>
        </div>
        <div style="float:left; width:200px; height:200px;margin:5px;padding:10px;border:1px solid #999">
       	  <br />
          <p style="font-style:normal;color:#09F;font-size:13px;padding-left:15px;font-weight:bold">U.S. Location:</p>
       	  <p style="font-style:normal;color:#000;font-size:13px;padding-left:15px;padding-top:15px; line-height:18px">
            Fremont, California,<br>
                48383 Fremont Blvd, Suite #116,<br>
                Fremont, CA-94538<br><br>
                
                Phone: 510-824-2000<br>
                Fax: 510-824-2098<br>
                E-mail: info@softsol-grp.com<br>
             </p>
        </div>
    </div>
</div>
<?php include("footer.php");?>