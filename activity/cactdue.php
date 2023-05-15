<?php 
	session_start();
	if(isset($_SESSION['phn'])){
		$n=$_SESSION['phn']
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="sactdue.css">
	<link rel="stylesheet" type="text/css" href="../menu/menu1.css">
</head>
<body>
    <?php
        include("../menu/menu2.php");
        include("../dbconnect/db.php");
        $query="select name,duedate,invoice,due from sellproduct where phone='$n' and due>0";
        $result=mysqli_query($con,$query) or die(mysqli_error($con));
        $cdd=0;
    ?>
    <table border="0" cellspacing="0px">
    	<tr>
    		<th>Product Name</th>
    		<th>Due Date</th>
            <th>Invoice No.</th>
            <th>Due Amount</th>
    	</tr>
     <?php while($row=mysqli_fetch_array($result)){ $cdd=$row['due']+$cdd;?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['duedate']; ?></td>
            <td><?php echo $row['invoice']; ?></td>
            <td><?php echo $row['due']; ?></td>
        </tr>
    <?php       
     }
     if($cdd==0){?>
        <tr>
            <td colspan="4"><h4 style="color: red;">No Due Amount</h4></td>
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
		header('location:../activity/cactlog.php');
	}
?>