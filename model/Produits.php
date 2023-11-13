<?php
class ProduitsModel
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getAllProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM clothes");
        return $stmt->fetchAll();
    }
    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getProductsByColor($color)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE couleur LIKE ?");
        $stmt->execute([$color]);
        return $stmt->fetchAll();
    }

    public function getAllProductsByType($type)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE type LIKE ?");
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }

    public function getAllProductsBySize($size)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE size = ?");
        $stmt->execute([$size]);
        return $stmt->fetchAll();
    }

    // NO NEED

    public function createUser($fullname, $email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (fullName, email, passwordUser) VALUES (?, ?, ?)");
        return $stmt->execute([
            $fullname,
            $email,
            $password
        ]);
    }
    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET fullName = ?, email = ? WHERE email = ?");
        return $stmt->execute([$data['fullName'], $data['email'], $data['email']]);
    }
    public function deleteUser($email)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE email = ?");
        return $stmt->execute([$email]);
    }
}