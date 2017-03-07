
<html>
<body background="bg1.jpg">
<head>
<title>
留言板V2
</title>
<style>
body{
	color:white;
	margin:0px;
	padding:0px;
	text-align:center;
}
</style>
</head>
<h1>留言板：</h1>
<hr/>
<?php
$con = mysql_connect("localhost","wpuser1","huanxiangwordpress");
      if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
      mysql_select_db("php", $con);
?>

<?php

if(isset($_GET['logout'])){
	setcookie("tuser","",time()-300);
	header("Location: index.php");
}

if(!isset($_COOKIE["tuser"]) && !isset($_COOKIE["user1"]))
{
setcookie("user1",time(),time()+6000000);
header("Location: index.php");
}
else if(isset($_GET['login'])){
	require_once ('login.php');
}
else
{
require_once('board.php');

}


if(isset($_GET['del']) && isset($_COOKIE["tuser"]) )
{
    $del=$_GET['del'];
	$getFromdb=mysql_query("SELECT * FROM message WHERE ID='$_GET[del]'");
    while($row = mysql_fetch_array($getFromdb)){
				if($_COOKIE["tuser"] == $row['Name'])
				{
					mysql_query("DELETE FROM message WHERE ID='$del'");
					header("Location: index.php");
				}
				else
					
					echo "<script>alert('您无权删除该评论');</script>";
	}
}
				
mysql_close($con);
?>

</body>
</html>