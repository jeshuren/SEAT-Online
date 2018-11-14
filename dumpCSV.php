<?php
if(isset($_POST["btnSubmit"]) && isset($_POST["database"]) && $_POST["database"] != "")
{
  $ini_array = parse_ini_file("config/config.cfg");

  $link = mysql_connect($ini_array['hostname'].':'.$ini_array['port'], $ini_array['username'], $ini_array['password']);
  $res = mysql_query("SHOW DATABASES");
  $dbName = null;
  while ($row = mysql_fetch_assoc($res)) {
    $x = split('_',$row['Database']);
    if ($x[1] == 'seat' && $x[2] == $_POST["database"])
    {
      $dbName = $row['Database'];
    }
  }
  if ($dbName == null){
    header('Location: '.'./?msg='.$_POST["database"].' database doesnt exists.');
  }
  else {

    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="output.csv"');
    $sql = "SELECT * FROM `tbl_output` limit 0,10";

    mysql_select_db($dbName);

    $fp = fopen('php://output', 'wb');
    $line = array('Student Roll Number', 'Course ID');
    fputcsv($fp, $line, ',');
    if ($result=mysql_query($sql,$link))
    {
      // Fetch one and one row
      while ($row=mysql_fetch_row($result))
      {
        // printf ("%s (%s)\n",$row[0],$row[1]);
        // echo "id: " . $row[0]. " - Name: " . $row[1]. "<br>";
        fputcsv($fp, $row, ',');
      }
      // Free result set
      // mysqli_free_result($result);
    }

    foreach ($user_CSV as $line) {
      // though CSV stands for "comma separated value"
      // in many countries (including France) separator is ";"
      fputcsv($fp, $line, ',');
    }
    fclose($fp);
  }
}
else {
  header('Location: '.'./?msg=Please input Database name.');
}
?>
