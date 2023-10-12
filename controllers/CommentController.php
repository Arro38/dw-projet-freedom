<?php
function createCommentAction($id_status)
{
    global $isConnected;
    global $base_url;
    if (!$isConnected) {
        header("Location: $base_url/?p=login");
        return;
    }
    if (isset($_POST["content"])) {
        $id_user = $_SESSION["user"]["id"];
        $content = $_POST["content"];
        $verif = createComment($id_user, $id_status, $content);
        if (!$verif) {
            echo "Erreur lors de la création du comentaire";
        } else {
            header("Location: $base_url");
        }
    }
}
