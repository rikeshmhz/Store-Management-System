<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
		session_destroy();
		header('location:../login/log.php');
	}
	else{
		header('location:../login/log.php');
	}
?>