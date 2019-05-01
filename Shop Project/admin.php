<?php
session_start();
require "LIB_project1.php";
loginEmpty($_SESSION['loggedIn']);
//if user id is greater than 1 go back to index page
if($_SESSION['loggedIn'] > 1)
{
	header("Location:index.php");
		exit;
}
require "DBPDO.class.php";
	
	$db = new DB();
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="css/mainCss.css">
</head>
<body>
<form action = "admin.php" method="POST">
<div class = "nav">
	 <ul>
	  <li><a href="index.php">Home</a></li>
	  <li><a href="cart.php">Cart</a></li>
	  <li><a class="active" href="admin.php">Admin</a></li>
	</ul> 
	</div>
<?php
	if (isset($_POST['submit'])) 
	{
		$pass = $db->getPassword();
		
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$sale = $_POST['sale'];
		$pic = "{$name}.jpg";
		$password = $_POST['password'];
		
		$name = vaild($name);
		$description = vaild($description);
		$price = vaild($price);
		$quantity = vaild($quantity);
		$sale = vaild($sale);
		$password = vaild($password);
		
		$password2 = sha1($password);
		foreach($pass as $row){
			if($password2 === $row['password']){
				
				$data = $db->insert($name,$description,$price,$quantity,$pic,$sale);
				echo "<h3>successful</h3>";
			}
		}
		
		
	}
?>
<div>
			<label>Name:</label>
			<input type="text" name="name" size="30" />
			<?php 
			if(empty($name))
			{
				echo "<h1>put a name </h1>";
			}
			
			?>
</div>
<div>
			<label>Description:</label>
			<input type="text" name="description" size="30" />
			<?php 
			if(empty($description))
			{
				echo "<h1>give a description</h1>";
			}
			
			?>
</div>
<div>
			<label>Price:</label>
			<input type="text" name="price" size="30" />
			<?php 
			if(empty($price))
			{
				echo "<h1>put a price</h1>";
			}
			
			?>
</div>
<div>
			<label>Quantity on hand:</label>
			<input type="text" name="quantity" size="30" />
			<?php 
			if(empty($quantity))
			{
				echo "<h1>put in the quantity</h1>";
			}
			
			?>
</div>
<div>
			<label>Sale Price:</label>
			<input type="text" name="sale" size="30" />
			<?php 
			if(empty($sale))
			{
				echo "<h1>put a sales price</h1>";
			}
			
			?>
</div>
<div>
		<label>New Image :</label>
		<input type="hidden" class='hidden' name="MAX_FILE_SIZE" id="MAX_FILE_SIZE" value="3500000" />
                    <label for="uploaded_file">Choose a file to upload:</label><input name="uploaded_file" id="uploaded_file" type="file" />
                    
</div>
<div>
			<label>Enter Password:</label>
			<input type="text" name="password" size="30" />
			<?php 
			if(empty($password))
			{
				echo "<h1>your password is wrong</h1>";
			}
			
			?>
</div>
<div class="submit">
			
			<input type="submit" name="submit" value="Submit Form" />
		</div>
</form>
</body>
</html>