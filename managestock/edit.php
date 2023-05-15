<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$price=$_POST['price'];
	$stock=$_POST['stock'];
	include("../dbconnect/db.php");
	$q="update product set name='$name' where id='$id'";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	$q1="update product set price='$price' where id='$id'";
	$result1=mysqli_query($con,$q1) or die(mysqli_error($con));
	$q2="update product set stock='$stock' where id='$id'";
	$result2=mysqli_query($con,$q2) or die(mysqli_error($con));
	if ($result){
        echo "<script>alert('Record Updated Successfully')</script>";
        ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/managestock/managestock.php"><?php 
    }
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="edit.css">
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
    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID: <input type="number" name="id" value="<?php  echo $data['id'];?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Product Name: <input type="text"  class="tx1" name="name" value="<?php  echo $data['name'];?>" required></p>
    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price: <input type="text" pattern="^[0-9]*$" name="price" id="pr" value="<?php  echo $data['price'];?>" onkeyup="sum()" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock: <input type="text" pattern="^[0-9]*$" name="stock" id="s" value="<?php  echo $data['stock'];?>" onkeyup="sum()" required></p>
    	<script type="text/javascript">
		function sum(){
			var s=document.getElementById('s').value;
			var pr=document.getElementById('pr').value;
			if(pr<0){
				document.getElementById('pr').value=-parseInt(pr);
				alert("Price Cannot be Negative");
			}
			if(s<0){
				document.getElementById('s').value=-parseInt(s);
				alert("Stock Cannot be Negative");
			}
		}
		</script>
    	<br><button name="submit"><img src="../image/mark.jpg">Done</button>
    </form>
</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>
