<?php

require './Modeles/dbCaller.php';
require_once 'Classes/Articles.php';
require_once 'Classes/Author.php';
require_once 'Classes/ManageData.php';
require_once 'Classes/Users.php';
require_once 'Classes/Comments.php';

session_start();

/** @var void|PDO $dsn */
$authorManager = new Author($dsn);
$articleManager = new Articles($dsn);
$dataManager = new ManageData($dsn, $authorManager);
$user = new Users($dsn);
$comment = new Comments($dsn);

try {
   if (isset($_GET['id']) && ctype_digit($_GET['id'])) {

       $article = $articleManager->getArticle($_GET['id']);
       $comments = $comment->getCommentsByArticleID($_GET['id']);
       require_once 'Vues/pageArticle_view.php';

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
       if(!isset($_SESSION['user'])) {
           throw new Exception('Vous devez être connecté pour poster un commentaire !');
       }


       $_SESSION['flashMessage'] = $comment->addInDB($_POST['message'], $articleManager->getArticle($_POST['articleId']), $user->getUser($_SESSION['userId'])) ;
       header("Location: page-article.php?id=".$_POST['articleId']."#comment-form");

   } else {
       throw new Exception('Oops ! La page demandée n\'existe pas !');
   }


} catch (Exception $e){
    require_once 'Vues/errorPage.php';
}
