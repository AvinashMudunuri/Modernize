<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to SoftSol</title>
	<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.validate.js"></script>
    <script>
		 $(document).ready(function(){
			$("#form1").validate();
  		});
	</script>
     <style>
		label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
	</style>
</head>
<body>
<div align="center">
	<div style="height: auto;">
	  <div style="width: 420px; height: auto; float: left;">
			<div style="width: 420px; height: auto; padding-bottom: 18px; text-align: left; 
        	font-weight: bold; font-family: Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 15px; color:#639ACE; float: left;">
            <p>
            	Please Enter your Email
            </p>
            <form name="form1" action="" method="post" id="form1">	
                <table align="center" style="font-family:Trebuchet MS', Arial, Helvetica, sans-serif">
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right" style="color:#000; font-weight:normal;">Email:<em style="color:#F00">*</em></td>
                      <td>
                            <input type="text" name="username" remote ="form.check-username.php" size="20" class="required email" minlength="6" />
                      </td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">&nbsp;</td>
                      <td><input type="submit" value="Submit" style="margin-top:5px;color:#085299;font-weight:bold" /></td>
                    </tr>                            
                </table>
           </form>            
            
		</div>
</div>
	</div>
</div>
</body>
</html>