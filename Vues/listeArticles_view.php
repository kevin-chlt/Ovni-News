<?php
/** @var array $authorList */
/** @var array $list */
/** @var Articles $articleManager */
/** @var string $pagination */
/** @var ManageData $dataManager */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="assets/images/favicon.ico"/>
    <link href="assets/css/header_viewStyle.css" rel="stylesheet" />
    <link href="assets/css/listArticle_viewStyle.css" rel="stylesheet">
    <script src="assets/js/header_scripts/btn-function.js" defer></script>
    <script src="assets/js/list-article_scripts/filter_numberPerPage.js" defer></script>
    <script src="assets/js/list-article_scripts/pagination.js" defer></script>
    <title><?php
    if(isset($_GET['category'])){
        echo 'Catégorie '.ucfirst($_GET['category']).'  | L\'OVNI';
        }else {
        echo 'Recherche | L\'OVNI';
        }
        ?>
         </title>
</head>
<body>
<header>
    <?php require_once 'header_view.php'; ?>
</header>
<main>
    <aside>
        <div class="container-filter_nbrPerPage">
            <label for="limit">Articles</label>
            <select name="limit" id="numberPerPage">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
        </div>
       <div>
           <select name="author" id="authorLink">
               <option value="0">Choissisez une source</option>
                <?php
               for ($i = 0; $i < count($authorList) ; $i++){
                   echo '<option value="'.$authorList[$i]['id'].'">'.$authorList[$i]['name'].'</option>';
               }  ?>
           </select>
       </div>
    </aside>
    <?php
    for($i = 0; $i < count($list); $i++){
        echo '
           <article class="container-list">
               <img src="'.$list[$i]['urlToImage'].'" alt="image article">
               <a  href="page-article.php?id='.$list[$i]['id'].'">'.ucfirst($list[$i]['title']).'</a>
               '.$dataManager->showManageButtonAdmin($list[$i]['id']).'
           </article>
                ';
    }
    ?>
    <div class="pagination-container" id="pagination">
        <?php echo $pagination ; ?>
    </div>
    <a class="btn-retour_text" href="index.php"> Retour à l'accueil</a>
</main>
<footer>
    <?php include 'Vues/footer_view.php' ; ?>
</footer>
</body>
</html>



