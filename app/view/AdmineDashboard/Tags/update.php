<?php 

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /app/view/AdmineDashboard/users/logIn.php');
    exit();
}

require_once __DIR__ . '/../../../controllers/TagsController.php';

use App\Controllers\TagsController;

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $tag = TagsController::edit($id); 

} else {
    header("Location: tag.php");
    exit();
}

if (isset($_POST['updateTag']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $newTag = $_POST['name_tag'];
    TagsController::update($id, $newTag); 
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Update Tag</title>
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
                    <a href="tag.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-arrow-left h-6 w-6 mr-2"></i> Back to Tags
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-white">
            <header class="flex items-center justify-between p-6 bg-white shadow-md">
                <div class="flex items-center">
                    <span class="text-2xl font-bold">Update Tag</span>
                </div>
            </header>

            <main class="flex-1 p-6 space-y-6">
                <div class="text-3xl font-bold text-gray-900">Update Tag Information</div>

                <!-- Update Form -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="tag_name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                            <input type="text" name="name_tag" id="tag_name" value="<?= htmlspecialchars($tag['name_tag']); ?>"
                                class="mt-2 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <button type="submit" name="updateTag"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">Update Tag</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>

</html>
