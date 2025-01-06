<?php 
 require_once __DIR__ . '/../../../controllers/CategoriesController.php';

use App\Controllers\CategoriesController;
use App\Models\ModelCategories;

$categories = CategoriesController::show();
// $totalTags = TagsController::totalTags();
// TagsController::create();

if (isset($_POST['addCategory']) && isset($_POST['categorie_name']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $value = $_POST['categorie_name'];
    $result = CategoriesController::create($value);
}


// // Check if the delete action is triggered
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    CategoriesController::delete($id); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Categories Dashboard</title>
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
                    <a href="/app/view/AdmineDashboard/AdmineDashboard.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="/app/view/AdmineDashboard/dashboard.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-users h-6 w-6 mr-2"></i> Users
                    </a>
                    <a href="/app/view/AdmineDashboard/articles/ManageArticles.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-newspaper h-6 w-6 mr-2"></i> Articles
                    </a>
                    <!-- <a href="/app/view/AdmineDashboard/dashboard.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-th h-6 w-6 mr-2"></i> Categories
                    </a> -->
                    <a href="/app/view/AdmineDashboard/Tags/tag.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
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
                    <div class="text-3xl font-bold text-gray-900">Welcome to your Dashboard! where to manage Categories</div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-600">Total Categories</h3>
                        <p class="text-3xl font-bold text-indigo-600"></p>
                    </div>
                </div>

                <!-- Tag Form -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="tag_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="categorie_name" id="categorie_name" placeholder="Enter tag name"
                                class="mt-2 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <button type="submit" name="addCategory"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">Add Category</button>
                    </form>
                </div>

                <!-- Tags Table -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6 overflow-x-auto">
                    <div class="max-h-72 overflow-y-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-4 py-2 text-center">Number</th>
                                    <th class="px-4 py-2 text-center">Category Name</th>
                                    <th class="px-4 py-2 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                                <?php
                                    if ($categories) {
                                        $count = 1; // Start counting from 1
                                        foreach($categories as $category){
                                ?>
                                <tr class="hover:bg-gray-100 transition duration-200 ease-in-out">
                                    <td class="px-4 py-2 text-center"><?= $count; ?></td> <!-- Incrementing counter -->
                                    <td class="px-4 py-2 text-center"><?= $category['categorie_name']; ?></td>
                                    <td class="px-4 py-2 text-sm text-gray-600">
                                        <div class="flex justify-center space-x-4">
                                                        <!-- Edit icon -->
                                            <div class="cursor-pointer hover:text-blue-500">
                                                <a href="update.php?id=<?= $category['id']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <!-- Delete icon -->
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                <a href="category.php?id=<?= $category['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete this tag?')">
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
                                $count++; 
                                        }
                                    } else {
                                        echo "<tr><td colspan='3' class='py-2 text-center'>No tags available</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>

</html>

