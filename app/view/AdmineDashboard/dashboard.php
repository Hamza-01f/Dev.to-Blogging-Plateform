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
<body class="bg-gradient-to-r from-blue-100 to-indigo-200">

<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="bg-indigo-900 text-white w-64 p-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-pink-500">DivoBlog</h1>
        </div>
        <nav class="space-y-6">
            <a href="#" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a href="./Users/User.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                <i class="fas fa-users mr-3"></i> Users
            </a>
            <a href="Articles/Article.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                <i class="fas fa-newspaper mr-3"></i>Add Articles
            </a>
            <a href="Categories/Category.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                <i class="fas fa-tags mr-3"></i> Categories
            </a>
            <a href="Tags/tag.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                <i class="fas fa-cogs mr-3"></i> Tags
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

        <!-- Welcome Message -->
        <div class="mb-8">
            <h2 class="text-3xl font-semibold text-gray-800">Welcome to your Dashboard!</h2>
            <p class="text-gray-600 mt-2">Here's a quick overview of the platform's activity.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-gradient-to-r from-pink-500 to-indigo-500 p-6 rounded-lg shadow-lg border border-gray-200 text-white hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-semibold">Total Users</h3>
                <p class="text-4xl font-bold mt-2 text-white"> <!--?php echo $totalUsers ?--> </p>
            </div>
            <!-- Add more stat cards if needed -->
        </div>

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
                                                <!-- Edit icon -->
                                    <div class="cursor-pointer hover:text-blue-500">
                                        <a href="update.php?id=<?= $row['id']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <!-- Delete icon -->
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                        <a href="dashboard.php?id=<?= $tag['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete this tag?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
