<?php
require "LIB_project1.php";
session_start();
loginEmpty($_SESSION['loggedIn']);
	require "DBPDO.class.php";
	$db = new DB();
	if(isset($_POST['submit'])){
		$db->deletefromCart($_SESSION['loggedIn']);
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
<link rel="stylesheet" type="text/css" href="css/mainCss.css">
</head>
<body>
<form action = "cart.php" method="POST">
<div class = "nav">
	 <ul>
	  <li><a href="index.php">Home</a></li>
	  <li><a class="active" href="cart.php">Cart</a></li>
	  <li><a href="admin.php">Admin</a></li>
	</ul> 
	</div>
<div class="cart">
<?php
//loop sales items here 
	$user = $_SESSION['loggedIn'];
	$total = cartList($db,$user);
	echo "<div><p>The Total price of all the items are $ {$total}</p></div>";
	echo "<input type='submit' name='submit' value='Empty Cart' />";
	echo "<hr />";
?>
</div>
</form>
</body>
</html>