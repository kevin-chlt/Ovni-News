<?php

class UserManager
{
    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addUserinDb (string $firstName, string $lastName, string $email, string $birthDate, string $password ) : void
    {
        $request = 'INSERT INTO users (id , first_name, last_name, email, birthDate, password) VALUES (UUID(), ?, ?,  ?, ?, ?)';
        $stmt = $this->pdo->prepare($request);
        $stmt->bindValue(1, strtoupper($firstName));
        $stmt->bindValue(2, strtoupper($lastName));
        $stmt->bindValue(3, $email);
        $stmt->bindValue(4, $birthDate );
        $stmt->bindValue(5, password_hash($password, PASSWORD_BCRYPT));
        $stmt->execute();
    }


    public function seekUser (string $email, string $password) : Users
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? ');
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $user = $stmt->fetchObject('Users');

        if ($user === false) {
            throw new Exception('Identifiant inconnu');
        } else if (!password_verify($password, $user->getPassword())) {
            throw New Exception('Identifiant inconnu');
        }
        return $user;
    }

    public function checkNewUser (string $email) : void
    {
        $stmt = $this->pdo->prepare('SELECT email FROM users WHERE email = ?');
        $stmt->bindValue(1, $email);
        $stmt->execute();

        if(!empty($stmt->fetch(PDO::FETCH_ASSOC))){
            throw new Exception('Adresse email déjà utilisé');
        }
    }
}