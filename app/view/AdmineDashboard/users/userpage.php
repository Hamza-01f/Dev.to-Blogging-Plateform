<?php
session_start();

require_once __DIR__ . '/../../../controllers/authcontroller.php';

use App\controllers\auth;

if(isset($_POST['ask_to_be_author'])){
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
    $image_url = $_SESSION['user']['profile_picture']; 
    $user_id = $_SESSION['user']['id'];
    
    auth::askedToAuthor( $username,$email,$image_url,$user_id);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Welcome to DivoBlog</title>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <header class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white text-3xl font-bold uppercase">
                DivoBlog
            </div>
            <div class="flex space-x-4">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Display Log Out and Profile buttons if user is logged in -->
                    <span class="text-white font-semibold">Welcome, <?= $_SESSION['user']['username'] ?>!</span>
                    <a href="/app/view/AdmineDashboard/users/Profile.php" class="text-white py-2 px-4 bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-md transition duration-300">Profile</a>
                    <a href="logout.php" class="text-white py-2 px-4 bg-red-500 hover:bg-red-600 rounded-lg shadow-md transition duration-300">Log Out</a>
                <?php else: ?>
                    <!-- Display Register and Log In buttons if user is not logged in -->
                    <a href="/app/view/AdmineDashboard/users/Register.php" class="text-white py-2 px-4 bg-green-500 hover:bg-green-600 rounded-lg shadow-md transition duration-300">Register</a>
                    <a href="/app/view/AdmineDashboard/users/LogIn.php" class="text-white py-2 px-4 bg-blue-500 hover:bg-blue-600 rounded-lg shadow-md transition duration-300">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-extrabold mb-4">Welcome to DivoBlog</h1>
            <p class="text-xl mb-6">Explore the latest articles, news, and insights across various categories!</p>
            
            <?php if (isset($_SESSION['user'])): ?>
                <!-- If user is logged in, provide a link to start reading -->
                <a href="#articles" class="inline-block py-3 px-6 bg-yellow-400 text-gray-800 rounded-full shadow-lg hover:bg-yellow-500 hover:shadow-xl transition duration-300">Start Reading</a>
            <?php else: ?>
                <!-- If user is not logged in, prompt to log in -->
                <p class="mt-4 text-xl">Please log in to start reading articles.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Ask to be Author Section (Only Visible for Logged-in Users) -->
    <?php if (isset($_SESSION['user'])): ?>
        <section class="bg-white py-8" id="ask-author-section">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Want to be an Author?</h2>
                <p class="text-lg text-gray-600 mb-6">If you're passionate about writing and want to contribute to our blog, you can apply to become an author!</p>
                <button onclick="showModal()" class="inline-block py-3 px-6 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition duration-300">Ask to be Author</button>
            </div>
        </section>
    <?php endif; ?>

    <!-- Modal for Success Message -->
    <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <h3 class="text-2xl font-semibold text-green-500">Request Sent Successfully!</h3>
            <p class="text-gray-600 mt-4">Thank you for your interest in becoming an author. We will review your request shortly.</p>
            <form method = "POST">
               <button onclick="closeModal()" name ="ask_to_be_author" class="mt-4 py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">Close</button>
            </from>
        </div>
    </div>

    <!-- Articles Section -->
    <section id="articles" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-12">Latest Articles</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Article 1 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                    <img src="https://via.placeholder.com/300" alt="Article Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">The Future of Tech: What's Next?</h3>
                        <p class="text-gray-600 mb-4">Dive into the world of upcoming tech trends that are shaping the future of our society.</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800">Read more</a>
                    </div>
                </div>

                <!-- Article 2 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                    <img src="https://via.placeholder.com/300" alt="Article Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">10 Tips for Better Productivity</h3>
                        <p class="text-gray-600 mb-4">Learn the best practices and techniques to enhance your productivity and efficiency at work.</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800">Read more</a>
                    </div>
                </div>

                <!-- Article 3 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:scale-105 transform transition-all duration-300">
                    <img src="https://via.placeholder.com/300" alt="Article Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Understanding Cryptocurrency</h3>
                        <p class="text-gray-600 mb-4">A beginner's guide to understanding cryptocurrency, blockchain, and their impact on the economy.</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800">Read more</a>
                    </div>
                </div>

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

    <script>
        // Function to show modal and hide the "Ask to be Author" section
        function showModal() {
            // Hide the ask-author section
            document.getElementById("ask-author-section").style.display = "none";
            // Show the success modal
            document.getElementById("modal").classList.remove("hidden");
        }

        // Function to close the modal
        function closeModal() {
            // Hide the modal
            document.getElementById("modal").classList.add("hidden");
        }
    </script>

</body>

</html>
