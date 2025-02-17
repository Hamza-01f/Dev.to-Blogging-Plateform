<?php

namespace App\models;

use App\Config\Database;

class ArticlesModel{
    
    private static $article = 'articles';
    private $users = 'users';
    private $categories = 'categories';
    private $tags = 'tags';
    private $article_tags = 'article_tags';

    public static function getData($userId){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("
            SELECT 
                articles.id AS article_id, 
                articles.title,
                articles.slug,
                articles.content,    
                articles.featured_image,
                articles.status,
                users.username,
                articles.views,
                categories.categorie_name,
                GROUP_CONCAT(tags.name_tag) AS tags
            FROM articles 
            JOIN users ON articles.author_id = users.id
            JOIN categories ON articles.category_id = categories.id
            LEFT JOIN article_tags ON articles.id = article_tags.article_id
            LEFT JOIN tags ON article_tags.tag_id = tags.id
            WHERE articles.status = 'published' AND articles.author_id = :userId
            GROUP BY articles.id
        ");
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $articles = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }


    public static function getDataOfArticle($articleId){
        $stmt = Database::getConnection()->prepare("
            SELECT  
                articles.title,
                articles.content,    
                articles.views
            FROM articles 
            WHERE id = :articleId
        ");
        $stmt->bindParam(':articleId', $articleId, \PDO::PARAM_INT);
        $stmt->execute();
        $articles = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $articles;
    }

    public static function incrementView($articleId){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE articles SET views = views+1 WHERE id = :articleId");
        $stmt -> bindParam(':articleId',$articleId,\PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function getPublicData(){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("
            SELECT 
                articles.id AS article_id, 
                articles.title,
                articles.slug,
                articles.content,    
                articles.featured_image,
                articles.status,
                users.username,
                categories.categorie_name,
                GROUP_CONCAT(tags.name_tag) AS tags
            FROM articles 
            JOIN users ON articles.author_id = users.id
            JOIN categories ON articles.category_id = categories.id
            LEFT JOIN article_tags ON articles.id = article_tags.article_id
            LEFT JOIN tags ON article_tags.tag_id = tags.id
            WHERE articles.status = 'published' 
            GROUP BY articles.id
        ");
        $stmt->execute();
        $articles = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }

    public static function getAdmineArticle(){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("
            SELECT 
                articles.id AS article_id, 
                articles.title,
                articles.slug,
                articles.content,    
                articles.featured_image,
                articles.status,
                users.username,
                articles.views,
                categories.categorie_name,
                GROUP_CONCAT(tags.name_tag) AS tags
            FROM articles 
            JOIN users ON articles.author_id = users.id
            JOIN categories ON articles.category_id = categories.id
            LEFT JOIN article_tags ON articles.id = article_tags.article_id
            LEFT JOIN tags ON article_tags.tag_id = tags.id
            GROUP BY articles.id
        ");
        $stmt->execute();
        $articles = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }
    

    public static function addArticle($data) {
        Database::getInstance();
        $conn = Database::getConnection();
        
        // Check if the slug already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM articles WHERE slug = :slug");
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->execute();

        $slugCount = $stmt->fetchColumn();
        if ($slugCount > 0) {
            throw new \Exception("The slug '{$data['slug']}' already exists. Please choose a different slug.");
        }
    
        $stmt = $conn->prepare("INSERT INTO articles (title, slug, content,  featured_image, status, category_id, author_id)
                                VALUES(:title, :slug, :content,  :featured_image, :status, :category_id, :author_id)");
    
        // Bind the data to the query
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':featured_image', $data['featured_image']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':category_id', $data['category']);
        $stmt->bindParam(':author_id', $data['author']);
    

        $stmt->execute();
 
        return $conn->lastInsertId();
    }
    
    public static function delete($id){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("DELETE FROM articles WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function getSpecificData($id){
        Database::getInstance();
    
        // Prepare the SQL query
        $stmt = Database::getConnection()->prepare("
        SELECT
            articles.id, 
            articles.title,
            articles.slug,
            articles.content,
         
            articles.featured_image,
            articles.status
         
        FROM articles 
        WHERE articles.id = :id
         ");

        $stmt->execute([':id' => $id]);

        $articles = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        return $articles;
    }
    

    public static function update($id, $data){
        Database::getInstance();
        $conn = Database::getConnection();
    
        $stmt = $conn->prepare("
            UPDATE articles 
            SET 
                title = :title, 
                slug = :slug, 
                content = :content, 
                featured_image = :featured_image,  
                category_id = :category_id
            WHERE id = :id
        ");
    
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);     
        $stmt->bindParam(':featured_image', $data['featured_image']);
        $stmt->bindParam(':category_id', $data['category']);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
 
        $stmt->execute();
    }

    public static function publish($id){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE articles SET status = 'published' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function draft($id){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE articles SET status = 'draft' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}