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
}
