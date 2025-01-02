<?php 
require_once __DIR__ . '/../../controllers/UsersController.php';
use App\Controllers\UsersController;

$rows = UsersController::show();
$totalUsers = UsersController::CountUsers();
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
<body class="bg-gray-100">

<div class="flex h-screen">

    <div class="bg-indigo-900 text-white w-64 p-6">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold">DivoBlog</h1>
        </div>
        <nav class="space-y-4">
            <a href="#" class="flex items-center text-lg hover:text-indigo-400">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a href="./Users/User.php" class="flex items-center text-lg hover:text-indigo-400">
                <i class="fas fa-users mr-3"></i> Users
            </a>
            <a href="Articles/Article.php" class="flex items-center text-lg hover:text-indigo-400">
                <i class="fas fa-newspaper mr-3"></i> Articles
            </a>
            <a href="Categories/Category.php" class="flex items-center text-lg hover:text-indigo-400">
                <i class="fas fa-tags mr-3"></i> Categories
            </a>
            <a href="Tags/tag.php" class="flex items-center text-lg hover:text-indigo-400">
                <i class="fas fa-cogs mr-3"></i> Tags
            </a>
        </nav>
    </div>

    <div class="flex-1 bg-white p-8 overflow-y-auto">

 
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4">
                <button class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <input type="text" class="px-4 py-2 border border-gray-300 rounded-md" placeholder="Search">
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sign-out-alt fa-lg"></i>
                </button>
            </div>
        </div>


        <div class="mb-8">
            <h2 class="text-3xl font-semibold text-gray-800">Welcome to your Dashboard!</h2>
            <p class="text-gray-600 mt-2">Here's a quick overview of the platform's activity.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">Total Users</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-2"><?php echo $totalUsers ?></p>
            </div>
        </div>

        <!-- User Table Section -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-800 text-white">
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
                        <tr class="border-b">
                            <td class="py-3 px-4"><?= $row['username']; ?></td>
                            <td class="py-3 px-4"><?= $row['email']; ?></td>
                            <td class="py-3 px-4"><?= $row['role']; ?></td>
                            <td class="py-3 px-4">
                                <a href="users/updateUser.php?User_id=<?= $row['id']; ?>" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a> |
                                <a href="dashboard.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this player?')" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
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
