<?php
require_once("../manager/SessionManager.php");
require_once("../manager/DatabaseManager.php");
require_once("../controller/Utilisateurs.php");

$session = SessionManager::getInstance();
$db = DBManager::getInstance();

$productId = $_GET['id'];
$productDetails = $db->getControllerProduct()->getProductById($productId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product</title>
  <link rel="stylesheet" href="product.css" />
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
  <nav>
    <img class="menu" src="img/icons8-menu-50.png" alt="menu" id="menu" />
    <p class="cart">
      <?php
      echo "Cart " . count($_SESSION['Cart']);
      ?>
    </p>
  </nav>
  <div>
    <a href="products.php">
      <img class="arrow" src="img/Arrow 1.png" alt="arrow" />
    </a>
  </div>
  <div>
    <div class="product-img-container">
      <img class="product" src="../<?php echo $productDetails['image'] ?>" alt="clothes" />
    </div>
    <div class="container-h2">
      <h2>
        <?php echo $productDetails['nom'] ?>
      </h2>
    </div>
    <div class="container-text">
      <p>
        <?php echo $productDetails['description'] ?>
      </p>
    </div>
    <div class="end-content">
      <div class="size-tie">
        <?php if (!empty($productDetails['size'])): ?>
          <label for="sizeCravatte">Size:
            <?php echo $productDetails['size'] ?>
          </label>
        <?php elseif (empty($productDetails['size'])): ?>
          <label for="sizeCravatte">Size of your tie:</label>
          <input
            id="sizeCravatte"
            type="number"
            name="sizeCravatte"
            value="42"
            min="42"
            max="54"
            step="2"
          />
        <?php endif; ?>
      </div>
      <div class="button-container">
        <form action="index.php" method="post">
          <input type="hidden" name="addToCart">
          <input type="hidden" name="product_id" value="<?php echo $productDetails['id'] ?>">
          <button type="submit" class="add-to-cart">Add to cart</button>
        </form>
      </div>
    </div>
  </div>
  <script src="product.js"></script>
</body>

</html>