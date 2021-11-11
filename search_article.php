<?php
require_once 'Modeles/dbCaller.php';
require_once 'Classes/Articles.php';
require_once 'Classes/Author.php';
require_once 'Classes/ManageData.php';

/** @var void|PDO $dsn */
$articleManager = new Articles($dsn);
$authorManager = new Author($dsn);
$dataManager = new ManageData($dsn, $authorManager);
session_start();



    if($_GET['author'] > 0 && ctype_digit($_GET['author'])) {
        $list = $articleManager->listArticles($_GET['author'],'author', $_GET['limit'], $_GET['page'] );
        $authorList = $authorManager->getAuthorList();
        $pagination = $dataManager->getPagination('search_article', 'author',  $_GET['author'], $_GET['limit']);
        require_once 'Vues/listeArticles_view.php';
    }else {
        header("Location: index.php?category=general");
    }




