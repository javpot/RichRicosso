<?php

require_once("../manager/SessionManager.php");
require_once("../manager/DatabaseManager.php");
require_once("../controller/Utilisateurs.php");

$sessionManager = SessionManager::getInstance();
$sessionManager->end();
header("Location: ../vue/index.php");

?>