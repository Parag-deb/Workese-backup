<?php 
require 'connect.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<header class="bg-black text-white p-4 flex justify-between items-center">
    <!-- Logo Section -->
    <div class="flex items-center">
        <i class="fas fa-briefcase mr-2"></i>
        <span class="text-xl font-bold">WORKEASE</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="hidden md:flex space-x-4">
        <a class="hover:text-gray-400" href="/home/index.html">Home</a>
        <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
        <a class="hover:text-gray-400" href="/about-us/index.html">About Us</a>
        <a class="hover:text-gray-400" href="/contact-us/index.html">Contact Us</a>
    </nav>

    <!-- User Profile and Authentication -->
    <div class="flex items-center space-x-4">
    <?php if (isset($_SESSION['name'])) { ?>
        <!-- Logged-in User Section -->
        <span class="mr-2">
            <?php echo htmlspecialchars($_SESSION['name'] ?? 'users'); ?>
        </span>
        <img 
            alt="User Avatar" 
            class="rounded-full" 
            height="40" 
            src="https://storage.googleapis.com/a1aa/image/lyou4ghwI2rfFSOMEefw0VROzQIkdIGqehYskzfb92Fn3lSgC.jpg" 
            width="40"
        />
        <button class="relative">
            <i class="fas fa-bell text-white"></i>
            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">
                <?php echo $notifications_count ?? '0'; ?>
            </span>
        </button>
        <form method="POST" action="logout.php" class="inline">
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Log Out</button>
</form>

    <?php } else { ?>
        <!-- Guest User Section -->
        <a href="/login.html" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Log In</a>
        <a href="/register.html" class="bg-green-500 text-white px-4 py-2 rounded-lg">Register</a>
    <?php } ?>
</div>


    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden">
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="/home/index.html">Home</a>
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="/jobs/index.html">Jobs</a>
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="/about-us/index.html">About Us</a>
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="/contact-us/index.html">Contact Us</a>
        <?php if (!isset($_SESSION['user_id'])) { ?>
            <a href="/login.html" class="block w-full text-left px-4 py-2 text-sm bg-blue-500 hover:bg-blue-400">Log In</a>
            <a href="/register.html" class="block w-full text-left px-4 py-2 text-sm bg-green-500 hover:bg-green-400">Register</a>
        <?php } ?>
    </div>
</header>
