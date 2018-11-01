<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SEAT Admin</title>

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
                <div class="col-lg-12">
                    <h1 class="page-header">SEAT Allocation - Admin View</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">  
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            File Upload
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            The files required to be uploaded are(please name the files accordingly),
							<ul>
							<li>students.csv</li>
							<li>courses.csv</li>
							<li>studentPreferences.csv</li>
							<li>slot_config.csv</li>
							</ul>
							
							<form action="upload.php" method="post" enctype="multipart/form-data" name="formUploadFile">
							<label>Select input files to upload:</label></br>
							<input type="file" name="files[]" multiple="multiple" /></br></br>
							<button type="submit" class="btn btn-primary" name="btnSubmit">Upload File</button>
							</form>
							
							</br>
							<a href="remove.php"><button type="button" class="btn btn-danger">Remove Uploaded Files</button></a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
				</div>
				
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Uploaded Files
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php
                                $dir = "files/";
                                // Open a directory, and read its contents
                                if (is_dir($dir)){
                                if ($dh = opendir($dir)){
                                        while (($file = readdir($dh)) !== false){
                                                if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'csv') {
                                                        echo "<a href='download.php?name=".$dir.$file."'>".$file."</a></br> "; 
                                                }
                                        }
                                        closedir($dh);
                                }
                                }
                        ?>
						</div>
                        <!-- /.panel-body -->
                    </div>
				</div>                       
            
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
