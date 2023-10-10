<?php
require_once "autoload.php";

if (isset($_GET["p"])) {
    $page = $_GET["p"];
    switch ($page) {
        case "register":
            registerAction();
            break;
        default:
            echo "Erreur 404";
            break;
    }
} else {
    // homeAction();
}
