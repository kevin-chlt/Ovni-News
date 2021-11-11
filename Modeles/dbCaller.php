<?php

try {
    $username = 'root';
    $password = 'root';
    $database= 'news_blog';
    $hostname = 'localhost';
    $port = '8889';

    $dsn = new PDO("mysql:host=$hostname;port=$port;charset=utf8mb4;dbname=$database", $username, $password);
}
catch(PDOException $e) {
    echo "Un soucis est apparu ! Veuillez réessayer plus tard !";
    die();
}
