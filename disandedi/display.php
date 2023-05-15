<?php 
    session_start();
    if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
if(isset($_POST['usernaedi'])){ 
        header('location:../disandedi/usernaedi.php');
}
?>
<?php
if(isset($_POST['userpasedi'])){ 
        header('location:../disandedi/userpasedi.php');
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="display.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
    ?>
    <form class="box" method="POST">
        <h1>Admin</h1>
        <?php
            include("../dbconnect/db.php");
            $q="select * from admin";
            $result=mysqli_query($con,$q) or die(mysqli_error($con));
             if(mysqli_num_rows($result)>0){
                foreach($result as $row){
        ?>
                    <p>Username:</p>
                    <p class="user"><?php echo $row['Username'] ?></p>
                    <button name="usernaedi"><img src="../image/edit.jpg">Edit Username</button>
                    <button name="userpasedi"><img src="../image/edit.jpg">Edit Password</button>
        <?php
                }
             }
        ?>
        
    </form>
</body>
</html>
<?php 
    }
    else{
        header('location:../login/log.php');
    }
?>
