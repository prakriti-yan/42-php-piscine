<?php
session_start();
	include("query_db.php");
	include("user_db.php");
	
	if ($_POST["submit"]){
		$user = get_user($_SESSION['logged_in']);
		if ($user['admin']){
			if (add_product($_POST['name'], $_POST['information'], $_POST['price'], $_POST['category'], $_POST['origin'], $_POST['img'])){
				header("location: /index.php");
			}else{
				echo "<script type='text/javascript'>alert('Please fill in all fields!');</script>";
			}
		}else{
			echo "<script type='text/javascript'>alert('You do not have admin right!');</script>";
		}
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/product.css">
		<title>e-commerce</title>
	</head>
	<body>
		<?php require('page-header.php'); ?>
			<div id="site-wrapper">
				<h2>Add a new product</h2>
				<form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					Name: <input id="input" type="text" name="name"/>
					<br />
					Information: <input id="input" type="text" name="information"/>
					<br />
					Price (in euro): <input id="input" type="text" name="price"/>
					<br />
					Bread category: <input id="input" type="text" name="category"/>
					<br />
					Origin: <input id="input" type="text" name="origin"/>
					<br />
					URL for picture: <input id="input" type="text" name="img"/>
					<input id="login-button" type="submit" name="submit" value="Add">
				</form>
			</div>
	</body>
</html>