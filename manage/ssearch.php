<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
	$name=$_POST['name1'];
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="ssearch.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
    	include("../menu/menu.php");
    	include("../dbconnect/db.php");
		$query="select * from product where name='$name'";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$count=mysqli_num_rows($result);
		if($count>0){
			
		}
		else{
			echo "<script>alert('Product Not Found')</script>";
            ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/manage/sell.php"><?php
		}
    ?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th>ID</th>
    		<th>Name</th>
    		<th>Price</th>
    		<th>Stock</th>
    		<th>&nbsp;</th>
    	<tr>
    <?php while($row=mysqli_fetch_array($result)){ ?>
    	<tr>
    		<td><?php echo $row['id']; ?></td>
    		<td><?php echo $row['name']; ?></td>
    		<td><?php echo $row['price']; ?></td>
    		<td><?php echo $row['stock']; ?></td>
    		<td><a href="<?php echo "sview.php?id=".$row['id']?>"><button><img src="../image/sell.jpg">Add</button>
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

