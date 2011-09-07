<?php 
	require_once('Connections/powermigrate.php');
	include("includes/common.php"); 
	
?>
<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_login"])) && ($_POST["MM_login"] == "login_form")) 
{
	$error = array();
	
	if (!isset($_SESSION)) {
  	session_start();
	}
	
	$loginUsername		 = htmlspecialchars($_POST['email'],ENT_QUOTES);
	$password			 = sha1($_POST['password']);
	$MM_redirectLoginSuccess = "details.php";
	
	mysql_select_db($database_powermigrate, $powermigrate);
  
	  $LoginRS__query=sprintf("SELECT email, password FROM customers WHERE email=%s AND password=%s AND isactive = '1'",
		GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
	   
	  $LoginRS = mysql_query($LoginRS__query, $powermigrate) or die(mysql_error());
	  $LoginRS_Row = mysql_fetch_array($LoginRS);;
	  $loginFoundUser = mysql_num_rows($LoginRS);

	  $fname 	= $LoginRS_Row['first_name'];
	  $lname 	= $LoginRS_Row['last_name'];
	  $id 		= $LoginRS_Row['id'];
	  	
	  if ($loginFoundUser) {
			
			$update_LastLogin = sprintf("UPDATE customers SET last_login = NOW() WHERE email = %s", 			
				GetSQLValueString($loginUsername, "text"));
			$update_result = mysql_query($update_LastLogin, $powermigrate);

			$loginStrGroup = "";
			if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
			//declare two session variables and assign them
			$_SESSION['MM_Username'] = $loginUsername;
			$_SESSION['MM_UserGroup'] 	= $loginStrGroup;
			$_SESSION['MM_fname']	 	= $fname;
			$_SESSION['MM_lname'] 		= $lname;
			header("Location: " . $MM_redirectLoginSuccess );
		  }
		  else {
			$error['invalid'] = 'Invalid Username or Password';
	  }
}

?>

<?php include("header.php");?>
			<script type="text/javascript">
                 $(document).ready(function(){
					$("#login_form").validate();					
                  });
            </script>
            <div id="main-content">
            	<div id="indexImg">
                    <div id="banner">
                    	<div id="banner_text">
                        	<p class="bannerText" style="padding-top:40px; font-size:18px">Modernize Now.  Decide Later.
                            <p class="bannerText">&nbsp;</p>
							<p class="bannerText">
                            Migrate your PowerBuilder applications to Java or .NET web for free.You'll be able to view and test the translated 
							application at no cost or obligation before deciding whether to purchase.</p>
                            </p>
                            <br />
                         </div>
                         <div style="width:250px;padding-left:45px;">
                            <p class="button"><a href="register.php">Get Started Now</a></p>
                         </div>
                    </div>
                 </div>
           	  <div id="mid_content">
               		<div id="mid_left">
                    	<div id="mid_left_content">
                        	<p class="heading">4 Easy Steps to Migrate Your PowerBuilder Applications</p>
                            <ul class="mid_left_list">
                            	<li>Sign up for a ModernizeNow Account </li><br />
                                <li>Upload code for  each  PowerBuilder application you want to 
                                	migrate– indicating as a target either .NET or Java web </li><br />
                                <li>Within 48 hours , we'll send you a link to view and test the 
                                	migrated application--there is no cost or obligation for this service
								</li><br />
                                <li>If the modernized application is to  your satisfaction, 
                                	you can choose  to purchase the migrated code, 
	                               	which will be delivered immediately along with instructions for implementation
								</li>
                            </ul>
                        </div>
                    </div>
                    <div id="mid_center">
                    	<div id="mid_center_content">
                        	<p class="heading_center">&quot;SoftSol's automation tools were accurate and 
                            efficient in migrating all of our business logic to the new application&quot;</p>
                            <p>&nbsp;&nbsp;--Principle Project Manager, Genentech, Inc</p>
                            <br />
                            <p class="heading">Satisfied Modernization Clients</p>
                             <div id="images">
                             	<table width="100%" cellpadding="2" cellspacing="5">
                                	<tr>
                                    	<td>
                                        	<img src="images/hbo.png" align="baseline" alt="HBO" width="120" height="100" />
                                        </td>
                                        <td>
                                        	<img src="images/mittal.jpg" align="baseline" alt="HBO" width="120" height="100" />
                                        </td>
                                        <td>
                                        	<img src="images/california.png" align="baseline" alt="HBO" width="100" height="100" />
                                        </td>
                                    <tr>    
                                   	<tr>
                                    	<td>
                                        	<img src="images/calipers.jpg" align="baseline" alt="HBO" width="120" height="100" />
                                        </td>
                                        <td>
                                        	<img src="images/infor.png" align="baseline" alt="HBO" width="120" height="62" />
                                        </td>
                                        <td></td>
                                    <tr>    
                                </table>
	                         </div>
                        </div>
                    </div>
                    <div id="mid_right">
                    	<div id="mid_right_content">
                        	 <p class="heading">Existing User Login</p>
                             <form id="login_form" method="POST" name="login_form">
                                  <table align="center">
                                    <tr><td align="left"><label for="email">Email Address:</label></td></tr>
                                    <tr><td align="left"><input type="text" name="email" id="email" class="required email"  /></td></tr>
                                    <tr><td align="left"><label for="password">Password:</label></td></tr>
                                    <tr><td align="left">
                                    	<input type="password" name="password" id="password" class="required" minlength="6"/></td></tr>
                                    <tr>
                                        <td align="left">
                                           <input type="submit" value=" Login " style="margin-top:5px;color:#085299;font-weight:bold"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                           <a href="forgotPassword.php"> Forgot Password</a>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td align="left" class="error" style="text-wrap:normal">
											<?php
												if (isset($error)) {
												echo '<ul>';
												foreach ($error as $alert) {
													echo "<li class='warning'>$alert</li>\n";
												}
													echo '</ul>';
												}
											?>
                                        </td>
                                    </tr>
                                  </table>
                                  <input type="hidden" name="MM_login" value="login_form" />
                              </form>
                              <hr />
                              <p class="heading">Questions?</p>
                              <div id="leftside2">
                                <div id="iamonline">
                                    <div id="con1">
                                        <a class="thickbox " 
                                        href="http://www.softsol.net/contactus.aspx?KeepThis=true&TB_iframe=true&height=450&width=640" 
                                          title="Contact Us">Contact Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
              </div>
          </div>
 <?php include("footer.php");?>           