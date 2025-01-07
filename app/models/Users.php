<?php

namespace App\Models;

use App\Config\Database;

class Users {

    private static $table = "users";

    // Fetch users from the database
    public static function showUsers(){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM ".self::$table."");
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
}
