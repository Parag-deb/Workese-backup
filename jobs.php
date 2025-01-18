<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>WORKESE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
<header class="bg-black text-white">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <div class="flex items-center">
            <i class="fas fa-briefcase text-2xl mr-2"></i>
            <span class="text-xl font-semibold">WORKESE</span>
        </div>
        <nav class="flex space-x-6">
            <div class="hidden md:flex space-x-4">
                <a class="hover:text-gray-400" href="/home/index.html">Home</a>
                <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
                <a class="hover:text-gray-400" href="/about us/index.html">About Us</a>
                <a class="hover:text-gray-400" href="/contact us/index.html">Contact Us</a>
            </div>
        </nav>
        <div class="flex space-x-4">
            <button class="bg-transparent border border-white py-1 px-4 rounded hover:bg-white hover:text-black" onclick="loginBtn()">Login</button>
            <button class="bg-green-500 py-1 px-4 rounded hover:bg-green-600" onclick="registerBtn()">Register</button>
        </div>
    </div>
</header>
<main class="container mx-auto mt-8 px-6">
    <div class="flex flex-col lg:flex-row">
        <aside class="w-full lg:w-1/4 bg-white p-6 rounded-lg shadow-md mb-6 lg:mb-0">
          
        <h2 class="text-xl font-semibold mb-4">Search by Job Title</h2>
            <div class="mb-4">
                <input id="job_title" name="job_title" class="w-full p-2 border rounded" placeholder="Job title" type="text"/>
            </div>
            <!-- Other filters here -->
            <div class="mb-4">
            <label class="block mb-2">
            Location
            </label>
            <select class="w-full p-2 border rounded">
            <option>
                Choose city
            </option>
            </select>
            </div>
            <div class="mb-4">
            <h3 class="font-semibold mb-2">
            Category
            </h3>
            <div class="space-y-2">
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Commerce
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Telecommunications
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Hotels &amp; Tourism
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Education
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Financial Services
                <span class="ml-auto">
                10
                </span>
            </label>
            </div>
            <button class="mt-4 text-green-500">
            Show More
            </button>
            </div>
            <div class="mb-4">
            <h3 class="font-semibold mb-2">
            Job Type
            </h3>
            <div class="space-y-2">
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Full Time
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Part Time
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Freelance
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Seasonal
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Fixed-Price
                <span class="ml-auto">
                10
                </span>
            </label>
            </div>
            </div>
            <div class="mb-4">
            <h3 class="font-semibold mb-2">
            Experience Level
            </h3>
            <div class="space-y-2">
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                No-experience
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Fresher
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Intermediate
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Expert
                <span class="ml-auto">
                10
                </span>
            </label>
            </div>
            </div>
            <div class="mb-4">
            <h3 class="font-semibold mb-2">
            Date Posted
            </h3>
            <div class="space-y-2">
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                All
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Last Hour
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Last 24 Hours
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Last 7 Days
                <span class="ml-auto">
                10
                </span>
            </label>
            <label class="flex items-center">
                <input class="mr-2" type="checkbox"/>
                Last 30 Days
                <span class="ml-auto">
                10
                </span>
            </label>
            </div>
            </div>
            <div class="mb-4">
            <h3 class="font-semibold mb-2">
            Salary
            </h3>
            <div class="flex items-center">
            <input class="w-full" max="99999" min="0" type="range"/>
            <span class="ml-2">
                Salary: $0 - $99999
            </span>
            </div>
            <button class="mt-4 bg-green-500 text-white py-1 px-4 rounded">
            Apply
            </button>
            </div>
            <div class="mb-4">
            <h3 class="font-semibold mb-2">
            Tags
            </h3>
            <div class="flex flex-wrap gap-2">
            <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded">
                engineering
            </span>
            <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded">
                design
            </span>
            <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded">
                ui/ux
            </span>
            <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded">
                marketing
            </span>
            <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded">
                management
            </span>
            <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded">
                soft
            </span>
            <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded">
                construction
            </span>
            </div>
            </div>
            <div class="bg-gray-300 p-4 rounded-lg text-center">
            <h3 class="text-lg font-semibold mb-2">
            WE ARE HIRING
            </h3>
            <p>
            Apply Today!
            </p>
            <img alt="We are hiring banner" class="mt-4 rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/5dvlHHkAd0rvJ1tYI4qkjeRAloCFvTEvmsBp5OKCWylb4KBKA.jpg" width="200"/>
            </div>
        </aside>
        <section class="w-full lg:w-3/4 lg:pl-6">
            <div class="flex justify-between items-center mb-6">
                <span>Showing 6-6 of 10 results</span>
                <select class="p-2 border rounded">
                    <option>Sort by latest</option>
                </select>
            </div>


            <div id="job-show"></div> <!-- This is where job data will be displayed -->



            <div class="flex justify-center mt-6">
                <button class="bg-white border border-gray-300 py-2 px-4 rounded-l">1</button>
                <button class="bg-white border border-gray-300 py-2 px-4">2</button>
                <button class="bg-white border border-gray-300 py-2 px-4 rounded-r">Next</button>
            </div>
        </section>
    </div>
</main>
<footer class="bg-black text-white mt-8 p-4">
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
            <button id="subscribeNow" class="w-full bg-green-500 text-white px-4 py-2 rounded mt-2 hover:bg-green-400" onclick="subscribeNewsletter()">Subscribe Now</button>
        </div>
    </div>
    <div class="text-center mt-4">
        <p>© 2023 Job Portal. All rights reserved.</p>
        <div class="space-x-4">
            <a class="hover:text-gray-400" href="#">Privacy Policy</a>
            <a class="hover:text-gray-400" href="#">Terms & Conditions</a>
        </div>
    </div>
</footer>
<script>
    $(document).ready(function() {
        fetchData(); // Call the function to fetch data on page load
    });

    function fetchData() {
        var action = 'fetchData';
        $.ajax({
            url: "job-action.php",
            method: "POST",
            data: { action: action },
            success: function(data) {
                $('#job-show').html(data);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
            }
        });
    }
    $(document).ready(function(){
        $('#job_title').keyup(function(event){
            event.preventDefault();
            var action ='searchRecord';
            var job_title = $('#job_title').val();
            if(job_title !=''){
                $.ajax({
                    url: "job-action.php",
                    method: "POST",
                    data: {action: action, job_title: job_title},
                    success: function(data){
                        $('#job-show').html(data);
                        //alert(data);
                    }
            });
        }
    });
    });

    function subscribeNewsletter() {
        alert('Thank you for subscribing to our newsletter!');
    }

    function loginBtn() {
        window.location.href = "/log in/index.html";
    }

    function registerBtn() {
        window.location.href = "/create account/index.html";
    }
</script>
</body>
</html>