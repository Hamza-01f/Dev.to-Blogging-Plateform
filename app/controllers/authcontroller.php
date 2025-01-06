<?php

namespace App\controllers;

require_once __DIR__ . '/../models/authModel.php';

use App\models\authModel;

class auth {

 public static function logIn($username,$password){
    $user = authModel::finduser($username,$password);


   if ($user[0]['role'] == 'user') {
      session_start();
      $_SESSION['user'] = $user[0]; 
      header('Location: /app/view/AdmineDashboard/users/userpage.php');
      exit();
   }else if($user[0]['role'] == 'admin'){
      session_start();
      $_SESSION['user'] = $user[0];
      header('Location: /app/view/AdmineDashboard/AdmineDashboard.php');
      exit();          
   }else if($user[0]['role'] == 'author'){
      session_start();
      $_SESSION['user'] = $user[0];
      header('Location: /app/view/AdmineDashboard/articles/ManageArticles.php');
      exit();
   } else { 
      echo "Invalid username or password";
   }
 }

}

