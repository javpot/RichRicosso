<?php
class SessionManager
{
    private static $instance = null;
    private $controller;

    private function __construct()
    {
        $this->controller = DBManager::getInstance()->getControllerUser();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            session_start();
            self::$instance = new SessionManager();
        }

        return self::$instance;
    }

    private function verifyUser($email, $password)
    {
        $user = $this->controller->getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['passwordUser'])) {
                return true;
            }
        }
        return false;
    }

    public function login($email, $password)
    {
        if ($this->verifyUser($email, $password)) {
            $_SESSION['USER_email'] = $email;
            return true;
        }
        return false;
    }

    public function addToCart($id) 
    {
        if (!isset($_SESSION['Cart'])) {
            $_SESSION['Cart'] = array();
        }

        array_push($_SESSION['Cart'], $id);
    }

    public function removeFromCart($id) 
    {
        if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
            $index = array_search($id, $_SESSION['Cart']);

            if ($index !== false) {
                unset($_SESSION['Cart'][$index]);
            }
        }
    }

    public function end()
    {
        session_start();
        session_destroy();
        echo json_encode(["success" => true, "message" => "Déconnecté avec succès"]);
    }
}
?>