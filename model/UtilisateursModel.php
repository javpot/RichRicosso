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
        $stmt = $this->pdo->query("SELECT * FROM utilisateurs");
        return $stmt->fetchAll();
    }
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function createUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email,
mot_de_passe) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data
            ['mot_de_passe']
        ]);
    }
    public function updateUser($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?,
email = ? WHERE id = ?");
        return $stmt->execute([$data['nom'], $data['prenom'], $data['email'], $id]);
    }
    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
        return $stmt->execute([$id]);
    }
    // Ajoutez d'autres fonctions ici
}