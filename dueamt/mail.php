<?php
    $to_email=$_GET['email'];
    $duedate=$_GET['duedate'];
    $due=$_GET['due'];
	$subject = "Due Amount Reminder";
	$body = "I hope you are well. I just wanted to drop you a quick note to remind you about Due Amount Payment, Last Date ($duedate). Sum of Rs.$due is Due by you.";
	$headers = "From: superiorcollection63@gmail.com";
	mail($to_email, $subject, $body, $headers); 
	echo "<script>alert('Mail Send')</script>";
?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/dueamt/cusdue.php">