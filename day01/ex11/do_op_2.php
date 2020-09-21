#!/usr/bin/php
<?PHP

function is_op ($char)
{
	if ($char == "+" || $char =="-" || $char =="*" || $char =="/" || $char =="%")
		return (1);
	return (0); 
}

function ft_atoi ($str)
{
	$sign = 1;
	$i = 0;
	$result = 0;
	if ($str[$i] == "-")
	{
		$sign = -1;
		$i++;
	}
	else if ($str[$i] == "+")
		$i++;
	while (is_numeric($str[$i]))
	{
		$result = $result * 10 + $str[$i];
		$i++;
	}
	return ($result * $sign);
}

if ($argc != 2)
	echo "Incorrect Parameters\n";
else {
	$str = trim ($argv[1]);
	$str = preg_replace("/ +/", " ", $str);
	$i = 0;
	$error = 0;
	if ((is_numeric($str[$i])) || (($str[$i] == "-" || $str[$i] == "+") && is_numeric($str[$i + 1])))
	{
		$i++;
		$nb1 = ft_atoi($str);
	}else{
		$error = 1;
	}
	while (is_numeric($str[$i]))
		$i++;
	if ($str[$i] == " ")
		$i++;
	if (is_op($str[$i]))
		$op = $str[$i++];
	else
		$error = 1;
	if ($str[$i] == " ")
		$i++;
	if ((is_numeric($str[$i])) || (($str[$i] == "-" || $str[$i] == "+") && is_numeric($str[$i + 1])))
	{
		$nb2 = ft_atoi(substr($str, $i));
		$i++;
	}else {
		$error = 1;
	}
	while (is_numeric($str[$i]))
		$i++;
	if ($str[$i])
		$error = 1;
}
if ($error!=1)
{
	if (($op== "/" || $op== "%") && ($nb2 == 0))
		echo "Incorrect Second Parameter\n";
	else if ($op == "+")
		echo $nb1 + $nb2."\n";
	else if ($op == "-")	
		echo $nb1 - $nb2."\n";
	else if ($op == "*")	
		echo $nb1 * $nb2."\n";
	else if ($op == "/")	
		echo $nb1 / $nb2."\n";	
	else if ($op == "%")	
		echo $nb1 % $nb2."\n";	
}else if ($error==1){
	echo "Syntax Error\n";
}
?>