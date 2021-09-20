<?php

require 'Modeles/dbCaller.php';
require_once 'Classes/ManageData.php';

/** @var void|PDO $dsn */
$pdo = new ManageData($dsn);
session_start();

try {
    if (isset($_GET['remove-article']) && $_SESSION['isAdmin'] === true) {
        echo $pdo->removeArticle($_GET['remove-article']);
    } else {
        throw new Exception('Désolé, il faut être administrateur pour pouvoir faire ça');
    }
} catch (Exception $e) {
    require_once 'Vues/errorPage.php';
}
