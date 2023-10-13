<?php
function likeAction()
{
    global $base_url;
    if (isset($_GET["a"]) && isset($_GET["id_status"]) && isset($_SESSION["user"]) && ($_GET["a"] == "create" || $_GET["a"] == "delete")) {
        $action = $_GET["a"];
        $id_status = $_GET["id_status"];
        $id_user = $_SESSION["user"]["id"];
        if ($action == "create") {
            createLiked($id_status, $id_user);
        } elseif ($action == "delete") {
            deleteLiked($id_status, $id_user);
        } else {
            echo "Erreur 404 - Action inconnue";
        }
    }
    header("Location: $base_url");
}
