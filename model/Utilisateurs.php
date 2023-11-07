<?php
class UtilisateursModel
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    public function createUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (fullName, email, passwordUser, infolettreSub) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['fullName'],
            $data['email'],
            $data['passwordUser'],
            $data['infolettreSub']
        ]);
    }
    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET fullName = ?,
email = ? WHERE email = ?");
        return $stmt->execute([$data['fullName'], $data['email'], $data['email']]);
    }
    public function deleteUser($email)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE email = ?");
        return $stmt->execute([$email]);
    }
    // Ajoutez d'autres fonctions ici
}