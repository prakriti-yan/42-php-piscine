<?PHP
    if (($_SERVER['PHP_AUTH_USER'] == "zaz") && ($_SERVER['PHP_AUTH_PW'] == "Ilovemylittleponey"))
    {
        $file = '../img/42.png';
        $picture = base64_encode(file_get_contents($file));
        echo "<html><body>\nHello Zaz<br />\n<img src='data:image/png;base64,";
        echo $picture;
        echo "'>\n</body></html>\n";
    }else{
        header(' HTTP/1.0 401 Unauthorized');
        header('WWW-Authenticate: Basic realm=\'\'Member area\'\'');
        header("Content-Type: text/html");
        echo "<html><body>That area is accessible for members only</body></html>     \n";
    }
?>