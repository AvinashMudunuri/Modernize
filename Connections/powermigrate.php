<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//Development

/*$hostname_powermigrate = "localhost:5000";
$database_powermigrate = "powermigrate";
$username_powermigrate = "root";
$password_powermigrate = "sa";*/

//Production

$hostname_powermigrate = "powermigratetool.db.5884614.hostedresource.com";
$database_powermigrate = "powermigratetool";
$username_powermigrate = "powermigratetool";
$password_powermigrate = "Softsol@123";
$powermigrate = mysql_pconnect($hostname_powermigrate, $username_powermigrate, $password_powermigrate) or trigger_error(mysql_error(),E_USER_ERROR); 

#FTP Details

$ftp_server = "modernizenow.com"; 
$ftp_user_name = "modernize"; 
$ftp_user_pass = "Password1";
$conn_id = ftp_connect($ftp_server); 


error_reporting("0");
date_default_timezone_set('America/Toronto');

ini_set('upload_max_filesize', '10M');
ini_set('display_errors', '0');



?>
