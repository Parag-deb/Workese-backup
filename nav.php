<?php 
require 'connect.php';
//session_start(); // Ensure session is started
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>
<body>
<header class="bg-black text-white p-4 flex justify-between items-center">
    <!-- Logo Section -->
    <div class="flex items-center">
        <i class="fas fa-briefcase mr-2"></i>
        <span class="text-xl font-bold">WORKEASE</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="hidden md:flex space-x-4">
        <a class="hover:text-gray-400" href="/home/index.html">Home</a>
        <a class="hover:text-gray-400" href="jobs.php">Jobs</a>
        <a class="hover:text-gray-400" href="../about-us.php">About Us</a>
        <a class="hover:text-gray-400" href="../contact-us.php">Contact Us</a>
    </nav>

    <!-- User Profile and Authentication -->
    <div class="flex items-center space-x-4">
        <?php if (isset($_SESSION['name'])) { ?>
            <!-- Logged-in User Section -->
            <a href="worker-profile.php" class="text-blue-500 hover:underline" title="Go to profile">
                <?php echo htmlspecialchars($_SESSION['name']); ?>
            </a>
            <img 
                alt="User Avatar" 
                class="rounded-full" 
                height="40" 
                src="https://storage.googleapis.com/a1aa/image/lyou4ghwI2rfFSOMEefw0VROzQIkdIGqehYskzfb92Fn3lSgC.jpg" 
                width="40"
            />
            <!-- Notification Button -->
            <button class="relative" onclick="toggleNotificationModal()">
                <i class="fas fa-bell text-white"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">
                    <?php 
                    if (isset($_SESSION['id'])) {
                        $userId = intval($_SESSION['id']); // Sanitize user ID
                        $notificationSql = "SELECT COUNT(*) FROM notifications WHERE worker_id = ? AND is_read = FALSE";
                        $notificationStmt = $conn->prepare($notificationSql);
                        $notificationStmt->bind_param("i", $userId);
                        $notificationStmt->execute();
                        $notificationStmt->bind_result($notifications_count);
                        $notificationStmt->fetch();
                        echo htmlspecialchars($notifications_count ?? '0'); 
                        $notificationStmt->close();
                    } else {
                        echo '0';
                    }
                    ?>
                </span>
            </button>
            <form method="POST" action="logout.php" class="inline">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Log Out</button>
            </form>
        <?php } else { ?>
            <!-- Guest User Section -->
            <a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Log In</a>
            <a href="create-account.php" class="bg-green-500 text-white px-4 py-2 rounded-lg">Register</a>
        <?php } ?>
    </div>
</header>

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
            if (isset($userId)) {
                $notificationSql = "SELECT * FROM notifications WHERE worker_id = ? AND is_read = FALSE";
                $notificationStmt = $conn->prepare($notificationSql);
                $notificationStmt->bind_param("i", $userId);
                $notificationStmt->execute();
                $notifications = $notificationStmt->get_result();

                if ($notifications->num_rows > 0) {
                    while ($notification = $notifications->fetch_assoc()) {
                        echo '<div class="p-2 border rounded hover:bg-gray-100 cursor-pointer" onclick="openNotificationDetail(' . htmlspecialchars($notification['id']) . ', ' . htmlspecialchars($notification['job_id']) . ')">' . htmlspecialchars($notification['message']) . '</div>';
                    }
                } else {
                    echo '<div class="text-gray-500">No new notifications.</div>';
                }
                $notificationStmt->close();
            } else {
                echo '<div class="text-gray-500">Log in to see notifications.</div>';
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
                document.getElementById('jobDetailsContent').innerHTML = data;
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
