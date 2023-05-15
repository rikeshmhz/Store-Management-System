<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="homesd.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
    	$date=date('Y-m-d');
        include("../dbconnect/db.php");
        $querysdd="select * from sellproduct where duedate='$date' and due>0";
		$resultsdd=mysqli_query($con,$querysdd) or die(mysqli_error($con));
		$cdd=0; 
    ?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th colspan="6">Customer Due Date For Today</th>
    	</tr>
    	<tr>
    		<th>Due Date</th>
    		<th>Due Amount</th>
    		<th>Invoice No.</th>
    		<th>Product Name</th>
    		<th>Customer Name</th>
    		<th>Phone Number</th>
    	<tr>
    	<?php while($rowsdd=mysqli_fetch_array($resultsdd)){ $cdd=$rowsdd['due']+$cdd; ?>
    	<tr>
    		<td><?php echo $rowsdd['duedate']; ?></td>
    		<td><?php echo $rowsdd['due']; ?></td>
    		<td><?php echo $rowsdd['invoice']; ?></td>
    		<td><?php echo $rowsdd['name']; ?></td>
    		<td><?php echo $rowsdd['customer']; ?></td>
    		<td><?php echo $rowsdd['phone']; ?></td>
    	<?php		
		}
		if($cdd==0){?>
		<tr>
			<td colspan="6"><h4>No Customer Due Date</h4></td>
		</tr>
		<?php  
		}
		?>
	</table>
</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>