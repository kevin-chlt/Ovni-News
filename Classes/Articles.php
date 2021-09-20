<?php


class Articles
{
    private ?PDO $pdo;
    private int $id;
    private string $title;
    private ?string $description;
    private string $url;
    private string $urlToImage;
    private string $publishedAt;
    private string $category;


    public function __construct(PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }


    public function listArticles($searchItem, string $column, int $limit = 10, int $page = 1): array
    {
        $stmt = $this->pdo->prepare('SELECT title, urlToImage, id FROM articles WHERE '.$column.' = ? ORDER BY publishedAt DESC LIMIT ? OFFSET ? ;');
        $stmt->bindValue(1, $searchItem); //Author ID or category name//
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->bindValue(3, ($page -1) * $limit, PDO::PARAM_INT);
        $stmt->execute();

        $list = [];
            while ($content = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $list[] = $content;
            }
        return $list;
    }


    public function getArticle(int $id) : self
    {
        $stmt = $this->pdo->prepare('SELECT * FROM articles WHERE id = ? ');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchObject('Articles');
        if(empty($data)){
            throw New Exception('Oops ! La page demandée n\'existe pas !');
        }
        return $data;
    }


    public function getCategory(): string
    {
        if(empty($this->category)){
            return 'general';
        }
        return $this->category;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        if (isset($this->description)){
            return $this->description;
        }
        return 'Description non trouvée';
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUrlToImage(): string
    {
        return $this->urlToImage;
    }

    public function getPublishedAt(): string
    {
        if (isset($this->publishedAt)){
            $dateFormatted = new DateTime($this->publishedAt);
            return $dateFormatted->format("d/m/Y H:m");
        }else{
            return '  ';
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPdo(?PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    private function setId(int $id): void
    {
        $this->id = $id;
    }

    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    private function setUrl(string $url): void
    {
        $this->url = $url;
    }

    private function setUrlToImage(string $urlToImage): void
    {
        $this->urlToImage = $urlToImage;
    }

    private function setPublishedAt(string $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    private function setCategory(string $category): void
    {
        $this->category = $category;
    }
}
