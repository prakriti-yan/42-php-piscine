<?php
	include("install.php");
	include("query_db.php");
	include("database_cart.php");
	$products = get_products();
	session_start();
	echo "<!--", "\nSession ", print_r($_SESSION, TRUE), "-->", "\n";
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
		$_SESSION['item_nb'] = 0;
		$_SESSION['total_price'] = 0;
	}
	if ($_GET['action'] == 'logout')
	{
		$_SESSION = array();
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/category.css">
		<title>e-commerce</title>
	</head>
	<body>
	<?php require('page-header.php'); ?>
		<div id="site-wrapper">
			<table id=category-products>
			<?php
				for ($i=0, $max=count($products); $i < $max; $i++)
				{
					if ($i % 5 == 0)
					{
						if ($i != 0)
							echo "<tr>";
						else
							echo "</tr><tr>";
					}
					$url = $products[$i]['img'];
					echo "<td style=\"background-image: url(", $products[$i]["img"] ,")\"><h1 class=\"name\"><a href=\"product.php?id=" . $products[$i]['id'] . "\">", $products[$i]["name"], "</a></h1>";
				}
				echo "</tr>";
			?>
			</table>
		</div>
	</body>
</html>
