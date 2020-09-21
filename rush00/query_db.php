<?php
	define(PASSWORD, "password");

	function get_products(){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$query = "SELECT * FROM product ORDER BY id ASC";
		$data = mysqli_query($link,$query);
		while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
			$products[] = $row;
		}
		mysqli_free_result($data);
		mysqli_close($link);
		return($products);
	}

	function get_single_product($id){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$id = mysqli_real_escape_string($link, $id);
		$query = "SELECT * FROM product WHERE id = $id ORDER BY id ASC";
		$data = mysqli_query($link,$query);
		$item = mysqli_fetch_array($data, MYSQLI_ASSOC);
		mysqli_free_result($data);
		mysqli_close($link);
		return($item);
	}

	function get_categories(){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$query = "SELECT * FROM category ORDER BY id ASC";
		$data = mysqli_query($link,$query);
		while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
			$categories[] = $row;
		}
		mysqli_free_result($data);
		mysqli_close($link);
		return($categories);
	}

	function get_products_by_category($cat){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$cat = mysqli_real_escape_string($link, $cat);
		$query = "SELECT * FROM product WHERE category = '$cat' ORDER BY id ASC";
		$data = mysqli_query($link,$query);
		while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
			$products[] = $row;
		}
		mysqli_free_result($data);
		mysqli_close($link);
		return($products);
	}

	function get_products_by_origin($origin){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$origin = mysqli_real_escape_string($link, $origin);
		$query = "SELECT * FROM product WHERE origin = '$origin' ORDER BY id ASC";
		$data = mysqli_query($link,$query);
		while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
			$products[] = $row;
		}
		mysqli_free_result($data);
		mysqli_close($link);
		return($products);
	}

	function add_product($name, $information, $price, $category, $origin, $img){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$name = mysqli_real_escape_string($link, $name);
		$information = mysqli_real_escape_string($link, $information);
		$price = mysqli_real_escape_string($link, $price);
		$category = mysqli_real_escape_string($link, $category);
		$origin = mysqli_real_escape_string($link, $origin);
		$img = mysqli_real_escape_string($link, $img);
		$query = "INSERT INTO `product`(`name`, `information`, `price`, `category`, `origin`, `img`) VALUES ('$name','$information','$price','$category','$origin','$img')";
		if(mysqli_query($link, $query)){
			return TRUE;
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_connect_error($link);
			return FALSE;
		}
	}

?>