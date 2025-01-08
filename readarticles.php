<?php

session_start();

require_once __DIR__ . '/app/controllers/ArticlesController.php';

$role = $_SESSION['user']['role'];

use App\Controllers\ArticleController;

$articleData = '';
if(isset($_GET['id'])){
   $articleId = $_GET['id'];
   $articleData = ArticleController::incrementView($articleId);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title><?php echo htmlspecialchars($articleData['title']); ?> - DivoBlog</title>
    <style>
        .article-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .content-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .reading-progress {
            transition: width 0.2s ease;
            background: linear-gradient(90deg, #3B82F6, #6366F1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(8px);
            background-opacity: 0.95;
        }

        nav a {
            font-weight: 500;
        }

        nav a:hover {
            transform: translateY(-1px);
        }

        .reading-progress {
            z-index: 41;  
        }
        
    </style>
</head>
<body class="article-bg min-h-screen">
      
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
           
            <a href="#" class="text-white text-2xl font-bold">
                DivoBlog
            </a>

            <div class="flex items-center space-x-4">
            <?php if($role === 'admin' || $role === 'author' || $role === 'user'): ?>
                <a href="/app/view/AdmineDashboard/articles/ManageArticles.php" class="flex items-center px-4 py-2 bg-white text-indigo-600 rounded-lg hover:bg-gray-100 transition duration-300 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back
                </a>
            
                <a href="/app/view/AdmineDashboard/users/logout.php" class="flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 shadow-md">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </a>
            <?php else: ?>
                <a href="index.php" class="flex items-center px-4 py-2 bg-white text-indigo-600 rounded-lg hover:bg-gray-100 transition duration-300 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back
                </a>
            <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- Reading Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-1 z-50">
        <div class="reading-progress h-full w-0"></div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="content-container max-w-4xl mx-auto rounded-2xl shadow-2xl overflow-hidden">
            <!-- Article Header -->
            <header class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white">
                <h1 class="text-4xl font-bold mb-4 fade-in">
                    <?php echo htmlspecialchars($articleData['title']); ?>
                </h1>
                <div class="flex items-center space-x-4 text-sm fade-in" style="animation-delay: 0.2s">
                    <div class="flex items-center">
                        <i class="fas fa-eye mr-2"></i>
                        <span><?php echo number_format($articleData['views']); ?> views</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>5 min read</span>
                    </div>
                </div>
            </header>

            <!-- Article Content -->
            <article class="p-8 bg-white fade-in" style="animation-delay: 0.4s">
                <div class="border-2 border-black rounded-lg shadow-lg mb-4 p-6 font-mono">
                    <p class="text-gray-600 mb-4">
                        <?php echo nl2br(htmlspecialchars($articleData['content'])); ?>
                    </p>
                </div>
            </article>

            <!-- Article Footer -->
            <footer class="bg-gray-50 p-8 border-t border-gray-200 fade-in" style="animation-delay: 0.6s">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <button class="p-2 rounded-full hover:bg-gray-200 text-gray-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="p-2 rounded-full hover:bg-gray-200 text-gray-600 transition-colors">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="p-2 rounded-full hover:bg-gray-200 text-gray-600 transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </button>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.querySelector('.reading-progress').style.width = scrolled + '%';
        });

        document.querySelector('button:contains("Share")').addEventListener('click', () => {
            if (navigator.share) {
                navigator.share({
                    title: '<?php echo htmlspecialchars($articleData['title']); ?>',
                    url: window.location.href
                });
            }
        });
    </script>
</body>
</html>
