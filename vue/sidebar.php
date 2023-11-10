<?php
require_once('../controller/Utilisateurs.php');
require_once('../manager/DBManager.php');

$pdo = DBManager::getInstance();
$controller = $pdo->getController();
$message = "allo";


$userEmail = isset($_SERVER['USER_email']) ? $_SERVER['USER_email'] : null;
$user = null;
if ($userEmail !== null) {
    $user = $controller->getUserByEmail($userEmail);
    echo 'USER email IS : ' . $userEmail;
}

if ($user != null) {
    $message = '
        <div class="sidebar" id="sidebar">
            <div class="x">
                <img class="x-image" src="img/icons8-x-48.png" alt="X button" id="x" />
            </div>
            <ul class="sidebar-option">
                <li><a href="./products.html">Shop</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Log in</a></li>
            </ul>
            <div class="account-info">
                <div class="upper-account">
                    <p>Marceloti Pako</p>
                    <img class="three-dot" src="img/icons8-3-points-60.png" alt="settings account" />
                </div>
                <div class="lower-account">
                    <p class="account-email">marceloti@gmail.com</p>
                </div>
            </div>
        </div>';
} else {
    $message = '
        <div class="sidebar" id="sidebar">
            <div class="x">
                <img class="x-image" src="img/icons8-x-48.png" alt="X button" id="x" />
            </div>
            <ul class="sidebar-option">
                <li><a href="./products.html">Shop</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Log in</a></li>
            </ul>
        </div>';
}

?>