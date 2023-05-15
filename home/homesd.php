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
        $nextDate = date('Y-m-d', strtotime('+1 days'));
        include("../dbconnect/db.php");
        $querysdd="select * from addproduct where duedate='$nextDate' and due>0";
		$resultsdd=mysqli_query($con,$querysdd) or die(mysqli_error($con));
		$cdd=0; 
    ?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th colspan="6">Supplier Due Date for Tomorrow</th>
    	</tr>
    	<tr>
    		<th>Due Date</th>
    		<th>Due Amount</th>
    		<th>Invoice No.</th>
    		<th>Product Name</th>
    		<th>Supplier Name</th>
    		<th>Phone Number</th>
    	</tr>
    	<?php while($rowsdd=mysqli_fetch_array($resultsdd)){ $cdd=$rowsdd['due']+$cdd; ?>
    	<tr>
    		<td><?php echo $rowsdd['duedate']; ?></td>
    		<td><?php echo $rowsdd['due']; ?></td>
    		<td><?php echo $rowsdd['invoice']; ?></td>
    		<td><?php echo $rowsdd['name']; ?></td>
    		<td><?php echo $rowsdd['supplier']; ?></td>
    		<td><?php echo $rowsdd['phone']; ?></td>
    	</tr>
    	<?php		
		}
		if($cdd==0){?>
		<tr>
			<td colspan="6"><h4>No Supplier Due Date</h4></td>
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