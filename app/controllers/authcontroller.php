<?php

namespace App\controllers;

require_once __DIR__ . '/../models/authModel.php';

use App\models\authModel;

class auth {

 public static function logIn($username,$password){
    $user = authModel::finduser($username,$password);


   if ($user[0]['role'] == 'user') { 
      header('Location: /app/view/AdmineDashboard/users/userpage.php');
      exit();
   }else if($user[0]['role'] == 'admin'){
      header('Location: /app/view/AdmineDashboard/dashboard.php');
      exit();          
   }else if($user[0]['role'] == 'author'){
      header('Location: /app/view/AdmineDashboard/articles/ManageArticles.php');
      exit();
   } else { 
      echo "Invalid username or password";
   }
 }

}

