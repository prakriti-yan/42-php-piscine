<?PHP
    $fn = '../img/42.png';
    header('Content-Type: image/png');
    readfile($fn);
?>