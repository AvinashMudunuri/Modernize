<?php include("header.php") ?>
<div id="main-content">
	<div id="solutionsImg" style="padding:15px"><img src="images/solutions.jpg" /></div>
    <div id="leftside">
    	<TABLE width="210" border="0" cellspacing="0" cellpadding="0">
 		 <TBODY><TR>
    		<TD><DIV class="applemenu">
                <DIV class="left_top">
                <DIV style="padding-left: 15px; float: left; width: 150px; text-align: left;">Solutions</DIV>
                </DIV>
                <DIV class="left_top1solution">
                <DIV style="border-bottom: 1px solid rgb(224, 224, 224); display: block; float: left; width: 198px; 
                	padding-left: 10px; padding-bottom: 2px; padding-top: 10px;"><SPAN class="tail"><A href="solutions.php">Overview</A></SPAN></DIV>
                <BR/>
               
                <DIV style="border-bottom: 1px solid rgb(224, 224, 224); display: block; float: left; padding-top: 2px;
                	 padding-bottom: 2px; width: 198px; padding-left: 10px;"><SPAN class="tail2"><A href="#">PowerBuilder 2 JSF</A></SPAN></DIV>
                <BR/>
                <DIV style="border-bottom: 1px solid rgb(224, 224, 224); display: block; float: left; padding-top: 2px;
                	 padding-bottom: 2px; width: 198px; padding-left: 10px;"><SPAN class="tail"><A href="PB2N.php">PowerBuilder 2 Asp.Net</A></SPAN></DIV>
                <BR/>
              
                <DIV style="border-left: 1px solid rgb(0, 81, 148); border-right: 1px solid rgb(0, 81, 148); display: block; height: 15px; 
                	margin-left: 2px; float: left; width: 210px; background-color: rgb(0, 81, 148);">&nbsp;</DIV>
                </DIV>
             </TD>
          </TR></TBODY>
        </TABLE>
        <div id="leftside2">
        	<div id="iamonline">
            	<div id="con1">
                	<a class="thickbox " href="http://www.softsol.net/contactus.aspx?KeepThis=true&TB_iframe=true&height=450&width=640" 
                                            title="Contact Us">Contact Now</a>
                </div>
            </div>
        </div>
    </div>
    <div id="rightside">
    	<div>
        	<br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:10px;line-height:18px">
                            P2J Tool transparently converts PowerBuilder Application into JSF Based J2EE application with minimum or no manual refactoring. JSF is a component event driven based MVC 2 framework.  And, it suits well with PowerBuilder component events delegation. The translated J2EE components built using industry standard open source Myfaces components to handle rich UI Lookup. All PowerBuilder functions are translated into equivalent java functions with same hierarchy as in PowerBuilder functions.
                        </p><br />
                        <p style="font-style:normal;color:#333;font-size:13px;padding-left:10px;line-height:18px">
                            Similarly Business logic embedded in Non visual objects are carried to POJO based Application service objects which would be directly controlled from Managed/Backing beans. Data access to persistence is provided using DAO access layer with flexibility of replacing with ORM DAO layer.
                        </p><br />        
        </div>
        <div style="padding:27px">
        	<img src="images/PB2J.jpg" height="500" width="600" />
        </div>
        <div>
            <br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:10px">
            	     The application is layered as per below details
            </p><br />
            <dl>
            <dt style="font-style:normal;color:#333;font-size:13px;padding-left:10px;font-weight:bold">
             Presentation Layer:
            </dt><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:15px">
            	    This layer consists of the following components:
            </p><br />
                <ol class="list">
                <li>
                   <b>JSF MyFaces</b> Components which are industry standard and light weight.
                </li>
                <br />
                <li>
                   <b>A4J</b> Components for interactive event delegation from Client to Server apart from the JSF managed beans control
                </li>
                <br />
                <li>
                    All Reports will be handled by Jasper Reports.
                </li>
               </ol> 
                <br />
			<dt style="font-style:normal;color:#333;font-size:13px;padding-left:10px;font-weight:bold">
             Business Logic:
            </dt><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:15px">
            	    This layer consists of the following components:
            </p><br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:15px;line-height:18px">
            	   <b>Managed Bean / Backing Bean:</b> The bean classes provide the interface between the UI JSF pages and services of server layer. Also handles the event handling and data entry validations
            </dd><br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:15px;line-height:18px">
            	   <b>Business Components:</b> These are normal Java POJO classes providing interface to backend database through DAO layer.
            </dd><br />
            <dt style="font-style:normal;color:#333;font-size:13px;padding-left:10px;font-weight:bold">
             Data Access Layer:
            </dt><br />	
             <dd style="font-style:normal;color:#333;font-size:13px;padding-left:15px;line-height:18px">
            	  <b>Data Access Components:</b> DAO access is done by centralized query executor which handles all Database CRUD (Create-Read-Update-Delete) operations, which is a single interface built on JDBC API or Spring JDBC. 
            </dd><br />
            </dl>
        </div>
    </div>
</div>
<?php include("footer.php") ?>