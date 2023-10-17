<?php

function HomePage($allStatus, $allUser, $allRequestedUser)
{
    global $isConnected;
    $titre = "Accueil";
    ob_start();
?>
    <?php
    // Si l'utilisateur est connecté, on affiche le formulaire de statut
    if ($isConnected) { ?>
        <form method="post" action="?p=status&a=create">
            <textarea name="content" placeholder="Nouveau statut ..." cols="30" rows="10"></textarea>
            <input type="submit" value="Publier">
        </form>
    <?php } ?>

    <?php
    // On récupère tous les statuts
    foreach ($allStatus as $s) { ?>
        <p><?= $s["content"] ?> - <?= getUserPseudo($s["id_user"]) ?>

        </p>
        <?php
        // Si l'utilisateur est connecté, on affiche le formulaire de commentaire
        if ($isConnected) {
            // On vérifie si l'utilisateur a déjà liké le statut
            if (isLiked($s["id"], $_SESSION["user"]["id"])) {
                $action = "delete";
                $value = "Je n'aime plus";
            } else {
                $action = "create";
                $value = "J'aime";
            }
        ?>
            <a href="?p=like&a=<?= $action ?>&id_status=<?= $s["id"] ?> "> <?= $value ?></a>
            <form method="post" action="?p=comment&a=create&id_status=<?= $s["id"] ?>">
                <textarea name="content" placeholder="Commenter ..." cols="30" rows="1"></textarea>
                <input type="submit" value="Commenter">
            </form>

        <?php }
        // On récupère tous les commentaires du statut
        $comments = getAllCommentsByStatus($s["id"]);
        foreach ($comments as $c) { ?>
            <p><?= $c["content"] ?> -
                <?= getUserPseudo($c["id_user"]) ?>
            </p>
    <?php }
    } ?>


    <?php
    $contenu = ob_get_clean();
    ob_start();
    // Les personnes que je peux demander en amis
    foreach ($allUser as $u) {
    ?>
        <p><?= $u["nom"] . " " . $u["prenom"] ?><a href="?p=request&a=create&id_user_invited=<?= $u["id"] ?>"> Demander en ami </a></p>

    <?php
        //Les personnes que j'ai demandé en amis

    }
    foreach ($allRequestedUser as $u) {
    ?>
        <p><?= $u["nom"] . " " . $u["prenom"] ?><a href="?p=request&a=cancel&id_user_invited=<?= $u["id"] ?>"> Annuler la demande </a></p>
<?php }
    // Les personnes qui m'ont demandé en amis
    // Mes amis
    $contenu_friend = ob_get_clean();
    require "layout.php";
}
