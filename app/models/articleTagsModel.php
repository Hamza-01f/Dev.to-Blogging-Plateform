<?php


namespace App\Models;
use App\Config\Database;

class ArticleTagsModel{

    public static function deleteTagsForArticle($articleId) {
        Database::getInstance();
        $conn = Database::getConnection();

        // Delete the tags associated with the article
        $stmt = $conn->prepare("DELETE FROM article_tags WHERE article_id = :article_id");
        $stmt->bindParam(':article_id', $articleId, \PDO::PARAM_INT);
        $stmt->execute();
    }
    public static function addTagsToArticle($articleId,$tags){
        $conn = Database::getConnection();

        $stmt = $conn->prepare("
            INSERT INTO article_tags (article_id, tag_id)
            VALUES (:article_id, :tag_id)
        ");

        foreach ($tags as $tagId) {
            $stmt->bindParam(':article_id', $articleId);
            $stmt->bindParam(':tag_id', $tagId);
            $stmt->execute();
        }

        header('Location:/app/view/AdmineDashboard/articles/ManageArticles.php');
        exit();
    }

}