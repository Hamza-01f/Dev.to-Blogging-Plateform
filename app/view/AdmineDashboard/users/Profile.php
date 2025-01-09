<?php session_start(); include('/var/www/html/app/controllers/authcontroller.php'); use App\controllers\auth; if ($_SERVER['REQUEST_METHOD'] == 'POST') { $username = $_POST['username']; $email = $_POST['email']; $bio = $_POST['bio']; $profile_picture = $_POST['profile_picture']; $user_id = $_SESSION['user']['id']; auth::updateProfile($user_id, $username, $email, $bio, $profile_picture); } $user_id = $_SESSION['user']['id']; $user = auth::display($user_id); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <style>
        .profile-bg {
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #d946ef);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 to-violet-50">
    <!-- Navbar with session check -->
    <div class="flex justify-between items-center px-8 py-4 bg-white shadow-lg backdrop-blur-lg bg-opacity-90">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="text-sm">
                <span class="font-semibold text-violet-800">Hello, <?= $_SESSION['user']['username'] ?>! ✨</span>
            </div>
            <div class="flex space-x-4">
                <a href="/app/view/AdmineDashboard/AdmineDashboard.php" 
                   class="bg-amber-500 text-white py-2 px-4 rounded-lg hover:bg-amber-600 transition duration-300 transform hover:scale-105">Back</a>
                <a href="/app/view/AdmineDashboard/users/logout.php" 
                   class="bg-rose-500 text-white py-2 px-4 rounded-lg hover:bg-rose-600 transition duration-300 transform hover:scale-105">Log Out</a>
            </div>
        <?php else: ?>
            <a href="/login.php" 
               class="bg-violet-500 text-white py-2 px-4 rounded-lg hover:bg-violet-600 transition duration-300 transform hover:scale-105">Log In</a>
        <?php endif; ?>
    </div>

    <!-- Profile Section with Background -->
    <div class="min-h-screen flex justify-center items-center profile-bg py-12 px-4">
        <div class="max-w-3xl w-full bg-white rounded-xl shadow-2xl overflow-hidden backdrop-blur-xl bg-opacity-90 transform hover:scale-[1.01] transition duration-500">
            <!-- Profile Header with Picture -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-60"></div>
                <img class="w-full h-56 object-cover" 
                     src="<?= $user[0]['profile_picture'] ?: 'https://via.placeholder.com/150'; ?>" 
                     alt="Profile Picture">
                <div class="absolute bottom-0 left-0 w-full p-6">
                    <div class="flex justify-center">
                        <img class="w-32 h-32 object-cover rounded-full border-4 border-white shadow-2xl transform hover:scale-105 transition duration-300" 
                             src="<?= $user[0]['profile_picture'] ?: 'https://via.placeholder.com/150'; ?>" 
                             alt="Profile Picture">
                    </div>
                    <div class="text-center mt-4 text-white">
                        <h2 class="text-3xl font-bold text-white drop-shadow-lg"><?= $user[0]['username']; ?></h2>
                        <p class="text-lg text-violet-200"><?= $user[0]['email']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="p-8 bg-gradient-to-br from-white to-violet-50">
                <div class="space-y-6">
                    <div class="flex justify-between items-center p-4 bg-violet-50 rounded-lg hover:bg-violet-100 transition duration-300">
                        <p class="text-lg font-semibold text-violet-800">Bio</p>
                        <p class="text-md text-violet-600"><?= $user[0]['bio'] ?: 'No bio available.'; ?></p>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-violet-50 rounded-lg hover:bg-violet-100 transition duration-300">
                        <p class="text-lg font-semibold text-violet-800">Role</p>
                        <p class="text-md text-violet-600"><?= $user[0]['role'] ?: 'User'; ?></p>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="mt-8 flex justify-center">
                    <button class="bg-gradient-to-r from-violet-500 to-fuchsia-500 text-white py-3 px-8 rounded-full shadow-xl hover:shadow-2xl hover:from-violet-600 hover:to-fuchsia-600 transition duration-300 transform hover:scale-105" 
                            onclick="openModal()">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form for Editing Profile -->
    <div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center" 
         id="editModal" 
         style="display: none;">
        <div class="modal-content bg-white p-8 rounded-2xl shadow-2xl w-1/2 transform transition duration-300">
            <div class="modal-header text-center mb-6">
                <h2 class="text-2xl font-bold text-violet-800">Edit Profile</h2>
            </div>
            <form action="profile.php" method="POST">
                <div class="space-y-4">
                    <input type="text" 
                           class="w-full p-3 border border-violet-200 rounded-lg shadow-sm focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition duration-300" 
                           name="username" 
                           placeholder="Username" 
                           value="<?= $user[0]['username']; ?>" 
                           required>
                    <input type="email" 
                           class="w-full p-3 border border-violet-200 rounded-lg shadow-sm focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition duration-300" 
                           name="email" 
                           placeholder="Email" 
                           value="<?= $user[0]['email']; ?>" 
                           required>
                    <textarea class="w-full p-3 border border-violet-200 rounded-lg shadow-sm focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition duration-300" 
                              name="bio" 
                              placeholder="Bio" 
                              rows="4"><?= $user[0]['bio']; ?></textarea>
                    <input type="url" 
                           class="w-full p-3 border border-violet-200 rounded-lg shadow-sm focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition duration-300" 
                           name="profile_picture" 
                           accept="image/*" 
                           value="<?= $user[0]['profile_picture']; ?>">
                </div>
                <div class="flex justify-center mt-6">
                    <button type="submit" 
                            class="bg-gradient-to-r from-violet-500 to-fuchsia-500 text-white py-3 px-8 rounded-full shadow-xl hover:shadow-2xl hover:from-violet-600 hover:to-fuchsia-600 transition duration-300 transform hover:scale-105">
                        Save Changes
                    </button>
                </div>
            </form>
            <div class="flex justify-center mt-4">
                <button class="bg-gray-200 text-gray-700 py-2 px-6 rounded-full shadow-sm hover:bg-gray-300 transition duration-300 transform hover:scale-105" 
                        onclick="closeModal()">
                    Cancel
                </button>
            </div>
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