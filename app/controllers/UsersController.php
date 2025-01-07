<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Models\Users;

class UsersController {

    public static function show(){
        $UsersModel = Users::showUsers();
        return $UsersModel;
    }

    public static function addUser(){
        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['Register'])) {
            // Initialize the data array only when the form is submitted
            $data = [
                'username' => $_POST['username'] ?? null,
                'email' => $_POST['email'] ?? null,
                'pass' => $_POST['password'] ?? null,
                'bio' => $_POST['bio'] ?? null,
                'profile_picture' => $_POST['photo'] ?? null,
                'role' => 'user',
            ];

            // Validate that the required fields are not empty
            if (empty($data['username']) || empty($data['email']) || empty($data['pass'])) {
                echo "Please fill in all required fields.";
                return;
            }

            Users::AddUser($data);
        }
    }

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
}
