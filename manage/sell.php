<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sell.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>

	<?php
        include("../menu/menu.php");
		include("../dbconnect/db.php");
		$query="select * from product";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
    ?>
    <form class="box" method="POST" action="ssearch.php">
    <input type="text" name="name1" placeholder="Search Product in Your Stock"><button class="b1" name="search"><img src="../image/search.jpg"></button>
	</form>
    <h1 class="h12">Products in Your Stock</h1>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th>ID</th>
    		<th>Product Name</th>
    		<th>Price</th>
    		<th>Stock</th>
    		<th><p>Action</p></th>
    	</tr>
    <?php while($row=mysqli_fetch_array($result)){ ?>
    	<tr>
    		<td><?php echo $row['id']; ?></td>
    		<td><?php echo $row['name']; ?></td>
    		<td><?php echo $row['price']; ?></td>
    		<td><?php echo $row['stock']; ?></td>
    		<td><a href="<?php echo "sview.php?id=".$row['id']?>"><button><img src="../image/sell.jpg">Sell</button>
    </a></td>
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
