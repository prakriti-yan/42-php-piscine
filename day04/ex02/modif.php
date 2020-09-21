<?PHP
    if ($_POST['login'] != '' && $_POST['oldpw'] != '' && $_POST['newpw'] != '' && $_POST['submit'] == 'OK'){
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
            $present = FALSE;
            foreach ($account as $key => $val){
                if ($val['login'] === $_POST['login'] && $val['passwd'] === hash('whirlpool', $_POST['oldpw'])){
                    $present = TRUE;
                    $account[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
                }
            }
        }
        if ($present){ 
            file_put_contents("../htdocs/private/passwd", serialize($account));
            echo "OK\n";
        }else{
            echo "ERROR\n";
        }
    }else{
        echo "ERROR\n";
    }
?>