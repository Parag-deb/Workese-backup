<?php
require 'connect.php';
//include 'nav.php';
// Get the job_id from the query string
if (isset($_GET['job_id'])) {
    $job_id = intval($_GET['job_id']);
    $_SESSION ['job_id'] = $job_id;
    // Fetch the job details from the database
    $query = "SELECT * FROM jobs WHERE job_id = $job_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);
    } else {
        echo "Job not found!";
        exit;
    }
} else {
    echo "No job ID provided!";
    exit;
}
?>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Job Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<header class="bg-black text-white p-4 flex justify-between items-center">
    <div class="flex items-center">
     <img alt="Logo" class="mr-2" height="40" src="https://storage.googleapis.com/a1aa/image/mn5r6cMFAlLWMNwewZpktc1jabziQDdvdPI3mfFVAzgxuUCUA.jpg" width="40"/>
     <span class="text-xl font-bold">
         WORKESE
     </span>
    </div>
    <nav class="flex space-x-4">
        <div class="hidden md:flex space-x-4">
            <a class="hover:text-gray-400" href="/home/index.html">Home</a>
            <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
            <a class="hover:text-gray-400" href="/about us/index.html">About Us</a>
            <a class="hover:text-gray-400" href="/contact us/index.html">Contact Us</a>
        </div>
    </nav>
    <div class="flex items-center">
     <span class="mr-2">
      Parag
     </span>
     <img alt="User Avatar" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/lyou4ghwI2rfFSOMEefw0VROzQIkdIGqehYskzfb92Fn3lSgC.jpg" width="40"/>
    </div>
   </header>
<!-- <body>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($job['job_title']); ?></h1>
        <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company_name']); ?></p>
        <p><strong>Job Type:</strong> <?php echo htmlspecialchars($job['job_type']); ?></p>
        <p><strong>Salary Range:</strong> <?php echo htmlspecialchars($job['salary_range']); ?></p>
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
        <p><strong>Posted On:</strong> <?php echo htmlspecialchars($job['posted_date']); ?></p>

        <button 
            class="bg-gray-200 text-black py-2 px-4 rounded hover:bg-gray-300"
            onclick="window.location.href='index.php'">
            Back to Job Listings
        </button>
    </div>
