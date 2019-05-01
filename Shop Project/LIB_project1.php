<?php
//move all code to this file

	// checks to make sure there is nothing work with the strings and that they are safe to send to the database
	function vaild($value)
	{
		trim($value);
		stripslashes($value);
		strip_tags($value);
		htmlentities($value);
		htmlspecialchars($value);
		addslashes($value);
		return $value;
	}
	//checks to see if someone is logged in if not send them back to the login page
	function loginEmpty($login){
		if(empty($login)){
		header("Location:login.php");
		exit;
}
	}
	//lists the cart items takes in database object and who is logged in from the session
	function cartList($db,$user){
		$data = $db->getCart($user);
		$total = 0;
		foreach($data as $row){
		echo "<div>";
		echo "<h2>{$row['ProductName']}</h2>";
		echo "<p>Price: {$row['Price']}</p>";
		if($row['SalePrice'] == 0){
			$total = $row['Price'] + $total;
		}
		else
		{
			$percent = $row['SalePrice'] /100;
			$total = ($row['Price'] - ($row['Price'] * $percent)) + $total;
		}
		
		echo "<hr />";
		echo "</div>";
		
		
		}
		return $total;
	}
	
	//inserts the data from the page into the database taking in who is logged in from the session, the list of the items and the database class
	function indexinsertList($user,$list,$db){
		
		foreach($list as $selected){
			$test = explode(",",$selected);
			$db->insertInToCart($user,$test[0],$test[1],$test[2]);
		}
	}
	//loads the items that have sales to the page and it is taking in the item with sales database query
	function loadSalesDataIndex($data){
		foreach($data as $row){
			$value = "{$row['ProductName']},{$row['Price']},{$row['SalePrice']}";
			echo "<div>";
			echo "<h2>{$row['ProductName']}</h2>";
			echo "<img alt='{$row['ProductName']}' src='images/{$row['ImageName']}' >";
			echo "<h3>{$row['Description']}</h3>";
			echo "<p>Price: $ {$row['Price']} | Items left: {$row['Quantity']} | Sale at {$row['SalePrice']}%</p>";
			echo "<input type='checkbox' name='check_list[]' value='{$value}'><label>check to add {$row['ProductName']} to the cart</label><br/>";
			echo "<hr />";
			echo "</div>";
		}
	}
	//loads the items that has no sales to the page and it is taking in the item database query 
	function loadNoSalesDataIndex($data){
			foreach($data as $row){
			$value = "{$row['ProductName']},{$row['Price']},{$row['SalePrice']}";
			echo "<div>";
			echo "<h2>{$row['ProductName']}</h2>";
			echo "<img alt='{$row['ProductName']}' src='images/{$row['ImageName']}' >";
			echo "<h3>{$row['Description']}</h3>";
			echo "<p>Price: $ {$row['Price']} | Items left: {$row['Quantity']}</p>";
			echo "<input type='checkbox' name='check_list[]' value='{$value}'><label>check to add {$row['ProductName']} to the cart</label><br/>";
			echo "<hr />";
			echo "</div>";
		}
	}
	//login and checks of its the right person else echos invalid login takes in the query, username that was typed in and the password 
	function loginPassword($user,$username,$pass2){
		//$user = $db->getUser($username);
		echo "test";
		if($pass2 === $user['password']){
				
				$_SESSION['loggedIn'] = $user['id'];
				header("Location:index.php");
				exit;
				
			}
			else if ($username == "" && $password == ""){
				echo "<h2>You need to log in</h2>";
			}
			else{
				echo "<h2>Invalid Login</h2>";
			}
	}
?>