<?php
/** @var void|PDO $dsn */

require_once 'Controllers/IndexControleur.php';
require_once './Modeles/dbCaller.php';
require_once 'Classes/ApiCaller.php';
require_once 'Classes/ManageData.php';
require_once 'Classes/Articles.php';
require_once 'Classes/Author.php';

session_start();
$controller = new IndexControleur();
$api = new ApiCaller();
$author = new Author($dsn);
$dataManager = new ManageData($dsn, $author);
$articleManager = new Articles($dsn);


try{
    if(empty($_GET)){
        $controller->getIndexPage();

    }elseif (isset($_GET['category']) && empty($_GET['page']) && empty($_GET['limit'])) {
        $controller->getArticlesList($articleManager, $api, $dataManager, $author);

    }elseif (isset($_GET['category']) && isset($_GET['limit']) && empty($_GET['page'])){
        $controller->getArticlesListWithLimit($articleManager, $author, $dataManager);

    }elseif (isset($_GET['category']) && isset($_GET['limit'])&& isset($_GET['page'])) {
        $controller->getArticlesListWithLimit($articleManager, $author, $dataManager, $_GET['page']);

    }else {
        throw new Exception('Oops ! La page demandée n\'existe pas !');
    }
}catch (Exception $e) {
    require_once 'Vues/errorPage.php';
}

