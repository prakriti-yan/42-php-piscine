<?php
	define(PASSWORD, "password");

	function add_user($login, $passwd){
		
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$login = mysqli_real_escape_string($link, $login);
		$passwd = mysqli_real_escape_string($link, $passwd);
		$repeat = FALSE;
		$admin = FALSE;
		$query = "SELECT login FROM users";
		$data = mysqli_query($link,$query);
		while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
			if ($row['login'] == $login){
				$repeat = TRUE;
				return FALSE;
			}
		}
		mysqli_free_result($data);
		$passwd =  hash('whirlpool', $_POST['passwd']);
		$query = "INSERT INTO `users`(`login`, `passwd`) VALUES ('$login','$passwd')";
		if ($repeat == FALSE){
			if(mysqli_query($link, $query)){
				return TRUE;
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_connect_error($link);
				return FALSE;
			}
		}
	}

	function delete_user($login){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$login = mysqli_real_escape_string($link, $login);
		$query = "DELETE FROM users WHERE login='$login'";
		if(mysqli_query($link, $query)){
			return TRUE;
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_connect_error($link);
			return FALSE;
		}
	}

	function log_in($login, $passwd){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$login = mysqli_real_escape_string($link, $login);
		$passwd = mysqli_real_escape_string($link, $passwd);
		$query = "SELECT * FROM users WHERE login = '$login'";
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		if (hash('whirlpool', $_POST['passwd']) == $user['passwd']){
			return TRUE;
		}else{
			return FALSE;
		}

	}

	function update_user_cart($login, $cart){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$login = mysqli_real_escape_string($link, $login);
		$cart = mysqli_real_escape_string($link, $cart);
		$query = "UPDATE `users` SET `cart`= '$cart' WHERE login = '$login'";
		if(mysqli_query($link, $query)){
			return TRUE;
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_connect_error($link);
			return FALSE;
		}
	}

	function get_user($login){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$login = mysqli_real_escape_string($link, $login);
		$query = "SELECT * FROM users WHERE login = '$login'";
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		if(mysqli_query($link, $query)){
			return $user;
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_connect_error($link);
			return FALSE;
		}
	}

	function set_admin(string $login, int $status){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$login = mysqli_real_escape_string($link, $login);
		$query = "UPDATE users SET admin=$status WHERE login = '$login'";
		if(!mysqli_query($link, $query))
		{
			echo "ERROR: set_admin: ($query)" . mysqli_connect_error($link);
			return FALSE;
		}
		else
			return TRUE;
	}

	function update_order($login, $cart){
		$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
		if (!$link){
			die('Could not connect: ' . mysqli_connect_error());
		}
		$login = mysqli_real_escape_string($link, $login);
		$cart = mysqli_real_escape_string($link, $cart);
		$query = "SELECT * FROM orders WHERE login = '$login'";
		$data = mysqli_query($link,$query);
		$row = mysqli_fetch_array($data, MYSQLI_ASSOC);
		mysqli_free_result($data);
		if ($row) {
				$repeat = TRUE;
				$query = "UPDATE orders SET cart='$cart' WHERE login = '$login'";
				if (!mysqli_query($link, $query)){
					echo "ERROR: ($query)" . mysqli_connect_error($link);
					return FALSE;
				}else{
					return TRUE;
				}
		}else{
			$query = "INSERT INTO `orders`(`login`, `cart`) VALUES ('$login','$cart')";
			if(mysqli_query($link, $query)){
				return TRUE;
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_connect_error($link);
				return FALSE;
			}
		}
	}
?>