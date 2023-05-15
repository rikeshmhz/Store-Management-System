<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$date=$_POST['date'];
	$duedate=$_POST['duedate'];
	$invoice=$_POST['invoice'];
	$supplier=$_POST['supplier'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$price=$_POST['price'];
	$qty=$_POST['qty'];
	$discount=$_POST['dis'];
	$due=$_POST['due'];
	$totalamt=$_POST['totalamt'];
	$ns=$_POST['ns'];
	include("../dbconnect/db.php");
	$q2="select name from product where name='$name'";
	$result2=mysqli_query($con,$q2) or die(mysqli_error($con));
	$count=mysqli_num_rows($result2);
	if($count>0)
	{
		echo '<script type="text/javascript">';
		echo 'alert("Product Already Exists")';
		echo '</script>';
	}
	else{
	$q="insert into product(id,name,price,stock) values ('$id','$name','$price','$ns')";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	$q1="insert into addproduct(id,name,date,duedate,invoice,supplier,email,phone,price,qty,discount,due,totalamt) values ('$id','$name','$date','$duedate','$invoice','$supplier','$email','$phone','$price','$qty','$discount','$due','$totalamt')";
	$result1=mysqli_query($con,$q1) or die(mysqli_error($con));
	if ($result&&$result1){
        echo "<script>alert('New Product Added')</script>";
        ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/manage/addstock.php"><?php 
    }
	}
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="addnew.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
    <?php
        include("../menu/menu.php");
		include("../dbconnect/db.php");
		$query="select max(id) as maxid from product";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$row=mysqli_fetch_assoc($result);
		$maxnum=$row['maxid']+1;
    ?>
    <form class="box" method="POST">
    	<p>ID: <input type="text" name="id" value="<?php echo $maxnum;?>" readonly></p>
    	<p>Product Name: <input type="text" name="name" pattern="[a-zA-Z\s]+" required></p>
    	<p>Stock: <input type="text" name="stock" id="s" value="0" readonly></p>
    	<p>Date of Purchase: <input type="date" name="date" value="<?php echo date('Y-m-d');?>"><input type="hidden" id="dp" value="<?php echo date('Y-m-d');?>" onchange="dateva()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Due Date: <input type="date" id="dd" name="duedate" onchange="dateva()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invoice No.: <input type="text" pattern="^[0-9]*$" name="invoice" required></p>
    	<p>Supplier Name: <input type="text" name="supplier" pattern="[a-zA-Z\s]+" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: <input type="email" name="email" class="ema" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number: <input type="text" pattern="^[0-9]*$" maxlength="10" minlength="10" name="phone" required title="Require 10 Number"></p>
    	<p>Price: <input type="text" pattern="^[0-9]*$" id="pr" name="price" onkeyup="sum()" required></p>
    	<p>Qty: <input type="text" pattern="^[0-9]*$" id="q" name="qty" required required title="Atleast 1 qty required" onkeyup="sum()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Discount: <input type="text" pattern="^[0-9]*$" id="d" name="dis" onkeyup="sum()" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Due Amount: <input type="text" pattern="^[0-9]*$" value="0" id="due" name="due" onkeyup="sum()" required></p>
    	<p>Total amount: <input type="text" id="tm" name="totalamt" value="0" readonly> <input type="hidden" name="ns" id="ns"></p>
		<script type="text/javascript">
		function sum(){
			var s=document.getElementById('s').value;
			var pr=document.getElementById('pr').value;
			var q=document.getElementById('q').value;
			var d=document.getElementById('d').value;
			var due=document.getElementById('due').value;
			if(q==""){
				document.getElementById('tm').value=0;
				document.getElementById('d').value='';
				document.getElementById('due').value='';
			}
			if(q>0){
				var ns=parseInt(s)+parseInt(q);
			}
			var mq=parseInt(pr)*parseInt(q);
			if(pr<0){
				var mq=parseInt(pr)*-parseInt(q);
				document.getElementById('pr').value=-parseInt(pr);
				alert("Price Cannot be Negative");
			}
			else{
				var mq=parseInt(pr)*parseInt(q);
			}
			if(q<0){
				document.getElementById('q').value='';
				alert("Invalid Amount");
			}
			if(d<0){
				document.getElementById('d').value=0;
				alert("Invalid Amount");
			}
			if(due<0){
				document.getElementById('due').value=0;
				alert("Invalid Amount");
			}
			if(parseInt(d)>mq){
				document.getElementById('tm').value='';
				alert("Invalid Amount(Negative Total Amount)");
				document.getElementById('d').value=0;
				document.getElementById('due').value=0;
			}
			else{
				if(parseInt(d)>=0){
					var ad=mq-parseInt(d);
				}
				var adu=ad-parseInt(due);
				if(adu<0){
					document.getElementById('tm').value=ad;
					alert("Invalid Amount(Negative Total Amount)");	
					document.getElementById('due').value=0;
				}
				else{
					if(!isNaN(mq)){
						if(parseInt(q)<0){
							document.getElementById('tm').value=0;
						}
						else{
							document.getElementById('tm').value=mq;
						}
					}
					if(!isNaN(ad)){
						document.getElementById('tm').value=ad;
					}
					if(!isNaN(adu)){
						if(parseInt(due)<0){
							document.getElementById('tm').value=ad;
						}
						else{
							document.getElementById('tm').value=adu;
						}
					}
					if(!isNaN(ns)){
						document.getElementById('ns').value=ns;
					}
				}
			}
		}
		function dateva(){
			var d1=document.getElementById('dp').value;
			var d2=document.getElementById('dd').value;

			if(d1!="" && d2!=""){
				var dd1=new Date(d1);
				var dd2=new Date(d2);

				if(dd2<dd1){
					alert("Invalid Due Date");
					document.getElementById('dd').value=d1;
				}
			}
		}
	</script>
	<br><button name="submit"><img src="../image/mark.jpg">Done</button><br> 
	<a href="addstock.php" class="aa">Return Back</a>
    </form>
    <h1 class="h12">Products in Your Stock</h1>
    <?php
			$query="select * from product";
			$result=mysqli_query($con,$query) or die(mysqli_error($con));
    	?>
    	<table border="0" cellspacing="0px">
    	<tr>
    		<th>ID</th>
    		<th>Product Name</th>
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
    	</tr>
    	<?php		
		}
		?>
</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>
