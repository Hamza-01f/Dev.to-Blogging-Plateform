<?php
session_start();

$specificUser = $_SESSION['user']['id'];
$userRole =  $_SESSION['user']['role'];

require_once __DIR__ . '/../../../controllers/CategoriesController.php';
require_once __DIR__ . '/../../../controllers/UsersController.php';
require_once __DIR__ . '/../../../controllers/TagsController.php';
require_once __DIR__ . '/../../../controllers/ArticlesController.php';

use App\Controllers\ArticleController;
use App\Controllers\TagsController;
use App\Controllers\CategoriesController;
use App\Controllers\UsersController;

$tags = TagsController::show();
$categories = CategoriesController::show();
$authors = UsersController::show();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addArticle'])) {
    ArticleController::addArticle($specificUser);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
    <title>DivoBlog - Article Management</title>
    <style>
        .ts-control {
            border-radius: 0.375rem;
            border-color: #E5E7EB;
            padding: 0.5rem;
        }
        .ts-dropdown {
            border-radius: 0.375rem;
            border-color: #E5E7EB;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-col w-72 bg-gradient-to-b from-indigo-700 to-indigo-900 text-white">
            <div class="flex items-center justify-center h-20 bg-indigo-800">
                <span class="text-2xl font-bold tracking-wider">DIVO<span class="text-indigo-300">BLOG</span></span>
            </div>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 px-4 py-6 space-y-1">
                    <a href="/app/view/AdmineDashboard/AdmineDashboard.php" 
                       class="flex items-center px-4 py-3 text-gray-100 transition-colors duration-200 hover:bg-indigo-600 rounded-lg group">
                        <i class="fas fa-chart-line w-6 h-6 mr-3 text-indigo-300 group-hover:text-white"></i>
                        <span>Dashboard</span>
                    </a>
                    <?php if($userRole == 'admin'):?>
                    <a href="/app/view/AdmineDashboard/dashboard.php" 
                       class="flex items-center px-4 py-3 text-gray-100 transition-colors duration-200 hover:bg-indigo-600 rounded-lg group">
                        <i class="fas fa-users w-6 h-6 mr-3 text-indigo-300 group-hover:text-white"></i>
                        <span>Users</span>
                    </a>
                    <a href="/app/view/AdmineDashboard/categories/category.php" 
                       class="flex items-center px-4 py-3 text-gray-100 transition-colors duration-200 hover:bg-indigo-600 rounded-lg group">
                        <i class="fas fa-th w-6 h-6 mr-3 text-indigo-300 group-hover:text-white"></i>
                        <span>Categories</span>
                    </a>
                    <a href="/app/view/AdmineDashboard/Tags/tag.php" 
                       class="flex items-center px-4 py-3 text-gray-100 transition-colors duration-200 hover:bg-indigo-600 rounded-lg group">
                        <i class="fas fa-tag w-6 h-6 mr-3 text-indigo-300 group-hover:text-white"></i>
                        <span>Tags</span>
                    </a>
                    <?php endif; ?>
                    <a href="ManageArticles.php" 
                       class="flex items-center px-4 py-3 text-white bg-indigo-600 rounded-lg group">
                        <i class="fas fa-newspaper w-6 h-6 mr-3"></i>
                        <span>Manage Articles</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="md:hidden text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" 
                                   placeholder="Search articles..." 
                                   class="pl-10 pr-4 py-2 w-64 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-cog text-xl"></i>
                        </button>
                        <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                <div class="max-w-4xl mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Create New Article</h1>
                    </div>

                    <!-- Article Form -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <form method="POST" class="p-6 space-y-6">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Article Title</label>
                                    <input type="text" name="title" id="title" 
                                           class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="Enter article title" required>
                                </div>
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                    <input type="text" name="slug" id="slug" 
                                           class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="article-slug" required>
                                </div>
                            </div>

                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea name="content" id="content" rows="6" 
                                          class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                          placeholder="Write your article content here..." required></textarea>
                            </div>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image URL</label>
                                    <input type="text" name="featured_image" id="featured_image" 
                                           class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="https://example.com/image.jpg">
                                </div>
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                    <select name="category" id="category" 
                                            class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?php echo $category['id']?>"><?php echo $category['categorie_name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="author" value="<?php echo $specificUser ?>">

                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                                <select id="tags" name="tags[]" multiple 
                                        class="mt-1 block w-full">
                                    <?php foreach($tags as $tag): ?>
                                        <option value="<?php echo $tag['id']?>"><?php echo $tag['name_tag'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="pt-4">
                                <button type="submit" name="addArticle"
                                        class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    Publish Article
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        new TomSelect("#tags", {
            maxItems: 10,
            create: false,
            placeholder: 'Select tags...',
            plugins: ['remove_button'],
        });
    </script>
</body>
</html>