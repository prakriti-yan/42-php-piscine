<?php
// connect to localhost and create database:
	$servername = "localhost:3306";
	$username = "root";
	define(PASSWORD, "password");
	$con = mysqli_connect($servername, $username, PASSWORD);
	if (!$con){
		die('Could not connect: ' . mysqli_connect_error());
	}
	$db = "rush00";
	$query = "CREATE DATABASE IF NOT EXISTS $db";
	if (mysqli_query($con, $query)){
		echo "";
	}else{
		$message  = 'Invalid query: '.mysqli_connect_error()."\n";
		$message .= 'Whole query: '.$query;
		die($message);
	}
	mysqli_close($con);

	$con = mysqli_connect("localhost:3306", "root", PASSWORD, "rush00");
	if (!$con){
		die('Could not connect: ' . mysqli_connect_error());
	}
// create product table and load the data:
	$query = "CREATE TABLE IF NOT EXISTS product (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		information TEXT NOT NULL,
		price INT NOT NULL,
		category VARCHAR(100) NOT NULL,
		origin VARCHAR(100) NOT NULL,
		img VARCHAR(300) NOT NULL);";
	if (mysqli_query($con, $query)){
		echo "";
	}else{
		$message  = 'Invalid query: '.mysqli_connect_error()."\n";
		$message .= 'Whole query: '.$query;
		die($message);
	}

	$query = "SET GLOBAL local_infile=1;";
	if (mysqli_query($con, $query)){
		echo "";
	}else{
		$message  = 'Invalid query: '.mysqli_connect_error()."\n";
		$message .= 'Whole query: '.$query;
		die($message);
	}

	$query = "LOAD DATA LOCAL INFILE 'data/product.csv'
	INTO TABLE product
	FIELDS TERMINATED BY ';'
	ENCLOSED BY '\"'
	IGNORE 1 ROWS;";

	if (mysqli_query($con, $query)){
		echo "";
	}else{
		$message  = 'Invalid query: '.mysqli_connect_error()."\n";
		$message .= 'Whole query: '.$query;
		die($message);
	}

	$query = "CREATE TABLE IF NOT EXISTS users (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		login varchar(16) NOT NULL,
		passwd varchar(500) DEFAULT NULL,
		admin INT,
		cart TEXT
	);";
	if (mysqli_query($con, $query)){
		echo "";
	}else{
		$message  = 'Invalid query: '.mysqli_connect_error()."\n";
		$message .= 'Whole query: '.$query;
		die($message);
	}
	$passwd = hash('whirlpool', 'root');
	$admin = TRUE;

	$data = mysqli_query($con, "SELECT * FROM users WHERE id = 1");
	$item = mysqli_fetch_array($data, MYSQLI_ASSOC);
	if (!$item){
		$query = "INSERT INTO users (`id`, `login`, `passwd`, `admin`) VALUES (1,'root','$passwd', 1)";
		if (mysqli_query($con, $query)){
			echo "";
		}else{
			$message  = 'Invalid query: '.mysqli_connect_error()."\n";
			$message .= 'Whole query: '.$query;
			die($message);
		}
	}

	$query = "CREATE TABLE IF NOT EXISTS orders (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		login varchar(16) NOT NULL,
		cart TEXT
	);";
	if (mysqli_query($con, $query)){
		echo "";
	}else{
		$message  = 'Invalid query: '.mysqli_connect_error()."\n";
		$message .= 'Whole query: '.$query;
		die($message);
	}

	mysqli_close($con);


?>