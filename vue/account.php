<?php
require_once("C:/xampp\htdocs/RichRicosso/manager/SessionManager.php");
require_once("C:/xampp\htdocs/RichRicosso/manager/DatabaseManager.php");
require_once("C:/xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php");

SessionManager::getInstance();

$userEmail = isset($_SESSION['USER_email']) ? $_SESSION['USER_email'] : null;
$controller = DBManager::getInstance()->getControllerUser();
$user = $controller->getUserByEmail($userEmail);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="account.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
</head>

<body>
  <?php
  require('sidebar.php');
  echo $message;
  ?>
  <nav>
    <img class="menu" src="img/icons8-menu-50.png" alt="menu" id="menu" />
    <p class="cart">
      <?php
      echo "Cart " . count($_SESSION['Cart']);
      ?>
    </p>
  </nav>
  <div class="main-container">
    <form method="post" action="index.php">
      <input type="hidden" name="updateAccount">
      <div class="name-email">
        <h2 class="name">
          <h2>
            <?php echo $user['fullName'] ?>
          </h2>
        </h2>
        <p class="full-email">
          <?php echo $user['email'] ?>
        </p>
      </div>
      <h2 class="personal">Personal</h2>
      <hr />
      <div class="input-container">
        <div>
          <p class="title">Full name</p>
          <input type="text" name="fullName" value="<?php echo $user['fullName'] ?>" />
        </div>
        <div>
          <p class="title">Email</p>
          <input type="email" name="email" value="<?php echo $user['email'] ?>" readonly />
        </div>
        <div>
          <p class="title">Password</p>
          <input type="password" name="password" id="password" />
        </div>
      </div>
      <div class="container-button">
        <button type="submit" class="update">Update</button>
      </div>
    </form>
  </div>
  <script src="product.js"></script>
</body>

</html>