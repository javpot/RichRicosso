<?php
require_once 'C:\xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php';
require_once 'C:\xampp\htdocs/RichRicosso/api/controller/Produits.php';
require_once 'C:\xampp\htdocs/RichRicosso/manager/DatabaseManager.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
session_start();

function isAuthenticated()
{
    return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
}

$dbManager = DBManager::getInstance();
$controller = new UtilisateursController($dbManager->getConnection());
$produitsController = new ProduitsController($dbManager->getConnection());

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$tmp = explode('/', $uri);
$uri = "/" . implode('/', array_splice($tmp, 2));

switch (true) {
    case ($method == 'GET' && $uri == '/api/utilisateurs'):
        $users = $controller->getAllUsers();
        echo json_encode($users);
        break;

    case ($method == 'POST' && $uri == '/api/utilisateurs/login'):
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        $user = $controller->getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['passwordUser'])) {
                echo json_encode($user);
                break;
            }
            echo json_encode([
                "success" => false,
                "message" => "Mauvais mot de passe"
            ]);
            break;
        }
        echo json_encode([
            "success" => false,
            "message" => "Email non existant"
        ]);
        break;

    case ($method == 'GET' && preg_match('/^\/api\/utilisateurs\/get/', $uri)):
        $params = explode('&', parse_url($uri, PHP_URL_QUERY));
        $data = [];

        foreach ($params as $param) {
            if (strpos($param, '=') !== false) {
                list($key, $value) = explode('=', $param);
                $data[urldecode($key)] = urldecode($value);
            }
        }

        $email = $data['email'] ?? null;

        if (empty($email)) {
            echo json_encode([
                "success" => false,
                "message" => "Veuillez fournir l'e-mail de l'utilisateur en tant que parametre"
            ]);
        } else {
            $user = $controller->getUserByEmail($email);
            echo json_encode($user);
        }
        break;

    case ($method == 'POST' && $uri == '/api/utilisateurs/create'):
        $data = json_decode(file_get_contents("php://input"), true);
        $fullname = $data['fullname'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (empty($fullname) || empty($email) || empty($password)) {
            echo json_encode([
                "success" => false,
                "message" => "Veuillez fournir tous les paramètres nécessaires (fullname, email, password)"
            ]);
        } else {
            $result = $controller->createUser($fullname, $email, $password);
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
        }
        break;

    case ($method == 'POST' && preg_match('/^\/api\/utilisateurs\/delete/', $uri)):
        $data = json_decode(file_get_contents("php://input"), true);

        $email = $data['email'] ?? null;

        if (!empty($email)) {
            $result = $controller->deleteUser($email);
            if ($result) {
                echo json_encode([
                    "success" => true,
                    "message" => "Utilisateur supprime avec succes"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "echec de la suppression de l'utilisateur"
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Veuillez fournir l'e-mail de l'utilisateur à supprimer dans l'URL"
            ]);
        }
        break;
    case ($method == 'POST' && preg_match('/^\/api\/utilisateurs\/update/', $uri)):
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $controller->updateUser($data);

        if ($result) {
            echo json_encode([
                "success" => true,
                "message" => "Utilisateur mis à jour avec succès"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Échec de la mise à jour de l'utilisateur"
            ]);
        }
        break;

    case ($method == 'GET' && $uri == '/api/produits'):
        $products = $produitsController->getAllProducts();
        echo json_encode($products);
        break;
    case ($method == 'POST' && preg_match('/^\/api\/produits\/getById/', $uri)):
        $data = json_decode(file_get_contents("php://input"), true);

        $id = $data['id'] ?? null;

        if (empty($id)) {
            echo json_encode([
                "success" => false,
                "message" => "Veuillez fournir l'identifiant du produit en tant que parametre"
            ]);
        } else {
            $product = $produitsController->getProductById($id);
            echo json_encode($product);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Erreur : Chemin non reconnu ou non pris en charge."]);
}
?>