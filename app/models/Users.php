<?php

namespace App\Models;

use App\Config\Database;

class Users {

    private static $table = "users";

    // Fetch users from the database
    public static function showUsers(){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM ".self::$table." WHERE role != 'admin' ");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Add a new user to the database
    public static function AddUser($data){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("INSERT INTO users(username, email, pass, bio, profile_picture, role)
            VALUES(:username, :email, :pass, :bio, :profile_picture, :role)");
            $hash = password_hash($data['pass'],PASSWORD_DEFAULT);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':pass', $hash);
            $stmt->bindParam(':bio', $data['bio']);
            $stmt->bindParam(':profile_picture', $data['profile_picture']);
            $stmt->bindParam(':role', $data['role']);
            $stmt->execute();

    }

    public static function getUsersAskedToBeAuthors(){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM author_requests");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function deletUser($id){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("DELETE  FROM author_requests WHERE id = :id");
        $stmt->bindParam(':id',$id,\PDO::PARAM_INT);
        $stmt->execute(); 
    }

    public static function makeAuthor($id,$Newid){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE users SET role = 'author' WHERE id = :Newid");
        $stmt->bindParam(':Newid',$Newid,\PDO::PARAM_INT);
        $modify = $stmt->execute();
        if($modify){
           self::deletUser($id);
        }else{
            echo "error happened ";
        }
    }

    public static function banUser($id) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE " . self::$table . " SET banned = TRUE WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function unbanUser($id) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE " . self::$table . " SET banned = FALSE WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function isUserBanned($id) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM users WHERE id = :id AND banned = 1");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn(); 
    }

    
    public static function countUsers() {
        Database::getInstance();
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM users");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function countArticles() {
        Database::getInstance();
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM articles");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function countCategories() {
        Database::getInstance();
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM categories");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function countTags() {
        Database::getInstance();
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM tags");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function countArticlesByCategory() {
        Database::getInstance();
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT c.categorie_name, COUNT(a.id) AS total_articles
                             FROM categories c
                             LEFT JOIN articles a ON a.category_id = c.id
                             GROUP BY c.categorie_name");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countPopularTags() {
        Database::getInstance();
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT t.name_tag, COUNT(at.article_id) AS total_articles
                             FROM tags t
                             LEFT JOIN article_tags at ON at.tag_id = t.id
                             GROUP BY t.name_tag
                             ORDER BY total_articles DESC
                             LIMIT 5");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function TotalAuthors(){
  
    $pdo = Database::getConnection(); 


    $sql = "SELECT u.username AS author_name, COUNT(a.id) AS article_count
            FROM users u
            LEFT JOIN articles a ON u.id = a.author_id
            GROUP BY u.id
            ORDER BY article_count DESC
            LIMIT 3";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $topAuthors = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $topAuthors;
}

public static function searchContent($query)
{
    $conn = Database::getConnection();

    $sql = "
        (SELECT 'article' AS type, id, title AS name, slug FROM articles WHERE title LIKE :query)
        UNION 
        (SELECT 'category' AS type, id, categorie_name AS name, NULL AS slug FROM categories WHERE categorie_name LIKE :query)
        UNION 
        (SELECT 'tag' AS type, id, name_tag AS name, NULL AS slug FROM tags WHERE name_tag LIKE :query)
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':query', '%' . $query . '%');  
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


}
