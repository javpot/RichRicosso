<?php
echo "4";
require_once('C:\xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php');
class DBManager
{
    private static $instance = null;
    private $conn;
    private $controllerUser;
    private $controllerProduct;

    private function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=ricassodb', 'root');
        $this->controllerUser = new UtilisateursController($this->getConnection());
        $this->controllerProduct = new ProduitsController($this->getConnection());
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DBManager();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getControllerUser()
    {
        return $this->controllerUser;
    }

    public function getControllerProduct()
    {
        return $this->controllerProduct;
    }
}

?>