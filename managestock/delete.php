<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['submit_y'])){
	$id=$_POST['id'];
	include("../dbconnect/db.php");
	$q="delete from product where id='$id'";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	if ($result){
        echo "<script>alert('Product Deleted')</script>";
        ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/managestock/managestock.php"><?php 
    }
}
?>
<?php
if(isset($_POST['submit_n'])){
	header('location:../managestock/managestock.php');
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="delete.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
        $id=$_GET['id'];
		include("../dbconnect/db.php");
		$query="select * from product where id=$id";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($result);
    ?>
    <form class="box" method="POST">
    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID: <input type="number" name="id" value="<?php  echo $data['id'];?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Product Name: <input type="text" name="name" value="<?php  echo $data['name'];?>" readonly></p>
    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price: <input type="number" name="price" value="<?php  echo $data['price'];?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock: <input type="number" name="stock"  value="<?php  echo $data['stock'];?>" readonly></p>
    	<h5>Do You Want to Delete?</h5>
    	<br><button name="submit_y" class="yes">Yes</button><button name="submit_n" class="no">No</button>
    </form>
</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>
