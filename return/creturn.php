<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="creturn.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
    	include("../menu/menu.php");
    	$invoice=$_GET['invoice'];
    	$name=$_GET['name'];
    	include("../dbconnect/db.php");
	   	$query="select * from sellproduct where invoice='$invoice' and name='$name'";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$count=mysqli_num_rows($result);
		if($count>0){
		$data=mysqli_fetch_assoc($result);
		$query1="select stock from product where name='$name'";
		$result1=mysqli_query($con,$query1) or die(mysqli_error($con));
		$data1=mysqli_fetch_assoc($result1);
    ?>
    <form class="box" method="POST" action="done1.php">
    	<p>ID: <input type="number" name="id" value="<?php  echo $data['id'];?>" readonly></p>
    	<p>Product Name: <input type="text" value="<?php  echo $data['name'];?>" readonly></p>
    	<p>Stock: <input type="number" id="s" value="<?php  echo $data1['stock'];?>" readonly></p>
    	<p>Date of Sell: <input type="date" value="<?php echo $data['date'];?>" readonly></p>
    	<p>Invoice No.: <input type="number" name="invoice" value="<?php echo $data['invoice'];?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer Name: <input type="text" value="<?php echo $data['customer'];?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number: <input type="text" value="<?php echo $data['phone'];?>" readonly></p>
    	<p>Price: <input type="number" id="pr" value="<?php echo $data['price']?>" onkeyup="sum()"readonly></p>
    	<p>Qty: <input type="number" id="q" value="<?php echo $data['qty']?>" onkeyup="sum()"readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Discount: <input type="number" id="d" value="<?php echo $data['discount']?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Due Amount: <input type="number" id="due" value="<?php echo $data['due']?>" readonly></p>
    	<p>Return Qty: <input type="text" pattern="^[0-9]*$" id="rq" onkeyup="sum()" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Discount: <input type="text" pattern="^[0-9]*$" id="nd" name="nd" onkeyup="sum()" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Due Amount: <input type="text" pattern="^[0-9]*$" id="ndue" name="ndue" onkeyup="sum()" readonly> <input type="hidden" name="nq" id="nq"><input type="hidden" name="ns" id="ns"><input type="hidden" id="dpp"><input type="hidden" id="pfd"></p>
    	<p>New Total Amount: <input type="number" id="nta" name="newtotalamt" onkeyup="sum()" readonly>
    	<script type="text/javascript">
		function sum(){
			var s=document.getElementById('s').value;
			var pr=document.getElementById('pr').value;
			var q=document.getElementById('q').value;
			var d=document.getElementById('d').value;
			var due=document.getElementById('due').value;
			var duee=parseInt(due);
			var rq=document.getElementById('rq').value;
			var rq=document.getElementById('rq').value;
			if(rq==""){
				document.getElementById('nta').value='';
				document.getElementById('nd').value='';
				document.getElementById('ndue').value='';
			}
			var ns=parseInt(s)+parseInt(rq);
			var nq=parseInt(q)-parseInt(rq);
			var pfd=((parseInt(pr)*parseInt(q))-parseInt(d))/parseInt(q);
			document.getElementById('pfd').value=pfd;
			var dpp=parseInt(d)/parseInt(q);
			document.getElementById('dpp').value=dpp;
			var dd=parseInt(rq)*pfd;
			if(duee>=0){
				duee=duee-dd;
			}
			if(duee<0){
				document.getElementById('ndue').value=0;
			}
			if(ns<0){
				alert("Return Qty is more than Stock");	
				document.getElementById('rq').value='';
			}
			else{
				var nd=nq*dpp;
				if(duee>=0){
					var nta=((parseInt(pr)*nq)-nd)-duee;
				}
				if(duee<0){
					var nta=(parseInt(pr)*nq)-nd;
				}
				if(!isNaN(nd)){
					document.getElementById('nd').value=nd.toFixed(2);
				}
				if(!isNaN(ns)){
					document.getElementById('ns').value=ns;
				}
				if(!isNaN(nq)){
					document.getElementById('nq').value=nq;
				}
				if(!isNaN(nta)){
					if(duee>=0){
						document.getElementById('ndue').value=duee.toFixed(2);
						document.getElementById('nta').value=nta.toFixed(2);
						if(rq<0){
							alert("Invalid Qty");	
							document.getElementById('rq').value='';
							document.getElementById('nta').value='';
							document.getElementById('nd').value='';
							document.getElementById('ndue').value='';
						}
					}
					else if(nq<0){
						alert("Return Qty is more than Qty");	
						document.getElementById('rq').value='';
						document.getElementById('nta').value='';
						document.getElementById('nd').value='';
						document.getElementById('ndue').value='';
					}
					else if(rq<0){
						alert("Invalid Qty");	
						document.getElementById('rq').value='';
						document.getElementById('nta').value='';
						document.getElementById('nd').value='';
						document.getElementById('ndue').value='';
					}
					else{
						document.getElementById('nta').value=nta.toFixed(2);
					}
				}
    		}
    	}
    </script>
    <br><button name="submit_r"><img src="../image/mark.jpg">Done</button><br>
    <a href="return1.php" class="aa">Return Back</a>
    </form>
    <?php 
	}
	else{
		echo "<script>alert('Record Not Found')</script>";
        ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/return/return1.php"><?php
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
