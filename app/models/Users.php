<?php

namespace App\Models;

use App\Config\Database;


class Users{

    
 private static $table = "users";


public static function showUsers(){
    Database::getInstance();
    $stmt = Database::getConnection()->prepare("SELECT * FROM ".self::$table."");
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

// public static function countUsers(){

//     $query = database::countItems(self::$table);
//     return $query;
// }


public function login(){


}


}


