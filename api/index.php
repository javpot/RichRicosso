<?php
echo "1";
require_once 'C:\xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php';
require_once 'C:\xampp\htdocs/RichRicosso/manager/DatabaseManager.php';
session_start();
if (!isAuthenticated()) {
    echo json_encode(["success" => false, "message" => "Non authentifie"]);
}
function isAuthenticated()
{
    return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
}

$dbManager = DBManager::getInstance();
$controller = new UtilisateursController($dbManager->getConnection());
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$tmp = explode('/', $uri);
$uri = "/" . implode('/', array_splice($tmp, 2));
switch ($method | $uri) {
    case ($method == 'GET' && $uri == '/api/utilisateurs'):
        $users = $controller->getAllUsers();
        echo json_encode($users);
        break;
    case ($method == 'GET' && preg_match('/\/api\/utilisateurs\/[1-9]+/', $uri)):
        $tmp = explode('/', $uri);
        $id = end($tmp);
        $user = $controller->getUserById($id);
        echo json_encode($user);
        break;
    case ($method == 'POST' && $uri == '/api/utilisateurs'):
        $data = $_POST;
        $result = $controller->createUser($data);
        if ($result) {
            echo json_encode([
                "success" => true,
                "message" => "Utilisateur créé avec succès"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Échec de la création de l'utilisateur"
            ]);
        }
        break;
    default:
        echo json_encode(["success" => false, "message" => "Erreur : Chemin non reconnu ou non pris en charge."]);
}
?>