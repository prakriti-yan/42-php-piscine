#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$correct = 0;
	$s = ucwords(strtolower($argv[1]));
	if (substr_count($s, " ") == 4)
	{
		$array = explode(" ", $s);
		$correct++;
	}
	$day = array(
		"Monday"=>"Lundi", 
		"Tuesday"=>"Mardi", 
		"Wednesday"=>"Mercredi", 
		"Thursday"=>"Jeudi", 
		"Friday"=>"Vendredi", 
		"Saturday"=>"Samedi", 
		"Sunday"=>"Dimanche");
	$month = array(
		"1"=>"Janviere", 
		"2"=>"Fevrier", 
		"3"=>"Mars", 
		"4"=>"Avril", 
		"5"=>"Mai", 
		"6"=>"Juin", 
		"7"=>"Juillet", 
		"8"=>"Aout", 
		"9"=>"Septembre", 
		"10"=>"Octobre", 
		"11"=>"Novembre", 
		"12"=>"Decembre");
	if(in_array($array[0], $day))
		$correct++;
	if(preg_match("/^([1-9])([0-9])$/", $array[1]) && ($array[1] > 0 && $array[1] < 32))
		$correct++;
	if (in_array($array[2], $month))
		$correct++;
	if (preg_match("/^([0-9]){4}$/", $array[3]) && $array[3] >= 1970)
		$correct++;
	$time = explode(":", $array[4]);
	if (count($time) == 3)
		$correct++;
	if ((preg_match("/^([0-9]){2}$/", $time[0]) && $time[0] >=0 && $time[0] < 24) && 
		(preg_match("/^([0-9]){2}$/", $time[1]) && $time[1] >=0 && $time[1] < 60) &&
		(preg_match("/^([0-9]){2}$/", $time[2]) && $time[2] >=0 && $time[2] < 60))
		$correct++;
	if ($correct != 7)
	{
		echo "Wrong Format\n";
		exit (-1);
	}
	$jd = cal_to_jd(CAL_GREGORIAN, array_search($array[2], $month), $array[1], $array[3]);
	if (jddayofweek($jd, 1) == array_search($array[0], $day))
	{
		$stramp1 = "$array[1]"."-".array_search($array[2], $month)."-"."$array[3]"." ".$array[4];
		$time1 = strtotime($stramp1);
		$stramp2 = "01-01-1970 01:00:00";
		$time2 = strtotime($stramp2);
		$diff = $time1 - $time2;
		echo $diff."\n";
	}else
		echo "Wrong Format\n";
}
?>