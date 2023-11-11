<?php

$hash = '$2y$10$EM4RTpJ7lUswL.hIiuy4L.G9Ix2akzXfZeS7MdZUAuJgSBZD//ABO';

if (password_verify('1234', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>