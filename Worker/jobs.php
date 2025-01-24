<?php 
require '../connect.php';
session_start();
include '../nav.php'; 
//include '../fetch-notification.php';

// Check if the application was successful
if (isset($_SESSION['application_success'])) {
    echo '<script>alert("Application submitted successfully!");</script>';
    // Unset the session variable after displaying the message
    unset($_SESSION['application_success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>WORKESE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
<main class="container mx-auto mt-8 px-6">
    <div class="flex flex-col lg:flex-row">
        <aside class="w-full lg:w-1/4 bg-white p-6 rounded-lg shadow-md mb-6 lg:mb-0">
            <h2 class="text-xl font-semibold mb-4">Search by Job Title</h2>
            <div class="mb-4">
                <input id="job_title" name="job_title" class="w-full p-2 border rounded" placeholder="Job title" type="text"/>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Location</label>
                <select class="w-full p-2 border rounded" id="location">
                <option value="">Choose city</option>
                    <option value="Bagerhat">Bagerhat</option>
                    <option value="Bandarban">Bandarban</option>
                    <option value="Barguna">Barguna</option>
                    <option value="Barisal">Barisal</option>
                    <option value="Bhola">Bhola</option>
                    <option value="Bogra">Bogra</option>
                    <option value="Brahmanbaria">Brahmanbaria</option>
                    <option value="Chandpur">Chandpur</option>
                    <option value="Chattogram">Chattogram</option>
                    <option value="Chuadanga">Chuadanga</option>
                    <option value="Cox's Bazar">Cox's Bazar</option>
                    <option value="Cumilla">Cumilla</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Dinajpur">Dinajpur</option>
                    <option value="Faridpur">Faridpur</option>
                    <option value="Feni">Feni</option>
                    <option value="Gaibandha">Gaibandha</option>
                    <option value="Gazipur">Gazipur</option>
                    <option value="Gopalganj">Gopalganj</option>
                    <option value="Habiganj">Habiganj</option>
                    <option value="Jamalpur">Jamalpur</option>
                    <option value="Jashore">Jashore</option>
                    <option value="Jhalokati">Jhalokati</option>
                    <option value="Jhenaidah">Jhenaidah</option>
                    <option value="Joypurhat">Joypurhat</option>
                    <option value="Khagrachari">Khagrachari</option>
                    <option value="Khulna">Khulna</option>
                    <option value="Kishoreganj">Kishoreganj</option>
                    <option value="Kurigram">Kurigram</option>
                    <option value="Kushtia">Kushtia</option>
                    <option value="Lakshmipur">Lakshmipur</option>
                    <option value="Lalmonirhat">Lalmonirhat</option>
                    <option value="Madaripur">Madaripur</option>
                    <option value="Magura">Magura</option>
                    <option value="Manikganj">Manikganj</option>
                    <option value="Meherpur">Meherpur</option>
                    <option value="Moulvibazar">Moulvibazar</option>
                    <option value="Munshiganj">Munshiganj</option>
                    <option value="Mymensingh">Mymensingh</option>
                    <option value="Naogaon">Naogaon</option>
                    <option value="Narail">Narail</option>
                    <option value="Narayanganj">Narayanganj</option>
                    <option value="Narsingdi">Narsingdi</option>
                    <option value="Natore">Natore</option>
                    <option value="Netrokona">Netrokona</option>
                    <option value="Nilphamari">Nilphamari</option>
                    <option value="Noakhali">Noakhali</option>
                    <option value="Pabna">Pabna</option>
                    <option value="Panchagarh">Panchagarh</option>
                    <option value="Patuakhali">Patuakhali</option>
                    <option value="Pirojpur">Pirojpur</option>
                    <option value="Rajbari">Rajbari</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Rangamati">Rangamati</option>
                    <option value="Rangpur">Rangpur</option>
                    <option value="Satkhira">Satkhira</option>
                    <option value="Shariatpur">Shariatpur</option>
                    <option value="Sherpur">Sherpur</option>
                    <option value="Sirajganj">Sirajganj</option>
                    <option value="Sunamganj">Sunamganj</option>
                    <option value="Sylhet">Sylhet</option>
                    <option value="Tangail">Tangail</option>
                    <option value="Thakurgaon">Thakurgaon</option>

                </select>
            </div>
            <div class="mb-4">
                <h3 class="font-semibold mb-2">Category</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Commerce"/>
                        <span class="ml-2">Commerce</span>
                    </label>
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Telecommunications"/>
                        <span class="ml-2">Telecommunications</span>
                    </label>
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Hotels & Tourism"/>
                        <span class="ml-2">Hotels & Tourism</span>
                    </label>
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Education"/>
                        <span class="ml-2">Education</span>
                    </label>
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Financial Services"/>
                        <span class="ml-2">Financial Services</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <h3 class="font-semibold mb-2">Job Type</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Full Time"/>
                        <span class="ml-2">Full Time</span>
                    </label>
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Part Time"/>
                        <span class="ml-2">Part Time</span>
                    </label>
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Remote"/>
                        <span class="ml-2">Remote</span>
                    </label>
                    <label class="flex items-center">
                        <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Seasonal"/>
                        <span class="ml-2">Seasonal</span>
                    </label>
                </div>
            </div>
            <button id="filter-button" class="w-full bg-teal-500 text-white p-3 rounded">Filter</button>
        </aside>

        <!-- Main Content -->
        <section class="w-full lg:w-3/4 lg:pl-6">
            <div class="flex justify-between items-center mb-6">
                <span id="result-count">Showing results</span>
                <select class="p-2 border rounded" id="sort-by">
                    <option value="latest">Sort by latest</option>
                    <option value="oldest">Sort by oldest</option>
                </select>
            </div>
            <div id="job-show"></div> <!-- This is where job data will be displayed -->
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

        // Add event listener for the filter button
        $('#filter-button').click(function() {
            fetchData(); // Call fetchData when the filter button is clicked
        });

        // Add event listener for the sort dropdown
        $('#sort-by').change(function() {
            fetchData(); // Call fetchData when the sort option is changed
        });
    });

    function fetchData() {
        var action = 'fetchData';
        var jobTitle = $('#job_title').val(); // Get job title
        var location = $('#location').val(); // Get location
        var categories = $('input[name="category[]"]:checked').map(function() {
            return $(this).val();
        }).get(); // Get selected categories
        var jobTypes = $('input[name="job_type[]"]:checked').map(function() {
            return $(this).val();
        }).get(); // Get selected job types
        var sortBy = $('#sort-by').val(); // Get sort option

        $.ajax({
            url: "job-action.php",
            method: "POST",
            data: { 
                action: action,
                job_title: jobTitle,
                location: location,
                categories: categories,
                job_types: jobTypes,
                sort_by: sortBy // Send sort option
            },
            success: function(data) {
                $('#job-show').html(data);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
            }
        });
    }

    function subscribeNewsletter() {
        alert('Thank you for subscribing to our newsletter!');
    }
</script>
</body>
</html>