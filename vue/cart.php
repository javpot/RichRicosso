<?php
require_once("C:/xampp\htdocs/RichRicosso/manager/SessionManager.php");
require_once("C:/xampp\htdocs/RichRicosso/manager/DatabaseManager.php");
require_once("C:/xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php");


$session = SessionManager::getInstance();
$db = DBManager::getInstance();

$produitsController = DBManager::getInstance()->getControllerProduct();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cart.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body>
    <?php
    require('sidebar.php');
    echo $message;
    ?>
    <div class="content-container">
        <nav>
            <img class="menu" src="img/icons8-menu-50.png" alt="menu" id="menu" />

            <p class="cart">
                <?php
                echo "Cart " . count($_SESSION['Cart']);
                ?>
            </p>
        </nav>
        <h2>
            Summary
        </h2>
        <div class="container-card">
            <?php foreach ($_SESSION['Cart'] as $productId): ?>
                <?php
                $product = $produitsController->getProductById($productId);
                ?>
                <div class="card">
                    <img class="product-img" src="../<?php echo $product['image']; ?>" alt="">
                    <div class="info-product">
                        <div class="title-product">
                            <?php echo $product['nom']; ?>
                        </div>
                        <div class="bottom-info">
                            <p>
                                <?php echo $product['prix']; ?>$ +tx
                            </p>
                            <form method="post" action="index.php">
                                <input type="hidden" name="deleteFromCart">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" class="garbage" name="remove_from_cart"><img src="img/garbage.png"
                                        alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form action="../checkout.php" method="post">
            <input type="hidden" name="name" id="" value="<?php echo $user['fullName'] . " Cart"; ?>">



            <input type="hidden" name="price" id="" value="<?php
            $totalPrice = 0;
            foreach ($_SESSION['Cart'] as $productId) {
                $productPrice = $produitsController->getPriceProduct($productId);
                $totalPrice += $productPrice;

            }
            $totalPrice = ceil($totalPrice * 1.15) * 100;
            echo $totalPrice;


            ?>">
            </input>
            <button type="submit" class="checkout">Checkout</button>
        </form>
    </div>
    <script src="cart.js"></script>
</body>

</html>