<?php

require 'Modeles/dbCaller.php';
require_once 'Classes/UserManager.php';
require_once 'Classes/Users.php';
session_start();
/** @var void|PDO $dsn */


try {
    $dbManager = new UserManager($dsn);
    $user = $dbManager->seekUser($_POST['email'], $_POST['password']);

    $_SESSION['user'] = $user->getFullName();
    $_SESSION['userId'] = $user->getId();
    $_SESSION['isAdmin'] = $user->isAdmin();
    header("Location: ".$_SERVER['HTTP_REFERER']);

}catch (Exception $e) {
    require_once 'Vues/errorPage.php';
}

