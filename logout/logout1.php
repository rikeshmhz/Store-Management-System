<?php 
	session_start();
	if(isset($_SESSION['phn'])){
		session_destroy();
		header('location:../activity/sactlog.php');
	}
	else{
		header('location:../activity/sactlog.php');
	}
?>