<?php

require_once __DIR__ . '/../../../controllers/authcontroller.php';

use App\controllers\auth;


if(isset($_POST["submit"]) &&  $_SERVER['REQUEST_METHOD'] == "POST")
{

    if(empty($_POST["username"]) && empty($_POST["password"]))
    {
        echo "email or password is empty";
    }
    else{
        $username = $_POST["username"];
        $password = $_POST["password"];
        auth::logIn($username,$password);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Welcome Back!</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts (Optional for a custom font) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome CDN (Optional for icons) -->
  <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>

  <!-- Favicon (Optional) -->
  <link rel="icon" href="path-to-your-icon.ico" type="image/x-icon">

  <!-- Custom CSS for Rainbow Gradient Border -->
  <style>
    .border-rainbow-gradient {
      border-image: linear-gradient(to right, #ff0000, #ff7f00, #ffff00, #00ff00, #0000ff, #4b0082, #8f00ff) 1;
    }
  </style>
</head>

<body class="bg-gray-50 font-poppins">

  <!-- Login Form -->
  <div class="min-h-screen bg-gradient-to-b from-red-400 via-purple-500 to-blue-500 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white/90 backdrop-blur-sm rounded-lg shadow-xl p-8 border-t-4 border-rainbow-gradient">
      <h2 class="text-3xl font-bold text-center bg-gradient-to-r from-red-500 via-purple-500 to-blue-600 bg-clip-text text-transparent mb-8">Welcome Back!</h2>
      
      <!-- Form -->
      <form class="space-y-6" method = "POST">
        <!-- Username -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input 
            type="text"
            id="username"
            name = "username"
            class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-lg text-sm
            focus:outline-none focus:border-rainbow-gradient focus:ring-2 focus:ring-purple-500/50"
  
          />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input 
            type="password"
            id="password"
            name = "password"
            class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-lg text-sm
            focus:outline-none focus:border-rainbow-gradient focus:ring-2 focus:ring-purple-500/50"
     
          />
        </div>

        <!-- Submit Button -->
        <button 
          type="submit"  name = "submit"
          class="w-full py-3 px-4 rounded-lg text-sm font-semibold text-white 
          bg-gradient-to-r from-red-500 via-purple-500 to-blue-600 
          hover:from-red-600 hover:via-purple-600 hover:to-blue-700 
          focus:outline-none focus:ring-2 focus:ring-purple-500/50 transform transition hover:scale-105"
        >
          Login
        </button>
      </form>

      <!-- Register Link -->
      <div class="mt-8 text-center">
        <a href="Register.php" class="text-sm text-purple-600 hover:text-purple-500">
          Don't have an account? Register here
        </a>
        <p class="mt-4 text-xs text-gray-500">
          At Our Community, we celebrate diversity and provide a safe space for everyone.
        </p>
      </div>
    </div>
  </div>

</body>

</html>
