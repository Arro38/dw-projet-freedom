<?php
require_once "autoload.php";

if (isset($_GET["p"])) {
    $page = $_GET["p"];
    switch ($page) {
        case "logout":
            logoutAction();
            break;
        case "register":
            registerAction();
            break;
        case "login":
            loginAction();
            break;
        case "status":
            if (!isset($_GET["a"])) {
                echo "Erreur 404 - Action inconnue";
                break;
            }
            $action = $_GET["a"];
            if ($action == "create") {
                createStatusAction();
            } else {
                echo "Erreur 404 - Action inconnue";
            }
            break;
        case "comment":
            if (!isset($_GET["a"]) && !isset($_GET["id_status"])) {
                echo "Erreur 404 - Action inconnue";
                break;
            }
            $action = $_GET["a"];
            if ($action == "create") {
                $id_status = $_GET["id_status"];
                createCommentAction($id_status);
            } else {
                echo "Erreur 404 - Action inconnue";
            }
            break;
        default:
            echo "Erreur 404";
            break;
    }
} else {
    homeAction();
}
