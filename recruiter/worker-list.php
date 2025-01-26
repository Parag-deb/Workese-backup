<?php 
require '../connect.php';
session_start();
include '../nav.php'; 
?>
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

    <div class="container mx-auto p-4">
        <div class="flex flex-col lg:flex-row">
            <!-- Sidebar -->
            <div class="w-full lg:w-1/4 bg-white p-4 rounded-lg shadow-md">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="worker-name">Search by Worker Name</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="worker-name" placeholder="Enter worker name" type="text" />
            </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Location</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location">
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
                    <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                    <div class="flex flex-col">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Commerce"/>
                            <span class="ml-2">Commerce</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Telecommunications"/>
                            <span class="ml-2">Telecommunications</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Hotels & Tourism"/>
                            <span class="ml-2">Hotels & Tourism</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Education"/>
                            <span class="ml-2">Education</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="category[]" value="Financial Services"/>
                            <span class="ml-2">Financial Services</span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Job Type</label>
                    <div class="flex flex-col">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Full Time"/>
                            <span class="ml-2">Full Time</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Part Time"/>
                            <span class="ml-2">Part Time</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Remote"/>
                            <span class="ml-2">Remote</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Seasonal"/>
                            <span class="ml-2">Seasonal</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="job_type[]" value="Fixed-Price"/>
                            <span class="ml-2">Fixed-Price</span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Experience Level</label>
                    <div class="flex flex-col">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="experience[]" value="No experience"/>
                            <span class="ml-2">No experience</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="experience[]" value="0-1 year"/>
                            <span class="ml-2">0-1 year</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="experience[]" value="1-3 years"/>
                            <span class="ml-2">1-3 years</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="experience[]" value="3-5 years"/>
                            <span class="ml-2">3-5 years</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="experience[]" value="5-10 years"/>
                            <span class="ml-2">5-10 years</span>
                        </label>
                    </div>
                </div>
                <button id="filter-button" class="w-full bg-teal-500 text-white p-3 rounded">Filter</button>
            </div>

            <!-- Main Content -->
            <div class="w-full lg:w-3/4 p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="worker-list">
                    <!-- Worker cards will be injected here -->
                </div>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script>
        $(document).ready(function() {
            fetchData(); // Call the function to fetch data on page load

            // Add event listener for the filter button
            $('#filter-button').click(function() {
                fetchData(); // Call fetchData when the filter button is clicked
            });
        });

        function fetchData() {
                var action = 'fetchData';
                var workerName = $('#worker-name').val(); // Get worker name
                var location = $('#location').val(); // Get location
                var categories = $('input[name="category[]"]:checked').map(function() {
                    return $(this).val();
                }).get(); // Get selected categories
                var jobTypes = $('input[name="job_type[]"]:checked').map(function() {
                    return $(this).val();
                }).get(); // Get selected job types
                var experiences = $('input[name="experience[]"]:checked').map(function() {
                    return $(this).val();
                }).get(); // Get selected experience levels

                $.ajax({
                    url: "worker-action.php",
                    method: "POST",
                    data: { 
                        action: action,
                        worker_name: workerName,
                        location: location,
                        categories: categories,
                        job_types: jobTypes,
                        experiences: experiences
                    },
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