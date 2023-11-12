<?php
require_once("../manager/SessionManager.php");
require_once("../manager/DatabaseManager.php");
require_once("../controller/Utilisateurs.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>products</title>
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
        <div class="type">
          <p>Type:</p>
          <label for="cravatte-check">Cravatte</label>
          <input type="checkbox" name="type" id="cravatte-check" />
          <label for="chemise-check">Chemise</label>
          <input type="checkbox" name="type" id="chemise-check" />
        </div>
        <div class="couleur">
          <p>Couleur:</p>
          <label for="mauve-check">Mauve</label>
          <input type="checkbox" name="couleur" id="mauve-check" />
          <label for="rose-check">Rose</label>
          <input type="checkbox" name="couleur" id="rose-check" />
          <label for="bleu-check">Bleu</label>
          <input type="checkbox" name="couleur" id="bleu-check" />
          <label for="noir-check">Noir</label>
          <input type="checkbox" name="couleur" id="noir-check" />
          <label for="vert-check">Vert</label>
          <input type="checkbox" name="couleur" id="vert-check" />
        </div>
        <div class="taille">
          <p>Taille de chemise:</p>
          <label for="taille-44">44</label>
          <input class="taille" type="checkbox" name="taille" id="taille-44" />
          <label for="taille-46">46</label>
          <input class="taille" type="checkbox" name="taille" id="taille-46" />
          <label for="taille-48">48</label>
          <input class="taille" type="checkbox" name="taille" id="taille-48" />
          <label for="taille-50">50</label>
          <input class="taille" type="checkbox" name="taille" id="taille-50" />
          <label for="taille-52">52</label>
          <input class="taille" type="checkbox" name="taille" id="taille-52" />
          <label for="taille-54">54</label>
          <input class="taille" type="checkbox" name="taille" id="taille-54" />
          <label for="taille-56">56</label>
          <input class="taille" type="checkbox" name="taille" id="taille-56" />
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
      <p class="cart">Cart 0</p>
    </nav>
    <div class="main-products-container">
      <div class="top-container">
        <h2 class="all-products">All Products</h2>
        <img class="filtre" id="filtre" src="img/icons8-filtre-50.png" alt="" />
      </div>
      <div class="container-products">
        <div class="product-card">
          <img class="product-image" src="img/shirt1.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
        <div class="product-card">
          <img class="product-image" src="img/shirt2.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
        <div class="product-card">
          <img class="product-image" src="img/shirt3.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
        <div class="product-card">
          <img class="product-image" src="img/shirt4.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
        <div class="product-card">
          <img class="product-image" src="img/cravate1.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
        <div class="product-card">
          <img class="product-image" src="img/cravate4.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
        <div class="product-card">
          <img class="product-image" src="img/cravate2.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
        <div class="product-card">
          <img class="product-image" src="img/cravate3.png" alt="" />
          <p class="product-name">Cravatte Ratto</p>
          <p class="price">$89</p>
        </div>
      </div>
    </div>
  </div>
  <script src="products.js"></script>
</body>

</html>