<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Bootstrap Admin Theme</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="vendor/morrisjs/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div id="page-wrapper">
        <div class="row">
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
                $command = 'java -jar files/SEAT.jar < files/cliInput; tar czf files/seatOutput/emails.tar.gz files/seatOutput/studentEmails/';
                $proc = popen($command, 'r');
                echo '<pre>';
                while (!feof($proc))
                {
                  echo fread($proc, 4096);
                  @ flush();
                }
                echo '</pre>';
                $file = "files/seatOutput/output.csv";
                echo "<a href='download.php?name=".$file."'>Click Here to View the Output</a> (File is stored in /var/www/html/seat_allocation/files/seatOutput/output.csv)</br> ";
                $emails = "files/seatOutput/emails.tar.gz";
                echo "<a href='download.php?name=".$emails."'>Click Here to Download the Emails</a> (Files are stored in /var/www/html/seat_allocation/files/seatOutput/studentEmails/)</br>" ;
                echo "<form method='post' action='uploadDB.php'>" ;
                echo "Enter a name for Database to save: " ;
                echo "<input type='text' name='database'></br>" ;
                echo "<input type='submit' value='Save' name='btnSubmit'></br>" ;
                echo "</form>" ;
              }
            }
            else{
              echo "Please, Select file(s) to upload.";
            }
          }
          ?>
        </div>
        <!-- /.row -->
      </div>
      <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

  </body>

  </html>
