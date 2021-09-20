<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/ico" href="assets/images/favicon.ico"/>
    <link href="assets/css/errorPage_viewStyle.css" rel="stylesheet" />
    <title>Erreur | L'OVNI</title>
</head>
<body>
<main>
    <section>
            <img class="logo" src="assets/images/gestion-des-risques.svg">
            <h1 class="text-title"><?php echo $e->getMessage() ?></h1>
    </section>
    <a class="link_back" href="javascript:history.back()">Retour</a>
</main>
</body>
</html>