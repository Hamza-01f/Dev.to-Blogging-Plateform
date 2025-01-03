<?php

namespace App\Models;

use App\Config\Database;

class Tags {
    private static $table = "tags";
    private static $column = "name_tag";

    public static function showTags() {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM ".self::$table."");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function addTags($values) {
        // Ensure the database connection is established
        Database::getInstance();
        // Check if the tag already exists
        $stmt = Database::getConnection()->prepare("SELECT COUNT(*) FROM " . self::$table . " WHERE " . self::$column . " = :value");
        $stmt->bindParam(':value', $values, \PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false;
        }

        $stmt = Database::getConnection()->prepare("INSERT INTO " . self::$table . " (" . self::$column . ") VALUES (:value)");
        $stmt->bindParam(':value', $values, \PDO::PARAM_STR);

        // Execute the insertion and return true if successful
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Failed to add tag.";
            return false;
        }
    }

    //Methods to delete tag
    public static function deleteTag($id) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("DELETE FROM " . self::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
        return $stmt->execute(); 
    }

    // Method to find a tag by ID
    public static function findTagById($id) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    //Method to update the value of Tag
    public static function updateTag($id, $newTag){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE " . self::$table . " SET name_tag = :newTag WHERE id = :id");
        $stmt->bindParam(':newTag', $newTag, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }


}
