<?php

class SessionManager
{
    private static $instance = null;
    private $controller;

    private function __construct()
    {
        $this->controller = DBManager::getInstance()->getController();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new SessionManager();
        }

        return self::$instance;
    }

    private function verifyUser($email, $password)
    {
        $user = $this->controller->getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }
    public function grantAdminAccess($email, $password)
    {
        if ($this->verifyUser($email, $password)) {
            $user = $this->controller->getUserByEmail($email);
            session_start();
            if ($user['role'] == 'admin') {
                $_SESSION['admin']['isAuth'] = true;
                $_SESSION['admin']['role'] = 'admin';
            } else {
                $_SESSION['admin']['isAuth'] = false;
            }
        }
    }

    public function login($email, $password)
    {
        if ($this->verifyUser($email, $password)) {
            $_SESSION['authentifie'] = true;
            $this->grantAdminAccess($email, $password);
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