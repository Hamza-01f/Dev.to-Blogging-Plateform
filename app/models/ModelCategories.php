<?php

namespace App\Models;

use App\Config\Database;

class ModelCategories{
    public static $table = 'categories';
    public static $column = 'categorie_name';

    public static function display(){
        Database::getInstance();
        $stmt = Database::getConnection()->prepare("SELECT * FROM ".self::$table."");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}