<?php
	define(PASSWORD, "password");

	function add_to_cart($id) {
		if (isset($_SESSION['cart'][$id])){
			$_SESSION['cart'][$id] +=  1;
			return true;
		}else{
			$_SESSION['cart'][$id] = 1;
			return true;
		}
		return false;
	}

	function cal_num($cart){
		$nb = 0;
		if (is_array($cart)){
			foreach ($cart as $id => $num){
				$nb = $nb + $num;
			}
		}
		return $nb;
	}

	function cal_price($cart){
		$total_price = 0;
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		if (is_array($cart)) {
			foreach ($cart as $id => $num){
				$query = "SELECT * FROM product WHERE id=$id";
				$data = mysqli_query($link, $query);
				if ($data){
					$item =  mysqli_fetch_array($data, MYSQLI_ASSOC);
					$total_price += $num * $item['price'];
				}
			}
		}
		mysqli_close($link);
		return $total_price;
	}
?>