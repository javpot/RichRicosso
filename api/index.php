<?php
require_once 'C:\xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php';
require_once 'C:\xampp\htdocs/RichRicosso/api/controller/Produits.php';
require_once 'C:\xampp\htdocs/RichRicosso/manager/DatabaseManager.php';
header('Content-Type: application/json; charset=utf-8');
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
    // Cases for UtilisateursController methods
    case ($method == 'GET' && $uri == '/api/utilisateurs'):
        $users = $controller->getAllUsers();
        echo json_encode($users);
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

    case ($method == 'GET' && preg_match('/^\/api\/utilisateurs\/create/', $uri)):
        $params = explode('&', parse_url($uri, PHP_URL_QUERY));
        $data = [];

        foreach ($params as $param) {
            if (strpos($param, '=') !== false) {
                list($key, $value) = explode('=', $param);
                $data[urldecode($key)] = urldecode($value);
            }
        }

        $fullname = $data['fullname'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (empty($fullname) || empty($email) || empty($password)) {
            echo json_encode([
                "success" => false,
                "message" => "Veuillez fournir tous les parametres necessaires (fullname, email, password)"
            ]);
        } else {
            $result = $controller->createUser($fullname, $email, $password);
            if ($result) {
                echo json_encode([
                    "success" => true,
                    "message" => "Utilisateur cree avec succes"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "echec de la creation de l'utilisateur"
                ]);
            }
        }
        break;

    case ($method == 'GET' && preg_match('/^\/api\/utilisateurs\/delete/', $uri)):
        $params = explode('&', parse_url($uri, PHP_URL_QUERY));
        $data = [];

        foreach ($params as $param) {
            if (strpos($param, '=') !== false) {
                list($key, $value) = explode('=', $param);
                $data[urldecode($key)] = urldecode($value);
            }
        }

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

    // Cases for ProduitsController methods
    case ($method == 'GET' && $uri == '/api/produits'):
        $products = $produitsController->getAllProducts();
        echo json_encode($products);
        break;
    case ($method == 'GET' && preg_match('/^\/api\/produits\/getById/', $uri)):
        $params = explode('&', parse_url($uri, PHP_URL_QUERY));
        $data = [];

        foreach ($params as $param) {
            if (strpos($param, '=') !== false) {
                list($key, $value) = explode('=', $param);
                $data[urldecode($key)] = urldecode($value);
            }
        }

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
