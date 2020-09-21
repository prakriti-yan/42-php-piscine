<?php
	include("install.php");
	include("query_db.php");
	session_start();
	if ($_GET['category']){
		$products = get_products_by_category($_GET["category"]);
	}else if ($_GET['origin']){
		$products = get_products_by_origin($_GET["origin"]);
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
			<!-- content begin -->
			<!-- list specific category, order by name -->
			<table id=category-products> <?php
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
			?> </table>
			<!-- content end -->
		</div>
	</body>
</html>