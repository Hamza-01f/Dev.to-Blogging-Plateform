<?php

namespace App\models;

use App\Config\Database;

class ArticlesModel{
    
    private static $table = 'articles';
    public static function getData(){
        // $a = Database::getInstance();
        // print_r($a);
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
    
        $stmt = $conn->prepare("INSERT INTO articles (title, slug, content, excerpt, meta_description, featured_image, status, category_id, author_id)
                                VALUES(:title, :slug, :content, :excerpt, :meta_description, :featured_image, :status, :category_id, :author_id)");
    
        // Bind the data to the query
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':excerpt', $data['excerpt']);
        $stmt->bindParam(':meta_description', $data['meta_description']);
        $stmt->bindParam(':featured_image', $data['featured_image']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':category_id', $data['category']);
        $stmt->bindParam(':author_id', $data['author']);
    
        // Execute the statement
        $stmt->execute();
    
        // Return the last insert ID
        return $conn->lastInsertId();
    }
    
    
    
}