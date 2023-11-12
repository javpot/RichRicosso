<?php

class DBManager
{
    private static $instance = null;
    private $conn;
    private $controller;

    private function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=ricassodb', 'root');
        $this->controller = new UtilisateursController($this->getConnection());
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

    public function getController()
    {
        return $this->controller;
    }
}

?>