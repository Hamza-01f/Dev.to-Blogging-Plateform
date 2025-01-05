<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Join Our Library And Enjoy Reading Articles</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts (Optional for a custom font) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome CDN (Optional for icons, e.g., "Photo") -->
  <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
  
  <!-- Favicon (Optional) -->
  <link rel="icon" href="path-to-your-icon.ico" type="image/x-icon">

</head>

<body class="bg-gray-50 font-poppins">

  <!-- Register Form -->
  <div class="min-h-screen bg-gradient-to-b from-pink-400 via-orange-300 to-red-400 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white/90 backdrop-blur-sm rounded-lg shadow-xl p-8 border-t-4 border-pink-500">
      <h2 class="text-3xl font-bold text-center bg-gradient-to-r from-pink-500 via-orange-400 to-red-500 bg-clip-text text-transparent mb-8">Join Our Library And Enjoy Reading Articles</h2>
      
      <!-- Form -->
      <form method="POST" action="/router.php?action=addUser" class="space-y-6">
        <!-- Username -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input 
            type="text"
            id="username"
            name="username"
            class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-lg text-sm
            focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-500/50"
            required
          />
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input 
            type="email"
            id="email"
            name="email"
            class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-lg text-sm
            focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-500/50"
            required
          />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input 
            type="password"
            id="password"
            name="password"
            class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-lg text-sm
            focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-500/50"
            required
          />
        </div>

        <!-- Bio -->
        <div>
          <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
          <textarea
            id="bio"
            name="bio"
            rows="3"
            class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-lg text-sm
            focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-500/50"
          ></textarea>
        </div>

        <!-- Profile Picture URL -->
        <div>
          <label for="profile-picture" class="block text-sm font-medium text-gray-700">Profile Picture URL</label>
          <div class="mt-1 flex items-center">
            <div id="image-preview" class="h-12 w-12 rounded-full bg-gradient-to-r from-pink-400 to-orange-300 flex items-center justify-center">
              <span class="text-white">Photo</span>
            </div>
            <input
              type="url"
              id="profile-picture"
              name="photo"
              placeholder="Enter Image URL or CDN"
              class="ml-4 text-sm text-gray-500 border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
              oninput="previewImage(this)"
            />
          </div>
        </div>

        <!-- Hidden Role Input -->
        <input type="hidden" value="user" name="role" />

        <!-- Submit Button -->
        <button 
          type="submit" name="Register"
          class="w-full py-3 px-4 rounded-lg text-sm font-semibold text-white 
          bg-gradient-to-r from-pink-500 via-orange-400 to-red-500 
          hover:from-pink-600 hover:via-orange-500 hover:to-red-600 
          focus:outline-none focus:ring-2 focus:ring-pink-500/50 transform transition hover:scale-105"
        >
          Register
        </button>
      </form>

      <!-- Login Link -->
      <div class="mt-8 text-center">
        <a href="LogIn.php" class="text-sm text-pink-600 hover:text-pink-500">
          Already have an account? Login here
        </a>
        <p class="mt-4 text-xs text-gray-500">
          We're proud to create an inclusive space where everyone can be their authentic selves
        </p>
      </div>
    </div>
  </div>

  <script>
    // Function to display image preview
    function previewImage(input) {
      const preview = document.getElementById('image-preview');
      const fileURL = input.value;
      if (fileURL) {
        preview.style.backgroundImage = `url(${fileURL})`;
        preview.style.backgroundSize = 'cover';
        preview.style.backgroundPosition = 'center';
        preview.querySelector('span').style.display = 'none'; // Hide the "Photo" text
      } else {
        preview.style.backgroundImage = 'none';
        preview.style.backgroundColor = 'transparent';
        preview.querySelector('span').style.display = 'block'; // Show the "Photo" text
      }
    }
  </script>

</body>

</html>
