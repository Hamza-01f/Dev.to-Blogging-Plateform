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
                    <a href="#" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="Users/User.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-users h-6 w-6 mr-2"></i> Users
                    </a>
                    <a href="Categories/Category.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-th h-6 w-6 mr-2"></i> Categories
                    </a>
                    <a href="ManageArticles.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-newspaper h-6 w-6 mr-2"></i> Manage Articles
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
                <div class="text-3xl font-bold text-gray-900 mb-6">Article Details</div>

                <!-- Article Details Card -->
                <div class="bg-blue-200 shadow-2xl rounded-lg p-6 transform transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl hover:bg-gray-50">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Featured Image Section -->
                        <div class="w-full lg:w-1/3">
                            <img src="https://via.placeholder.com/300" alt="Featured Image" class="rounded-lg shadow-lg w-full object-cover h-48 lg:h-64 transform transition-all duration-300 ease-in-out hover:scale-105">
                        </div>

                        <!-- Article Info Section -->
                        <div class="flex-1">
                            <h2 class="text-3xl font-bold text-gray-800 hover:text-indigo-600 transition-all duration-300">
                                Sample Article Title
                            </h2>
                            <p class="mt-2 text-sm text-gray-600">
                                <span class="font-medium text-indigo-500">Category:</span> 
                                <span class="font-semibold text-indigo-600">Tech</span>
                            </p>
                            <p class="mt-2 text-sm text-gray-600">
                                <span class="font-medium text-indigo-500">Author:</span> 
                                <span class="font-semibold text-indigo-600">John Doe</span>
                            </p>
                            <p class="mt-4 text-gray-700 leading-relaxed text-lg">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula tortor neque, non vehicula ligula tincidunt ut. Donec luctus urna nec justo scelerisque mollis. Aliquam erat volutpat. 
                                Mauris eu ante a libero finibus feugiat. Cras euismod, eros sit amet fermentum venenatis, nunc lorem tincidunt nunc, eget mollis justo felis a leo. 
                                <span class="text-gray-500 text-sm">[Content truncated]</span>
                            </p>

                            <div class="mt-4 text-sm text-gray-500 italic">
                                <strong>Meta Description:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus viverra nulla at urna.
                            </div>

                            <div class="mt-6 flex space-x-6 items-center ">
                                <!-- Edit Icon -->
                                <a href="update.php?id=1" class="text-blue-600 hover:text-blue-800 transition-all duration-300">
                                    <div class="p-3 bg-blue-100 rounded-full hover:bg-blue-200 shadow-md hover:shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </a>

                                <!-- Delete Icon -->
                                <a href="dashboard.php?id=1&action=delete" onclick="return confirm('Are you sure you want to delete this article?')" class="text-red-600 hover:text-red-800 transition-all duration-300">
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

            </main>
        </div>
    </div>

</body>

</html>
