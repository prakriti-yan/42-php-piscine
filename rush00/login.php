<?php
	include ("user_db.php");
	
	function sanitize_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_POST["register"]){
		$login = sanitize_input($_POST["login"]);
		$passwd = sanitize_input($_POST["passwd"]);
		if(!add_user($login, $passwd)){
			echo "<script type='text/javascript'>alert('Give another username!');</script>";
		}else{
			echo "<script type='text/javascript'>alert('Successfully registered, please log in now!');</script>";
		}
	}
	if ($_POST["submit"]){
		$login = sanitize_input($_POST["login"]);
		$passwd = sanitize_input($_POST["passwd"]);
		if (log_in($login, $passwd)){
			header("location: /cart.php?login=$login");
		}else{
			echo "<script type='text/javascript'>alert('Wrong username or password!');</script>";
		}
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/login.css">
		<title>e-commerce</title>
	</head>
	<body>
		<div id="top-bar">
			<a id="top-logo" href="index.php">Bread house</a>
			<a id="top-login" class="button" href="login.php">Login</a>
			<a id="top-cart" class="button" href="cart.php">Cart</a>
		</div>
		<div id="site-wrapper">
			<form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				Username: <input id="login-input" type="text" name="login"/>
				<br />
				Password: <input id="passwd-input" type="password" name="passwd"/>
				<input id="login-button" type="submit" name="submit" value="Log in">
				<input id="login-button" type="submit" name="register" value="Create new user">
			</form>
		</div>
	</body>
</html>
