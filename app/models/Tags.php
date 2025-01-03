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
            echo 'Tag added successfully.';
            header("Location: tag.php");
        } else {
            echo 'Failed to add tag.';
        }
    }


    // public function deleteTag($id) {
    //     // Add your code here
    // }

    // public function getTagById() {
    //     // Add your code here
    // }

    // public function update() {
    //     // Add your code here
    // }

    // public static function countTags() {
  
    //     Database::getInstance();  

    //     $countTags = Database::countItems(self::$table);
    //     return $countTags;
    // }
}
