<?php

function isLiked($id_status, $id_user)
{
    global $pdo;
    try {
        $query = $pdo->prepare("SELECT * FROM liked WHERE id_user = :id_user AND id_status = :id_status");
        $query->execute([
            "id_user" => $id_user,
            "id_status" => $id_status
        ]);
        $liked = $query->fetch();
        // Si on a un résultat, c'est que l'utilisateur a déjà liké le statut
        if (!$liked) {
            return false;
        }
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function createLiked($id_status, $id_user)
{
    global $pdo;
    try {
        $query = $pdo->prepare("INSERT INTO liked (id_user, id_status) VALUES (:id_user, :id_status)");
        $query->execute([
            "id_user" => $id_user,
            "id_status" => $id_status
        ]);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function deleteLiked($id_status, $id_user)
{
    global $pdo;
    try {
        $query = $pdo->prepare("DELETE FROM liked WHERE id_user = :id_user AND id_status = :id_status");
        $query->execute([
            "id_user" => $id_user,
            "id_status" => $id_status
        ]);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
