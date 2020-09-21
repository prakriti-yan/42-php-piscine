<?PHP
    $array = $_GET;
    if ($array["action"]){
        if ($array["action"] == "set" && $array["name"] != "" && $array["value"] != ""){
            setcookie($array["name"], $array["value"], time() + (3600 * 6), "/");
        }
        else if ($array["action"] == "get" && $array["name"] != "" && !$array["value"]){
            $name = $array["name"];
            if ($_COOKIE[$name]){
                echo "$_COOKIE[$name]\n";
            }
        }
        else if ($array["action"] == "del" && $array["name"] != "" && !$array["value"]){
            setcookie($array["name"], "", time() - 3600);
        }
    }
?>