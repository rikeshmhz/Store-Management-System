<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['submit_r'])){
	$id=$_POST['id'];
	$invoice=$_POST['invoice'];
	$newq=$_POST['nq'];
	$news=$_POST['ns'];
	$newdi=$_POST['nd'];
	$newdue=$_POST['ndue'];
	$newtotalamt=$_POST['newtotalamt'];
	include("../dbconnect/db.php");
	$q="update product set stock='$news' where id='$id'";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	$q1="update sellproduct set qty='$newq' where id='$id' and invoice='$invoice'";
	$resul1=mysqli_query($con,$q1) or die(mysqli_error($con));
	$q2="update sellproduct set totalamt='$newtotalamt' where id='$id' and invoice='$invoice'";
	$result2=mysqli_query($con,$q2) or die(mysqli_error($con));
	$q3="update sellproduct set discount='$newdi' where id='$id' and invoice='$invoice'";
	$result3=mysqli_query($con,$q3) or die(mysqli_error($con));
	$q4="update sellproduct set due='$newdue' where id='$id' and invoice='$invoice'";
	$result4=mysqli_query($con,$q4) or die(mysqli_error($con));
	if ($result){
        echo "<script>alert('Record Updated Successfully')</script>";
        ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/return/return1.php"><?php 
    }
}
?>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>

