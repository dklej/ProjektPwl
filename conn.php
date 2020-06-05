<?php
    $mysql_host = 'mysql1.ugu.pl';
    $port = '';
    $username = 'db697848';
    $password = 'qwertyuio';
    $database = 'db697848';

    try {
        $pdo = new PDO( 'mysql:host=' . $mysql_host . ';dbname=' . $database . ';port=' . $port, $username, $password );
    } catch( PDOException $e ) {
        echo 'Polaczenie nie moglo zostac utworzone.<br />';
        exit;
    }
?>
