<?php 
	session_start();
	if(isset($_SESSION['phn'])){
		$n=$_SESSION['phn']
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="sactrec.css">
	<link rel="stylesheet" type="text/css" href="../menu/menu1.css">
</head>
<body>
    <?php
        include("../menu/menu1.php");
        include("../dbconnect/db.php");
        $query="select name,date,invoice,price,qty,discount,totalamt from addproduct where phone='$n'";
        $result=mysqli_query($con,$query) or die(mysqli_error($con));
    ?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th>Product Name</th>
    		<th>Date of Purchase</th>
    		<th>Invoice No.</th>
    		<th>Price</th>
    		<th>Qty</th>
    		<th>Discount</th>
    		<th>Total Amount</th>
    	</tr>
     <?php $c=0; 
     while($row=mysqli_fetch_array($result)){ $c=$row['totalamt']+$c; ?>
        <tr>
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
		<td colspan="7"><h2>Total Spending: <?php echo $c;?></h2></td>
	</tr>
    </table>
</body>
</html>
<?php 
	}
	else{
		header('location:../activity/sactlog.php');
	}
?>