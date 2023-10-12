<?php
function getAllCommentsByStatus($id_status)
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM comment where id_status = :id_status ORDER BY createdAt DESC");
    $query->execute([
        "id_status" => $id_status
    ]);
    $comments = $query->fetchAll();
    return $comments;
}

function createComment($id_user, $id_status, $content): bool
{
    global $pdo;
    try {
        $query = $pdo->prepare("INSERT INTO comment (id_user,id_status, content,createdAt) VALUES (:id_user,:id_status, :content, :createdAt)");
        $query->execute([
            "id_user" => $id_user,
            "id_status" => $id_status,
            "content" => $content,
            "createdAt" => date("Y-m-d H:i:s")
        ]);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
