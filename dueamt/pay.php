<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['submit'])){
	$invoice=$_POST['in'];
	$totalamt=$_POST['new'];
	$id=$_POST['idd'];
	include("../dbconnect/db.php");
	$query1="select totalamt,id from addproduct where invoice='$invoice'";
	$result1=mysqli_query($con,$query1) or die(mysqli_error($con));
	$row1=mysqli_fetch_assoc($result1);
	$num=$row1['totalamt']+$totalamt;
	$idd=$row1['id'];
	$q="update addproduct set totalamt='$num' where invoice='$invoice' and id='$idd'";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	$q2="update addproduct set due=0 where invoice='$invoice'";
	$result2=mysqli_query($con,$q2) or die(mysqli_error($con));
	if ($result){
        echo "<script>alert('Amount Payed')</script>";
        ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/dueamt/supdue.php"><?php 
    }
}
?>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>
