<?php
/** @var Articles $article */
/** @var Articles $articleManager */
/** @var ManageData $dataManager */
/** @var array $comments */
/** @var Users $user */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="assets/images/favicon.ico"/>
    <title> <?php echo ucfirst($article->getTitle()); ?>  | L'OVNI  </title>
    <link href="assets/css/header_viewStyle.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/pageArticle_viewStyle.css">
    <script src="assets/js/header_scripts/btn-function.js" defer></script>
    <script src="assets/js/page-article_scripts/comment-btn.js" defer></script>
</head>
<body>
<header>
    <?php require_once 'header_view.php'; ?>
</header>
<main>
    <article>
        <div class="article-title_container">
            <?php echo '<h1>' . $article->getTitle().'</h1>';
            echo $dataManager->showManageButtonAdmin($_GET['id']);
            ?>
        </div>
        <div class="article-releaseDate_container">
            <?php
            echo '<span>Publié le '. $article->getPublishedAt().'</span>';
            ?>
        </div>
        <div class="article-describe_container">
            <?php echo '<h2>'.$article->getDescription().'</h2>'; ?>
        </div>

        <div class="article-img_container">
            <?php echo '<img class="article-img_item" src=" '. $article->getUrlToImage().'" />'; ?>
        </div>
        <div class="article-btn-container">
            <a id="linkWithCategory" href="./index.php?category=<?php echo $article->getCategory(); ?>">
                Retour
            </a>
            <a href="./page-article.php?id=<?php echo ( $article->getId() -1 ) ?>">
                Precedent
            </a>
            <a href="./page-article.php?id=<?php echo ( $article->getId() +1 ) ?>" >
                Suivant
            </a>
            <a href="<?php echo $article->getUrl() ?>" target="_blank">
                Source
            </a>
        </div>
    </article>
    <aside>
        <h3>Espace commentaires</h3>

        <form method="POST" action="page-article.php" id="comment-form">
            <label for="message">Ecrivez votre commentaire</label>
            <div class="form-sendbox">
                <input type="hidden" value="<?php echo $article->getId() ?>" name="articleId" />
                <textarea name="message" rows="3" id="message"></textarea>
                <img role="button" src="assets/images/arrow-circle-right_pageArticle.svg" id="comment-btn" />
            </div>
            <span class="help-text_comment" id="help-text_comment"><?php if(isset($_SESSION['flashMessage'])) {echo $_SESSION['flashMessage']; unset($_SESSION['flashMessage']);} ?></span>
        </form>

        <h4>Les derniers commentaires :</h4>

        <?php for($i = 0; $i < count($comments); $i++){
           echo '<div class="user-comments_box">
                <span class="username"> '.ucfirst($user->getUser($comments[$i]['user_id'])->getFirst_name()).' '.ucfirst($user->getUser($comments[$i]['user_id'])->getLast_name()).'</span>
                <span> '.$comments[$i]['content'].' </span>
                <span class="createdAt"> '.date_create($comments[$i]['posted_at'])->format('d/m/Y H:m:s').' </span>
        </div>';
        }
        ?>
    </aside>
</main>
</body>
</html>