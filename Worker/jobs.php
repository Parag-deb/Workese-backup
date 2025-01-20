<?php
    require '../connect.php';
    if(!session_start()){
        header('Location:login.php');
    }else{
       // session_start();
    }

    include '../nav.php';
?>
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
    </div>
</header>
<body class="bg-gray-100">
<main class="container mx-auto mt-8 px-6">
    <div class="flex flex-col lg:flex-row">
        <aside class="w-full lg:w-1/4 bg-white p-6 rounded-lg shadow-md mb-6 lg:mb-0">
          
        <h2 class="text-xl font-semibold mb-4">Search by Job Title</h2>
            <div class="mb-4">
                <input id="job_title" name="job_title" class="w-full p-2 border rounded" placeholder="Job title" type="text"/>
            </div>
            <!-- Other filters here -->
            <div class="mb-4">
            <label class="block mb-2">Location</label>
        <select class="w-full p-2 border rounded">
            <option value="">Choose city</option>
            <option value="Barisal">Barisal</option>
            <option value="Bagerhat">Bagerhat</option>
            <option value="Brahmanbaria">Brahmanbaria</option>
            <option value="Chandpur">Chandpur</option>
            <option value="Chattogram">Chattogram</option>
            <option value="Chuadanga">Chuadanga</option>
            <option value="Comilla">Comilla</option>
            <option value="Cumilla">Cumilla</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Dinajpur">Dinajpur</option>
            <option value="Faridpur">Faridpur</option>
            <option value="Feni">Feni</option>
            <option value="Habiganj">Habiganj</option>
            <option value="Jamuna">Jamuna</option>
            <option value="Jhalokathi">Jhalokathi</option>
            <option value="Jessore">Jessore</option>
            <option value="Khagrachari">Khagrachari</option>
            <option value="Khulna">Khulna</option>
            <option value="Kushtia">Kushtia</option>
            <option value="Kurigram">Kurigram</option>
            <option value="Lakshmipur">Lakshmipur</option>
            <option value="Magura">Magura</option>
            <option value="Manikganj">Manikganj</option>
            <option value="Madaripur">Madaripur</option>
            <option value="Meherpur">Meherpur</option>
            <option value="Moulvibazar">Moulvibazar</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Naogaon">Naogaon</option>
            <option value="Narayanganj">Narayanganj</option>
            <option value="Netrakona">Netrakona</option>
            <option value="Netrokona">Netrokona</option>
            <option value="Noakhali">Noakhali</option>
            <option value="Pabna">Pabna</option>
            <option value="Panchagarh">Panchagarh</option>
            <option value="Patukhali">Patuakhali</option>
            <option value="Rajbari">Rajbari</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Rangamati">Rangamati</option>
            <option value="Rangpur">Rangpur</option>
            <option value="Satkhira">Satkhira</option>
            <option value="Shariatpur">Shariatpur</option>
            <option value="Sherpur">Sherpur</option>
            <option value="Sunamganj">Sunamganj</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Tangail">Tangail</option>
            <option value="Tangail">Tangail</option>
            <option value="Thakurgaon">Thakurgaon</option>
        </select>


    </select>
</div>

<div class="mb-4">
    <h3 class="font-semibold mb-2">Category</h3>
    <div class="space-y-2">
        <label class="flex items-center">
            <input id="category-commerce" name="category" value="Commerce" class="mr-2" type="checkbox" />
            Commerce
        </label>
        <label class="flex items-center">
            <input id="category-telecom" name="category" value="Telecommunications" class="mr-2" type="checkbox" />
            Telecommunications
        </label>
        <label class="flex items-center">
            <input id="category-hotels" name="category" value="Hotels & Tourism" class="mr-2" type="checkbox" />
            Hotels & Tourism
        </label>
        <label class="flex items-center">
            <input id="category-education" name="category" value="Education" class="mr-2" type="checkbox" />
            Education
        </label>
        <label class="flex items-center">
            <input id="category-financial" name="category" value="Financial Services" class="mr-2" type="checkbox" />
            Financial Services
        </label>
    </div>
    <button class="mt-4 text-green-500">Show More</button>
</div>

<div class="mb-4">
    <h3 class="font-semibold mb-2">Job Type</h3>
    <div class="space-y-2">
        <label class="flex items-center">
            <input id="job-fulltime" name="job-type" value="Full Time" class="mr-2" type="checkbox" />
            Full Time
        </label>
        <label class="flex items-center">
            <input id="job-parttime" name="job-type" value="Part Time" class="mr-2" type="checkbox" />
            Part Time
        </label>
        <label class="flex items-center">
            <input id="job-freelance" name="job-type" value="Freelance" class="mr-2" type="checkbox" />
            Freelance
        </label>
        <label class="flex items-center">
            <input id="job-seasonal" name="job-type" value="Seasonal" class="mr-2" type="checkbox" />
            Seasonal
        </label>
        <label class="flex items-center">
            <input id="job-fixedprice" name="job-type" value="Fixed-Price" class="mr-2" type="checkbox" />
            Fixed-Price
        </label>
    </div>
</div>

<div class="mb-4">
    <h3 class="font-semibold mb-2">Salary</h3>
    <div class="flex items-center">
        <input id="salary-range" name="salary" class="w-full" max="99999" min="0" type="range" />
        <span id="salary-display" class="ml-2">Salary: $0 - $99999</span>
    </div>
    <button id="apply-filter" class="mt-4 bg-green-500 text-white py-1 px-4 rounded">Apply</button>
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

//     $('#apply-filter').click(function (event) {
//     event.preventDefault();

//     const action = 'applyFilter';
//     const filters = {};

//     // Collect checkbox values
//     filters.categories = [];
//     $('input[name="category"]:checked').each(function () {
//         filters.categories.push($(this).val());
//     });

//     filters.jobTypes = [];
//     $('input[name="job-type"]:checked').each(function () {
//         filters.jobTypes.push($(this).val());
//     });

//     // Collect range value
//     filters.salary = $('#salary-range').val();

//     // Send data via Ajax
//     $.ajax({
//         url: "job-action.php",
//         method: "POST",
//         data: { action: action, filters: filters },
//         success: function (data) {
//             $('#job-show').html(data);
//         }
//     });
// });


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