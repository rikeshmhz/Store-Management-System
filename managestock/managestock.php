<?php 
    session_start();
    if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="managestock.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>

	<?php
        include("../menu/menu.php");
        include("../dbconnect/db.php");
		$query="select * from product";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
    ?>
    <h1 class="h12">Products in Your Stock</h1>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th>ID</th>
    		<th>Product Name</th>
    		<th>Price</th>
    		<th>Stock</th>
    		<th><p>Action</p></th>
    	<tr>
    <?php while($row=mysqli_fetch_array($result)){ ?>
    	<tr>
    		<td><?php echo $row['id']; ?></td>
    		<td><?php echo $row['name']; ?></td>
    		<td><?php echo $row['price']; ?></td>
    		<td><?php echo $row['stock']; ?></td>
    		<td><a href="<?php echo "edit.php?id=".$row['id']?>"><button class="edit"><img src="../image/edit.jpg">Edit</button>
    </a><a href="<?php echo "delete.php?id=".$row['id']?>"><button class="delete"><img src="../image/delete.jpg">Delete</button>
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
