<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Worker Listings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
<?php include 'nav.php'; ?>
    <!-- <nav class="bg-black text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">WORKESE</div>
            <div class="hidden md:flex space-x-4">
                <a class="hover:text-gray-400" href="/home/index.html">Home</a>
                <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
                <a class="hover:text-gray-400" href="/about/index.html">About Us</a>
                <a class="hover:text-gray-400" href="/contact/index.html">Contact Us</a>
            </div>
            <div class="hidden md:flex space-x-4">
                <button class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">Login</button>
                <button class="bg-[rgb(34,197,94)] px-4 py-2 rounded hover:bg-green-600">Register</button>
            </div>
            <div class="md:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav> -->
    <div class="container mx-auto p-4">
        <div class="flex flex-col lg:flex-row">
            <!-- Sidebar -->
            <div class="w-full lg:w-1/4 bg-white p-4 rounded-lg shadow-md">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="job-title">Search by Job Title</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="job-title" placeholder="Job title or company" type="text"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Location</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location">
                        <option>Choose city</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                    <div class="flex flex-col">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Commerce</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Telecommunications</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Hotels & Tourism</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Education</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Financial Services</span>
                        </label>
                    </div>
                    <button class="mt-2 text-indigo-600">Show More</button>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Job Type</label>
                    <div class="flex flex-col">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Full Time</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Part Time</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Remote</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Seasonal</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Fixed-Price</span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Experience Level</label>
                    <div class="flex flex-col">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">No experience</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">0-1 year</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">1-3 years</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">3-5 years</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">5-10 years</span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Date Posted</label>
                    <div class="flex flex-col">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Last Hour</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Last 24 Hours</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Last 7 Days</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox"/>
                            <span class="ml-2">Last 30 Days</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Main Content -->
            <div class="w-full lg:w-3/4 p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="worker-list">
                    <!-- Worker cards will be injected here -->
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script>
        $(document).ready(function() {
            fetchData(); // Call the function to fetch data on page load
        });

        function fetchData() {
            var action = 'fetchData';
            $.ajax({
                url: "worker-action.php",
                method: "POST",
                data: { action: action },
                success: function(data) {
                    console.log(data); // Log the response data
                    $('#worker-list').html(data);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", status, error);
                }
            });
        }
    </script>
</body>
</html>