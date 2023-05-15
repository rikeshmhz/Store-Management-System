<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="crecview.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
        $phone=$_GET['phone'];
		include("../dbconnect/db.php");
		$query="select customer,phone,name,date,invoice,price,qty,discount,totalamt from sellproduct where phone=$phone";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
	?>
	<table border="0" cellspacing="0px">
    	<tr>
    		<th>Customer Name</th>
    		<th>Phone Number</th>
    		<th>Product Name</th>
    		<th>Date of Purchase</th>
    		<th>Invoice No.</th>
    		<th>Price</th>
    		<th>Qty</th>
    		<th>Discount</th>
    		<th>Total Amount</th>
    	<tr>
    <?php $c=0; 
    while($row=mysqli_fetch_array($result)){ $c=$row['totalamt']+$c;?>
    	<tr>
    		<td><?php echo $row['customer']; ?></td>
    		<td><?php echo $row['phone']; ?></td>
    		<td><?php echo $row['name']; ?></td>
    		<td><?php echo $row['date']; ?></td>
    		<td><?php echo $row['invoice']; ?></td>
    		<td><?php echo $row['price']; ?></td>
    		<td><?php echo $row['qty']; ?></td>
    		<td><?php echo $row['discount']; ?></td>
    		<td><?php echo $row['totalamt']; ?></td>
    	</tr>

    <?php		
	}
	?>
	<tr>
		<td colspan="9"><h2>Total Spending: <?php echo $c;?></h2></td>
	</tr>
    </table>

</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>
