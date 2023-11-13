<?php

$pdo = DBManager::getInstance();
$controller = $pdo->getControllerUser();
$message = "allo";

$userEmail = isset($_SESSION['USER_email']) ? $_SESSION['USER_email'] : null;
$user = null;
if ($userEmail !== null) {
    $user = $controller->getUserByEmail($userEmail);
}

if ($user != null) {
    $message = '
        <div class="sidebar" id="sidebar">
            <div class="x">
                <img class="x-image" src="img/icons8-x-48.png" alt="X button" id="x" />
            </div>
            <ul class="sidebar-option">
                <li><a href="./products.php">Shop</a></li>
                <li><a href="./index.php">About</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="./logOut.php">Log out</a></li>
            </ul>
            <div class="account-info">
                <div class="upper-account">
                    <p>' . $user['fullName'] . '</p>
                    <a href="./account.html"><img class="three-dot" src="img/icons8-3-points-60.png" alt="settings account" /></a>
                </div>
                <div class="lower-account">
                    <p class="account-email">' . $userEmail . '</p>
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
                <li><a href="./products.php">Shop</a></li>
                <li><a href="./index.php">About</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="./logIn.html">Log in</a></li>
            </ul>
        </div>';
}

?>