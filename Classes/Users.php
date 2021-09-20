<?php


class Users
{
    private ?PDO $pdo;
    private string $id;
    private string $first_name;
    private string $last_name;
    private string $password;
    private string $email;
    private string $birthDate;
    private string $createdAt;
    private bool $is_admin;


    public function __construct(PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }


    public function getUser (string $id) : self
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject('Users');
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    private function setIsAdmin(bool $isAdmin): void
    {
        $this->is_admin = $isAdmin;
    }


    public function setFirstName(string $firstName): void
    {
        if(empty($firstName) || strlen($firstName) > 60 || !ctype_alpha($firstName)){
            throw new Exception('Votre prénom doit comporter 60 caractères maximum');
        }
        $this->first_name = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        if(empty($lastName) || strlen($lastName) > 60 || !ctype_alpha($lastName)){
            throw new Exception('Votre nom doit comporter 60 caractères maximum');
        }
        $this->last_name = $lastName;
    }


    public function setPassword(string $password): void
    {
        if(empty($password) || strlen($password) > 60){
            throw new Exception('Votre mot de passe doit comporter 60 caractères maximum');
        }
        $this->password = $password;
    }


    public function setEmail(string $email): void
    {
        if(empty($email) || strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Votre prénom doit comporter 60 caractères maximum');
        }
        $this->email = $email;
    }

    public function setBirthDate(string $birthDate): void
    {
        $input = new DateTime($birthDate);
        $dt = new DateTime();
        $dt_18 = $dt->sub(new DateInterval('P18Y'));
        $dt_100 = new DateTime();
        $dt120 = $dt_100->sub(new DateInterval('P120Y'));

        if (($dt_18 > $input) && ($dt120 < $input)){
            $this->birthDate = $birthDate;
        }else{
            throw new Exception('Vous devez avoir plus de 18 ans');
        }
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getFirst_name(): string
    {
        return $this->first_name;
    }

    public function getLast_name(): string
    {
        return $this->last_name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getFullName () : string
    {
        return $this->first_name. ' '.$this->last_name;
    }
}

