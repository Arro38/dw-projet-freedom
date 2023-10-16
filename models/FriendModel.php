<?php
function getAllOtherUsers($monId)
{
    global $pdo;
    try {

        $query = $pdo->prepare("SELECT u.* FROM `user` as u where u.id!= :id 
        AND u.id not in (SELECT f.id_user_friend from friend as f where f.id_user = :id) 
        AND u.id not in (SELECT f.id_user from friend as f where f.id_user_friend = :id);");
        $query->execute([
            "id" => $monId
        ]);
        $result = $query->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function createRequest($id_user, $id_user_invited)
{
    global $pdo;
    try {
        $query = $pdo->prepare("INSERT INTO request (id_user, id_user_invited,createdAt) VALUES (:id_user, :id_user_invited, :createdAt)");
        $query->execute([
            "id_user" => $id_user,
            "id_user_invited" => $id_user_invited,
            "createdAt" => date("Y-m-d H:i:s")
        ]);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function updateRequest($id_user, $id_user_friend, $confirmed)
{
    global $pdo;

    try {
        $query = $pdo->prepare("UPDATE request SET confirmed = :confirmed WHERE id_user = :id_user AND id_user_invited = :id_user_friend");
        $query->execute([
            "id_user" => $id_user,
            "id_user_friend" => $id_user_friend,
            "createdAt" => date("Y-m-d H:i:s")
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
    // $confirmed = true;
    if ($confirmed) {
        try {
            $query = $pdo->prepare("INSERT INTO friend (id_user, id_user_friend,createdAt) VALUES (:id_user, :id_user_friend, :createdAt)");
            $query->execute([
                "id_user" => $id_user,
                "id_user_friend" => $id_user_friend,
                "createdAt" => date("Y-m-d H:i:s")
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    return true;
}
