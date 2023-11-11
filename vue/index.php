<?php

require_once("../manager/SessionManager.php");
require_once("../manager/DatabaseManager.php");
require_once("../controller/Utilisateurs.php");

$session = SessionManager::getInstance();
$db = DBManager::getInstance();
$userController = $db->getController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($session->login($email, $password) == false) {
      header("Location: ../vue/logIn.php");
    }
    header("Location: ../vue/index.php");
  } else if (isset($_POST["signUp"])) {
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userController->createUser($fullName, $email, $password);
    header("Location: ../vue/logIn.html");
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
</head>

<body>
  <?php
  require('sidebar.php');
  echo $message;
  ?>
  <div class="content-container">
    <nav>
      <img class="menu" src="img/icons8-menu-50.png" alt="menu" id="menu" />
      <div class="top-red"></div>
      <p class="cart">Cart 0</p>
    </nav>
    <div>
      <div class="middle-red">
        <h1>Ricasso</h1>
      </div>
    </div>
    
    <img class="cravatte" src="img/cravatteRR.png" alt="" />
    <div class="bottom-red">
      <p class="text-rr">
        La cravate en soie noire unie est ornée d’une rayure brodée et d’un
        détail RR sur le devant. Le détail emblématique apporte une texture
        visuelle à la soie, tout en rendant hommage au fondateur de la Maison
      </p>
    </div>
    <div class="end-red">
      <p style="color: white">$299</p>
      <p>Add to cart</p>
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
      <img class="photo-ricasso" src="img/476254874616837 1.png" alt="image de ricasso" />
    </div>
    <div class="most-popular">
      <h2>Most popular</h2>
    </div>
    <div class="wrapper">
      <i id="left" class="fa-solid fa-angle-left"></i>
      <div class="carousel">
        <img src="img/shirt1.png" alt="" draggable="false" />
        <img src="img/cravate2.png" alt="" draggable="false" />
        <img src="img/shirt2.png" alt="" draggable="false" />
        <img src="img/cravate4.png" alt="" draggable="false" />
        <img src="img/shirt4.png" alt="" draggable="false" />
      </div>
      <i id="right" class="fa-solid fa-angle-right"></i>
    </div>
    <div class="end-content">
      <img src="img/dalcuore_suit_9_s1800x0_q80_noupscale (1).jpg" alt="" />
      <div class="call-action">
        <p class="text-action">
          Ricasso: Elevate Your Style, One Knot at a Time.
        </p>
        <a href="products.html"> <button class="buy">Buy</button></a>
      </div>
    </div>
    <div class="copyright">
      <p>Copyright © Rich Ricasso</p>
    </div>
  </div>
  <script src="index.js"></script>
</body>

</html>