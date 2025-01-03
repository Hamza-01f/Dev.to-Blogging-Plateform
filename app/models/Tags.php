<?php

namespace App\Models;

use App\Config\Database;

class Tags {
    private static $table = "tags";
    private static $column = "name_tag";

    public static function showTags() {
        Database::getInstance();
        return Database::getData(self::$table);
    }

    public static function addTags($values) {
        Database::getInstance();
        $result = Database::Add(self::$table, self::$column, $values);
        
        if ($result) {
            header("Location: tag.php");
        } else {
            echo 'Failed to add tag.';
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
