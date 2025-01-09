<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /app/view/AdmineDashboard/users/logIn.php');
    exit();
}

require_once __DIR__ . '/../../controllers/UsersController.php';
use App\Controllers\UsersController;

$totalUsers = UsersController::countUsers();
$totalArticles = UsersController::countArticles();
$totalCategories = UsersController::countCategories();
$totalTags = UsersController::countTags();
$role = $_SESSION['user']['role'];
$articlesByCategory = UsersController::countArticlesByCategory();
$popularTags = UsersController::countPopularTags();
$topAuthors = UsersController::TopAuthors();

if (isset($_POST['searchButton'])) {
    
    $query = $_POST['searchQuery'];  
    $results = UsersController::searchContent($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js for Graphs -->
</head>
<body class="bg-gradient-to-r from-blue-100 to-indigo-200">
<nav class="bg-indigo-900 text-white p-4 shadow-md fixed w-full z-10 top-0 left-0">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-extrabold">
                <h1>DevBlog Admin</h1>
            </div>

            <!-- Search Form in Navbar -->
            <form method="POST" action="AdmineDashboard.php" class="flex items-center space-x-4">
                <input type="text" id="searchQuery" name="searchQuery" class="w-full p-3 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search categories, tags, or articles..." value="<?php echo isset($_POST['searchQuery']) ? htmlspecialchars($_POST['searchQuery']) : ''; ?>" />
                <button type="submit" name="searchButton" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Search</button>
            </form>

            <div class="flex items-center space-x-6">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="text-sm">
                        <span>Hello Back Admin <?= $_SESSION['user']['username'] ?>!</span>
                    </div>
                    <div class="flex space-x-4">
                        <a href="/app/view/AdmineDashboard/users/Profile.php" class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 transition duration-300">Profile</a>
                        <a href="/app/view/AdmineDashboard/users/logout.php" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Log Out</a>
                    </div>
                  <?php endif; ?>
            </div>
        </div>
    </nav>
  <!-- Search Bar and Button -->
   <form method="POST" action="AdmineDashboard.php">
        <div class="search-container mt-8 flex justify-between items-center">
            <input type="text" id="searchQuery" name="searchQuery" class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search categories, tags, or articles..." value="<?php echo isset($_POST['searchQuery']) ? htmlspecialchars($_POST['searchQuery']) : ''; ?>" />
            <button type="submit" name="searchButton" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
        </div>
    </form>

    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="bg-indigo-900 text-white w-64 p-6">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-pink-500">Dashboard</h2>
            </div>
            <?php if($role === 'admin'): ?>
            <nav class="space-y-6">
                <a href="/app/view/AdmineDashboard/categories/category.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-cogs mr-3"></i> Categories
                </a>
                <a href="/app/view/AdmineDashboard/Tags/tag.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-tags mr-3"></i> Tags
                </a>
                <a href="dashboard.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-users mr-3"></i> Users
                </a>
                <?php endif; ?>
                <a href="/app/view/AdmineDashboard/articles/ManageArticles.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-newspaper mr-3"></i> Manage Articles
                </a>
            </nav>
        </div>

        <div class="flex-1 bg-white p-8 overflow-y-auto">
            <!-- Search Results Section -->
            <div id="searchResults" class="mt-6 space-y-4">
                <?php if (isset($results) && !empty($results)): ?>
                    <?php foreach ($results as $result): ?>
                        <div class="search-result p-4 border border-gray-300 rounded-md mb-4">
                            <h3 class="font-semibold"><?php echo $result['name']; ?></h3>
                            <p>Type: <?php echo ucfirst($result['type']); ?></p>
                            <?php if ($result['slug']): ?>
                                <a href="/path/to/<?php echo $result['type']; ?>/<?php echo $result['slug']; ?>" class="text-blue-500">View</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (isset($results)): ?>
                    <p>No results found.</p>
                <?php endif; ?>
            </div>

        <!-- Main Content -->
        <div class="flex-1 bg-white p-8 overflow-y-auto">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Users Card -->
                <div class="bg-gradient-to-r from-pink-500 to-indigo-500 p-6 rounded-lg shadow-lg border border-gray-200 text-white hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-semibold">Total Users</h3>
                    <p class="text-4xl font-bold mt-2"><?= $totalUsers ?></p>
                </div>
                <!-- Total Articles Card -->
                <div class="bg-gradient-to-r from-indigo-500 to-pink-500 p-6 rounded-lg shadow-lg border border-gray-200 text-white hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-semibold">Total Articles</h3>
                    <p class="text-4xl font-bold mt-2"><?= $totalArticles ?></p>
                </div>
                <!-- Total Categories Card -->
                <div class="bg-gradient-to-r from-teal-500 to-blue-500 p-6 rounded-lg shadow-lg border border-gray-200 text-white hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-semibold">Total Categories</h3>
                    <p class="text-4xl font-bold mt-2"><?= $totalCategories ?></p>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Platform Stats and Articles by Category (Top row) -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">Platform Statistics</h2>
                    <canvas id="platformStatsChart"></canvas>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">Articles by Category</h2>
                    <canvas id="articlesByCategoryChart"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Popular Tags and Top Authors (Bottom row) -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">Popular Tags</h2>
                    <canvas id="popularTagsChart"></canvas>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">Top 3 Authors</h2>
                    <canvas id="topAuthorsChart"></canvas>
                </div>
            </div>

            <script>
                var ctx1 = document.getElementById('platformStatsChart').getContext('2d');
                var platformStatsChart = new Chart(ctx1, {
                    type: 'pie',
                    data: {
                        labels: ['Total Users', 'Total Articles', 'Total Categories'],
                        datasets: [{
                            label: 'Platform Stats',
                            data: [<?php echo $totalUsers; ?>, <?php echo $totalArticles; ?>, <?php echo $totalCategories; ?>],
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });

                var ctx2 = document.getElementById('articlesByCategoryChart').getContext('2d');
                var articlesByCategoryChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_column($articlesByCategory, 'categorie_name')); ?>,
                        datasets: [{
                            label: 'Articles per Category',
                            data: <?php echo json_encode(array_column($articlesByCategory, 'total_articles')); ?>,
                            backgroundColor: '#4CAF50',
                            borderColor: '#388E3C',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                var ctx3 = document.getElementById('popularTagsChart').getContext('2d');
                var popularTagsChart = new Chart(ctx3, {
                    type: 'pie',
                    data: {
                        labels: <?php echo json_encode(array_column($popularTags, 'name_tag')); ?>,
                        datasets: [{
                            label: 'Popular Tags',
                            data: <?php echo json_encode(array_column($popularTags, 'total_articles')); ?>,
                            backgroundColor: ['#FF5733', '#FFC300', '#28A745', '#007BFF', '#6F42C1'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });

                var ctx4 = document.getElementById('topAuthorsChart').getContext('2d');
                var topAuthorsChart = new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_column($topAuthors, 'author_name')); ?>,
                        datasets: [{
                            label: 'Articles Written',
                            data: <?php echo json_encode(array_column($topAuthors, 'article_count')); ?>,
                            backgroundColor: '#007BFF',
                            borderColor: '#0056b3',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>

