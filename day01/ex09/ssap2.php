#!/usr/bin/php
<?PHP

function cmp($s1, $s2)
{
	$i = 0;
	$char = "abcdefghijklmnopqrstuvwxyz0123456789!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	while (($i < strlen($s1)) || ($i < strlen($s2)))
	{
		$s1_i = stripos($char, $s1[$i]);
		$s2_i = stripos($char, $s2[$i]);
		if ($s1_i > $s2_i)
			return (1);
		else if ($s1_i < $s2_i)
			return (-1);
		else 
			$i++;
	}
	if ($i < strlen($s1))
		return (1);
	else if ($i < strlen($s1))
		return (-1);
	else 
		return (0);
}

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
	usort($arr, "cmp");
	foreach($arr as $elem)
		echo"$elem\n";
}
?>