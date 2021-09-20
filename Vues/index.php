<?php  /** @var array $categories */ ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="assets/images/favicon.ico"/>
    <link href="assets/css/header_viewStyle.css" rel="stylesheet" />
    <link href="assets/css/Accueil.css" rel="stylesheet" />
    <script src="assets/js/header_scripts/btn-function.js" defer></script>
    <title>Accueil | L'OVNI </title>
</head>
<body>
<header>
    <?php require_once 'header_view.php'; ?>
</header>
<main>
    <div class="site-title_container">
        <img src="assets/images/logo.svg" />
        <div class="site-title_text">
            <h1>L'OVNI</h1>
            <h2>L'information à chaud !</h2>
        </div>
    </div>
    <div class="category-container">
        <div class="category-list_container">
        <?php

        for($i = 0; $i < count($categories) -4 ; $i++) {
            echo '
        <a href="index.php?category='.$categories[$i]['theme'].'" id="btn-category">
                <img class="category-list_img" src="'. $categories[$i]['image']. '">
                <span class="category-list_link">'.ucfirst($categories[$i]['theme']).'</span>
        </a>';
        }
        ?>
    </div>
        <div class="category-list_container">
        <?php
        for($i = 3; $i < count($categories) ; $i++) {
            echo '
        <a href="index.php?category='.$categories[$i]['theme'].'" class="category-list_item" id="btn-category">
                <img class="category-list_img" src="'. $categories[$i]['image']. '">
                <span class="category-list_link">'.ucfirst($categories[$i]['name']).'</span>
        </a>';
        }
        ?>
        </div>
    </div>
</main>
<footer>
    <?php include 'Vues/footer_view.php' ; ?>
</footer>
</body>
</html>