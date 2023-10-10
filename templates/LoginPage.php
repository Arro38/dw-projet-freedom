<?php

function LoginPage()
{
    $titre = "Connexion";
    ob_start();
?>
    <form method="post">
        <input type="text" name="pseudo" placeholder="pseudo">
        <input type="password" name="mdp" placeholder="mot de passe">
        <input type="submit" value="Se connecter">
    </form>

<?php
    $contenu = ob_get_clean();
    require "layout.php";
}
