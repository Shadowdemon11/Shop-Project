<?php
require "LIB_project1.php";
session_start();
loginEmpty($_SESSION['loggedIn']);
	require "DBPDO.class.php";
	$db = new DB();
	//if (isset($_POST['submit'])) {
    //echo print_r($_POST);
	if(isset($_POST['submit'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
$user = $_SESSION['loggedIn'];
$list = $_POST['check_list'];
indexinsertList($user,$list,$db);
// foreach($list as $selected){
	
	// //print_r($selected);
	// $test = explode(",",$selected);
	// //print_r($test);
	// //foreach($test as $row
	
	// $db->insertInToCart($user,$test[0],$test[1],$test[2]);
// }
}
}
//}
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Catalog Home</title>
<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/mainCss.css">
</head>
<body>
<form action = "index.php" method="POST">
<div class = "main">
	<div class = "nav">
	 <ul>
	  <li><a class="active" href="index.php">Home</a></li>
	  <li><a href="cart.php">Cart</a></li>
	  <li><a href="admin.php">Admin</a></li>
	</ul> 
	</div>
<h1>Sales</h1>
	<div class="sales">
	<?php
	//loop sales items here 
		$data = $db->getSales();
		echo "<input type='submit' name='submit' value='Add all to cart' />";
		loadSalesDataIndex($data);
		echo "<hr />";
	?>
	</div>
	<h1>Games to buy</h1>
	<div class="items">
	<?php
	//loop normal items here
	$data = $db->getItems();
	loadNoSalesDataIndex($data);
		echo "<hr />";
	?>
	</div>
</div>
</form>
</body>
</html>