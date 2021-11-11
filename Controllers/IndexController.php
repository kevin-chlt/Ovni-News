<?php

class IndexController
{

    protected int $limit = 10;
    protected int $page = 1;
    protected string $dbColumn;
    protected $searchItem;

    public function getMethodForApiData (ApiCaller $apiCaller, ManageData $dataManager)
    {
        $cleanApiData = $apiCaller->getDataFromApi($_GET['category']);
        $dataManager->noAddDoubleData($cleanApiData);
    }

    public function getArticlesList (Articles $articleManager, ManageData $dataManager, Author $author)
    {
        $list = $articleManager->listArticles($this->searchItem, $this->dbColumn, $this->limit, $this->page);
        $pagination = $dataManager->getPagination($this->dbColumn, $this->searchItem, $this->limit);
        $authorList = $author->getAuthorList();
        require_once 'Vues/listeArticles_view.php';
    }

    public function setLimit(int $limit): void
    {
         $this->limit = $limit;
         if($limit === 0) {
             $this->limit = 10;
         }
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
        if($page === 0) {
            $this->page = 1;
        }
    }

    public function setDbColumn(string $dbColumn): void
    {
        $this->dbColumn = $dbColumn;
    }

    public function setSearchItem($searchItem): void
    {
        $this->searchItem = $searchItem;
    }
}