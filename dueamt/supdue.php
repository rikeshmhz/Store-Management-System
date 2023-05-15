<?php 
    session_start();
    if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="supdue.css">
	<link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
    <?php
        include("../menu/menu.php");
        include("../dbconnect/db.php");
        $query="select name,duedate,invoice,supplier,email,phone,due from addproduct where due>0 order by duedate asc";
        $result=mysqli_query($con,$query) or die(mysqli_error($con));
        $cdd=0;
    ?>
    <form method="POST" action="duesearch.php">
    <input type="text" name="in1" placeholder="Enter Invoice No." class="in"><button class="b1" name="search"><img src="../image/search.jpg"></button>
	</form>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th>Product Name</th>
    		<th>Due Date</th>
            <th>Invoice No.</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Due Amount</th>
    	</tr>
     <?php while($row=mysqli_fetch_array($result)){ $cdd=$row['due']+$cdd; ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['duedate']; ?></td>
            <td><?php echo $row['invoice']; ?></td>
            <td><?php echo $row['supplier']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['due']; ?></td>
        </tr>
    <?php       
    }
    if($cdd==0){?>
        <tr>
            <td colspan="7"><h4>No Due Amount</h4></td>
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
