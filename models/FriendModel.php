<?php
//Récupérer les personnes que je peux ajouter en amis (cad qui ne sont pas mes amis et qui ne m'ont pas demandé en amis)
function getAllOtherUsers($monId)
{
    global $pdo;
    try {

        $query = $pdo->prepare("SELECT u.* FROM `user` as u where u.id!= :id 
        AND u.id not in (SELECT f.id_user from request as f where f.id_user_invited = :id) 
        AND u.id not in (SELECT f.id_user_invited from request as f where f.id_user = :id) 
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

//Récupérer les personnes que j'ai demandé en amis
function getUserRequest($monId)
{
    global $pdo;
    try {

        $query = $pdo->prepare("SELECT u.* FROM `user` as u where u.id!= :id
        AND u.id in (SELECT f.id_user_invited from request as f where f.id_user = :id) ;");
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

//Récupérer les personnes qui m'ont demandé en amis
function getAllRequestFromOtherUser($monId)
{
    global $pdo;
    try {

        $query = $pdo->prepare("SELECT u.* FROM `user` as u where u.id!= :id
        AND u.id in (SELECT f.id_user from request as f where f.id_user_invited = :id) ;");
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

//Récupérer mes amis
function getAllFriend($monId)
{
    global $pdo;
    try {

        $query = $pdo->prepare("SELECT u.* FROM `user` as u where u.id!= :id
        AND (u.id in (SELECT f.id_user from friend as f where f.id_user_friend = :id) 
        OR u.id in (SELECT f.id_user_friend from friend as f where f.id_user = :id)) ;");
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
        $query = $pdo->prepare("UPDATE request SET confirmed = :confirmed WHERE id_user = :id_user AND id_user_invited = :id_user_friend 
        OR id_user_invited = :id_user AND id_user = :id_user_friend");
        $query->execute([
            "id_user" => $id_user,
            "id_user_friend" => $id_user_friend,
            "confirmed" => $confirmed
        ]);
        print_r($query);
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


function cancelRequest($id_user, $id_user_friend)
{
    global $pdo;

    try {
        $query = $pdo->prepare("DELETE FROM request WHERE id_user = :id_user AND id_user_invited = :id_user_friend");
        $query->execute([
            "id_user" => $id_user,
            "id_user_friend" => $id_user_friend
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
