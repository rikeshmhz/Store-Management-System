<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="menu.css">
</head>
<body>
	<ul>
       <h1>Superior Collection</h1> 
        <li class="h"><a href="../home/home.php">Home</a></li>
        <li><a href="#">Manage Products</a>
        	<ul class="dropdown">
               <li><a href="../manage/addstock.php">Add Stock</a></li>
               <li><a href="../manage/sell.php">Sell</a></li>
               <li><a href="#">Return</a>
                    <ul class="sdp">
                        <li><a href="../return/return.php">To Suppliers</a></li>
                        <li><a href="../return/return1.php">From Customers</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#">Due Amounts</a>
            <ul class="dropdown">
               <li><a href="../dueamt/supdue.php">Suppliers</a></li>
               <li><a href="../dueamt/cusdue.php">Customers</a></li>
            </ul>
        </li>
        <li><a href="../managestock/managestock.php">Manage Stock</a></li>
        <li><a href="#">Records/Details</a>
            <ul class="dropdown">
                <li><a href="../records/suprec.php">Suppliers</a></li>
                <li><a href="../records/cusrec.php">Customers</a></li>
            </ul>
        </li>
		<li><a href="../disandedi/display.php">Manage Profile</a></li>
		<li><a href="../logout/logout.php">LogOut</a></li>
    </ul>
</body>
</html>
