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
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function createUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (fullName, email,
passwordUser,infolettreSub) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['fullName'],
            $data['email'],
            $data['passwordUser'],
            $data
            ['infolettreSub']
        ]);
    }
    public function updateUser($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET fullName = ?,
email = ? WHERE id = ?");
        return $stmt->execute([$data['fullName'], $data['email'], $id]);
    }
    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    // Ajoutez d'autres fonctions ici
}