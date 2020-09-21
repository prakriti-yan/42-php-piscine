<?PHP
    function auth($login, $passwd)
    {
        $account = unserialize(file_get_contents("../htdocs/private/passwd"));
        foreach ($account as $key => $val){
            if (($val['login']===$login) && $val['passwd']=== hash('whirlpool', $passwd))
                return TRUE;
        }
        return FALSE;
    }
?>