<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="return.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
    	include("../menu/menu.php");
   	?>
   	<h1 class="h11">Enter Product Name to Search</h1>
   	<form class="box" method="POST" action="sretu.php">
		<p>Product Name: <select name="sel">
			<?php
				include("../dbconnect/db.php");
				$query="select name from product;";
				$result=mysqli_query($con,$query) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result)){?>
					<option><?php echo $row['name']; ?></option>
				<?php
				}

			?>
		</select>
		<button name="submit"><img src="../image/mark.jpg">Done</button>
	</form>
</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>

