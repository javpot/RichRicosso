<?php

require_once("C:/xampp\htdocs/RichRicosso/manager/SessionManager.php");
require_once("C:/xampp\htdocs/RichRicosso/manager/DatabaseManager.php");
require_once("C:/xampp\htdocs/RichRicosso/api/controller/Utilisateurs.php");

$sessionManager = SessionManager::getInstance();
$sessionManager->end();
$sessionManager = SessionManager::getInstance();
header("Location: ../vue/index.php");

?>