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
    $location = $conn->real_escape_string($_POST['location']);
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
                location,
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
                '$location',
                '$job_description', 
                '$qualification', 
                '$application_deadline', 
                '$salary_range'
            )";

    if ($conn->query($sql) === TRUE) {
        // Notify workers in the same location
        $jobId = $conn->insert_id; // Get the last inserted job ID
        $workerSql = "SELECT worker_id FROM workers JOIN users ON workers.user_id = users.id WHERE users.district = '$location'AND users.role='worker'";
        $workerResult = $conn->query($workerSql);

        while ($worker = $workerResult->fetch_assoc()) {
            $notificationMessage = "A new job has been posted in your location: $job_title.";
            $notificationSql = "INSERT INTO notifications (worker_id, message, job_id) VALUES (?, ?, ?)";
            $notificationStmt = $conn->prepare($notificationSql);
            $notificationStmt->bind_param("isi", $worker['worker_id'], $notificationMessage, $jobId);
            $notificationStmt->execute();
        }

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
    <form action="post-a-job.php" method="POST" class="bg-white p-8 rounded shadow-md w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="company-name" class="block text-gray-700">Company Name / Recruiter Name</label>
                <input name="company_name" type="text" id="company-name" class="w-full border border-gray-300 p-2 rounded mt-1" required>
            </div>
            <div>
                <label for="company-website" class="block text-gray-700">Company Website</label>
                <input name="company_website" type="text" id="company-website" class="w-full border border-gray-300 p-2 rounded mt-1">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="job-title" class="block text-gray-700">Job Title</label>
                <input type="text" id="job-title" name="job_title" class="w-full border border-gray-300 p-2 rounded mt-1" required>
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
                    <option value="Full Time">Full Time</option>
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
        <div>
            <label for="location" class="block text-gray-700">Location</label>
            <select id="location" name="location" class="w-full border border-gray-300 p-2 rounded mt-1" required>
                <option value="" disabled selected>Select your district</option>
                <option value="Bagerhat">Bagerhat</option>
                <option value="Bandarban">Bandarban</option>
                <option value="Barguna">Barguna</option>
                <option value="Barishal">Barishal</option>
                <option value="Bhola">Bhola</option>
                <option value="Bogura">Bogura</option>
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
            <label for="job-description" class="block text-gray-700">Job Description</label>
            <textarea id="job-description" name="job_description" class="w-full border border-gray-300 p-2 rounded mt-1" rows="4" required></textarea>
        </div>
        <button type="submit" class="w-full bg-teal-500 text-white p-3 rounded">Post Job</button>
    </form>
</main>

<!-- Notification Modal -->
<div id="notificationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg w-96 p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Notifications</h2>
            <button onclick="toggleNotificationModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-2">
            <?php 
            // Fetch notifications for the logged-in worker
            $workerId = $_SESSION['worker_id']; // Assuming the worker is logged in
            $notificationSql = "SELECT * FROM notifications WHERE worker_id = ? AND is_read = FALSE";
            $notificationStmt = $conn->prepare($notificationSql);
            $notificationStmt->bind_param("i", $workerId);
            $notificationStmt->execute();
            $notifications = $notificationStmt->get_result();

            if ($notifications->num_rows > 0) {
                while ($notification = $notifications->fetch_assoc()) {
                    echo '<div class="p-2 border rounded hover:bg-gray-100 cursor-pointer" onclick="openNotificationDetail(' . htmlspecialchars($notification['id']) . ', ' . htmlspecialchars($notification['job_id']) . ')">' . htmlspecialchars($notification['message']) . '</div>';
                }
            } else {
                echo '<div class="text-gray-500">No new notifications.</div>';
            }
            ?>
        </div>
        <div class="mt-4">
            <button onclick="toggleNotificationModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>
</div>

<!-- Job Details Modal -->
<div id="jobDetailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg w-96 p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Job Details</h2>
            <button onclick="closeJobDetailsModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="jobDetailsContent" class="text-gray-700"></div>
        <div class="mt-4">
            <button onclick="closeJobDetailsModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>
</div>

<script>
    // Toggle the notification modal
    function toggleNotificationModal() {
        const modal = document.getElementById('notificationModal');
        modal.classList.toggle('hidden');
    }

    // Open a new modal for the notification detail
    function openNotificationDetail(notificationId, jobId) {
        // Fetch job details from the server
        $.ajax({
            url: 'fetch-job-details.php', // Create this PHP file to fetch job details
            method: 'POST',
            data: { job_id: jobId },
            success: function(data) {
                // Populate the job details modal with the fetched data
                document.getElementById('jobDetailsContent').innerHTML = data;
                // Show the job details modal
                document.getElementById('jobDetailsModal').classList.remove('hidden');
            },
            error: function(xhr, status, error) {
                console.error("Error fetching job details: ", status, error);
            }
        });
    }

    // Close job details modal
    function closeJobDetailsModal() {
        document.getElementById('jobDetailsModal').classList.add('hidden');
    }
</script>
</body>
</html>