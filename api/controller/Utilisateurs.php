<?php
require_once 'C:\xampp\htdocs/RichRicosso/api/model/Utilisateurs.php';
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
        $fullname = is_null($fullname) ? "" : $fullname;
        $email = is_null($email) ? "" : $email;
        $password = is_null($password) ? "" : $password;
        $password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );
        return $this->model->createUser($fullname, $email, $password);

    }
    public function createUserNewsletter($email)
    {
        return $this->model->createUserNewsletter($email);
    }
    public function updateUser($data)
    {
        $data["password"] = password_hash(
            $data["password"],
            PASSWORD_DEFAULT
        );
        return $this->model->updateUser($data);
    }
    public function deleteUser($email)
    {
        return $this->model->deleteUser($email);
    }
}
