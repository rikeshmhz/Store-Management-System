<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
	$invoice=$_POST['in1'];
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="duesearch.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
    	include("../menu/menu.php");
   	?>
   	<?php
    	include("../dbconnect/db.php");
		$query="select invoice,supplier,phone,duedate,due from addproduct where invoice='$invoice'";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$count=mysqli_num_rows($result);
		if($count>0){
			$c=0;
			while($row=mysqli_fetch_array($result)){ 
			$in=$row['invoice'];
			$sup=$row['supplier'];
			$ph=$row['phone'];
			$duedate=$row['duedate'];
			$c=$row['due']+$c;
			}?>
			<form class="box" method="POST" action="pay.php">
				<p>Invoice No.: <input type="text" value="<?php echo $in;?>" readonly> Supplier Name: <input type="text" value="<?php echo $sup;?>" readonly> Phone Number: <input type="text" value="<?php echo $ph;?>" readonly></p>
				<p>Due Date: <input type="text" value="<?php echo $duedate;?>" readonly></p>
				<?php
				if($c>1){
					$query1="select id,invoice,name,due from addproduct where invoice='$invoice'";
					$result1=mysqli_query($con,$query1) or die(mysqli_error($con));
    			?>
	    			<table border="0" cellspacing="0px">
	    			<tr>
	    				<th>Product Name</th>
	    				<th>Due Amount</th>
	    			</tr>
	    			<?php while($row1=mysqli_fetch_array($result1)){ ?>
	    				<input type="hidden" name="in" value="<?php echo $row1['invoice']?>">
	    				<input type="hidden" name="new" value="<?php echo $c;?>">
	    				<input type="hidden" name="idd" value="<?php echo $row1['id']?>">
	    			<tr>
			    		<td><?php echo $row1['name']; ?></td>
			    		<td><?php echo $row1['due']; ?></td>
			    	</tr>
		    	<?php		
				}
				?>
        			<tr>
            			<td colspan="2"><h2>Total Due Amount: <?php echo $c;?></h2><button name="submit"><img src="../image/pay.jpg">Pay</button></td>
        			</tr>
    				</table>
    			<?php
    			}
    			else{
    				?><table border="0" cellspacing="0px">
	    			<tr>
	    				<th>Product Name</th>
	    				<th>Due Amount</th>
	    			</tr>
	    			<tr>
            			<td colspan="3"><h2 class="nodue">NO Due Amount</h2></td>
        			</tr>
    			<?php
    			}
    			?>
    		</form>
		<?php
		}
		else{
			echo "<script>alert('Invoice No. Not Found')</script>";
            ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/dueamt/supdue.php"><?php
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
