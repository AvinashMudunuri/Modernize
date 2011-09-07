<?php
	require_once("includes/common.php");
	$user 		= "amudunuri";
	$tckno		= "45455";
	$pbversion		= "PowerBuilber 11";
	$dbversion		= "oracle11";
	$appservices		= "java";
	$target		=	"Cost";
	$fname = "avinash";
	$lname = "Mudunuri";
	$email	= "amudunuri@softsolindia.com";
				
	$result = sendRegisterMail($user, $fname, $lname, $email);
	//$result = sendUploadMail($user, $tckno, $pbversion, $dbversion, $appservices, $target, $email);
	echo $result;
?>