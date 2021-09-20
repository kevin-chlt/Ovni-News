<?php

class Author
{
    PRIVATE int $id;
    PRIVATE string $name;
    PRIVATE PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addAuthorInDB (string $name) : int
    {
        $stmtCreateAuthor = $this->pdo->prepare('INSERT INTO articles_author(name) VALUES (?)');
        $stmtCreateAuthor->bindValue(1, $name);
        $stmtCreateAuthor->execute();
        return $this->getIDAuthor($name);
    }

    public function getIDAuthor (string $name) : int
    {
        $stmtGetAuthorID = $this->pdo->prepare('SELECT * FROM articles_author WHERE name = ?');
        $stmtGetAuthorID->bindValue(1, $name);
        $stmtGetAuthorID->execute();
        $data = $stmtGetAuthorID->fetch();
            if(!$data) {
                return $this->addAuthorInDB($name);
            }
            return $data['id'];
    }

    public function getAuthorList () : array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM articles_author');
        $stmt->execute();
        $list = [];
        while ($data = $stmt->fetch()) {
            array_push($list, $data);
        }
        return $list;

    }
}