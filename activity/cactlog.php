<?php
session_start();
if(isset($_POST['cact'])){
	$number=$_POST['num'];
	include("../dbconnect/db.php");
	$q="select phone from sellproduct where phone='$number'";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	$count=mysqli_num_rows($result);
	if($count>0)
	{
		$_SESSION['phn']=$number;
		header('location:../activity/cactdue.php');
	}
	else
	{
		echo '<script type="text/javascript">';
		echo 'alert("Number Not Found")';
		echo '</script>';
	}
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="cactlog.css">
</head>
<body>
	<form class="box" method="POST">
		<h1>Customer</h1><br>
		<h1>Activity Log</h1>
		<input type="text" pattern="^[0-9]*$" maxlength="10" minlength="10" name="num" placeholder="Enter Number" required title="Require 10 Number">
		<button class="b" name="cact">View</button>
		<a href="../activity/sactlog.php" class="a2">View As Supplier</a>
	</form>
</body>
</html>