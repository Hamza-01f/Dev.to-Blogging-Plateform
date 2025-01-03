<?php

namespace App\Models;

use App\Config\Database;

class ModelCategories{
    public static $table = 'categories';
    public static $column = 'categorie_name';

    //Method to fetch categories from table
    public static function display(){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM ".self::$table."");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function create($values) {
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

    public static function delete($id){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("DELETE FROM " . self::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public static function findTagById($id) {
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    //Method to update the value of Tag
    public static function updateCategory($id, $newTag){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("UPDATE " . self::$table . " SET categorie_name = :newTag WHERE id = :id");
        $stmt->bindParam(':newTag', $newTag, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}