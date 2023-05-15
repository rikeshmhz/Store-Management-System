<?php
session_start();
if(isset($_POST['submit'])){
	$username=$_POST['un'];
	$password=$_POST['pw'];
	include("../dbconnect/db.php");
	$q="select * from admin where Username='$username' and Password='$password'";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	$count=mysqli_num_rows($result);
	if($count>0)
	{
		$_SESSION['user']=$username;
		$_SESSION['pass']=$password;
		header('location:../home/home.php');
	}
	else
	{
		echo '<script type="text/javascript">';
		echo 'alert("Login Failed")';
		echo '</script>';
	}
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	<form class="box" method="POST">
		<h1>Store Login</h1>
		<input type="text" name="un" placeholder="Username">
		<input type="password" name="pw" placeholder="Password">
		<input type="submit" name="submit" value="Login">
	</form>
</body>
</html>