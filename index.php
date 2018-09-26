<html>
	<head>
		<title>SEAT Allocation Online</title>
	</head>
	<body>
		The files required to be uploaded are(please name the files accordingly),
		<ul>
		<li>students.csv</li>
		<li>courses.csv</li>
		<li>studentPreferences.csv</li>
		<li>slot_config.csv</li>
		</ul>
		<form method="post" enctype="multipart/form-data" name="formUploadFile">		
			<label>Select input files to upload:</label></br>
			<input type="file" name="files[]" multiple="multiple" /></br></br>
			<input type="submit" value="Upload File" name="btnSubmit"/>
		</form>		
		<?php
			if(isset($_POST["btnSubmit"]))
			{
				$errors = array();
				$uploadedFiles = array();
				$extension = array("csv");
				$bytes = 1024;
				$KB = 1024;
				$totalBytes = $bytes * $KB;
				$UploadFolder = "files/upload";
				
				$counter = 0;
				
				foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
					$temp = $_FILES["files"]["tmp_name"][$key];
					$name = $_FILES["files"]["name"][$key];
					
					if(empty($temp))
					{
						break;
					}
					
					$counter++;
					$UploadOk = true;
					
					if($_FILES["files"]["size"][$key] > $totalBytes)
					{
						$UploadOk = false;
						array_push($errors, $name." file size is larger than the 1 MB.");
					}
					
					$ext = pathinfo($name, PATHINFO_EXTENSION);
					if(in_array($ext, $extension) == false){
						$UploadOk = false;
						array_push($errors, $name." is invalid file type.");
					}
					
					if(file_exists($UploadFolder."/".$name) == true){
						$UploadOk = false;
						array_push($errors, $name." file is already exist.");
					}
					
					if($UploadOk == true){
						move_uploaded_file($temp,$UploadFolder."/".$name);
						array_push($uploadedFiles, $name);
					}
				}
				
				if($counter>0){
					if(count($errors)>0)
					{
						echo "<b>Errors:</b>";
						echo "<br/><ul>";
						foreach($errors as $error)
						{
							echo "<li>".$error."</li>";
						}
						echo "</ul><br/>";
					}
					
					if(count($uploadedFiles)>0){
						echo "<b>Uploaded Files:</b>";
						echo "<br/><ul>";
						foreach($uploadedFiles as $fileName)
						{
							echo "<li>".$fileName."</li>";
						}
						echo "</ul><br/>";
						
						echo count($uploadedFiles)." file(s) are successfully uploaded.";
						$command = 'java -jar files/SEAT.jar < files/cliInput';
						$op_status = exec($command);
						$file = "files/seatOutput/output.csv";
						echo "<a href='download.php?name=".$file."'>Click Here to View the Output</a> ";
					}								
				}
				else{
					echo "Please, Select file(s) to upload.";
				}
			}
		?>
	</body>
</html>
