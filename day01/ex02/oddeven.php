#!/usr/bin/php
<?php
$input = fopen("php://stdin", "r");
while($input && !feof($input))
{
    echo("Enter a number: ");
    $num = fgets($input);
    if($num)
    {
        $num = str_replace("\n", "", $num);
        if(is_numeric($num))
        {
            if($num % 2 == 0)
            {
                echo "The number ".$num." is even\n";
            }else{
                echo"The number ".$num." is odd\n";
            }
        }else{
			echo "'".$num."'"." is not a number\n";
        }
    }
}
echo"\n";
?>