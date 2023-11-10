<?php
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
    require_once('sidebar.php');
    echo $message;
    ?>
    <div class="content-container">
        <nav>
            <img class="menu" src="img/icons8-menu-50.png" alt="menu" id="menu" />

            <p class="cart">Cart 0</p>
        </nav>
        <h2>
            Summary
        </h2>
        <div class="container-card">
            <div class=card>
                <img class="product-img" src="img\cravate2.png" alt="">
                <div class="info-product">
                    <div class="title-product">Chemise riso</div>

                    <div class="bottom-info">
                        <p>200$ +tx</p>
                        <img class="garbage" src="img\garbage.png" alt="">
                    </div>
                </div>
            </div>
            <div class=card>
                <img class="product-img" src="img\cravate2.png" alt="">
                <div class="info-product">
                    <div class="title-product">Chemise riso</div>

                    <div class="bottom-info">
                        <p>200$ +tx</p>
                        <img class="garbage" src="img\garbage.png" alt="">
                    </div>
                </div>
            </div>
            <div class=card>
                <img class="product-img" src="img\cravate2.png" alt="">
                <div class="info-product">
                    <div class="title-product">Chemise riso</div>

                    <div class="bottom-info">
                        <p>200$ +tx</p>
                        <img class="garbage" src="img\garbage.png" alt="">
                    </div>
                </div>
            </div>
            <div class=card>
                <img class="product-img" src="img\cravate2.png" alt="">
                <div class="info-product">
                    <div class="title-product">Chemise riso</div>

                    <div class="bottom-info">
                        <p>200$ +tx</p>
                        <img class="garbage" src="img\garbage.png" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>