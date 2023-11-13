<?php

$error = isset($_GET['error']) ? $_GET['error'] : null;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width= , initial-scale=1.0" />
        <title>Rich Ricasso</title>
        <link rel="stylesheet" href="logIn.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="main-container">
            <div class="sign-login">
                <h2>Log in</h2>
                <p>
                    <a class="have-account" href="signUp.html"
                        >Dont't have an account?</a
                    >
                </p>
            </div>

            <form action="index.php" method="POST" id="form-logIn">
                <input type="hidden" name="login" />
                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                </div>
                <?php if ($error == "wrongpwd"): ?>
                    <p class="error">Wrong password! Please retry.</p>
                <?php endif; ?>
            </form>

            <button type="submit" form="form-logIn">Log in</button>
        </div>
    </body>
</html>
