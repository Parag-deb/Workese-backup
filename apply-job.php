<?php 
require 'connect.php';
session_start();
include 'nav.php'; // Include your navigation bar

// Initialize jobLocation variable
$jobLocation = ''; // Default value

// Fetch user profile data
$userId = $_SESSION['id']; // Assuming user ID is stored in session
$userQuery = "SELECT * FROM users WHERE id = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param("i", $userId);
$userStmt->execute();
$userResult = $userStmt->get_result();
$userData = $userResult->fetch_assoc();

// Fetch job location based on job ID (assuming job_id is stored in the session)
if (isset($_SESSION['job_id'])) {
    $job_id = $_SESSION['job_id']; // Get the job ID from the session

    // Fetch the job details from the database
    $query = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $job_id); // Bind the job ID parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result); // Fetch job details
        $jobLocation = $job['location']; // Get the job location
    } else {
        echo "Job not found!";
        exit;
    }
} else {
    echo "No job ID provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Job Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Main Content -->
    <main class="flex-grow container mx-auto py-12 px-6">
        <div class="border p-8 w-full">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST" action="submit-application.php">
                <div>
                    <label for="name" class="block mb-2">Your name :</label>
                    <input type="text" id="name" class="w-full border p-2" value="<?php echo htmlspecialchars($userData['name']); ?>" readonly>
                </div>
                <div>
                    <label for="email" class="block mb-2">Your email :</label>
                    <input type="email" id="email" class="w-full border p-2" value="<?php echo htmlspecialchars($userData['email']); ?>" readonly>
                </div>
                <div>
                    <label for="dob" class="block mb-2">Date of birth :</label>
                    <input type="text" id="dob" class="w-full border p-2" placeholder="dd/mm/yyyy" value="<?php echo htmlspecialchars($userData['date_of_birth']); ?>" readonly>
                </div>
                <div>
                    <label for="phone" class="block mb-2">Your phone :</label>
                    <input type="text" id="phone" class="w-full border p-2" value="<?php echo htmlspecialchars($userData['phone']); ?>" readonly>
                </div>
                <div>
                    <label for="address" class="block mb-2">Division :</label>
                    <input type="text" id="address" class="w-full border p-2" value="<?php echo htmlspecialchars($userData['address']); ?>" readonly>
                </div>
                <div>
                    <label for="gender" class="block mb-2">Gender :</label>
                    <input type="text" id="gender" class="w-full border p-2" value="<?php echo htmlspecialchars($userData['gender']); ?>" readonly>
                </div>
                <div>
                    <label for="location" class="block mb-2">Location :</label>
                    <input type="text" id="location" class="w-full border p-2" value="<?php echo htmlspecialchars($jobLocation); ?>" readonly>
                </div>
                <div>
                    <label for="salary" class="block mb-2">Expected Salary :</label>
                    <input type="text" id="salary" name="expected_salary" class="w-full border p-2" required>
                </div>
                <div>
                    <label for="cover_letter" class="block mb-2">Cover Letter :</label>
                    <textarea id="cover_letter" name="cover_letter" class="w-full border p-2" rows="4" required></textarea>
                </div>

                <div class="col-span-1 md:col-span-2 flex justify-center">
                    <button type="submit" class="bg-teal-500 text-white px-6 py-2 rounded hover:bg-teal-600">SUBMIT</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-12">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-6">
            <div>
                <div class="flex items-center mb-4">
                    <i class="fas fa-briefcase mr-2"></i>
                    <span class="font-bold text-lg">Job</span>
                </div>
                <p>Quis enim pellentesque viverra tellus eget malesuada facilisis. Congue nibh vivamus aliquet nunc mauris d...</p>
            </div>
            <div>
                <h3 class="font-bold mb-4">Company</h3>
                <ul>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">About Us</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">Our Team</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">Partners</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">For Candidates</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">For Employers</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-4">Job Categories</h3>
                <ul>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">Telecommunications</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">Hotels & Tourism</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">Construction</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">Education</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-gray-400">Financial Services</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-4">Newsletter</h3>
                <p class="mb-4">Eu nunc pretium vitae pisces. Non netus elementum vulputate</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Email Address" class="w-full border p-2">
                    <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600">Subscribe now</button>
                </form>
            </div>
        </div>
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center mt-8 px-6">
            <p class="mb-4 md:mb-0">© Copyright Job Portal 2024. Designed by Figma.guru</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-gray-400">Privacy Policy</a>
                <a href="#" class="hover:text-gray-400">Terms & Conditions</a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('nav-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>