<?php
session_start(); // Start a session

// Include database connection
include 'connect.php'; // Ensure this file connects to your database
include 'nav.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $company_website = $conn->real_escape_string($_POST['company_website']);
    $job_title = $conn->real_escape_string($_POST['job_title']);
    $job_type = $conn->real_escape_string($_POST['job_type']);
    $job_category = $conn->real_escape_string($_POST['job_category']);
    $salary_range = $conn->real_escape_string($_POST['salary_range']);
    $application_deadline = $conn->real_escape_string($_POST['application_deadline']);
    $qualification = $conn->real_escape_string($_POST['qualification']);
    $job_description = $conn->real_escape_string($_POST['job_description']);

    // Insert data into the jobs table
    $sql = "INSERT INTO jobs (
                job_title, 
                company_name, 
                company_website, 
                job_type, 
                job_category, 
                description, 
                qualification, 
                application_deadline, 
                salary_range
            ) VALUES (
                '$job_title', 
                '$company_name', 
                '$company_website', 
                '$job_type', 
                '$job_category', 
                '$job_description', 
                '$qualification', 
                '$application_deadline', 
                '$salary_range'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Job posted successfully!'); window.location.href='post-a-job.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close the connection
$conn->close();
?>

    <body class="bg-gray-100 font-roboto">
    <main class="flex flex-col items-center mt-10 px-4" method="POST">
        <h1 class="text-4xl font-bold mb-4">Create A Job</h1>
        <p class="mb-6">Already create an account? <a href="#" class="bg-teal-500 text-white px-4 py-2 rounded">Sign in</a></p>
        <form action="post-a-job.php" method="POST" class="bg-white p-8 rounded shadow-md w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="company-name" class="block text-gray-700">Company Name / Recruiter Name</label>
                    <input name="company_name" type="text" id="company-name" name="company_name" class="w-full border border-gray-300 p-2 rounded mt-1" required>
                </div>
                <div>
                    <label for="company-website" class="block text-gray-700">Company Website</label>
                    <input name="company_website" type="text" id="company-website" name="company_website" class="w-full border border-gray-300 p-2 rounded mt-1">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="job-title" class="block text-gray-700">Job Title</label>
                    <input type="text" id="job-title" name="job_title" class="w-full border border-gray-300 p-2 rounded mt -1" required>
                </div>
                <div>
                    <label for="job-type" class="block text-gray-700">Job Type</label>
                    <select id="job-type" name="job_type" class="w-full border border-gray-300 p-2 rounded mt-1" required>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="job-category" class="block text-gray-700">Job Category</label>
                    <select id="job-category" name="job_category" class="w-full border border-gray-300 p-2 rounded mt-1" required>
                        <option value="Plumber">Plumber</option>
                        <option value="Driver">Driver</option>
                        <option value="Full Time">k</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>
                <div>
                    <label for="salary-range" class="block text-gray-700">Salary Range</label>
                    <select id="salary-range" name="salary_range" class="w-full border border-gray-300 p-2 rounded mt-1" required>
                        <option value="100-1k">100-1k</option>
                        <option value="1k-5k">1k-5k</option>
                        <option value="5k-10k">5k-10k</option>
                        <option value="10k-15k">10k-15k</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="application-deadline" class="block text-gray-700">Application Deadline</label>
                    <input type="date" id="application-deadline" name="application_deadline" class="w-full border border-gray-300 p-2 rounded mt-1" required>
                </div>
                <div>
                    <label for="qualification" class="block text-gray-700">Qualification</label>
                    <input type="text" id="qualification" name="qualification" class="w-full border border-gray-300 p-2 rounded mt-1" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="job-description" class="block text-gray-700">Job Description</label>
                <textarea id="job-description" name="job_description" class="w-full border border-gray-300 p-2 rounded mt-1" rows="4" required></textarea>
            </div>
            <div class="mb-4">
                <label for="job-requirements" class="block text-gray-700">Job Requirements</label>
                <textarea id="job-requirements" name="job_requirements" class="w-full border border-gray-300 p-2 rounded mt-1" rows="4" required></textarea>
            </div>
            <button type="submit" class="w-full bg-teal-500 text-white p-3 rounded">Post Job</button>
        </form>
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
                    <li><a class="hover:text-gray-400" href="#">Finance</a></li ```html
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
    </footer>
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