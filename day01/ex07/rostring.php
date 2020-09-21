#!/usr/bin/php
<?PHP
if ($argc >= 2)
{
	$array = preg_split("/ +/", trim($argv[1]));
	$i = 1;
	while ($i < count($array))
	{
		echo"$array[$i]";
		echo" ";
		$i++;
	}
	echo"$array[0]\n";
}
?>