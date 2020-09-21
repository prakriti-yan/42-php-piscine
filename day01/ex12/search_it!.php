#!/usr/bin/php
<?PHP
if ($argc < 3)
	return (0);
$key = $argv[1];
$i = 1;
$array = array();
foreach($argv as $ele)
{
	if ($i > 2)
	{
		$pair = explode(":", $ele);
		if (count($pair) == 2 && strcmp($key, $pair[0]) == 0)
			$result = $pair[1];
	}
	$i++;
}
if ($result)
	echo($result)."\n";
?>