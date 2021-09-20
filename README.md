## Projet Ovni news 
#### Lien du projet: https://ovni-news.herokuapp.com/

--------------------------------------------------------
#### PHP Vanilla 7.4 / Javascript Vanilla / Base de données relationnelle MariaDB

### Résumé & Fonctionnalités

Projet de réseaux social autour de l'actualité avec un partage d'articles provenant de divers journaux couvrant plusieurs thèmes avec un systeme de commentaire pour permettre l'interaction entre utilisateurs enregistré sur la plateforme.

L'utilisateur arrivant sur la page d'accueil aura la possibilité de se connecter et de choisir dans quel catégorie d'information il veux naviguer.
Les appels à l'API se font à chaque fois qu'un utilisateur clique sur la categorie de son choix', la categorie est placé dans l'url d'appel à l'API.
Une fois les articles récupéré de l'API, l'application traitera les données en filtrant les données comportant obligatoire titre, image et url de la source extérieur, puis verifiera si les données sont déjà enregistré ou non dans la base de données et les ajoutes dans celle-ci dans le cas où elle ne serait pas enregistré.

L'utilisateur à accès à un filtre par auteur et par nombre d'articles retournés dans la liste.

Une fois l'article choisi, une page de détai de celui-ci s'affichera, et un espace de commentaire permettant aux utilisateur de réagir à l'info.

Le projet est responsive est adapté à tous les supports avec un dropdown fait maison en JS/CSS pour le menu des catégories.



### Schema de relation entre les tables de la base de données


![schema_bdd_ovni](https://user-images.githubusercontent.com/83563269/128762257-f96113bd-2c1a-461f-b0f7-9662cb0bb613.PNG)


### Deploiement en local 

- Cloner les fichier sur votre ordinateur avec git  
`git clone git@github.com:kevin-chlt/Ovni-News.git`
- Aller dans le fichier `Modeles/dbCaller.php` et remplissez la configuration de votre base de données.  
Pour configurer votre base de données, un fichier d'import des tables nommé `import.sql` est disponible à la racine du projet.
- Aller sur le site de [News Api](https://newsapi.org/) pour obtenir une clé d'API que vous collerez dans le fichier `Classes/ApiCaller.php` 
à la fin du lien contenu dans la variable `$url`

Vous pouvez maintenant lancer votre serveur local et commencer à naviguer sur le projet.


