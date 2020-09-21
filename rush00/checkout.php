<?php
	session_start();
	include("user_db.php");
	// print_r($_SESSION);
	if ($_SESSION['logged_in']){
		$user_cart = serialize($_SESSION);
		// print_r($user_cart);
		update_order($_SESSION['logged_in'], $user_cart);
		$_SESSION['cart'] = array();
		$_SESSION['item_nb'] = 0;
		$_SESSION['total_price'] = 0;
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<title>e-commerce</title>
	</head>
	<body>
		<?php require('page-header.php'); ?>
			<div id="site-wrapper">
				<h1>Congratulations!</h1>
				<h1>You have successfully checked out!</h1>
			</div>
	</body>
</html>