<?php
require_once("../manager/SessionManager.php");
require_once("../manager/DatabaseManager.php");
require_once("../controller/Utilisateurs.php");

$session = SessionManager::getInstance();
$db = DBManager::getInstance();

$produitsController = $db->getControllerProduct();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filters'])) {
  $typeFilter = isset($_POST['type']) ? $_POST['type'] : null;
  $couleurFilter = isset($_POST['couleur']) ? $_POST['couleur'] : null;
  $tailleFilter = isset($_POST['taille']) ? $_POST['taille'] : null;
  $prixRangeFilter = isset($_POST['range-prix']) ? $_POST['range-prix'] : null;

  $allProducts = $produitsController->getFilteredProducts($typeFilter, $couleurFilter, $tailleFilter, $prixRangeFilter);
} else {
  $allProducts = $produitsController->getAllProducts();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Products</title>
  <link rel="stylesheet" href="products.css" />
</head>

<body>
  <?php
  require('sidebar.php');
  echo $message;
  ?>
  <div class="content-container">
    <div class="filtre-container" id="filtre-container">
      <div class="head-filtre">
        <h3 class="filtre">Filtre</h3>
        <p class="x-text" id="x-text">X</p>
      </div>
      <form action="" method="post">
        <input type="hidden" name="filters">
        <div class="type">
          <p>Type:</p>
          <label for="cravatte-check">Cravatte</label>
          <input type="radio" name="type" id="cravatte-check" value="Cravatte" />
          <label for="chemise-check">Chemise</label>
          <input type="radio" name="type" id="chemise-check" value="Chemise" />
        </div>
        <div class="couleur">
          <p>Couleur:</p>
          <label for="mauve-check">Mauve</label>
          <input type="checkbox" name="couleur" id="mauve-check" value="Mauve" />
          <label for="rose-check">Rose</label>
          <input type="checkbox" name="couleur" id="rose-check" value="Rose" />
          <label for="bleu-check">Bleu</label>
          <input type="checkbox" name="couleur" id="bleu-check" value="bleu" />
          <label for="noir-check">Noir</label>
          <input type="checkbox" name="couleur" id="noir-check" value="Noir" />
          <label for="vert-check">Vert</label>
          <input type="checkbox" name="couleur" id="vert-check" value="Vert" />
        </div>
        <div class="taille">
          <p>Taille de chemise:</p>
          <label for="taille-44">44</label>
          <input class="taille" type="checkbox" name="taille" id="taille-44" value="44" />
          <label for="taille-46">46</label>
          <input class="taille" type="checkbox" name="taille" id="taille-46" value="46" />
          <label for="taille-48">48</label>
          <input class="taille" type="checkbox" name="taille" id="taille-48" value="48" />
          <label for="taille-50">50</label>
          <input class="taille" type="checkbox" name="taille" id="taille-50" value="50" />
          <label for="taille-52">52</label>
          <input class="taille" type="checkbox" name="taille" id="taille-52" value="52" />
          <label for="taille-54">54</label>
          <input class="taille" type="checkbox" name="taille" id="taille-54" value="54" />
          <label for="taille-56">56</label>
          <input class="taille" type="checkbox" name="taille" id="taille-56" value="56" />
        </div>
        <div class="range">
          <label for="range-prix">Range de prix:</label>
          <input type="range" name="range-prix" id="range-prix" min="0" max="500" />
          <p>Price range: <output id="value"></output></p>
        </div>
        <button class="button-filtre" id="button-filtre" type="submit">
          Submit
        </button>
      </form>
    </div>
    <nav>
      <img class="menu" src="img/icons8-menu-50.png" alt="menu" id="menu" />
      <p class="cart">
        <?php
        echo "Cart " . count($_SESSION['Cart']);
        ?>
      </p>
    </nav>
    <div class="main-products-container">
      <div class="top-container">
        <h2 class="all-products">All Products</h2>
        <img class="filtre" id="filtre" src="img/icons8-filtre-50.png" alt="" />
      </div>
      <div class="container-products">
        <?php foreach ($allProducts as $product): ?>
          <div class="product-card">
            <a href="product.php?id=<?php echo $product['id']; ?>">
              <img class="product-image" src="../<?php echo $product['image']; ?>" alt="" />
            </a>
            <p class="product-name">
              <?php echo $product['nom']; ?>
            </p>
            <p class="price">$
              <?php echo $product['prix']; ?>
            </p>
            <form method="post" action="index.php">
              <input type="hidden" name="addToCart">
              <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
              <button type="submit" class="add-to-cart" name="add_to_cart">Add to Cart</button>
            </form>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
  <script src="products.js"></script>
</body>

</html>