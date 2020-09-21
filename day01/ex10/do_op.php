#!/usr/bin/php
<?PHP
if ($argc != 4)
	echo"Incorrect Parameters\n";
else {
	$a1 = trim($argv[1]);
	$a2 = trim($argv[2]);
	$a3 = trim($argv[3]);
	if (($a2== "/" || $a2== "%") && ($a3 == 0))
		echo "Incorrect Second Parameter\n";
	else if ($a2 == "+")
		echo $a1 + $a3."\n";
	else if ($a2 == "-")	
		echo $a1 - $a3."\n";
	else if ($a2 == "*")	
		echo $a1 * $a3."\n";	
	else if ($a2 == "/")	
		echo $a1 / $a3."\n";
	else if ($a2 == "%")	
		echo $a1 % $a3."\n";
}
?>