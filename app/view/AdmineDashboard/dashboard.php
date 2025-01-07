<?php
require_once __DIR__ . '/../../controllers/UsersController.php';
use App\Controllers\UsersController;

// Get all users
$rows = UsersController::show();

// Get users who have requested to be authors
$authorRequests = UsersController::getUsersAskedToBeAuthors();

if (isset($_GET['action']) && $_GET['action'] == 'banning') {
    $id = $_GET['id'];
    UsersController::toggleBan($id); 
}else if(isset($_GET['action']) && $_GET['action'] == 'accept'){
    $id = $_GET['id'];
    $Newid = $_GET['user_id'];
    UsersController::makeAuthor($id, $Newid);
}else if(isset($_GET['action']) && $_GET['action'] == 'reject'){
    $id = $_GET['id'];
    UsersController::rejectAuthor($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body class="bg-gradient-to-r from-blue-100 to-indigo-200">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="bg-indigo-900 text-white w-64 p-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-pink-500">DivoBlog</h1>
            </div>
            <nav class="space-y-6">
                <a href="AdmineDashboard.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="Articles/Article.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-newspaper mr-3"></i>Add Articles
                </a>
                <a href="Categories/Category.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-tags mr-3"></i>Add Categories
                </a>
                <a href="Tags/tag.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-cogs mr-3"></i>Add Tags
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-white p-8 overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                    <input type="text" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Search">
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-sign-out-alt fa-lg"></i>
                    </button>
                </div>
            </div>

            <!-- All Users Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200 mb-8">
                <h2 class="text-xl text-gray-700 font-semibold p-4">All Users</h2>
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gradient-to-r from-indigo-600 to-pink-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Username</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">Profile</th>
                            <th class="py-3 px-4 text-left">Role</th>
                            <th class="">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($rows) {
                            foreach($rows as $row) {
                                $isBanned = $row['Banned']; 
                        ?>
                            <tr class="border-b hover:bg-gray-100 transition-all">
                                <td class="py-3 px-4"><?= $row['username']; ?></td>
                                <td class="py-3 px-4"><?= $row['email']; ?></td>
                                <td class="py-3 px-4">
                                    <img src="<?= $row['profile_picture']; ?>" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
                                </td>
                                <td class="py-3 px-4"><?= $row['role']; ?></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <div class="flex justify-center space-x-4">
                                        <!-- Display ban icon based on banned status -->
                                        <?php if ($isBanned): ?>
                                            <div class="mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer w-7 h-7 bg-green-400 rounded-full">
                                                <a href="dashboard.php?id=<?= $row['id']; ?>&action=banning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 text-green-500">
                                                        <path d="M224 64c-44.2 0-80 35.8-80 80l0 48 240 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0 0-48C80 64.5 144.5 0 224 0c57.5 0 107 33.7 130.1 82.3c7.6 16 .8 35.1-15.2 42.6s-35.1 .8-42.6-15.2C283.4 82.6 255.9 64 224 64zm32 320c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer w-6 h-6 bg-red-400 rounded-full">
                                                <a href="dashboard.php?id=<?= $row['id']; ?>&action=banning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" viewBox="0 0 512 512">
                                                        <path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' class='py-3 px-4 text-center text-gray-500'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Users Who Requested to Be Authors Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
                <h2 class="text-xl text-gray-700 font-semibold p-4">Users Who Requested to Be Authors</h2>
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gradient-to-r from-indigo-600 to-pink-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Username</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">Profile Picture</th>
                            <th class="pl-48 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($authorRequests) {
                            foreach($authorRequests as $request) {
                        ?>
                            <tr class="border-b hover:bg-gray-100 transition-all">
                                <td class="py-3 px-4"><?= $request['username']; ?></td>
                                <td class="py-3 px-4"><?= $request['email']; ?></td>
                                <td class="py-3 px-4">
                                    <img src="<?= $request['image_url']; ?>" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <div class="flex justify-center space-x-4">
                                        <div class="flex justify-center transform hover:text-purple-500 hover:scale-110 cursor-pointer items-center w-10 h-10 bg-green-300 rounded-full">
                                            <a href="dashboard.php?id=<?= $request['id']; ?>&user_id=<?= $request['user_id']; ?>&action=accept">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 text-green-500">
                                                    <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3l32.3-32.3c12.5-12.5 32.8-12.5 45.3 0l77.1 77.1 187.7-187.7c12.5-12.5 32.8-12.5 45.3 0l32.3 32.3z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="flex justify-center transform hover:text-purple-500 hover:scale-110 cursor-pointer items-center w-10 h-10 bg-red-500 rounded-full">
                                            <a href="dashboard.php?id=<?= $request['id']; ?>&action=reject">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 text-green-500">
                                                    <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3l32.3-32.3c12.5-12.5 32.8-12.5 45.3 0l77.1 77.1 187.7-187.7c12.5-12.5 32.8-12.5 45.3 0l32.3 32.3z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='py-3 px-4 text-center text-gray-500'>No users requested to be authors</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
