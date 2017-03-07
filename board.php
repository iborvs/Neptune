<html>
<head>

<style>
body{
	color:white;
	margin:0px;
	padding:0px;
	text-align:center;
}
span
{
width:500px;
height:200px;
background-color:#9F79EE;
-moz-box-shadow: 5px 5px 2.5px #888888;
box-shadow: 5px 5px 2.5px #888888;
text-align:left;
}
div
{
width:500px;
height:200px;
background-color:#9F79EE;
-moz-box-shadow: 5px 5px 2.5px #888888;
box-shadow: 5px 5px 2.5px #888888;
text-align:left;
}
</style>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery
/jquery-1.4.min.js"></script>
<script>
$(document).ready(function(){
	$("p").click(function(){
		$("textarea").toggle();
	});
});

</script>
</head>
<body  background="/phps2/bg1.jpg">

<br/><br/>
<?php
		if(!isset($_COOKIE["tuser"]))
		{
			if(!isset($_COOKIE["user1"])){
                setcookie("user1",time(),time()+6000000);
			}
			echo "<p>游客:".$_COOKIE["user1"]."</p><br/><br/>";
		    $no=1;
		   
		}
		else{
			echo "<p>用户：".$_COOKIE["tuser"]."</p><br/><br/>";
			$no=0;
		}

?>



<form method= "POST" action= "<?php echo $_SERVER['PHP_SELF']; ?>" >
<textarea name="content" style="height:190px; width:350px;"> </textarea></br></br>
<input type="submit" value="留言"/>

</form>

<td align="left">

</td>
<?php 
if($no){
	echo '<a href="index.php?login=1">登录</a><br/>';
	}
else{
	echo '<a href="index.php?logout=1">登出</a><br/>';
}
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(isset($_COOKIE["tuser"])){
		$name=$_COOKIE["tuser"];
		$tour=0;
	}
	else{
		$name=$_COOKIE["user1"];
		$tour=1;
	}
	if(strlen($_POST["content"])>1)
	{
		if(preg_match ("/\S/", $_POST["content"]) ){
			$ID=0;
			$getFromdb=mysql_query("SELECT * FROM message");
			while($row = mysql_fetch_array($getFromdb)){
				$ID++;
			}
			$date=date("Y-m-d h:i:sa");
			$sqlContnt="INSERT INTO message (Name,content,date,tour,ID) 
                     VALUES 
					 ('$name','$_POST[content]','$date','$tour','$ID')";
			if (!mysql_query($sqlContnt,$con))
             {
                 die('Error: ' . mysql_error());
              }	
		}
		else
			echo "<script>alert('请输入合适的内容');</script>";
	}
	else 
		echo "<script>alert('输入不能为空');</script>";
}

$getFromdb=mysql_query("SELECT * FROM message order by id desc limit 0,10");
while($rowr = mysql_fetch_array($getFromdb)){
	if($rowr['tour'])
		$tourCon="游客: ";
	else
		$tourCon="用户: ";
    echo "<div><span>".$tourCon.$rowr['Name']."        ".$rowr['date']."  ";
	if($rowr['Name'] == $_COOKIE["tuser"])
	      echo "<a href='javascript:if(confirm(&apos;确实要删除吗?&apos;)) location=&apos;index.php?del=" .$rowr['ID']." &apos;'>删除</a>";
              
	echo "</span><br/><br/><span>".htmlspecialchars($rowr['content'])."</span></div> <br/>";
}
?>
