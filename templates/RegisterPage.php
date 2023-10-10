<?php

function RegisterPage()
{
    $titre = "Inscription";
    ob_start();
?>
    <form method="post">
        <input type="text" name="pseudo" placeholder="pseudo">
        <input type="text" name="nom" placeholder="nom">
        <input type="text" name="prenom" placeholder="prenom">
        <input type="password" name="mdp" placeholder="mot de passe">
        <input type="submit" value="S'inscrire">
    </form>

<?php
    $contenu = ob_get_clean();
    require "layout.php";
}
