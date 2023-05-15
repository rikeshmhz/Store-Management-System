<?php 
	session_start();
	if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
    ?>
    <form class="box">
    	<img src="../image/sell.jpg" class="a1"> 
    	<p class="p1">
    		Today's <br>Highest Selling<br>Amount:<br>
    		<?php
    			$date=date('Y-m-d');
    			include("../dbconnect/db.php");
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
				$query="select max(totalamt) as maxamt from sellproduct where date='$date'";
				$result=mysqli_query($con,$query) or die(mysqli_error($con));
				$row=mysqli_fetch_assoc($result);
				$maxamt=$row['maxamt']
    		?>
    		<h4 class="h31"><?php echo $maxamt ?></h4>
    	</p>
    	<img src="../image/lowstock.jpg" class="a2"> 
    	<p class="p2">
    		Low<br>Stock Product:<br>
    		<?php
    			$qs="select stock from product where stock<20";
    			$results=mysqli_query($con,$qs) or die(mysqli_error($con));
    			$count=0;
    			if(mysqli_num_rows($results)>0){
        			foreach($results as $row){
            			$count++;
        			}
    			}
    		?>
    		<a href="homelow.php"><h2 class="h32"><?php echo $count ?></h2></a>
    	</p>
    	<img src="../image/duedate.jpg" class="a3"> 
    	<p class="p3">
    		Due<br>Date:<br>
    		<?php
    			$nextDate = date('Y-m-d', strtotime('+1 days')); 
    			$qd="select * from addproduct where duedate='$nextDate' and due>0";
    			$resultd=mysqli_query($con,$qd) or die(mysqli_error($con));
    			$countd=0;
    			if(mysqli_num_rows($resultd)>0){
        			foreach($resultd as $rowd){
            			$countd++;
        			}
    			}
    		?>
    		Supplier:<a href="homesd.php"><h2 class="h33"><?php echo $countd ?></h2></a>
    		<?php
    			$qsd="select * from sellproduct where duedate='$date' and due>0";
    			$resultsd=mysqli_query($con,$qsd) or die(mysqli_error($con));
    			$countsd=0;
    			if(mysqli_num_rows($resultsd)>0){
        			foreach($resultsd as $rowsd){
            			$countsd++;
        			}
    			}
    		?>
    		<p class="aa">Customer:</p> <a href="homecs.php"><h2 class="h35"><?php echo $countsd ?></h2></a>
    	</p>
    </form>
    <?php 
    	$queryhsp="select totalamt,id,name,customer,phone from sellproduct where date='$date' order by totalamt desc";
		$resulthsp=mysqli_query($con,$queryhsp) or die(mysqli_error($con));
		$cdd=0; 
	?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th colspan="5">Highest Selling Amount</th>
    	</tr>
    	<tr>
    		<th>Amount</th>
    		<th>ID</th>
    		<th>Product Name</th>
    		<th>Customer Name</th>
    		<th>Phone Number</th>
    	<tr>
   <?php while($rowhsp=mysqli_fetch_array($resulthsp)){ $cdd=$rowhsp['totalamt']+$cdd;?>
    	<tr>
    		<td><?php echo $rowhsp['totalamt']; ?></td>
    		<td><?php echo $rowhsp['id']; ?></td>
    		<td><?php echo $rowhsp['name']; ?></td>
    		<td><?php echo $rowhsp['customer']; ?></td>
    		<td><?php echo $rowhsp['phone']; ?></td>
    	</tr>
    <?php		
	}
	?>
		<tr>
    		<td colspan="5"><h4>Today's Total Earning: <?php echo $cdd ?></h4></td>
    	</tr>
	</table>
</body>
</html>
<?php 
	}
	else{
		header('location:../login/log.php');
	}
?>