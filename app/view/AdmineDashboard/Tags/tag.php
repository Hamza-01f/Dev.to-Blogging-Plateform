<?php 
require_once __DIR__ . '/../../../controllers/TagsController.php';

use App\Controllers\TagsController;

$tags = TagsController::show();
$totalTags = TagsController::totalTags();
TagsController::create();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Tags Dashboard</title>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div class="flex flex-col w-64 bg-gray-800 text-white shadow-lg">
        <div class="flex items-center justify-center h-16 bg-gray-900">
            <span class="text-2xl font-bold uppercase">DivoBlog</span>
        </div>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Dashboard
                </a>
                <a href="Users/User.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                    <i class="fas fa-users h-6 w-6 mr-2"></i> Users
                </a>
                <a href="Articles/Article.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                    <i class="fas fa-newspaper h-6 w-6 mr-2"></i> Articles
                </a>
                <a href="Categories/Category.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                    <i class="fas fa-th h-6 w-6 mr-2"></i> Categories
                </a>
                <a href="Tags/Tag.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                    <i class="fas fa-tag h-6 w-6 mr-2"></i> Tags
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col bg-white">
        <header class="flex items-center justify-between p-6 bg-white shadow-md">
            <div class="flex items-center">
                <button class="text-gray-500 focus:outline-none focus:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <input class="ml-4 w-full border rounded-md px-4 py-2" type="text" placeholder="Search" />
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                    <i class="fas fa-bell text-xl"></i>
                </button>
                <button class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                    <i class="fas fa-cog text-xl"></i>
                </button>
            </div>
        </header>

        <main class="flex-1 p-6 space-y-6">
            <div class="flex justify-between items-center mb-6">
                <div class="text-3xl font-bold text-gray-900">Welcome to your Dashboard!</div>
                <div>
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition duration-200">Add Tags</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-600">Total Tags</h3>
                    <p class="text-3xl font-bold text-indigo-600"><?php echo $totalTags; ?></p>
                </div>
            </div>

            <!-- Tag Form -->
            <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                <form method="POST" class="space-y-4">
                    <div>
                        <label for="tag_name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                        <input type="text" name="tag_name" id="tag_name" placeholder="Enter tag name" class="mt-2 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <button type="submit" name="addTag" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">Add Tag</button>
                </form>
            </div>

            <!-- Tags Table -->
            <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Tag Name</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        <?php
                            if ($tags) {
                                foreach($tags as $tag){
                        ?>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2"><?= $tag['id']; ?></td>
                            <td class="px-4 py-2"><?= $tag['tag_name']; ?></td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <a href="Tags/update.php?User_id=<?= $tag['id']; ?>" class="text-blue-500 hover:underline">Edit</a> | 
                                <a href="tag.php?id=<?= $tag['id']; ?>" onclick="return confirm('Are you sure you want to delete this tag?')" class="text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='3' class='py-2 text-center'>No tags available</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

</body>
</html>
