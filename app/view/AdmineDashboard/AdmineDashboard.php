<?php
session_start();

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
    <!-- Main Navbar -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-4 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-extrabold">
                <h1>DevBlog Admin</h1>
            </div>
            <div class="flex items-center space-x-6">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="text-sm">
                        <span>Hello Back Admin <?= $_SESSION['user']['username'] ?>!</span>
                    </div>
                    <div class="flex space-x-4">
                        <!-- Profile Button -->
                        <a href="/app/view/AdmineDashboard/users/Profile.php" class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 transition duration-300">Profile</a>
                        <!-- Logout Button -->
                        <a href="/app/view/AdmineDashboard/users/logout.php" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Log Out</a>
                    </div>
                <?php else: ?>
                    <a href="/login.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="bg-indigo-900 text-white w-64 p-6">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-pink-500">Dashboard</h2>
            </div>
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
                <a href="/app/view/AdmineDashboard/articles/ManageArticles.php" class="flex items-center text-lg hover:text-pink-300 transition-colors">
                    <i class="fas fa-newspaper mr-3"></i> Articles
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
            </div>

            <!-- Welcome Message -->
            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-gray-800">Welcome to the Admin Dashboard!</h2>
                <p class="text-gray-600 mt-2">Manage users, articles, categories, and tags with ease.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Users Card -->
                <div class="bg-gradient-to-r from-pink-500 to-indigo-500 p-6 rounded-lg shadow-lg border border-gray-200 text-white hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-semibold">Total Users</h3>
                    <p class="text-4xl font-bold mt-2">1,250</p>
                </div>
                <!-- Total Articles Card -->
                <div class="bg-gradient-to-r from-indigo-500 to-pink-500 p-6 rounded-lg shadow-lg border border-gray-200 text-white hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-semibold">Total Articles</h3>
                    <p class="text-4xl font-bold mt-2">478</p>
                </div>
                <!-- Total Categories Card -->
                <div class="bg-gradient-to-r from-indigo-500 to-pink-500 p-6 rounded-lg shadow-lg border border-gray-200 text-white hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-semibold">Categories</h3>
                    <p class="text-4xl font-bold mt-2">15</p>
                </div>
            </div>

            <!-- Graphs Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Articles Per Category Graph -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <h3 class="text-xl font-semibold mb-4">Articles per Category</h3>
                    <canvas id="categoryChart"></canvas>
                </div>

                <!-- Popular Tags Graph -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <h3 class="text-xl font-semibold mb-4">Popular Tags</h3>
                    <canvas id="tagsChart"></canvas>
                </div>
            </div>

            <!-- User Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200 mb-8">
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
                        <tr class="border-b hover:bg-gray-100 transition-all">
                            <td class="py-3 px-4">john_doe</td>
                            <td class="py-3 px-4">john@example.com</td>
                            <td class="py-3 px-4">Author</td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <button class="text-red-500 hover:text-red-700">Suspend</button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition-all">
                            <td class="py-3 px-4">admin_user</td>
                            <td class="py-3 px-4">admin@example.com</td>
                            <td class="py-3 px-4">Admin</td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <button class="text-red-500 hover:text-red-700">Suspend</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        // Sample Data for Graphs
        const categoryChart = new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: ['PHP', 'JavaScript', 'Python', 'HTML', 'CSS'],
                datasets: [{
                    label: 'Articles per Category',
                    data: [120, 85, 150, 75, 100],
                    backgroundColor: ['#6B46C1', '#4C51BF', '#D53F8C', '#ED64A6', '#F6AD55'],
                    borderColor: ['#6B46C1', '#4C51BF', '#D53F8C', '#ED64A6', '#F6AD55'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        const tagsChart = new Chart(document.getElementById('tagsChart'), {
            type: 'pie',
            data: {
                labels: ['PHP', 'JavaScript', 'React', 'Node.js', 'Laravel'],
                datasets: [{
                    label: 'Popular Tags',
                    data: [300, 200, 150, 100, 50],
                    backgroundColor: ['#F6AD55', '#D53F8C', '#ED64A6', '#4C51BF', '#6B46C1'],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>
</html>
