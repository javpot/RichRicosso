<?php
require_once 'model/Utilisateurs.php';
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
    public function getUserById($id)
    {
        return $this->model->getUserById($id);
    }
    public function createUser($data)
    {
        $data['passwordUser'] = password_hash(
            $data['passwordUser'],
            PASSWORD_DEFAULT
        );
        return $this->model->createUser($data);
    }
    public function updateUser($id, $data)
    {
        return $this->model->updateUser($id, $data);
    }
    public function deleteUser($id)
    {
        return $this->model->deleteUser($id);
    }
}
