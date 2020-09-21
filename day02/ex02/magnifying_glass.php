#!/usr/bin/php
<?PHP 
if ($argc==2 && file_exists($argv[1]))
{
	$str = file_get_contents($argv[1]);
	$result = preg_replace_callback("/<a.*?>.*<\/a>/s", 
	function($match){
		$match[0] = preg_replace_callback("/title=\"(.*?)\"/s", 
		function($match){
			return (str_replace($match[1], strtoupper($match[1]), $match[0]));
		}
		, $match[0]);
		$match[0] = preg_replace_callback("/>(.*?)</s",
		function($match){
			return (str_replace($match[1], strtoupper($match[1]), $match[0]));
		}
		,$match[0]);
		return ($match[0]);
	}
	, $str);
	echo $result."\n";
}else if ($argc != 2) {
	echo "There can be only one argument!\n";
} else if (!file_exists($argv[1])) {
	echo "Specified file doesn't exist!\n";
}
?>