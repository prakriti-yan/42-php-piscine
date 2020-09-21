#!/usr/bin/php
<?PHP
if ($argc >= 2)
{
	$i = 1;
	$arr = array();
	while ($i < $argc)
	{
		$temp = preg_split("/ +/", trim($argv[$i]));
		if ($temp[0])
			$arr = array_merge($arr, $temp);
		$i++;
	}
	sort($arr);
	foreach($arr as $elem)
		echo"$elem\n";
}
?>