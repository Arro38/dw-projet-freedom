<?php

function HomePage($allStatus)
{
    global $isConnected;
    $titre = "Accueil";
    ob_start();
?>
    <?php if ($isConnected) { ?>
        <form method="post" action="?p=status&a=create">
            <textarea name="content" placeholder="Nouveau statut ..." cols="30" rows="10"></textarea>
            <input type="submit" value="Publier">
        </form>
    <?php } ?>
    <?php foreach ($allStatus as $s) { ?>
        <p><?= $s["content"] ?> -
        <h3><?= getUserPseudo($s["id_user"]) ?></h3>
        </p>
    <?php } ?>


<?php
    $contenu = ob_get_clean();
    require "layout.php";
}
