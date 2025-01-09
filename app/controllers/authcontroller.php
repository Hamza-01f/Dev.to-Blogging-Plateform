<?php

namespace App\controllers;

require_once __DIR__ . '/../models/authModel.php';

use App\models\authModel;

class auth {

    public static function logIn($username, $password) {
        $user = authModel::finduser($username, $password);
        if(password_verify($password, $user[0]['pass'])) {
            if ($user[0]['role'] == 'user' && $user[0]['Banned'] == false) {
                session_start();
                $_SESSION['user'] = $user[0]; 
                header('Location: /app/view/AdmineDashboard/users/userpage.php');
                exit();
            } else if ($user[0]['role'] == 'admin') {
                session_start();
                $_SESSION['user'] = $user[0];
                header('Location: /app/view/AdmineDashboard/AdmineDashboard.php');
                exit();          
            } else if ($user[0]['role'] == 'author' && $user[0]['Banned'] == false ) {
                session_start();
                $_SESSION['user'] = $user[0];
                header('Location: /app/view/AdmineDashboard/articles/ManageArticles.php');
                exit();
            } else { 
                echo 'Sorry you are Banned By Admin';
            }
        }else{
          echo 'invalid password or username';
        }
    }

    public static function display($id) {
        $user = authModel::display($id);
        return $user;
    }

    public static function updateProfile($id, $username, $email, $bio, $profile_picture) {
        $updateSuccess = authModel::update($id, $username, $email, $bio, $profile_picture);

        if ($updateSuccess) {
            
            header('Location: /app/view/AdmineDashboard/users/Profile.php'); 
            exit();
        } else {
        
            echo "Profile update failed.";
        }

    }

    public static function askedToAuthor($username,$email,$image_url,$user_id){
        authModel::askedToAuthor($username,$email,$image_url,$user_id);
    }
}
