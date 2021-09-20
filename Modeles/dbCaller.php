<?php

try {
    $username = '';
    $password = '';
    $database= 'news_blog';
    $hostname = '';

    $dsn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
}
catch(PDOException $e) {
    echo "Un soucis est apparu ! Veuillez réessayer plus tard !";
    die();
}
