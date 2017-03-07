
<div class="lg">
<form method="POST" action="login.php" >
用户名：<input type="text" name="username"></br></br>
密码：<input type="password" name="password"></br></br>
<input type="submit"><br/><a href="register.php">没有账号？</a>
</form>
</div>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$con = mysql_connect("localhost","wpuser1","huanxiangwordpress");
     if (!$con)
      {
       die('Could not connect: ' . mysql_error());
      }

      if($con){
	     echo "fuck!";
		 mysql_select_db("php", $con);
         }
      

	$Good=1;
	if(empty($_POST["username"]))
	{
		echo "用户名不能为空！<br/>";
		$Good=0;
	}
	if(empty($_POST["password"]))
	{
		echo "密码不能为空!<br/>";
		$Good=0;
	}

	if($Good)
	{
		$getFromdb=mysql_query("SELECT * FROM Boarduser");
		$check=0;
		while($row = mysql_fetch_array($getFromdb)){
			if($_POST["username"] == $row['Name'] && $_POST["password"] == $row['pswd'])
			{
				echo "<script>alert('登陆成功');</script>";
				setcookie("tuser",$_POST["username"],time()+300);
		              header("Location: index.php");
					  $check=1;
			}
			
				
			
		}
		if($check==0){
			echo "<script>alert('登录名或密码错误');</script>";
		}
	}
	mysql_close($con);
}
?>
