<?php
// Start the session and include the database connection
//session_start();
require 'connect.php';

// Initialize notification count
$notifications_count = 0;

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    $userId = intval($_SESSION['id']);
    
    // Query to get unread notifications for workers
    if ($_SESSION['role'] === 'worker') {
        $sql = "SELECT COUNT(*) FROM notifications 
                JOIN workers ON notifications.worker_id = workers.worker_id 
                WHERE workers.user_id = ? AND notifications.is_read = FALSE";
    } 
    // Query to get unread notifications for recruiters
    elseif ($_SESSION['role'] === 'recruiter') {
        $sql = "SELECT COUNT(*) FROM notificationsJobs 
                WHERE worker_id = ? AND is_read = FALSE";
    }

    if (isset($sql)) {
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $userId);
            if ($stmt->execute()) {
                $stmt->bind_result($notifications_count);
                $stmt->fetch();
            } else {
                error_log("Error executing SQL: " . $stmt->error);
            }
            $stmt->close();
        } else {
            error_log("Error preparing SQL: " . $conn->error);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    #notificationsList::-webkit-scrollbar {
        width: 8px;
    }
    #notificationsList::-webkit-scrollbar-thumb {
        background: #cbd5e0; /* Light gray */
        border-radius: 4px;
    }
    #notificationsList::-webkit-scrollbar-thumb:hover {
        background: #a0aec0; /* Darker gray */
    }
</style>

</head>
<body>
<header class="bg-black text-white p-4 flex justify-between items-center">
    <div class="flex items-center">
        <i class="fas fa-briefcase mr-2"></i>
        <span class="text-xl font-bold">WORKEASE</span>
    </div>
    <nav class="hidden md:flex space-x-4">
        <?php if (isset($_SESSION['role'])): ?>
            <a class="hover:text-gray-400" href="<?php echo $_SESSION['role'] === 'worker' ? 'home-worker.php' : 'home-recruiter.php'; ?>">Home</a>
            <?php if ($_SESSION['role'] === 'worker'): ?>
                <a class="hover:text-gray-400" href="jobs.php">Jobs</a>
            <?php elseif ($_SESSION['role'] === 'recruiter'): ?>
                <a class="hover:text-gray-400" href="worker-list.php">Workers</a>
            <?php endif; ?>
        <?php else: ?>
            <a class="hover:text-gray-400" href="index.php">Home</a>
        <?php endif; ?>
        <a class="hover:text-gray-400" href="../about-us.php">About Us</a>
        <a class="hover:text-gray-400" href="../contact-us.php">Contact Us</a>
    </nav>
    <div class="flex items-center space-x-4">
        <?php if (isset($_SESSION['name'])): ?>
            <a href="worker-profile.php" class="text-blue-500 hover:underline" title="Go to profile">
                <?php echo htmlspecialchars($_SESSION['name']); ?>
            </a>
            <button class="relative" onclick="toggleNotificationModal()">
                <i class="fas fa-bell text-white"></i>
                <?php if ($notifications_count > 0): ?>
                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">
                        <?php echo htmlspecialchars($notifications_count); ?>
                    </span>
                <?php endif; ?>
            </button>
            <form method="POST" action="logout.php" class="inline">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Log Out</button>
            </form>
        <?php else: ?>
            <a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Log In</a>
            <a href="create-account.php" class="bg-green-500 text-white px-4 py-2 rounded-lg">Register</a>
        <?php endif; ?>
    </div>
</header>

<!-- Notification Modal -->
<!-- Notification Modal -->
<div id="notificationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-5 rounded-lg w-1/3">
        <h2 class="text-xl font-bold">Notifications</h2>
        <div id="notificationsList" class="mt-4 overflow-y-auto max-h-64 border-t border-b border-gray-300">
            <!-- Notifications will be dynamically loaded -->
        </div>
        <button onclick="toggleNotificationModal()" class="mt-4 bg-gray-600 text-white py-2 px-4 rounded">Close</button>
    </div>
</div>

<script>
// Toggle the visibility of the notification modal
function toggleNotificationModal() {
    const modal = document.getElementById('notificationModal');
    modal.classList.toggle('hidden');
    if (!modal.classList.contains('hidden')) {
        fetchNotifications();
    }
}

// Fetch notifications dynamically
function fetchNotifications() {
    const userId = <?php echo json_encode($_SESSION['id'] ?? null); ?>;
    fetch('fetch-notification.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=${userId}`
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('notificationsList').innerHTML = data;
    })
    .catch(error => console.error('Error fetching notifications:', error));
}
</script>
</body>
</html>
