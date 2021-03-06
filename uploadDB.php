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
    <?php include("sideBar.php"); ?>
    <div id="page-wrapper">
      <div class="row">
        <?php
        if(isset($_POST["btnSubmit"]))
        {

          $errors = array();


          $ini_array = parse_ini_file("config/config.cfg");

          $link = mysql_connect($ini_array['hostname'].':'.$ini_array['port'], $ini_array['username'], $ini_array['password']);
          $res = mysql_query("SHOW DATABASES");
          while ($row = mysql_fetch_assoc($res)) {
            $x = split('_',$row['Database']);
            if ($x[1] == 'seat' && $x[2] == $_POST["database"])
            {
              array_push($errors, $_POST["database"]." exists. Please try another name.");
            }
          }


          $lines = file('files/cliInput');

          // Pop the last item from the array
          array_pop($lines);

          if ($_POST["coursePreferences"] == "1") {
            $lines[5] = "files/seatOutput/coursePreferences.csv\n";
          }

          // Join the array back into a string
          $file = join('', $lines);

          // Write the string back into the file
          $file_handle = fopen('files/cliInput_temp', 'w');
          fputs($file_handle, $file);
          fputs($file_handle, "1");
          fputs($file_handle, "\n".$_POST["database"]);
          fclose($file_handle);


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
          else{

            $command = 'java -jar files/SEAT.jar < files/cliInput_temp';
            $proc = popen($command, 'r');
            echo '<pre>';
            while (!feof($proc))
            {
              echo fread($proc, 4096);
              @ flush();
            }
            echo '</pre>';
            $outputfile = "files/seatOutput/output.csv";
            echo "<a href='download.php?name=".$outputfile."'>Click Here to View the Output</a> (File is stored in /var/www/html/seat_allocation/files/seatOutput/output.csv)</br> ";
            if ($_POST["coursePreferences"] == "1") {
              $coursePrefFile = "files/seatOutput/coursePreferences.csv";
              echo "<a href='download.php?name=".$coursePrefFile."'>Click Here to View the Generated coursePreferences</a> (File is stored in /var/www/html/seat_allocation/files/seatOutput/coursePreferences.csv)</br> ";
            }
            $emails = "files/seatOutput/emails.tar.gz";
            echo "<a href='download.php?name=".$emails."'>Click Here to Download the Emails</a> (Files are stored in /var/www/html/seat_allocation/files/seatOutput/studentEmails/)</br>" ;
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
