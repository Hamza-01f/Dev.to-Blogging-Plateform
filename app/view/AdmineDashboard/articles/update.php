<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>

    <title>Update Article</title>
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
                    <a href="ManageArticles.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-newspaper h-6 w-6 mr-2"></i> Manage Articles
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
            </header>

            <main class="flex-1 p-6 space-y-6 overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <div class="text-3xl font-bold text-gray-900">Edit Article</div>
                </div>

                <!-- Article Edit Form -->
                <div class="bg-white shadow-lg rounded-lg p-6 mt-6 overflow-auto max-h-[calc(100vh-200px)]">
                    <form method="POST" action="/router.php?action=updateArticle&id=<?php echo $article['id']; ?>" class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Article Title</label>
                            <input type="text" name="title" id="title" value="<?php echo $article['title']; ?>"
                                class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                            <input type="text" name="slug" id="slug" value="<?php echo $article['slug']; ?>"
                                class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="4"
                                class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required><?php echo $article['content']; ?></textarea>
                        </div>
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                            <input type="text" name="excerpt" id="excerpt" value="<?php echo $article['excerpt']; ?>"
                                class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                            <input type="text" name="meta_description" id="meta_description" value="<?php echo $article['meta_description']; ?>"
                                class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image URL</label>
                            <input type="text" name="featured_image" id="featured_image" value="<?php echo $article['featured_image']; ?>"
                                class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="draft" <?php echo $article['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                                <option value="published" <?php echo $article['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                            </select>
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['id']?>" <?php echo $article['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                                    <?php echo $category['categorie_name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                            <select name="author" id="author" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <?php foreach($authors as $author): ?>
                                <option value="<?php echo $author['id']?>" <?php echo $article['author_id'] == $author['id'] ? 'selected' : ''; ?>>
                                    <?php echo $author['username']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                            <select id="tags" name="tags[]" multiple class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <?php foreach($tags as $tag): ?>
                                <option value="<?php echo $tag['id']?>" <?php echo in_array($tag['id'], explode(',', $article['tags'])) ? 'selected' : ''; ?>>
                                    <?php echo $tag['name_tag']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="updateArticle"
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-200">
                            Update Article
                        </button>
                    </form>
                </div>

            </main>
        </div>
    </div>

    <script>
    new TomSelect("#tags", {
        maxItems: 10,
        create: false,
        placeholder: 'Select tags...',
    });
    </script>

</body>

</html>
