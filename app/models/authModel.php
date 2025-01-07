<?php

namespace App\models;

require_once __DIR__ . '/../config/Database.php';

use App\Config\Database;

class authModel {

    public static function finduser($username, $password) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function display($id) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

   
    public static function update($id, $username, $email, $bio, $profile_picture) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("
            UPDATE users 
            SET username = :username, email = :email, bio = :bio, profile_picture = :profile_picture 
            WHERE id = :id
        ");

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, \PDO::PARAM_STR);
        $stmt->bindParam(':profile_picture', $profile_picture, \PDO::PARAM_STR);

        return $stmt->execute(); 
    }

    public static function askedToAuthor($username,$email,$image_url,$user_id){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("INSERT INTO author_requests(user_id,username,email,image_url) VALUES(:user_id,:username,:email,:image_url)");
        $stmt->bindParam(':user_id',$user_id,\PDO::PARAM_INT);
        $stmt->bindParam(':username',$username,\PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,\PDO::PARAM_STR);
        $stmt->bindParam(':image_url',$image_url,\PDO::PARAM_STR);
        $stmt->execute();
    }
}
