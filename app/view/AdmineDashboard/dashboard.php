<?php 
 
require_once __DIR__ . '/../../controllers/UsersController.php';
use App\Controllers\UsersController;

$rows = UsersController::show();
// $totalUsers = UsersController::CountUsers();
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
<body class=" bg-gradient-to-r from-blue-100 to-indigo-200">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-indigo-900 text-white w-64 p-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-pink-500">DivoBlog</h1>
            </div>
            <nav class="space-y-6">
                <a href="AdmineDashboard.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <!-- <a href="./Users/User.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-users mr-3"></i> Users
                </a> -->
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

            <!-- Content: Welcome Message, Stats, etc. -->

            <!-- User Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gradient-to-r from-indigo-600 to-pink-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Username</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">Role</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($rows) {
                            foreach($rows as $row){
                        ?>
                            <tr class="border-b hover:bg-gray-100 transition-all">
                                <td class="py-3 px-4"><?= $row['username']; ?></td>
                                <td class="py-3 px-4"><?= $row['email']; ?></td>
                                <td class="py-3 px-4"><?= $row['role']; ?></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <div class="flex justify-center space-x-4">
                                        <!-- Delete icon -->
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                            <a href="dashboard.php?id=<?= $tag['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete this tag?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='py-3 px-4 text-center text-gray-500'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
