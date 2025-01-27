<?php
includes 'connect.php';
session_start();
include  'nav.php';
?>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Job Portal
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
  </style>
 </head>
 <body class="bg-gray-100">
  <!-- Navbar -->
  <!-- <nav class="bg-black text-white p-4">
   <div class="container mx-auto flex justify-between items-center">
    <div class="text-lg font-bold">
        WORKESE
    </div>
    <div class="hidden md:flex space-x-4">
        <a class="hover:text-gray-400" href="/home/index.html">Home</a>
        <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
        <a class="hover:text-gray-400" href="/about us/index.html">About Us</a>
        <a class="hover:text-gray-400" href="/contact us/index.html">Contact Us</a>
    </div>
    <div class="hidden md:flex space-x-4">
     <button class="bg-transparent border border-white px-4 py-2 rounded hover:bg-white hover:text-black">
      Login
     </button>
     <button class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">
      Register
     </button>
    </div>
   </div>
  </nav> -->
  <!-- Main Content -->
  <div class="container mx-auto p-4 md:p-8">
   <div class="text-center mb-8">
    <h1 class="text-2xl md:text-4xl font-bold mb-4">
     You Will Grow, You Will Succeed. We Promise That
    </h1>
    <p class="text-gray-600">
     Welcome to our job portal. We are committed to helping you find the best job opportunities.
    </p>
   </div>
   <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Contact Details -->
    <div class="space-y-4">
     <div>
      <h3 class="text-xl font-bold">
       Call for inquiry
      </h3>
      <p class="text-gray-600">
       +987 876 6546
      </p>
     </div>
     <div>
      <h3 class="text-xl font-bold">
       Send us email
      </h3>
      <p class="text-gray-600">
       sendmail@jobportal.net
      </p>
     </div>
     <div>
      <h3 class="text-xl font-bold">
       Opening hours
      </h3>
      <p class="text-gray-600">
       Mon - Fri: 10AM - 7PM
      </p>
     </div>
     <div>
      <h3 class="text-xl font-bold">
       Office
      </h3>
      <p class="text-gray-600">
       27th Street Road, Picrociny, NY 10085
      </p>
     </div>
    </div>
    <!-- Contact Info -->
    <div class="bg-green-100 p-4 md:p-8 rounded shadow-md">
     <h2 class="text-2xl font-bold mb-4">
      Contact Info
     </h2>
     <form>
      <div class="mb-4">
       <label class="block text-gray-700">
        Full Name
       </label>
       <input class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your name" type="text"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        Email Address
       </label>
       <input class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your email" type="email"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        Message
       </label>
       <textarea class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your message" rows="4"></textarea>
      </div>
      <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
       Send Message
      </button>
     </form>
    </div>
   </div>
   <!-- Map -->
   <div class="mt-8">
    <img alt="Map showing office location" class="w-full rounded shadow-md" height="400" src="https://storage.googleapis.com/a1aa/image/p2lulGf2rej0QkLjXbUmvkajlekNFMbvF5fJNaYpRTmMfgQgC.jpg" width="800"/>
   </div>
   <!-- Partners -->
   <div class="flex flex-wrap justify-around items-center mt-8">
    <img alt="Zoom logo" class="h-12 m-2" height="50" src="https://storage.googleapis.com/a1aa/image/LaXkSEeQhYUf9kYCkipfEiBgWu6VyS8E2MxNEqDZdIy1PIEoA.jpg" width="100"/>
    <img alt="Tinder logo" class="h-12 m-2" height="50" src="https://storage.googleapis.com/a1aa/image/dvgPgkbTfyUDRKXowhIYeq1F4DfSSSCy9iXb6sF4u2fjfgQgC.jpg" width="100"/>
    <img alt="Dribbble logo" class="h-12 m-2" height="50" src="https://storage.googleapis.com/a1aa/image/DaLSgyY4xdqFNts5NEOXPSmHpvqgoiJkWBIqROZBRlq9BhAF.jpg" width="100"/>
    <img alt="Asana logo" class="h-12 m-2" height="50" src="https://storage.googleapis.com/a1aa/image/Pwo0bBPFwDY8MNX1dAhaMPL5buNXdPRRlwhny7gfLdh6DCBKA.jpg" width="100"/>
   </div>
  </div>
  <!-- Footer -->
  <!-- <footer class="bg-black text-white mt-8 p-4">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <h3 class="font-bold">Job</h3>
            <p>Get more information about various job opportunities. Connect with employers and find your dream job.</p>
        </div>
        <div>
            <h3 class="font-bold">Company</h3>
            <ul>
                <li><a class="hover:text-gray-400" href="#">About Us</a></li>
                <li><a class="hover:text-gray-400" href="#">Contact Us</a></li>
                <li><a class="hover:text-gray-400" href="#">Careers</a></li>
                <li><a class="hover:text-gray-400" href="#">For Employers</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold">Job Categories</h3>
            <ul>
                <li><a class="hover:text-gray-400" href="#">Technology</a></li>
                <li><a class="hover:text-gray-400" href="#">Finance</a></li>
                <li><a class="hover:text-gray-400" href="#">Healthcare</a></li>
                <li><a class="hover:text-gray-400" href="#">Education</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold">Newsletter</h3>
            <p>Subscribe to our newsletter to get the latest job updates.</p>
            <input class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Enter your email" type="email"/>
            <button class="w-full bg-green-500 text-white px-4 py-2 rounded mt-2 hover:bg-green-400">Subscribe Now</button>
        </div>
    </div>
    <div class="text-center mt-4">
        <p>© 2023 Job Portal. All rights reserved.</p>
        <div class="space-x-4">
            <a class="hover:text-gray-400" href="#">Privacy Policy</a>
            <a class="hover:text-gray-400" href="#">Terms &amp; Conditions</a>
        </div>
    </div>
</footer> -->

<?php include 'footer.php'; ?>
<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    });
</script>
</body>
</html>