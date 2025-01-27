<?php
    require '../connect.php';
    session_start();
    include '../nav.php';
?>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Web Page
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
 </head>
 <body class="font-roboto bg-gray-100 text-gray-800">
  <!-- Header -->
  <!-- <nav class="bg-black text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold">WORKESE</div>
        <div class="hidden md:flex space-x-4">
            <a class="hover:text-gray-400" href="/home/index.html">Home</a>
            <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
            <a class="hover:text-gray-400" href="/about us/index.html">About Us</a>
            <a class="hover:text-gray-400" href="/contact us/index.html">Contact Us</a>
        </div>
        <div class="hidden md:flex space-x-4">
            <button class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600" onclick="loginBtn()">Login</button>
            <button class="bg-[rgb(34,197,94)] px-4 py-2 rounded hover:bg-green-600" onclick="registerBtn()">Register</button>

        </div>
        <div class="md:hidden">
            <button id="menu-toggle" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
    <div id="mobile-menu" class="hidden md:hidden">
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="#">Home</a>
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="#">Jobs</a>
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="#">About Us</a>
        <a class="block px-4 py-2 text-sm hover:bg-gray-700" href="#">Contact Us</a>
        <button class="block w-full text-left px-4 py-2 text-sm bg-gray-700 hover:bg-gray-600" onclick="loginBtn()">Login</button>
        <button class="block w-full text-left px-4 py-2 text-sm bg-green-500 hover:bg-green-400" onclick="registerBtn()">Register</button>
    </div>
</nav> -->
  <!-- Hero Section -->
  <section class="container mx-auto px-4 py-8">
   <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div>
     <img alt="Hero Image 1" class="w-full rounded-lg shadow-md" height="400" src="https://storage.googleapis.com/a1aa/image/mYc7hjSJzCZqMZsM0K4sxpE8Kp2LNZswwdFx3iNuIJGTDhAF.jpg" width="600"/>
    </div>
    <div>
     <img alt="Hero Image 2" class="w-full rounded-lg shadow-md" height="400" src="https://storage.googleapis.com/a1aa/image/Za8P0yquC6b3GtfRz1GUKUycOleRD1z0pi49E73CxcXDNECUA.jpg" width="600"/>
    </div>
   </div>
  </section>
  <!-- Main Section -->
  <section class="container mx-auto px-4 py-8">
   <div class="bg-white rounded-lg shadow-md p-8 text-center">
    <h2 class="text-3xl font-bold mb-4">
     Good Life Begins With A Good Company
    </h2>
    <p class="text-gray-600 mb-4">
     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
    </p>
    <div class="flex justify-center space-x-4">
        <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 rounded-lg hover:bg-green-600" onclick="window.location.href='/about us/index.html'">
            Learn More
        </button>
        
     <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="window.location.href='/contact us/index.html'">
      Contact Us
     </button>
    </div>
   </div>
  </section>
  <!-- FAQ Section -->
  <section class="container mx-auto px-4 py-8">
   <h2 class="text-2xl font-bold mb-4">
    Frequently Asked Questions
   </h2>
   <div class="bg-white rounded-lg shadow-md p-4">
    <div class="border-b border-gray-200 py-2">
     <h3 class="text-lg font-medium">
      What is your return policy?
     </h3>
     <p class="text-gray-600">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
     </p>
    </div>
    <div class="border-b border-gray-200 py-2">
     <h3 class="text-lg font-medium">
      How do I track my order?
     </h3>
     <p class="text-gray-600">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
     </p>
    </div>
    <div class="border-b border-gray-200 py-2">
     <h3 class="text-lg font-medium">
      Can I purchase items again?
     </h3>
     <p class="text-gray-600">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
     </p>
    </div>
   </div>
  </section>
  <!-- Team Section -->
  <section class="container mx-auto px-4 py-8">
   <h2 class="text-2xl font-bold mb-4">
    We're Only Working With The Best
   </h2>
   <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div>
     <img alt="Team Member 1" class="w-full rounded-lg shadow-md" height="300" src="https://storage.googleapis.com/a1aa/image/eS3Thh0R0fg0vkfxjO0p2r0jCvopCKpqdRPUWIjjmsmVaIEoA.jpg" width="300"/>
     <h3 class="text-lg font-medium mt-4">
      John Doe
     </h3>
     <p class="text-gray-600">
      CEO
     </p>
    </div>
    <div>
     <img alt="Team Member 2" class="w-full rounded-lg shadow-md" height="300" src="https://storage.googleapis.com/a1aa/image/02k8eDFiixUNH6p8DMG61YnUCczfyOauUdfa8Ng63lRMaIEoA.jpg" width="300"/>
     <h3 class="text-lg font-medium mt-4">
      Jane Smith
     </h3>
     <p class="text-gray-600">
      CTO
     </p>
    </div>
    <div>
     <img alt="Team Member 3" class="w-full rounded-lg shadow-md" height="300" src="https://storage.googleapis.com/a1aa/image/TBSrchyX7W4eIKrgFJIj6GkDwDcb1CNtRK1tY1ovQddnGCBKA.jpg" width="300"/>
     <h3 class="text-lg font-medium mt-4">
      Mike Johnson
     </h3>
     <p class="text-gray-600">
      CFO
     </p>
    </div>
   </div>
  </section>
  <!-- News and Blog Section -->
  <section class="container mx-auto px-4 py-8">
   <h2 class="text-2xl font-bold mb-4">
    News and Blog
   </h2>
   <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="bg-white rounded-lg shadow-md p-4">
     <img alt="Blog Post 1" class="w-full rounded-lg mb-4" height="400" src="https://storage.googleapis.com/a1aa/image/JX9L9s6N0La2C9qkfetjjh4SljYyGOdGXCffjGztmclg0QIQB.jpg" width="600"/>
     <h3 class="text-lg font-medium">
      Blog Post Title 1
     </h3>
     <p class="text-gray-600">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
     </p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4">
     <img alt="Blog Post 2" class="w-full rounded-lg mb-4" height="400" src="https://storage.googleapis.com/a1aa/image/SwCSwGreGoxhMaYw6SFL8dpSp8OEB9cxxt2IcAcELThiGCBKA.jpg" width="600"/>
     <h3 class="text-lg font-medium">
      Blog Post Title 2
     </h3>
     <p class="text-gray-600">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
     </p>
    </div>
   </div>
  </section>
  <!-- Footer -->
 <?php
 include 'footer.php';
 ?>
<script >
    function subscribeNewsletter() {
    // Add your subscription logic here
    alert('Thank you for subscribing to our newsletter!');
}

function loginBtn(){
    window.location.href = "/log in/index.html";
}
function registerBtn(){
    window.location.href = "/create account/index.html";
}
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