<?php
require_once '../model/Produits.php';
class ProduitsController
{
    private $model;
    public function __construct($pdo)
    {
        $this->model = new ProduitsModel($pdo);
    }
    public function getAllProducts()
    {
        return $this->model->getAllProducts();
    }
    public function getProductById($id)
    {
        return $this->model->getProductById($id);
    }
    public function calculateCart()
    {
        return $this->model->calculateCart();
    }

    public function getPriceProduct($id)
    {
        return $this->model->getPriceProduct($id);
    }

    public function getProductsByColor($color)
    {
        return $this->model->getProductsByColor($color);
    }
    public function getAllProductsByType($type)
    {
        return $this->model->getAllProductsByType($type);
    }
    public function getAllProductsBySize($size)
    {
        return $this->model->getAllProductsBySize($size);
    }

    public function getFilteredProducts($type, $couleur, $taille, $prixRange)
    {
        return $this->model->getFilteredProducts($type, $couleur, $taille, $prixRange);
    }
}
