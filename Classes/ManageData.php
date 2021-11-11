<?php


class ManageData
{
    private PDO $pdo;
    private Author $author;

    public function __construct(PDO $pdo, Author $author)
    {
        $this->pdo = $pdo;
        $this->author = $author;
    }


    private function addArticlesInDatabase(array $content): void
    {
        for ($i = 0; $i < count($content); $i++) {
            $publishAt = new DateTime($content[$i]['publishedAt']); // transforme la date pour HEROKU //
            $requete = 'INSERT INTO articles(title, description, urlToImage, publishedAt, url , category, author) 
            VALUES (?, ?, ?, ?,? , ?, ?);';
            $stmt = $this->pdo->prepare($requete);
            $stmt->bindValue(1, htmlspecialchars_decode($content[$i]['title'], ENT_HTML5));
            $stmt->bindValue(2, htmlspecialchars_decode($content[$i]['description'], ENT_HTML5));
            $stmt->bindValue(3, $content[$i]['urlToImage']);
            $stmt->bindValue(4, $publishAt->format('Y-m-d H:m:s'));
            $stmt->bindValue(5, $content[$i]['url']);
            $stmt->bindValue(6, $_GET['category']);
            $stmt->bindValue(7, ($this->author->getIDAuthor($content[$i]['source']['name'])), PDO::PARAM_INT);
            $stmt->execute();
        }
    }


    public function noAddDoubleData(array $apiContent): void
    {
        $stmt = $this->pdo->prepare('SELECT title FROM articles');
        $titles = []; // CONTIENT LES TITRES DE LA REQUETE SQL //
        $content = [];
        if ($stmt->execute()) {
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $titles[] = $data['title']; // LES TITRES DE LA REQUETES SQL ALIMENTES LE TABLEAU $TITLES //
            }
            foreach ($apiContent as $article) {
                if (!in_array($article['title'], $titles)) {
                    $content[] = $article;
                }
            }
        }
        $this->addArticlesInDatabase($content);
    }


    public function getPagination(string $column, $searchItem , int $limit) : string
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(id) as count FROM articles WHERE '.$column.' = ?');
        $stmt->bindValue(1, $searchItem);
        $stmt->execute();
        $countItem = $stmt->fetch(PDO::FETCH_ASSOC);

        ob_start();
        for ($i = 0; $i < ((int) $countItem['count'] / $limit) ; $i ++) {
            echo '<a href="index.php?'.$column.'='.$searchItem .'&page='.($i+1).'&limit='.($limit).'">'.($i+1).'</a>';
        }
        return ob_get_clean();
    }


    public function showManageButtonAdmin(int $id) : ?string
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            return '<a class="remove-link" href="admin.php?remove-article='.$id.'">Supprimer</a>';
        } else {
            return null;
        }
    }

    public function removeArticle (int $id): string
    {
        foreach ($this->pdo->query('SELECT MAX(id) as max FROM articles') as $item){
            if($id >= $item['max']){
                throw new Exception('ID non existant en base de donnée');
            }
        }

        $stmt = $this->pdo->prepare('DELETE FROM articles WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return 'Suppression de l\'article effectué avec succés, <a href="javascript:history.go(-1)"> Retour à la page précédente</a>';
    }
}

