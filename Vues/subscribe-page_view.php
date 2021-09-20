<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="assets/images/favicon.ico"/>
    <link href="assets/css/subscribe-page_viewStyle.css" rel="stylesheet" />
    <script src="assets/js/subscribe-page/animation-input.js" defer></script>
    <title>Page d'inscription</title>
</head>
<body>

<main>
    <form method="POST" action="subscribe-check.php" id="form">
        <div class="container_title">
            <a class="link-logo" href="index.php">
                <img class="logo-header" src="assets/images/logo_transparent.svg" />
            </a>
            <h1>Formulaire d'inscription</h1>
        </div>
        <div class="container-text">
            <p>Afin de pouvoir accéder à certaines fonctionnalitée de l'OVNI, vous aurez besoin d'un compte.</p>
            <p>Pour vous enregistrer, veuillez écrire votre nom et prénom ainsi que votre date de naissance, un mot de passe et une adresse email valide.</p>
        </div>
        <div class="input_container" id="inputContainer">
            <label id="label">Email</label>
            <input type="email" id="0" name="email" placeholder="Entrer une adresse email valide" required/>
        </div>
        <div class="btn-container">
            <button type="button" id="backBtn">Précédent</button>
            <span class="counter_text" id="spanCounter">1/5</span>
            <button type="submit" id="submitBtn">M'inscrire</button>
            <button type="button" id="nextBtn">Suivant</button>
        </div>
    </form>
</main>
</body>
</html>