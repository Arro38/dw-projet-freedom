<?php
function loginAction()
{
    global $base_url;
    global $isConnected;
    // Si Utilisateur connecté alors redirection vers la page d'accueil
    if ($isConnected) {
        header("Location: $base_url");
    }
    if (isset($_POST["pseudo"]) && isset($_POST["mdp"])) {
        $pseudo = $_POST["pseudo"]; //$_POST correspond aux données envoyées par le formulaire de connexion et à l'input avec name = "pseudo"
        $mdp = $_POST["mdp"];
        $verif = login($pseudo, $mdp);
        if ($verif) {
            header("Location: $base_url");
        } else {
            echo "Erreur lors de la connexion";
        }
    }
    LoginPage();
}

function logoutAction()
{
    global $base_url;
    session_destroy();
    header("Location: $base_url");
}
