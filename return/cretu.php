<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['submit'])){
	$name=$_POST['sel'];
	include("../dbconnect/db.php");
	$query1="select invoice,name,customer,price,qty,totalamt from sellproduct where name='$name' order by invoice asc";
    $result1=mysqli_query($con,$query1) or die(mysqli_error($con));
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="cretu.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
    	include("../menu/menu.php");
   	?>
   	<h1 class="h11">Enter Product Name to Search</h1>
   	<form class="box" method="POST" action="cretu.php">
		<p>Product Name: <select name="sel">
			<?php
				include("../dbconnect/db.php");
				$query="select name from product;";
				$result=mysqli_query($con,$query) or die(mysqli_error($con));
				$cdd=0;
				while($row=mysqli_fetch_array($result)){?>
					<option><?php echo $row['name']; ?></option>
				<?php
				}

			?>
		</select>
		<button name="submit" class="b1"><img src="../image/mark.jpg">Done</button>
	</form>
	<table border="0" cellspacing="0px">
    	<tr>
    		<th>Invoice</th>
    		<th>Product Name</th>
    		<th>Customer</th>
    		<th>Price</th>
    		<th>Qty</th>
    		<th>Total Amount</th>
    		<th><p class="ac">Action</p></th>
    	<tr>
    <?php while($row1=mysqli_fetch_array($result1)){ $cdd=$row1['qty']+$cdd; ?>
    	<tr>
    		<td><?php echo $row1['invoice']; ?></td>
    		<td><?php echo $row1['name']; ?></td>
    		<td><?php echo $row1['customer']; ?></td>
    		<td><?php echo $row1['price']; ?></td>
    		<td><?php echo $row1['qty']; ?></td>
    		<td><?php echo $row1['totalamt']; ?></td>
    		<td><a href="<?php echo "creturn.php?invoice=".$row1['invoice']."&name=".$row1['name']?>"><button><img src="../image/return.jpg">Return</button>
    </a></td>
    	</tr>
    <?php		
	}
	if($cdd==0){?>
        <tr>
            <td colspan="6"><h4>No Product Found</h4></td>
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
