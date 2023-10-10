<?php
function login($pseudo, $mdp): bool
{
    global $pdo;
    try {
        $query = $pdo->prepare("SELECT * FROM user WHERE pseudo = :pseudo");
        $query->execute([
            "pseudo" => $pseudo
        ]);
        $user = $query->fetch();
        // Si l'utilisateur n'existe pas avec ce pseudo
        if (!$user) {
            return false;
        }

        // Si le mot de passe ne correspond pas
        if (!password_verify($mdp, $user["password"])) {
            return false;
        }

        // Si tout est bon, on connecte l'utilisateur
        $_SESSION["user"] = $user;
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage(); // Affiche le message d'erreur
        return false;
    }
}
