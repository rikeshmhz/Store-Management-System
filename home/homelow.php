<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="homelow.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
        include("../dbconnect/db.php");
        $querylsp="select * from product where stock<20";
		$resultlsp=mysqli_query($con,$querylsp) or die(mysqli_error($con));
		$cdd=0; 
    ?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th colspan="5">Low Stock Product</th>
    	</tr>
    	<tr>
    		<th>Stock</th>
    		<th>ID</th>
    		<th>Product Name</th>
    		<th>Price</th>
    	<tr>
    	<?php while($rowlsp=mysqli_fetch_array($resultlsp)){ $cdd=$rowlsp['id']+$cdd; ?>
    	<tr>
    		<td><?php echo $rowlsp['stock']; ?></td>
    		<td><?php echo $rowlsp['id']; ?></td>
    		<td><?php echo $rowlsp['name']; ?></td>
    		<td><?php echo $rowlsp['price']; ?></td>
    	</tr>
    <?php		
	}
	if($cdd==0){?>
		<tr>
			<td colspan="4"><h4>No Low Stock Product</h4></td>
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