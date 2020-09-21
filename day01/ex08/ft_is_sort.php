#!/usr/bin/php
<?PHP
function ft_is_sort($tab)
{
	$temp = $tab;
	sort($tab);
	if ($temp == $tab)
		return (TRUE);
	else
		return (FALSE);
}
?>