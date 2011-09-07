<?php ini_set('upload_tmp_dir', 'D:/Temp/php/uploads');?>
<?php 
	
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	
	$permitted = array('application/zip','application/x-zip-compressed','application/x-zip',
				  'multipart/x-zip','application/octet-stream','application/x-7z-compressed',
				  'application/x-alz','application/x-gzip','application/x-rar-compressed',
				  'application/x-compress','application/x-compressed');

	if (in_array($_FILES['file']['type'], $permitted) && ($_FILES["file"]["size"] < 10485760))
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
	  else
		{
			echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . $_FILES["file"]["size"] . " <br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	
			if (file_exists("uploads" . $_FILES["file"]["name"]))
			  {
			 	 echo $_FILES["file"]["name"] . " already exists. ";
			  }
			else
			  {
				  move_uploaded_file($_FILES["file"]["tmp_name"],
				  "uploads/" . $_FILES["file"]["name"]);
				  echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
			  }
		}
	  }
	else
	  {
	  	echo "Invalid file";
	  }	
	
?>
<?php include("header_new.php"); ?>
<div id="main-content">
	<div align="center" style="width:60%; height:auto;margin-left:20%;margin-right:20%;margin-top:10px">
       
	<div class="error" style="width:500px" align="center">
          <?php
                if (isset($error)) {
                echo '<ul>';
                foreach ($error as $alert) {
                    echo "<li class='warning'>$alert</li>\n";
                }
                    echo '</ul>';
                }
            ?>
      </div><br />
	
                     
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
      <table align="center" border="0" cellpadding="0" cellspacing="0">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" style="color:#085299;font-weight:bold">Filename:<em>*</em></td>
          <td align="left">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <input type="file" name="file" id="file" class="required"/>
           </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" style="color:#085299;font-weight:bold"></td>
          <td align="left" style="color:#F00;font-weight:bold">
               Max File Size 10MB
           </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td align="left">
          <input type="submit" name="filename" id="filename" value="Upload" 
             style="margin-top:5px;color:#085299;font-weight:bold"/>
         </td>
        </tr>
      </table>
   <input type="hidden" name="MM_upload" value="form1" />
   </form>
   <p>&nbsp;</p>        
     </div>   
</div>
<?php include("footer.php");?>
