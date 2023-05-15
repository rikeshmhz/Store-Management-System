<?php 
    session_start();
    if((isset($_SESSION['user']))&&(isset($_SESSION['pass']))){
?>
<?php
error_reporting(0);
if(isset($_POST['submit'])){
    $Pass=$_POST['pw'];
    $User=$_POST['un'];
    include("../dbconnect/db.php");
    $q="select Password from admin where Password='$Pass'";
    $result=mysqli_query($con,$q) or die(mysqli_error($con));
    if(mysqli_num_rows($result)>0){
        $q="update admin set Username='$User' where id='1'";
        $result=mysqli_query($con,$q) or die(mysqli_error($con));
        if ($result){
            echo "<script>alert('Username Updated')</script>";
            ?><meta http-equiv="Refresh" content="0.4;http://localhost/summ/disandedi/display.php"><?php 
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
	<link rel="stylesheet" type="text/css" href="usernaedi.css">
    <link rel="stylesheet" type="text/css" href="../menu/menu.css">
</head>
<body>
	<?php
        include("../menu/menu.php");
    ?>
    <form class="box" method="POST">
        <h1>Enter New Username</h1>
        <input type="password" name="pw" placeholder="Password" required>
        <input type="text" name="un" placeholder="Username" required>
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
