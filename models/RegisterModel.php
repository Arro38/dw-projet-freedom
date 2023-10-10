<?php
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
