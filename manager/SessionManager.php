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

    public function end()
    {
        session_start();
        session_destroy();
        echo json_encode(["success" => true, "message" => "Déconnecté avec succès"]);
    }
}
?>