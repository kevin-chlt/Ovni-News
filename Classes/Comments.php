<?php

class Comments
{
    private PDO $pdo;
    private int $id;
    private string $content;
    private Articles $article;
    private Users $user;
    private datetime $postedAt;


    public function __construct(PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    # Return list of comment by article ID
    public function getCommentsByArticleID (int $id) : array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comments WHERE article_id = ? ORDER BY posted_at DESC');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = [];
        while($comment = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $comment;
        }
        return $data;
    }

    # Add comment in DB and return true
    public function addInDB(string $content, Articles $articles, Users $users): string
    {
        if (!$this->antiSpam($articles, $users)){
            return 'Vous devez patienter pour écrire un nouveau commentaire.';
        }
        if(!isset($_POST['message']) || strlen($_POST['message']) < 2){
            return 'Vous devez écrire quelque chose.';
        }

        $stmt = $this->pdo->prepare('INSERT INTO comments (content, article_id, user_id) VALUE (?,?,?) ');
        $stmt->bindValue(1,htmlspecialchars($content, ENT_QUOTES));
        $stmt->bindValue(2, $articles->getId(), PDO::PARAM_INT);
        $stmt->bindValue(3, $users->getId());
        $stmt->execute();
       return 'Votre message à bien été envoyé !';
    }


    # 3 Messages maximum par minute
    public function antiSpam (Articles $article, Users $user) : bool
    {
        $stmt = $this->pdo->prepare('SELECT count(id) as count FROM comments WHERE article_id = ? AND user_id = ? AND posted_at BETWEEN DATE_SUB(now(), INTERVAL 1 minute ) AND now()');
        $stmt->bindValue(1, $article->getId(), PDO::PARAM_INT);
        $stmt->bindValue(2, $user->getId());
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if((int)$data['count'] > 1) {
            return false;
        }
        return true;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getArticle(): Articles
    {
        return $this->article;
    }

    public function setArticles(Articles $article): void
    {
        $this->article = $article;
    }

    public function getUser(): Users
    {
        return $this->user;
    }

    public function setUsers(Users $user): void
    {
        $this->user = $user;
    }

    public function getPostedAt(): string
    {
        return $this->postedAt->format('d/m/Y H:m:s');
    }

    public function setPostedAt(datetime $postedAt): void
    {
        $this->postedAt = $postedAt;
    }



}