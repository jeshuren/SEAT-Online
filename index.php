<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
  header("location: allocation.php");
}
?>
<!DOCTYPE html>
<html lang="en">

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
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">SEAT Allocation</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Login
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <form action="" method="post">
                <div class="form-group">
                  <label>UserName :</label>
                  <input class="form-control" id="name" name="username" placeholder="username" type="text" size="20"></br>
                  <label>Password :</label>
                  <input class="form-control" id="password" name="password" placeholder="**********" type="password" size="20"></br>
                  <button name="submit" type="submit" class="btn btn-default">Login</button>
                  <span><?php echo $error; ?></span>
                </form>

              </div>
              <!-- /.panel-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
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

</body>

</html>
