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
                	 padding-bottom: 2px; width: 198px; padding-left: 10px;"><SPAN class="tail"><A href="PB2J.php">PowerBuilder 2 JSF</A></SPAN></DIV>
                <BR/>
                <DIV style="border-bottom: 1px solid rgb(224, 224, 224); display: block; float: left; padding-top: 2px;
                	 padding-bottom: 2px; width: 198px; padding-left: 10px;"><SPAN class="tail2"><A href="PB2N.php">PowerBuilder 2 Asp.Net</A></SPAN></DIV>
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
            	Below diagram and the following text content provides high level architecture and component level recommendations for each application layer.
            </p><br />
        </div>
        <div style="padding:27px">
        	<img src="images/PB2N.jpg" height="500" width="600" />
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
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:10px">
            	    This layer consists of the following components:
            </p><br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:30px;line-height:18px">
               <b> jQuery</b> is a client side technology, supported by Microsoft. It is pretty light weight library which makes interaction between HTML and JavaScript very easy. Client side Development and maintainability is very much simplified using this library.
            </dd>
            <br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:30px;line-height:18px">
             The design will include a combination of <b>ASP.NET Framework</b> with the <b>Ajax Control Toolkit</b> for server-side Ajax and jQuery for client-side Ajax.
            </dd>
            <br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:30px;line-height:18px">
              <b>Silverlight:</b> During the requirements phase the modules, where high performance is required, will be implemented using Silverlight. They simulate a standard desktop client without post backs and callbacks
            </dd>
            <br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:30px;line-height:18px">
              All Reporting capabilities will be handled by <b>Microsoft RDLC</b> (Report Definition Language Client-side).
            </dd>
            <br />
			<dt style="font-style:normal;color:#333;font-size:13px;padding-left:15px;font-weight:bold">
             Business Logic:
            </dt><br />
            <dl style="font-style:normal;color:#333;font-size:13px;padding-left:15px">
            	    This layer consists of the following components:
            </dl><br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:25px;line-height:18px">
            	   <b>Facade: </b> Abstraction is used to implement loose coupling between layers. This is    accomplished by defining interface components, such as a facade. The façade layer is exposed to the Clients
            </dd><br />
            <dd style="font-style:normal;color:#333;font-size:13px;padding-left:25px;line-height:18px">
            	   <b>Business Components:</b> These components implement the business logic of the application. This layer contains both the business logic and also act as a data transfer layer to the presentation layer.
            </dd><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:20px;font-weight:bold">
             Business Entities:
            </p><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:30px;line-height:18px">
              •	Business entity classes are used to transfer data across layers. These entities reduce the coupling among different layers.
            </p>
            <br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:30px">
              •	Data will be passed across the layers of the application using thee Business Entities. 
            </p>
            <br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:30px">
              •	These entities are implemented using custom object-oriented classes
            </p>
            <br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:15px;font-weight:bold">
             Data Access Layer:
            </p><br />	
             <p style="font-style:normal;color:#333;font-size:13px;padding-left:25px;line-height:18px">
            	  <b>Data Access Components:</b>Data access components abstract the logic necessary to communicate with the underlying data store. 
            </p><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:15px;font-weight:bold">
             Cross Cutting Components:
            </p><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:25px">
            	   This section is a part of all the Layers. It includes the following:
            </p><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:50px">
              •	<b>Security</b>
            </p><br />
            <p style="font-style:normal;color:#333;font-size:13px;padding-left:50px">
              •	<b>Exception</b>
            </p><br />
             <p style="font-style:normal;color:#333;font-size:13px;padding-left:50px">
              •	<b>Logging</b>
            </p><br />	
             <p style="font-style:normal;color:#333;font-size:13px;padding-left:50px">
              •	<b>Caching</b>
            </p><br />
         </dl>   			
        </div>
    </div>
</div>
<?php include("footer.php") ?>