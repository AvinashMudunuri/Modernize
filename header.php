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
	<link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css"/>
    <link href="css/thickbox.css" rel="stylesheet" type="text/css"/>
    <link rel="SHORTCUT ICON" href="images/favicon.ico">
    <script type="text/javascript" src="scripts/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="scripts/jquery.ui.core.js"></script>
	<script type="text/javascript" src="scripts/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="scripts/jquery.ui.accordion.js"></script>
	<script type="text/javascript" src="scripts/jquery.validate.js"></script>
    <script type="text/javascript" src="scripts/jquery.lightbox-0.5.js"></script>
    <script type="text/javascript" src="scripts/thickbox.js"></script>
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
        <div id="container1">
        	<div id="container11">
                <div id="content">
                    <div id="header">
                         <div id="logofull">
                            <div id="logo">
                                <a href="index.php"><img src="images/new_logo.jpg" /></a>
                                <a href="http://www.softsol.net" target="_new"><img src="images/small_logo.jpg" /></a>
                            </div>
                        </div>
                        <div id="logocurve" >
                             <img height="100" width="50" border="0" alt="" src="images/logocurve.gif"/> 
                         </div>
                      <div style="width:570px;height:100px;float:left">
                          <div style="width:100%;height:58px;float:left"></div>
                           <div style="width:100%;height:42px;float:left;background:url(images/logo_navbg.jpg) repeat-x">
                                <ul id="nav">
                                        <li class="top">
                                            <a class="top_link" href="details.php"><span style="float: left;">HOME</span></a>
                                        </li>
										<li class="top">
                                            <a class="top_link" href="solutions.php"><span style="float: left;">SOLUTIONS</span></a>
                                            <ul class="sub">
                                                <li><a href="PB2J.php" class="fly">PowerBuilder 2 JSF</a></li>
                                                <li><a href="PB2N.php" class="fly">PowerBuilder 2 Asp.Net</a></li>
                                            </ul>	                                
                                        </li>
										<li class="top">
                                            <a class="top_link" href="faq.php"><span style="float: left;">FAQ</span></a>
                                        </li>
                                        <li class="top">
                                            <a class="top_link" href="http://www.softsol.net/aboutus.aspx" target="_blank">
                                            	<span style="float: left;">ABOUT</span></a>
                                        </li>
                                        <li class="top">
                                            <a class="thickbox  top_link" 
                                            href="http://www.softsol.net/contactus.aspx?KeepThis=true&TB_iframe=true&height=450&width=640" 
                                            title="Contact Us">
                                                <span style="float: left;">CONTACT US</span></a>
                                        </li>
                                    </ul>
                            </div>
                         </div>
                    </div>