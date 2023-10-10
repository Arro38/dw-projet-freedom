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
function register($pseudo, $mdp, $nom, $prenom): bool
{
    global $pdo;
    try {
        $query = $pdo->prepare("INSERT INTO user (pseudo, password, nom, prenom) VALUES (:pseudo, :mdp, :nom, :prenom)");
        $query->execute([
            "pseudo" => $pseudo,
            "mdp" => password_hash($mdp, PASSWORD_DEFAULT),
            "nom" => $nom,
            "prenom" => $prenom
        ]);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function getUserPseudo($id)
{
    global $pdo;
    $query = $pdo->prepare("SELECT pseudo FROM user WHERE id = :id");
    $query->execute([
        "id" => $id
    ]);
    $user = $query->fetch();
    return $user["pseudo"];
}
