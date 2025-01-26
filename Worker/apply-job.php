<?php 
ob_start(); // Start output buffering
require '../connect.php';
session_start();
include '../nav.php'; // Include your navigation bar
//include '../fetch-notification.php';

// Console log function
function console_log($message) {
    $output = json_encode($message); // Encode the message for JavaScript
    echo "<script>console.log($output);</script>";
}

// Initialize jobLocation variable
$jobLocation = ''; // Default value
console_log("Script started.");

// Fetch user profile data
$userId = $_SESSION['id']; // Assuming user ID is stored in session
console_log("User ID: " . $userId);

$userQuery = "SELECT * FROM users WHERE id = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param("i", $userId);
$userStmt->execute();
$userResult = $userStmt->get_result();
$userData = $userResult->fetch_assoc();
console_log("User data: " . json_encode($userData));

// Fetch job location and recruiter ID based on job ID
if (isset($_SESSION['job_id'])) {
    $job_id = $_SESSION['job_id'];
    console_log("Job ID from session: " . $job_id);

    $query = "SELECT jobs.*, users.id AS recruiter_id FROM jobs JOIN users ON jobs.user_id = users.id WHERE job_id = ?";
    console_log("Executing query: " . $query);

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $job_id);

    if ($stmt->execute()) {
        console_log("Job query executed successfully.");
        $result = $stmt->get_result();

        if ($result && mysqli_num_rows($result) > 0) {
            $job = mysqli_fetch_assoc($result);
            console_log("Job details: " . json_encode($job));

            $jobLocation = $job['location'];
            $recruiterId = $job['recruiter_id'];
        } else {
            console_log("Job not found for job ID: " . $job_id);
            echo "Job not found!";
            exit;
        }
    } else {
        console_log("Error executing job query: " . $stmt->error);
    }
    $stmt->close();
} else {
    console_log("No job ID provided in session.");
    echo "No job ID provided!";
    exit;
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    console_log("Form submitted.");

    if (!isset($_SESSION['id']) || !isset($_SESSION['job_id'])) {
        console_log("Session variables are not set.");
        echo "Session variables are not set.";
        exit;
    }

    $workerId = $_SESSION['id']; // Assuming this is the worker's ID
    $jobId = $_SESSION['job_id'];

    $expectedSalary = $_POST['expected_salary'];
    $coverLetter = $_POST['cover_letter'];
    $location = $_POST['location']; // Assuming you have a location field in your form

    console_log("Expected Salary: " . $expectedSalary);
    console_log("Cover Letter: " . $coverLetter);
    console_log("Location: " . $location);

    $query = "INSERT INTO jobapplications (job_id, worker_id, expected_salary, cover_letter, location) VALUES (?, ?, ?, ?, ?)";
    console_log("Executing job application query: " . $query);

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        console_log("Error preparing job application statement: " . $conn->error);
        exit;
    }

    $stmt->bind_param("iisss", $jobId, $workerId, $expectedSalary, $coverLetter, $location);

    if ($stmt->execute()) {
        console_log("Job application inserted successfully.");
        $_SESSION['application_success'] = true;

        $notificationMessage = "A new application has been submitted for your job: " . htmlspecialchars($job['title']) . ". Expected Salary: " . htmlspecialchars($expectedSalary);
        console_log("Notification message: " . $notificationMessage);

        $notificationQuery = "INSERT INTO notifications (worker_id, message, job_id, is_read, created_at) VALUES (?, ?, ?, ?, ?)";
        $notificationStmt = $conn->prepare($notificationQuery);

        if (!$notificationStmt) {
            console_log("Error preparing notification statement: " . $conn->error);
            exit;
        }

        $isRead = 0;
        $createdAt = date('Y-m-d H:i:s');
        $notificationStmt->bind_param("isiss", $recruiterId, $notificationMessage, $jobId, $isRead, $createdAt);

        if ($notificationStmt->execute()) {
            console_log("Notification inserted successfully.");
        } else {
            console_log("Error executing notification statement: " . $notificationStmt->error);
        }

        $notificationStmt->close();

        echo '<script>alert("Application submitted successfully!");</script>';
        header("Location: Worker/jobs.php");
        exit;
    } else {
        console_log("Error executing job application statement: " . $stmt->error);
    }

    $stmt->close();
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
    <main class="flex-grow container mx-auto py-12 px-6">
        <div class="border p-8 w-full">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST" action="">
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
                    <input type="text" id="address" class="w-full border p-2" value="<?php echo htmlspecialchars($userData['division']); ?>" readonly>
                </div>
                <div>
                    <label for="expected_salary" class="block mb-2">Expected Salary :</label>
                    <input type="text" id="expected_salary" name="expected_salary" class="w-full border p-2" required>
                </div>
                <div>
                    <label for="cover_letter" class="block mb-2">Cover Letter :</label>
                    <textarea id="cover_letter" name="cover_letter" class="w-full border p-2" rows="4" required></textarea>
                </div>
                <div>
                    <label for="location" class="block mb-2">Location :</label>
                    <input type="text" id="location" name="location" class="w-full border p-2" value="<?php echo htmlspecialchars($jobLocation); ?>" readonly>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit Application</button>
                </div>
            </form>
        </div>
    </main>
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date("Y"); ?> Job Portal. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
