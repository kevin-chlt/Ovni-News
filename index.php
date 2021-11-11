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



try {
    if (empty($_GET)) {
        require_once('Vues/index.php');
    }

    if(isset($_GET['category'])){
        $controller->getMethodForApiData($api, $dataManager);
        $controller->setDbColumn('category');
        $controller->setSearchItem($_GET['category']);

        if(isset($_GET['limit']) && is_numeric($_GET['limit'])) {
            $controller->setLimit($_GET['limit']);
        }

        if (isset($_GET['page']) && is_numeric($_GET['page'])){
            $controller->setPage($_GET['page']);
        }

        $controller->getArticlesList($articleManager, $dataManager, $author);
    }

    if($_GET['author'] == 0) {
        header("Location: index.php?category=general");
    }

    if($_GET['author'] >= 0 && is_numeric($_GET['author'])){

        $controller->setDbColumn('author');
        $controller->setSearchItem($_GET['author']);

        $controller->getArticlesList($articleManager, $dataManager, $author);
    }
    else {
        throw new Exception('Oops ! La page demandée n\'existe pas !');
    }


}catch (Exception $e) {
    require_once 'Vues/errorPage.php';
}

