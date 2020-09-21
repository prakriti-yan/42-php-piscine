<?php
	include("install.php");
	include("query_db.php");
	include("database_cart.php");
	include("user_db.php");
	$product = get_single_product($_GET["id"]);
	session_start();
	if ($_GET['action'] == 'add_to_cart') {
		add_to_cart($_GET['id']);
		$_SESSION['item_nb'] = cal_num($_SESSION['cart']);
		$_SESSION['total_price'] = cal_price($_SESSION['cart']);
		if (isset($_SESSION['logged_in'])){
			$user_cart = serialize($_SESSION);
			update_user_cart($_SESSION['logged_in'], $user_cart);
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
			<!-- content begin -->
			<div id="product-main">
				<?php
				echo "<img id=\"product-img\" class=\"main\" src=" . $product["img"] . " />";
				?>

				<div id="product-right">
					<h1 id="product-name"><? echo $product["name"]; ?></h1>
					<h2 id="product-price"><? echo $product["price"]; echo ' €'; ?></h2>
					<p id="product-info"><? echo $product["information"]; ?></p>
				</div>
			</div>
				<div id="product-showcase"></div>
				<form id="product-actions">
					<?php
						echo "<a href=\"/product.php?action=add_to_cart&id=" . $product["id"] . "\" ><input type=\"button\" value=\"ADD CART\" /></a>";
					?>
				</form>
			<!-- content end -->
		</div>
	</body>
</html>