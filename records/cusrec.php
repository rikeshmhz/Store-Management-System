<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="cusrec.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
        include("../dbconnect/db.php");
		$query="select customer,phone from sellproduct group by phone";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
    ?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th>Customer Name</th>
    		<th>Phone Number</th>
    		<th><p>Action</p></th>
    	<tr>
    <?php while($row=mysqli_fetch_array($result)){ ?>
    	<tr>
    		<td><?php echo $row['customer']; ?></td>
    		<td><?php echo $row['phone']; ?></td>
    		<td><a href="<?php echo "crecview.php?phone=".$row['phone']?>"><button><img src="../image/view.jpg">View</button>
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
