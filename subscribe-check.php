<?php

require 'Modeles/dbCaller.php';
require_once 'Modeles/processForm.php';
require_once 'Classes/UserManager.php';
/** @var void|PDO $dsn */
session_start();
try{
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once 'Vues/subscribe-page_view.php';
    }else{
        processForm();
        $pdo = new UserManager($dsn);
        $pdo->checkNewUser($_POST['email']);
        $pdo->addUserinDb($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['birthDate'], $_POST['password']);
        $user = $pdo->seekUser($_POST['email'], $_POST['password']);

        $_SESSION['user'] = $user->getFullName();
        header("Location: index.php");
    }
} catch (Exception $e){
    require_once 'Vues/errorPage.php';
}
