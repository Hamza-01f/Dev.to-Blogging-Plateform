<?php
session_start();

require_once __DIR__ . '/../../../controllers/ArticlesController.php';

use App\Controllers\ArticleController;

$articles = ArticleController::getData();
$AdmineArticles = ArticleController::getAdmineArticle();

$userRole =  $_SESSION['user']['role'];

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    ArticleController::delete($id); 
}

if (isset($_GET['action']) && $_GET['action'] == 'publish' && isset($_GET['id'])) {
    $id = $_GET['id'];
    ArticleController::publish($id); 
}

if (isset($_GET['action']) && $_GET['action'] == 'draft' && isset($_GET['id'])) {
    $id = $_GET['id'];
    ArticleController::draft($id); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Articles Dashboard</title>
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

                     <?php if($userRole === 'admin'):?>
                    <a href="/app/view/AdmineDashboard/categories/category.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-th h-6 w-6 mr-2"></i> Categories
                    </a>
                    <a href="/app/view/AdmineDashboard/dashboard.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                                <i class="fas fa-users h-6 w-6 mr-2"></i> Users
                            </a>
                    <a href="/app/view/AdmineDashboard/Tags/tag.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-tag h-6 w-6 mr-2"></i> Tags
                    </a>
                    <?php else: ?>
                    <a href="article.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-newspaper h-6 w-6 mr-2"></i> Add Articles
                    </a>
                    <?php endif; ?>
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

            <main class="flex-1 p-6 space-y-6 overflow-y-auto">
                <div class="text-3xl font-bold text-gray-900 mb-6">Articles Listing</div>
                <?php if($userRole === 'author'):?>
                <?php foreach ($articles as $article): ?>
                <!-- Article Details Card -->
                <div class="bg-blue-200 shadow-2xl rounded-lg p-6 transform transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl hover:bg-gray-50">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Featured Image Section -->
                        <div class="w-full lg:w-1/3">
                            <img src="<?= $article['featured_image'] ?>" alt="Featured Image" class=" bg-green-200 rounded-lg shadow-lg w-full object-cover h-48 lg:h-64 transform transition-all duration-300 ease-in-out hover:scale-105">
                        </div>

                        <!-- Article Info Section -->
                        <div class="flex-1 p-6 bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
    <!-- Title -->
    <h2 class="text-4xl font-extrabold text-gray-900 hover:text-indigo-600 transition-all duration-300 mb-4">
        <?= htmlspecialchars($article['title']) ?>
    </h2>

    <!-- Category -->
    <p class="mt-2 text-sm text-gray-600">
        <span class="font-medium text-indigo-500">Category:</span> 
        <span class="font-semibold text-indigo-700"><?= htmlspecialchars($article['categorie_name']) ?></span>
    </p>

    <!-- Content -->
    <p class="mt-4 text-gray-700 leading-relaxed text-lg font-sans line-clamp-3">
        <?= nl2br(htmlspecialchars($article['content'])) ?>
    </p>




                            <div class="mt-6 flex space-x-6 items-center ">
                                <!-- Edit Icon -->
                              
                                    <a href="update.php?id=<?= $article['article_id'] ?>" class="text-blue-600 hover:text-blue-800 transition-all duration-300">
                                        <div class="p-3 bg-blue-100 rounded-full hover:bg-blue-200 shadow-md hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                    </a>

                                    <div class="flex items-center space-x-2 p-3 bg-blue-100 rounded-full hover:bg-blue-200 shadow-md hover:shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6 h-6 text-blue-600 hover:text-blue-800 transition-all duration-300">
                                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
                                        </svg>
                                        <p class="text-gray-600 text-lg"><?= $article['views'] ?> views</p>
                                   </div>

                                   <a href="/../../../../readarticles.php?id=<?= $article['article_id'] ?>" class="text-blue-600 hover:text-blue-800 transition-all duration-300">
                                        <div class="flex items-center space-x-2 p-3 bg-blue-100 rounded-full hover:bg-blue-200 shadow-md hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  class="w-6 h-6 text-blue-600 hover:text-blue-800 transition-all duration-300">
                                                <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                                <path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                                <p class="text-gray-600 text-lg"> Read </p>
                                            </svg>
                                        </div>
                                    </a>
                  
                                    <!-- Delete Icon -->
                                    <a href="ManageArticles.php?id=<?= $article['article_id'] ?>&action=delete" onclick="return confirm('Are you sure you want to delete this article?')" class="text-red-600 hover:text-red-800 transition-all duration-300">
                                        <div class="p-3 bg-red-100 rounded-full hover:bg-red-200 shadow-md hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </a>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php elseif ($userRole === 'admin'): ?>
                    <?php foreach ($AdmineArticles as $AdmineArticle): ?>
              
                <div class="bg-blue-200 shadow-2xl rounded-lg p-6 transform transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl hover:bg-gray-50">
                    <div class="flex flex-col lg:flex-row gap-6">
                       
                        <div class="w-full lg:w-1/3">
                            <img src="<?= $AdmineArticle['featured_image'] ?>" alt="Featured Image" class=" bg-green-200 rounded-lg shadow-lg w-full object-cover h-48 lg:h-64 transform transition-all duration-300 ease-in-out hover:scale-105">
                        </div>

                        <!-- Article Info Section -->
                        <div class="flex-1">                          
                            <h2 class="text-3xl font-bold text-gray-800 hover:text-indigo-600 transition-all duration-300">
                                <?= htmlspecialchars($AdmineArticle['title']) ?>
                            </h2>
                            <p class="mt-2 text-sm text-gray-600">
                                <span class="font-medium text-indigo-500">Category:</span> 
                                <span class="font-semibold text-indigo-600"><?= htmlspecialchars($AdmineArticle['categorie_name']) ?></span>
                            </p>
                            <p class="mt-2 text-sm text-gray-600">
                                <span class="font-medium text-indigo-500">Author:</span> 
                                <span class="font-semibold text-indigo-600"><?= htmlspecialchars($AdmineArticle['username']) ?></span>
                            </p>
                            <span class="font-medium text-indigo-500">content:</span> 
                            <p class="mt-4 text-gray-700 leading-relaxed text-lg">
                                <?= nl2br(htmlspecialchars($AdmineArticle['content'])) ?>
                            </p>


                            <div class="mt-6 flex space-x-6 items-center ">
                                <a href="update.php?id=<?= $AdmineArticle['article_id'] ?>" class="text-blue-600 hover:text-blue-800 transition-all duration-300">
                                    <div class="p-3 bg-blue-100 rounded-full hover:bg-blue-200 shadow-md hover:shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </a>
                             
                                <div class="flex items-center space-x-2 p-3 bg-blue-100 rounded-full hover:bg-blue-200 shadow-md hover:shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6 h-6 text-blue-600 hover:text-blue-800 transition-all duration-300">
                                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
                                        </svg>
                                        <p class="text-gray-600 text-lg"><?= $AdmineArticle['views'] ?> views</p>
                                </div>
                                 
                                <a href="/../../../../readarticles.php?id=<?= $AdmineArticle['article_id'] ?>" class="text-blue-600 hover:text-blue-800 transition-all duration-300">
                                    <div class="flex items-center space-x-2 p-3 bg-blue-100 rounded-full hover:bg-blue-200 shadow-md hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  class="w-6 h-6 text-blue-600 hover:text-blue-800 transition-all duration-300">
                                        <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                        <p class="text-gray-600 text-lg"> Read </p>
                                    </svg>
                                    </div>
                                </a>

                                <a href="ManageArticles.php?id=<?= $AdmineArticle['article_id'] ?>&action=delete" onclick="return confirm('Are you sure you want to delete this article?')" class="text-red-600 hover:text-red-800 transition-all duration-300">
                                    <div class="p-3 bg-red-100 rounded-full hover:bg-red-200 shadow-md hover:shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </a>

                                <?php if($AdmineArticle['status'] === 'draft' && $userRole === 'admin' ):  ?>
                                    <a href="?id=<?= $AdmineArticle['article_id'] ?>&action=publish" class="text-white">
                                        <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg shadow-md">PUBLISH</button>
                                    </a>
                                 <?php else:  ?>
                                    <a href="?id=<?= $AdmineArticle['article_id'] ?>&action=draft" class="text-white">
                                        <button class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded-lg shadow-md">DRAFT</button>
                                    </a>
                                 <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-6 bg-yellow-100 rounded-lg text-center">
                        <p class="text-xl font-semibold text-gray-700">No Articles Available</p>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

</body>

</html>

                               