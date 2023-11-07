<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ricassodb";

$dsn = "mysql:host=$serverName;dbname=$dbName";
try {
    $conn = new PDO($dsn, $dbUsername, $dbPassword);
} catch (PDOException $e) {
    die("connection failed: " . $e->getMessage());
}