</body> -->
<body class="bg-gray-50 text-gray-800">
<div class="max-w-7xl mx-auto p-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                    <div>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <span>10 min ago</span>
                        </div>
                        <h1 class="text-2xl font-bold mt-2"><?php echo htmlspecialchars($job['job_title']); ?></h1>
                        <p class="text-gray-500"><?php echo htmlspecialchars($job['company_name']); ?></p>
                        <div class="flex flex-wrap items-center space-x-4 mt-4">
                            <div class="flex items-center space-x-1 text-sm text-gray-500">
                                <i class="fas fa-briefcase"></i>
                                <span><?php echo htmlspecialchars($job['job_category']); ?></span>
                            </div>
                            <div class="flex items-center space-x-1 text-sm text-gray-500">
                                <i class="fas fa-clock"></i>
                                <span><?php echo htmlspecialchars($job['job_type']); ?></span>
                            </div>
                            <div class="flex items-center space-x-1 text-sm text-gray-500">
                                <i class="fas fa-dollar-sign"></i>
                                <span><?php echo htmlspecialchars($job['salary_range']); ?></span>
                            </div>
                            <div class="flex items-center space-x-1 text-sm text-gray-500">
                                <i class="fas fa-dollar-sign"></i>
                                <span><?php echo htmlspecialchars($job['application_deadline']); ?></span>
                            </div>
                            <div class="flex items-center space-x-1 text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo htmlspecialchars($job['location']); ?>
                            </span>
                            </div>
                        </div>
                    </div>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-4 lg:mt-0" onclick="window.location.href='/after applying job Button/index.html'">Apply Job</button>
                </div>
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Job Description</h2>
                    <p class="mt-2 text-gray-600">
                    <?php echo htmlspecialchars($job['description']); ?>
                    </p>
                </div>
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Key Responsibilities</h2>
                    <ul class="mt-2 text-gray-600 list-disc list-inside">
                        <li>Et nunc ut tempus duis nisi sed massa. Ornare varius faucibus nisi vitae vitae cras ornare. Cras facilisis dignissim augue lorem amet adipiscing cursus.</li>
                        <li>Cras facilisis dignissim augue lorem amet adipiscing cursus faucibus mauris. Tortor amet porta porta in.</li>
                        <li>Ornare varius faucibus nisi vitae vitae cras ornare. Cras facilisis dignissim augue lorem amet adipiscing cursus faucibus.</li>
                        <li>Tortor amet porta porta in. Orci imperdiet nisi dignissim pellentesque morbi vitae. Quisque tincidunt metus lectus porta.</li>
                        <li>Tortor amet porta porta in. Orci imperdiet nisi dignissim pellentesque morbi vitae. Quisque tincidunt metus lectus porta.</li>
                    </ul>
                </div>
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Professional Skills</h2>
                    <ul class="mt-2 text-gray-600 list-disc list-inside">
                        <li>Et nunc ut tempus duis nisi sed massa. Ornare varius faucibus nisi vitae vitae cras ornare.</li>
                        <li>Ornare varius faucibus nisi vitae vitae cras ornare.</li>
                        <li>Tortor amet porta porta in. Orci imperdiet nisi dignissim pellentesque morbi vitae.</li>
                        <li>Tortor amet porta porta in. Orci imperdiet nisi dignissim pellentesque morbi vitae.</li>
                        <li>Tortor amet porta porta in. Orci imperdiet nisi dignissim pellentesque morbi vitae.</li>
                    </ul>
                </div>
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Tags:</h2>
                    <div class="flex flex-wrap mt-2 space-x-2">
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">Full time</span>
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">Commerce</span>
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">New York</span>
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">Corporate</span>
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">Location</span>
                    </div>
                </div>
                <div class="mt-6 flex items-center space-x-4">
                    <span class="text-gray-600">Share Job:</span>
                    <a class="text-gray-600" href="#"><i class="fab fa-facebook"></i></a>
                    <a class="text-gray-600" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="text-gray-600" href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="mt-8">
                <h2 class="text-2xl font-bold">Related Jobs</h2>
                <div class="mt-4 space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row justify-between items-start lg:items-center">
                        <div>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <span>24 min ago</span>
                            </div>
                            <h3 class="text-lg font-semibold mt-2">Internal Creative Coordinator</h3>
                            <p class="text-gray-500">Green Group</p>
                            <div class="flex flex-wrap items-center space-x-4 mt-2">
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Commerce</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-clock"></i>
                                    <span>Full time</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span>$44000-$46000</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>New York, USA</span>
                                </div>
                            </div>
                        </div>
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-4 lg:mt-0">Job Details</button>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row justify-between items-start lg:items-center">
                        <div>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <span>24 min ago</span>
                            </div>
                            <h3 class="text-lg font-semibold mt-2">District Intranet Director</h3>
                            <p class="text-gray-500">VonRueden - Weber Co</p>
                            <div class="flex flex-wrap items-center space-x-4 mt-2">
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Commerce</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-clock"></i>
                                    <span>Full time</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span>$42000-$48000</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>New York, USA</span>
                                </div>
                            </div>
                        </div>
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-4 lg:mt-0">Job Details</button>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row justify-between items-start lg:items-center">
                        <div>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <span>26 min ago</span>
                            </div>
                            <h3 class="text-lg font-semibold mt-2">Corporate Tactics Facilitator</h3>
                            <p class="text-gray-500">Cummer, Turner and Fridley Inc.</p>
                            <div class="flex flex-wrap items-center space-x-4 mt-2">
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Commerce</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-clock"></i>
                                    <span>Full time</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span>$38000-$40000</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>New York, USA</span>
                                </div>
                            </div>
                        </div>
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-4 lg:mt-0">Job Details</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-y-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold">Job Overview</h2>
                <ul class="mt-4 space-y-2 text-gray-600">
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-briefcase text-gray-500"></i>
                        <span>Job Title: Corporate Solutions Executive</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-clock text-gray-500"></i>
                        <span>Job Type: Full time</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-briefcase text-gray-500"></i>
                        <span>Category: Commerce</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-graduation-cap text-gray-500"></i>
                        <span>Degree: Masters</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-dollar-sign text-gray-500"></i>
                        <span>Offered Salary: $40000-$42000</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-map-marker-alt text-gray-500"></i>
                        <span>Location: New York, USA</span>
                    </li>
                </ul>
                <div class="mt-4">
                    <img alt="Map showing job location" class="w-full rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/8HZUOqXrnDKhJNGIdOU48GfBepsMoBVmllyzPzTl7TeeXZKQB.jpg" width="300"/>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold">Send Us Message</h2>
                <form class="mt-4 space-y-4">
                    <input class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Full name" type="text"/>
                    <input class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Email Address" type="email"/>
                    <input class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Phone Number" type="tel"/>
                    <textarea class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Your Message"></textarea>
                    <button class="w-full bg-green-500 text-white px-4 py-2 rounded-lg" type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
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










