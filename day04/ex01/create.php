<?PHP
    if ($_POST['login'] != '' && $_POST['passwd'] != '' && $_POST['submit'] == 'OK'){
        if (!file_exists("../htdocs")){
            mkdir("../htdocs");
        }
        if (!file_exists("../htdocs/private")){
            mkdir("../htdocs/private");
        }
        if (!file_exists("../htdocs/private/passwd")){
            file_put_contents("../htdocs/private/passwd", null);
        }
        $account = unserialize(file_get_contents("../htdocs/private/passwd"));
        if ($account){
            $repeat = FALSE;
            foreach ($account as $key => $val){
                if ($val['login'] === $_POST['login'])
                    $repeat = TRUE;
            }
        }
        if ($repeat){
            echo "ERROR\n";
        }else{
            $new['login'] = $_POST['login'];
            $new['passwd'] = hash('whirlpool', $_POST['passwd']);
            $account[] = $new;
            file_put_contents("../htdocs/private/passwd", serialize($account));
            echo "OK\n";
        }
    }else{
        echo "ERROR\n";
    }
?>