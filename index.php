<?php

require_once __DIR__ . '/app/controllers/ArticlesController.php';

use App\Controllers\ArticleController;

$articles = ArticleController::getPublicData();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Welcome to DivoBlog</title>
    <style>
        /* Truncate the content to 3 lines */
        .truncate-lines {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Show only 3 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Customizing card hover effect */
        .card:hover {
            transform: translateY(-10px); /* Move the card up */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Add a more dramatic shadow */
            transition: all 0.3s ease;
        }

        /* Enhancing the image */
        .card-image {
            transition: transform 0.3s ease;
        }

        .card:hover .card-image {
            transform: scale(1.05); /* Slight zoom effect on hover */
        }

        /* Customizing the button */
        .read-more-btn {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .read-more-btn:hover {
            background-color: #4b86b4; /* Darker blue on hover */
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <header class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white text-3xl font-bold uppercase">
                DivoBlog
            </div>
            <div class="flex space-x-4">
                <a href="/app/view/AdmineDashboard/users/Register.php" class="text-white py-2 px-4 bg-green-500 hover:bg-green-600 rounded-lg shadow-md transition duration-300">Register</a>
                <a href="/app/view/AdmineDashboard/users/LogIn.php" class="text-white py-2 px-4 bg-blue-500 hover:bg-blue-600 rounded-lg shadow-md transition duration-300">Log In</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-extrabold mb-4">Welcome to DivoBlog</h1>
            <p class="text-xl mb-6">Explore the latest articles, news, and insights across various categories!</p>
            <a href="#articles" class="inline-block py-3 px-6 bg-yellow-400 text-gray-800 rounded-full shadow-lg hover:bg-yellow-500 hover:shadow-xl transition duration-300">Start Reading</a>
        </div>
    </section>

    <!-- Articles Section -->
    <section id="articles" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-12">Latest Articles</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($articles as $article): ?>
                    <div class="bg-green-100 shadow-lg rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                        <div class="bg-blue-100">
                            <img 
                                src="<?php echo htmlspecialchars($article['featured_image']) ?: 'https://via.placeholder.com/300'; ?>" 
                                alt="<?php echo htmlspecialchars($article['title']); ?>" 
                                class="w-full h-48 object-cover"
                            />
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3 ml-32">
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                                    <?php echo htmlspecialchars($article['categorie_name']); ?>
                                </span>
                                <span class="text-gray-500 text-sm">
                                    By <?php echo htmlspecialchars($article['username']); ?>
                                </span>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-2">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </h3>
                            <p class="text-gray-600 mb-4 overflow-hidden line-clamp-3">
                                <?php echo htmlspecialchars($article['content']); ?>
                            </p>
                            <div class="flex items-center justify-between">
                                <a href="readarticle=<?php echo htmlspecialchars($article['id']); ?>" 
                                class="text-indigo-600 hover:text-indigo-800 font-medium ml-40">
                                    Read more
                                </a>
                                <!-- <div class="flex gap-2">
                                    <!?php foreach (explode(',', $article['tags']) as $tag): ?>
                                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded-full">
                                            #<!?php echo htmlspecialchars(trim($tag)); ?>
                                        </span>
                                    <!?php endforeach; ?>
                                </div> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 DivoBlog. All rights reserved.</p>
            <p class="text-sm">Follow us on social media: 
                <a href="#" class="text-blue-500 hover:text-blue-700">Facebook</a>, 
                <a href="#" class="text-blue-400 hover:text-blue-600">Twitter</a>, 
                <a href="#" class="text-pink-500 hover:text-pink-700">Instagram</a>
            </p>
        </div>
    </footer>

</body>
</html>
