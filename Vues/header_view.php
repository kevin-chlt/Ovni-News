<?php
/** @var array $categories */
require_once 'Modeles/category.php';
?>


<div class="header-logo_container">
    <a class="link-logo" href="index.php"> <img class="logo-header" src="assets/images/logo.svg" /> </a>
    <img class="small-category_icon" src="assets/images/align-justify.svg" id="btn-category" />
</div>


<nav class="header-nav">
            <?php
            for($i = 0; $i < count($categories); $i++) {
                echo ' 
                <a class="header-nav_link '.$categories[$i]['theme'].'" href="index.php?category='.$categories[$i]['theme'].'">
                    '.ucfirst($categories[$i]['name']).'
                </a> ';
            }?>
    </nav>

        <?php
        if(isset($_SESSION['user'])){
        echo '
    <div class="user-board_container" id="userboardContainer">
            <span class="userName_text">' .ucfirst($_SESSION['user']).'</span>
            <a class="user-profil_link" href="">Accedez à votre profil</a>
    </div>
    <div class="user-panel_container"> 
        <img class="user-picture_img" src="assets/images/male-default-profile-picture.jpg">
    </div>   
';
        }else {
            echo '
            <a class="user-subscribe_link" id="subscribe-container"href="./subscribe-check.php"> Inscrivez-vous </a>
    <div class="small-connexion_container">
    <img src="assets/images/house-user.svg" class="small-connexion_icon" id="btn-img_connexion">
    </div>
    <div class="user-connexion_container" id="container-formConnect">
        <form class="user-connexion_form" method="POST" action="connexion-check.php" id="form-user">
            <input class="input" type="text" name="email" placeholder="Adresse mail">
            <input class="input" type="password" name="password" placeholder="Mot de passe">
        </form>
        <div class="user-connexion_btn" id="submit-btn" role="button" tabindex="0">
            <img class="user-connexion_img" src="assets/images/arrow-circle-right_pageArticle.svg" />
        </div>
    </div>
    ';
        }?>


<ul id="menu" class="responsive-dropdown_close responsive_dropdown">
    <?php for($i = 0; $i < count($categories); $i++){
        echo '
        <li class="responsive-text_container"> 
            <a href="index.php?category='.$categories[$i]['theme'].'" class="dropdown-text '.$categories[$i]['theme'].'_responsive"> '.$categories[$i]['name'].'</a> 
        </li>';
    } ?>

</ul>
