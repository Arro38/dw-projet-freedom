<?php
function createStatusAction()
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
        $verif = createStatus($id_user, $content);
        if (!$verif) {
            echo "Erreur lors de la création du status";
        } else {
            header("Location: $base_url");
        }
    }
}
