<?php

require_once("../manager/SessionManager.php");
require_once("../manager/DatabaseManager.php");
require_once("../controller/Utilisateurs.php");

$session = SessionManager::getInstance();
$db = DBManager::getInstance();
$userController = $db->getControllerUser();

if (!isset($_SESSION['Cart'])) {
  $_SESSION['Cart'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($session->login($email, $password) == false) {
      header("Location: ../vue/logIn.php?error=wrongpwd");
    } else {
      header("Location: ../vue/index.php");
    }

  } else if (isset($_POST["signUp"])) {

    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userController->createUser($fullName, $email, $password);
    header("Location: ../vue/logIn.php");

  } else if (isset($_POST["newsletter"])) {

    $email = $_POST["email"];

    if (isset($_POST["news"])) {
      $userController->createUserNewsletter($email);
    }

  } else if (isset($_POST["deleteFromCart"])) {

    $productId = $_POST["product_id"];
    $session->removeFromCart($productId);

    header("Location: ../vue/cart.php");

  } else if (isset($_POST["addToCart"])) {

    $productId = $_POST["product_id"];
    $session->addToCart($productId);

    header("Location: ../vue/products.php");
  } else if (isset($_POST["updateAccount"])) {
    $arr = array("email" => $_POST["email"], "fullName" => $_POST["fullName"], "password" => $_POST["password"]);
    $db->getControllerUser()->updateUser($arr);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rich Ricasso</title>
  <link rel="stylesheet" href="./index.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="img/cover (1).png" />
  <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>

<body>
  <?php
  require('sidebar.php');
  echo $message;
  ?>
  <div id="app">
    <div class="content-container">
      <nav>
        <img class="menu" src="img/icons8-menu-50.png" alt="menu" id="menu" />
        <div class="top-red"></div>
        <p class="cart">
          <?php
          echo "Cart " . count($_SESSION['Cart']);
          ?>
        </p>
      </nav>
      <div>
        <div class="middle-red">
          <h1>Ricasso</h1>
        </div>
      </div>

      <img class="cravatte" src="img/cravateRR2.png" alt="" />
      <div class="bottom-red">
        <p class="text-rr">
          The solid black silk tie is adorned with an embroidered stripe and an RR detail on the front. The iconic
          detail
          adds a visual texture to the silk while paying tribute to the founder of the House
        </p>
      </div>
      <div class="end-red">
        <p style="color: white">$299</p>
        <a class="view-product" href="product.php?id=8">View product</a>
      </div>
      <div class="who-am-i">
        <h2>Who I am ?</h2>
      </div>
      <div class="who-container">
        <div class="left-who-container">
          <h3>Rich Ricasso</h3>
          <p class="ricasso-bio" id="ricasso-bio">
            Rich Ricasso, a luminary in the world of tie design, has left an
            indelible mark on the fashion industry. With a career spanning
            decades, he has consistently pushed the boundaries of creativity and
            elegance in the realm of neckwear.
          </p>
        </div>
        <img class="photo-ricasso" src="img/ricassoPicture.png" alt="image de ricasso" />
      </div>
      <div class="most-popular">
        <h2>Most popular</h2>
      </div>
      <div class="wrapper">
        <i id="left" class="fa-solid fa-angle-left"></i>
        <div class="carousel">
          <?php
          $allProducts = $db->getControllerProduct()->getAllProducts();
          shuffle($allProducts);
          $allProducts = array_slice($allProducts, 0, 4);

          foreach ($allProducts as $product) {
            ?>
            <a href="product.php?id=<?php echo $product['id']; ?>">
              <img src="../<?php echo $product['image']; ?>" alt="product" draggable="false" />
            </a>
            <?php
          }
          ?>
        </div>

        <i id="right" class="fa-solid fa-angle-right"></i>
      </div>
      <div class="end-content">
        <img src="img/suitBleu.jpg" alt="" />
        <div class="call-action">
          <p class="text-action">
            Ricasso: Elevate Your Style, One Knot at a Time.
          </p>
          <a href="products.php"> <button class="buy">View products</button></a>
        </div>
      </div>
      <div class="copyright">
        <div>
          <a href="infolettre.php">S'inscrire a l'infolettre</a>
          <p>Copyright © Rich Ricasso</p>
        </div>
      </div>
    </div>
  </div>
  <script src="index.js"></script>
</body>

</html>

<script>
  Vue.component('sidebar', {
    template: `
      <div>
        <!-- Your sidebar code goes here -->
      </div>
    `
  });

  new Vue({
    el: '#app'
  });
</script>