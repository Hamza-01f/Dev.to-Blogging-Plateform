<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Models\Users;

class UsersController {

    public static function show(){
        $UsersModel = Users::showUsers();
        return $UsersModel;
    }

    public static function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    
            $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
            $bio = htmlspecialchars(trim($_POST['bio']), ENT_QUOTES, 'UTF-8');
            $profile_picture = htmlspecialchars(trim($_POST['photo']), ENT_QUOTES, 'UTF-8');
            
 
            $data = [
                'username' => $username,
                'email' => $email,
                'pass' => $password, 
                'bio' => $bio,
                'profile_picture' => $profile_picture,
                'role' => 'user', 
            ];
    
            UserModel::addUser($data);
    
        }
    }

    // public static function addUser(){
    //     if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['Register'])) {
            
    //         $data = [
    //             'username' => $_POST['username'] ,
    //             'email' => $_POST['email'] ,
    //             'pass' => $_POST['password'] ,
    //             'bio' => $_POST['bio'] ,
    //             'profile_picture' => $_POST['photo'] ,
    //             'role' => 'user',
    //         ];

       
    //         if (empty($data['username']) || empty($data['email']) || empty($data['pass'])) {
    //             echo "Please fill in all required fields.";
    //             return;
    //         }

    //         Users::AddUser($data);
    //     }
    // }

    public static function getUsersAskedToBeAuthors(){
        $askedusers = Users::getUsersAskedToBeAuthors();
        return $askedusers ;
    }

    public static function makeAuthor($id,$Newid){
          Users::makeAuthor($id,$Newid);
    }

    public static function rejectAuthor($id){
        Users::deletUser($id);
    }

    public static function toggleBan($id) {
        if (Users::isUserBanned($id)) {
            Users::unbanUser($id); 
        } else {
            Users::banUser($id); 
        }
    }

    public static function countUsers() {
        return Users::countUsers();
    }

    public static function countArticles() {
        return Users::countArticles();
    }

    public static function countCategories() {
        return Users::countCategories();
    }

    public static function countTags() {
        return Users::countTags();
    }

    public static function countArticlesByCategory() {
        return Users::countArticlesByCategory();
    }

    public static function countPopularTags() {
        return Users::countPopularTags();
    }

    public static function TopAuthors(){
        return Users::TotalAuthors();
    }

    public static function searchContent($query){
        return Users::searchContent($query);
    }
}
