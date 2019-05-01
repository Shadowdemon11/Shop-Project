<?php
require "DBPDO.class.php";
require "LIB_project1.php";

$db = new DB();
session_start();

if (isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password'];

$password = vaild($password);
$username = vaild($username);
$user = $db->getUser($username);
$pass2 = sha1($password);
	loginPassword($user,$username,$pass2);

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/mainCss.css">
</head>
<body>
<form action = "login.php" method="POST">
<label>Enter Username:</label>
<input type="text" name="username" size="30" />

<label>Enter Password:</label>
<input type="password" name="password" size="30" />
<div class="submit">
			
			<input type="submit" name="submit" value="Login" />
		</div>
</form>
</body>
</html>