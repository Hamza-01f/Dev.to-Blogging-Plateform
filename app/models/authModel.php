<?php


namespace App\models;

require_once __DIR__ . '/../config/Database.php';


use App\Config\Database;

class authModel {

 public static function finduser($username,$password){
      Database::getInstance();
      $stmt = Database::getConnection()->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
      $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
 }


}