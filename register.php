<html>
<body background="bg1.jpg">
<head>
<style>
body{
	color:white;
	margin:0px;
	padding:0px;
	text-align:center;
}
</style>
</head>
<h1>注册</h1><hr/>
<div class="lg">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
用户名：<input type="text" name="username"></br></br>
密码：<input type="password" name="password"></br></br>
<input type="submit">
</form>
</div>
<a href="index.php">懒得注册了，匿名挺好</a>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$Good=1;
	if(empty($_POST["username"]) && strlen($_POST["username"])<=15 )
	{
		echo "用户名不能为空或大于15个字符！<br/>";
		$Good=0;
	}

	$getFromdb=mysql_query("SELECT * FROM Boarduser");
	
		while($row = mysql_fetch_array($getFromdb))
		{
		    if($row['Name']==$_POST["username"])
			{
				echo "此用户名已被注册<br/>";
				$Good=0;
			}
		}
	if(empty($_POST["password"]) && strlen($_POST["password"])<=15 )
	{
		echo "密码不能为空或大于15个字符!<br/>";
		$Good=0;
	}
	if($Good)
	{
		$sql="INSERT INTO Boarduser (Name, pswd) 
                     VALUES 
					 ('$_POST[username]','$_POST[password]')";
          if (!mysql_query($sql,$con))
             {
                 die('Error: ' . mysql_error());
              }	
        else{			  
		echo "<script>alert('注册成功');</script>";}
		//setcookie("tuser",$_POST["username"],time()+300);
		//header("Location: board.php");
	}
}





?>

</body>
</html>