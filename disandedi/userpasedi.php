<?php 
    session_start();
    if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
error_reporting(0);
if(isset($_POST['submit'])){
    $old=$_POST['op'];
    $new=$_POST['np'];
    $conf=$_POST['cp'];
    include("../dbconnect/db.php");
    $q="select Password from admin where Password='$old'";
    $result=mysqli_query($con,$q) or die(mysqli_error($con));
    if(mysqli_num_rows($result)>0){
        if($new==$conf){
            $q1="update admin set Password='$new' where id='1'";
            $result1=mysqli_query($con,$q1) or die(mysqli_error($con));
            if ($result1){
                echo "<script>alert('Password Updated')</script>";
                ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/disandedi/display.php"><?php 
            }
        }else{
            echo '<script language="javascript">';
            echo 'alert("New Password And Confirm New Password Are Not Same")';
            echo '</script>';
        } 
    }else{
        echo '<script language="javascript">';
        echo 'alert("Incorrect Password")';
        echo '</script>'; 
    }
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="userpasedi.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
    <?php
        include("../menu/menu.php");
    ?>
    <form class="box" method="POST">
        <h1>Enter New Password</h1>
        <input type="password" name="op" placeholder="Current Password" required>
        <input type="password" name="np" placeholder="New Password" pattern=".{8,}" required title="Enter at least 8 characters">
        <input type="password" name="cp" placeholder="Confirm New Password" required>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
<?php 
    }
    else{
        header('location:../login/log.php');
    }
?>
