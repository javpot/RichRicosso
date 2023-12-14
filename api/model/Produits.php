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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPriceProduct($id)
    {
        $stmt = $this->pdo->prepare("SELECT prix FROM clothes WHERE id = ?");
        $stmt->execute([$id]);
        $price = $stmt->fetchColumn();
        return $price;
    }

    public function calculateCart()
    {
        if (!empty($_SESSION['Cart'])) {
            $somme = 0;
            foreach ($_SESSION['Cart'] as $productId) {
                $price = $this->getPriceProduct($productId);
                $somme += $price;
            }
            return $somme;
        }
        return "marche pas";
    }

    public function getProductsByColor($color)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE couleur LIKE ?");
        $stmt->execute([$color]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProductsByType($type)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE type LIKE ?");
        $stmt->execute([$type]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProductsBySize($size)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clothes WHERE size = ?");
        $stmt->execute([$size]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFilteredProducts($type, $couleur, $taille, $prixRange)
    {
        $sql = "SELECT * FROM clothes WHERE ";

        $conditions = [];

        if (!empty($type)) {
            $conditions[] = "type LIKE :type";
            $type = "%" . $type . "%";
        }

        if (!empty($couleur)) {
            $conditions[] = "couleur LIKE :couleur";
            $couleur = "%" . $couleur . "%";
        }

        if (!empty($taille)) {
            $conditions[] = "size = :taille";
        }

        if (!empty($prixRange)) {
            $conditions[] = "prix <= :prixRange";
        }

        if (empty($conditions)) {
            return [];
        }

        $sql .= implode(" AND ", $conditions);

        $stmt = $this->pdo->prepare($sql);

        if (!empty($type)) {
            $stmt->bindValue(':type', $type, PDO::PARAM_STR);
        }

        if (!empty($couleur)) {
            $stmt->bindValue(':couleur', $couleur, PDO::PARAM_STR);
        }

        if (!empty($taille)) {
            $stmt->bindValue(':taille', $taille, PDO::PARAM_STR);
        }

        if (!empty($prixRange)) {
            $stmt->bindValue(':prixRange', $prixRange, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}