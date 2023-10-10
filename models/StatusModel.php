<?php
function getAllStatus()
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM status ORDER BY createdAt DESC");
    $query->execute();
    $status = $query->fetchAll();
    return $status;
}

function createStatus($id_user, $content): bool
{
    global $pdo;
    try {
        $query = $pdo->prepare("INSERT INTO status (id_user, content,createdAt) VALUES (:id_user, :content, :createdAt)");
        $query->execute([
            "id_user" => $id_user,
            "content" => $content,
            "createdAt" => date("Y-m-d H:i:s")
        ]);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
