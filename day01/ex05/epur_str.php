#!/usr/bin/php
<?PHP
if ($argc >= 2)
{
	$str = trim($argv[1]);
	$array = preg_split('/ +/', $str);
	echo implode(" ", $array)."\n";
}
?>