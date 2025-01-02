<?php

namespace App\Models;

use App\Config\Database;


class Users{

    
 private static $table = "users";


public static function showUsers(){
    $query = database::getData(self::$table);
    return $query;
}

public static function countUsers(){

    $query = database::countItems(self::$table);
    return $query;
}


public function login(){



}


}


