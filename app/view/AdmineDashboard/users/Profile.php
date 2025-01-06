<?php
session_start(); 

include('/var/www/html/app/controllers/authcontroller.php');

use App\controllers\auth;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $profile_picture = $_POST['profile_picture'];

    $user_id = $_SESSION['user']['id']; 
    auth::updateProfile($user_id, $username, $email, $bio, $profile_picture);
}

$user_id = $_SESSION['user']['id']; 
$user = auth::display($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <style>
        /* Custom Gradient Background */
        .profile-bg {
            background: linear-gradient(to right, #4e73df, #1cc88a);
        }

        /* Card Shadow and Hover Effects */
        .profile-card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 50%;
            height: 90%;
            max-width: 500px;
            max-height: 800px;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Profile Info Text Styling */
        .profile-info-title {
            font-size: 1.125rem;
            font-weight: 500;
            color: #4A4A4A;
        }

        .profile-info-text {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Edit Profile Button */
        .edit-btn {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #fff;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .edit-btn:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
            transform: translateY(-3px);
        }

        /* Profile Image Customization */
        .profile-image {
            border-radius: 50%;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Modal Background and Content */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            width: 50%;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .modal-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .modal-btn {
            background: #4e73df;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        .modal-btn:hover {
            background: #1cc88a;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Profile Section with Background -->
    <div class="flex items-center justify-center min-h-screen bg-profile-bg py-16 px-4">
        <div class="profile-card bg-white rounded-2xl overflow-hidden">
            <!-- Profile Header with Picture -->
            <div class="relative">
                <img class="w-full h-40 object-cover" >
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-6">
                    <div class="flex justify-center">
                        <img class="profile-image w-32 h-32 object-cover" src="<?= $user[0]['profile_picture'] ?: 'https://cdn.sofifa.net/players/158/023/25_120.png'; ?>" alt="Profile Picture">
                    </div>
                    <div class="text-center mt-4">
                        <h2 class="text-white text-3xl font-semibold"><?= $user[0]['username']; ?></h2>
                        <p class="text-white text-lg"><?= $user[0]['email']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <p class="profile-info-title">Bio</p>
                        <p class="profile-info-text"><?= $user[0]['bio'] ?: 'No bio available.'; ?></p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="profile-info-title">Role</p>
                        <p class="profile-info-text"><?= $user[0]['role'] ?: 'User'; ?></p>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="mt-6 flex justify-center">
                    <button class="edit-btn" onclick="openModal()">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form for Editing Profile -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Profile</h2>
            </div>
            <form action="profile.php" method="POST">
                <input type="text" class="modal-input" name="username" placeholder="Username" value="<?= $user[0]['username']; ?>" required>
                <input type="email" class="modal-input" name="email" placeholder="Email" value="<?= $user[0]['email']; ?>" required>
                <textarea class="modal-input" name="bio" placeholder="Bio" rows="4"><?= $user[0]['bio']; ?></textarea>
                <input type="url" class="modal-input" name="profile_picture" accept="image/*" value="<?= $user[0]['profile_picture']; ?>">
                <button type="submit" class="modal-btn">Save Changes</button>
            </form>
            <button class="modal-btn mt-3" onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
       
        function openModal() {
            document.getElementById('editModal').style.display = 'flex';
        }

       
        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>

</body>

</html>
