<?php

class IndexControleur
{
    public function getIndexPage () {
        require_once('Vues/index.php');
    }


    public function getArticlesList (Articles $articleManager, ApiCaller $apiCaller, ManageData $dataManager, Author $author) {
        $cleanApiData = $apiCaller->getDataFromApi($_GET['category']);
        $dataManager->noAddDoubleData($cleanApiData);
        $list = $articleManager->listArticles($_GET['category'], 'category');
        $pagination = $dataManager->getPagination('index', 'category', $_GET['category']);
        $authorList = $author->getAuthorList();
        require_once 'Vues/listeArticles_view.php';
    }


    public function getArticlesListWithLimit (Articles $articleManager, Author $author, ManageData $dataManager, int $page = 1)
    {
        if ($_GET['limit'] > 0 && is_numeric($_GET['limit']) && $_GET['page'] > 0 && is_numeric($_GET['page'])){

        $list = $articleManager->listArticles($_GET['category'],'category', $_GET['limit'], $page);
        $pagination = $dataManager->getPagination('index', 'category', $_GET['category'], $_GET['limit']);
        $authorList = $author->getAuthorList();

        require_once 'Vues/listeArticles_view.php';
        } else {
            throw New Exception('Page introuvable');
        }

    }






}