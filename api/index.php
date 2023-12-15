<?php
require_once 'C:\xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php';
require_once 'C:\xampp\htdocs/RichRicosso/api/controller/Produits.php';
require_once 'C:\xampp\htdocs/RichRicosso/manager/DatabaseManager.php';
require_once '../vendor/autoload.php';  // Include Stripe autoload

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

        if (empty($email)) {
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

    case ($method == 'POST' && $uri == '/api/payment/checkout'):

        $price = isset($_POST['price']) ? $_POST['price'] : "200";
        $price_in_cents = (int) round(floatval($price) * 100); // Convert to cents
        $name = isset($_POST['name']) ? $_POST['name'] : "Default Product Name";

        $stripeKey = "sk_test_51ONLMrCSaJtvvE1CqAiq7RO86H7DPSQlCZlAbuiBo2MckN7PS83mYlH8Lwn1C8gN1ahbsEpg2DNTb97AMP4xL2t100TEpUgGAS";

        \Stripe\Stripe::setApiKey($stripeKey);

        $line_items = [
            [
                'price_data' => [
                    'currency' => 'cad',
                    'product_data' => [
                        'name' => $name . "'s Cart",
                        'description' => 'We cannot guarantee the safety, integrity and well-being of your order. Continue at your own risk',
                        'images' => ["https://i.postimg.cc/CMRp309s/7467bd695b1349d8abdcd70fd878b0a7.png"],
                    ],
                    'unit_amount' => $price_in_cents . "",
                ],
                'quantity' => 1,
            ]
        ];

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => "http://localhost:8080/home",
                "line_items" => $line_items,
            ]);

            echo json_encode([
                'name' => $name,
                'price_data' => $price,
                'checkout_session_id' => $checkout_session->id,
                'checkout_url' => $checkout_session->url,
            ]);

            error_log("Checkout Session created successfully: " . json_encode($checkout_session));
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo json_encode(["success" => false, "message" => "Error creating Checkout Session" . $e]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Erreur : Chemin non reconnu ou non pris en charge."]);
}
?>