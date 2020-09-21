#!/usr/bin/php
<?PHP
if ($argc > 1)
{
	$i = 1;
	while($i < $argc)
	{
		echo"$argv[$i]\n";
		$i++;
	}
}
?>