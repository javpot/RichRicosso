<?php
require_once '../model/Utilisateurs.php';
class UtilisateursController
{
    private $model;
    public function __construct($pdo)
    {
        $this->model = new UtilisateursModel($pdo);
    }
    public function getAllUsers()
    {
        return $this->model->getAllUsers();
    }
    public function getUserByEmail($email)
    {
        return $this->model->getUserByEmail($email);
    }
    public function createUser($fullname, $email, $password)
    {
        $password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );
        return $this->model->createUser($fullname, $email, $password);
    }
    public function updateUser($data)
    {
        return $this->model->updateUser($data);
    }
    public function deleteUser($email)
    {
        return $this->model->deleteUser($email);
    }
}
