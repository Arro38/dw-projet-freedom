<?php
function requestAction()
{
    global $base_url;
    if (isset($_GET["a"]) && isset($_GET["id_user_invited"]) && isset($_SESSION["user"]) && ($_GET["a"] == "create" || $_GET["a"] == "accept" || $_GET["a"] == "refuse")) {
        $action = $_GET["a"];
        $id_user_invited = $_GET["id_user_invited"];
        $id_user = $_SESSION["user"]["id"];
        if ($action == "create") {
            createRequest($id_user, $id_user_invited);
        } elseif ($action == "accepte") {
            updateRequest($id_user, $id_user_invited, true);
        } elseif ($action == "refuse") {
            updateRequest($id_user, $id_user_invited, false);
        } else {
            echo "Erreur 404 - Action inconnue";
        }
    }
    header("Location: $base_url");
}
