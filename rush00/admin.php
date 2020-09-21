<?php
	include_once("query_db.php");
	include_once("user_db.php");
	session_start();
	define(PASSWORD, "password");
	$user = get_user($_SESSION['logged_in']);
	if (!$user['admin']){
		header("location: /index.php");
	}
	else if ($_GET['action'] == 'delete_user')
	{
		$user = $_GET['login'];
		if ($user != "root")
		{
			delete_user($user);
		}
	}
	else if ($_GET['action'] == 'clear_cart')
	{
		$user = get_user($_GET['login']);
		$user_session = unserialize($user['cart']);
		$user_session['cart'] = array();
		$user_session['item_nb'] = 0;
		$user_session['total_price'] = 0;
		$serial = serialize($user_session);
		update_user_cart($_GET['login'], $serial);
	}
	else if ($_GET['action'] == 'toggle_admin')
	{
		if ($_GET['login'] != "root")
		{
			$user = get_user($_GET['login']);
			set_admin($user['login'], !$user['admin']);
		}
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/cart.css">
		<title>e-commerce</title>
	</head>
	<body>
		<?php require('page-header.php'); ?>
		<div id="site-wrapper">
			<!-- content begin -->
			<table id=cart-content>
				<tr class="cart-item">
					<th class="name">Username</th>
					<th class="price"></th>
					<th class="count"></th>
					<th class="total"></th>
				</tr>
			<?php
				$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
				if (!$link)
					die('Could not connect: ' . mysqli_connect_error());
				$query = "SELECT * FROM users";
				$data = mysqli_query($link, $query);
				$data = mysqli_fetch_all($data, MYSQLI_ASSOC);
				// print_r($data);
				// print_r($user);

				foreach ($data as $user)
				{
					// echo "<!--", "\nCart ", print_r($user, TRUE), "-->", "\n";
					echo '<tr class="cart-item">';
					echo '<td class="name">' . $user['login'] . '</td>';
					echo '<td class="price">';
						echo '<a href="/admin.php?action=clear_cart&login=', $user['login'], '"><input type="button" class="button warning" value="Clear cart" /></a>';
					echo '</td>';
					echo '<td class="price">';
						echo '<a href="/admin.php?action=delete_user&login=', $user['login'], '"><input type="button" class="button danger" value="Delete user" /></a>';
					echo '</td>';
					echo '</td>';
					echo '<td class="price">';
						echo '<a href="/admin.php?action=toggle_admin&login=', $user['login'], '">',
						'<input type="button" class="button ', $user['admin'] ? 'safe' : 'danger',
							'" value="', $user['admin'] ? 'Demote' : 'Promote' ,'" /></a>';
					echo '</td>';
				}
			?>
			</table>

			<!-- Validated Orders -->
			<table id=cart-content>
				<tr class="cart-item">
					<td class="name">Received orders</td>
				</tr>
				<tr class="cart-item">
					<th class="name">Username / Product</th>
					<th class="price">Price</th>
					<th class="count">Count</th>
					<th class="total">Total</th>
				</tr>
			<?php
				$link = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
				if (!$link){
					die('Could not connect: ' . mysqli_connect_error());
				}
				$query = 'SELECT * FROM orders ORDER BY id DESC';
				$data = mysqli_query($link, $query);
				$orders = mysqli_fetch_all($data, MYSQLI_ASSOC);
				// echo "<!--", "\nTest ", print_r($test, TRUE), "-->", "\n";

				foreach ($orders as $user)
				{
					echo '<tr class="cart-item">';
					echo '<th class="name">', $user['login'], '</th>';
					echo '<th></th><th></th><th></th></tr>';
					$user_session = unserialize($user['cart']);
					echo "<!--", "\nUserSession ", print_r($user_session, TRUE), "-->", "\n";
					foreach ($user_session['cart'] as $key => $value)
					{
						$item = get_single_product($key);
						echo '<tr class="cart-item">';
						echo '<td class="name">'. $item['name']. '</td>';
						echo '<td class="price">'.$item['price'].' €</td>';
						echo '<td class="count">'.$value.'</td>';
						echo '<td class="total">'.$item['price']*$value.' €</td>';
						echo '</tr>';
					}
				}
			?>
			</table>
			<a id="checkout" href="add_product.php">Add New Product</a>
		</div>
	</body>
</html>
