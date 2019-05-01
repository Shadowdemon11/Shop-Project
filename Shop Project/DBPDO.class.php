<?php
class DB{
		//private $connection;
		private $dbh;
		
		function __construct(){
		require_once("../../../dbInfo.php");
		try{
			$this-> dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
			//change error reporting
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			die("Bad database info");
		}
	}
	//delete from the table cart using the userid
	function deletefromCart($id){
		try{
			$stmt = $this->dbh->query("Delete from cart where userid = {$id}");
			$stmt->execute();
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	}
	//insert into the table cart using userid, item name , price, and sales price
	function insertInToCart($userid,$name,$price,$sale){
	try{
			$stmt = $this->dbh->prepare("insert into cart(userid,ProductName,Price,SalePrice) values(:userid,:productName,:price,:salePrice)");
			$stmt->execute(array(
				"userid"=> $userid,
				"productName"=> $name,
				"price"=> $price,
				"salePrice"=> $sale
			));
			return $this->dbh->lastInsertId();
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	
	}
	// make an insert for the catalog table
 	function insert($name,$description,$price,$quantity,$pic,$sale){
	try{
			$stmt = $this->dbh->prepare("insert into catalog(ProductName,Description,Price,Quantity,ImageName,SalePrice) values(:productName,:description,:price,:quantity,:imageName,:salePrice)");
			$stmt->execute(array(
				"productName"=> $name,
				"description"=> $description,
				"price"=> $price,
				"quantity"=> $quantity,
				"imageName"=> $pic,
				"salePrice"=> $sale
			));
			return $this->dbh->lastInsertId();
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	
	}
	// get the data from the catalog if its an item for sale
	function getSales(){
		try{
			
			$data = array();
			$stmt = $this->dbh->prepare("select * from catalog where SalePrice > 0");
			$stmt->execute();
			$data = $stmt->fetchALL(PDO::FETCH_ASSOC);
			return $data;
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	}
	// get items from the cart under the user's id
	function getCart($id){
		try{
			
			$data = array();
			$stmt = $this->dbh->prepare("select * from cart where userid = {$id}");
			$stmt->execute();
			$data = $stmt->fetchALL(PDO::FETCH_ASSOC);
			return $data;
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	}
	// get the users password
	function getPassword()
	{
		try{
			
			$data = array();
			$stmt = $this->dbh->prepare("select * from users");
			$stmt->execute();
			$data = $stmt->fetchALL(PDO::FETCH_ASSOC);
			return $data;
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	}
	// get the user by name from table users
	function getUser($user)
	{
		try{
			
			$data = array();
			$stmt = $this->dbh->prepare("select * from users where username = ".$this->dbh->quote($user));
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			return $data;
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	}
	// get all the items that are not for sale
	function getItems(){
		try{
			
			$data = array();
			$stmt = $this->dbh->prepare("select * from catalog where SalePrice = 0");
			$stmt->execute();
			$data = $stmt->fetchALL(PDO::FETCH_ASSOC);
			return $data;
		} catch(PDOException $e){
			echo $e-> getMessage();
			die();
		}
	}
}
?>