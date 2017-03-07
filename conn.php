<?php
$con = mysql_connect("localhost","CU0LKWnI","sB0Bpx43lJDu");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("CU0LKWnI", $con);
$sql = "CREATE TABLE Boarduser 
(
Name varchar(15),
pswd varchar(15),
)";
mysql_query($sql,$con);

mysql_close($con);
?>