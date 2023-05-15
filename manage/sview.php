<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$stock=$_POST['stock'];
	$date=$_POST['date'];
	$duedate=$_POST['duedate'];
	$invoice=$_POST['invoice'];
	$customer=$_POST['customer'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$qty=$_POST['qty'];
	$price=$_POST['price'];
	$discount=$_POST['dis'];
	$due=$_POST['due'];
	$totalamt=$_POST['totalamt'];
	$mail=$_POST['mail'];
	$ns=$_POST['ns'];
	include("../dbconnect/db.php");
	$q="update product set stock='$ns' where id='$id'";
	$result=mysqli_query($con,$q) or die(mysqli_error($con));
	$q1="update product set price='$price' where id='$id'";
	$result1=mysqli_query($con,$q1) or die(mysqli_error($con));
	$q2="insert into sellproduct(id,name,date,duedate,invoice,customer,email,phone,price,qty,discount,due,totalamt,mail) values ('$id','$name','$date','$duedate','$invoice','$customer','$email','$phone','$price','$qty','$discount','$due','$totalamt','$mail')";
	$result2=mysqli_query($con,$q2) or die(mysqli_error($con));
	if ($result&&$result2){
		$nextDate = date('Y-m-d', strtotime('+1 days'));
		$q3="select email,due,mail from sellproduct where duedate='$nextDate' and due>0";
		$result3=mysqli_query($con,$q3) or die(mysqli_error($con));
		while($row=mysqli_fetch_array($result3)){
			$due = $row['due'];
			$mail = $row['mail'];
			if($mail==0){
				$to_email = $row['email'];
				$subject = "Due Amount Reminder";
				$body = "I hope you are well. I just wanted to drop you a quick note to remind you that tomorrow is last date for your Due Amount Payment. Sum of Rs.$due is Due by you.";
				$headers = "From: superiorcollection63@gmail.com";
				mail($to_email, $subject, $body, $headers);
				$q4="update sellproduct set mail='1' where email='$to_email'";
				$result4=mysqli_query($con,$q4) or die(mysqli_error($con));
			}
		}
        echo "<script>alert('Product sold')</script>";
        ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/manage/sell.php"><?php 
    }
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sview.css">
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
    	<p>ID: <input type="number" name="id" value="<?php  echo $data['id'];?>" readonly></p>
    	<p>Product Name: <input type="text" name="name" value="<?php  echo $data['name'];?>" readonly></p>
    	<p>Stock: <input type="number" name="stock" id="s" value="<?php  echo $data['stock'];?>" readonly></p>
    	<p>Date of Sell: <input type="date" name="date" value="<?php echo date('Y-m-d');?>"><input type="hidden" id="dp" value="<?php echo date('Y-m-d');?>" onchange="dateva()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Due Date: <input type="date" id="dd" name="duedate" onchange="dateva()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invoice No.: <input type="text" pattern="^[0-9]*$" name="invoice" required></p>
    	<p>Customer Name: <input type="text" name="customer" pattern="[a-zA-Z\s]+" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: <input type="email" name="email" class="ema" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number: <input type="text" pattern="^[0-9]*$" maxlength="10" minlength="10" name="phone" required title="Require 10 Number"></p>
    	<p>Price: <input type="text" pattern="^[0-9]*$" id="pr" name="price" value="<?php echo $data['price']?>" onkeyup="sum()" required></p>
    	<p>Qty: <input type="text" pattern="^[0-9]*$" id="q" name="qty" required required title="Atleast 1 qty required" onkeyup="sum()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Discount: <input type="text" pattern="^[0-9]*$" id="d" name="dis"  onkeyup="sum()" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Due Amount: <input type="text" value="0" pattern="^[0-9]*$" id="due" name="due" onkeyup="sum()" required></p>
    	<p>Total amount: <input type="text" id="tm" name="totalamt" value="0" readonly> <input type="hidden" name="ns" id="ns"></p> <input type="hidden" name="mail" value="0" readonly>
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
				var ns=parseInt(s)-parseInt(q);
			}
			var mq=parseInt(pr)*parseInt(q);
			if(pr<0){
				var mq=parseInt(pr)*-parseInt(q);
				document.getElementById('pr').value=-parseInt(pr);;
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
				document.getElementById('d').value='';
				alert("Invalid Amount");
			}
			if(due<0){
				document.getElementById('due').value='';
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
					document.getElementById('tm').value='';
					alert("Invalid Amount(Negative Total Amount)");	
					document.getElementById('due').value='';
				}
				else{
					if(!isNaN(mq)){
						if(parseInt(q)<0){
							document.getElementById('tm').value=0;
						}
						else if(ns<0){
							document.getElementById('q').value='';
							document.getElementById('tm').value=0;
							alert("Qty is More Than Stock");
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
	<a href="sell.php" class="aa">Return Back</a>
    </form>
</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>
