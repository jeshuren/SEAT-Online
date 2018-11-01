<html>
	<head>
		<title>SEAT Allocation Online</title>
	</head>
	<body>
	<table>
         <tr>
            <td>
				The files required to be uploaded are(please name the files accordingly),
				<ul>
				<li>students.csv</li>
				<li>courses.csv</li>
				<li>studentPreferences.csv</li>
				<li>slot_config.csv</li>
				</ul>
			</td>
            <td>
			Files currently available:</br>
			<?php
				$dir = "files/";
				// Open a directory, and read its contents
				if (is_dir($dir)){
				if ($dh = opendir($dir)){
					while (($file = readdir($dh)) !== false){
						if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'csv') {
							echo "<a href='download.php?name=".$dir.$file."'>".$file."</a></br>";
						}
					}
					closedir($dh);
				}
				}
			?>
			</td>
         </tr>
         
         <tr>
            <td>
				<form action="upload.php" method="post" enctype="multipart/form-data" name="formUploadFile">		
				<label>Select input files to upload:</label></br>
				<input type="file" name="files[]" multiple="multiple" /></br></br>
				<input type="submit" value="Upload File" name="btnSubmit"/>
				</form>
			</td>
            <td><a href="remove.php">Click here to remove the uploaded files</a></td>
         </tr>
      </table>
		
			
	</body>
</html>

