<?php
session_start(); // Start the session
require '../connect.php'; // Database connection

// Use user ID and role from POST or fallback to session
$userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : (isset($_SESSION['id']) ? intval($_SESSION['id']) : null);
$userRole = isset($_POST['role']) ? $_POST['role'] : (isset($_SESSION['role']) ? $_SESSION['role'] : null);
// console_log("Job ID from session: " . $userId);
// console_log("Job Role from session: " . $userRole);

if ($userId && $userRole) {
    if ($userRole === 'worker') {
        // SQL query to fetch notifications for workers
        $notificationSql = "SELECT notifications.*, jobs.job_id, jobs.job_title AS job_title 
                            FROM notifications
                            JOIN workers ON notifications.worker_id = workers.worker_id
                            JOIN users ON workers.user_id = users.id
                            JOIN jobs ON notifications.job_id = jobs.job_id
                            WHERE workers.user_id = ? AND notifications.is_read = FALSE 
                            ORDER BY notifications.created_at DESC";
    } elseif ($userRole === 'recruiter') {
        // SQL query to fetch notifications for recruiters
        $notificationSql = "SELECT notificationsJobs.message, notificationsJobs.created_at, jobs.job_id, jobs.job_title 
                            FROM notificationsJobs
                            LEFT JOIN jobs ON notificationsJobs.job_id = jobs.job_id
                            WHERE notificationsJobs.worker_id = ? AND notificationsJobs.is_read = FALSE 
                            ORDER BY notificationsJobs.created_at DESC";
    } else {
        echo '<div class="text-red-500">Invalid user role.</div>';
        exit;
    }

    $notificationStmt = $conn->prepare($notificationSql);

    if (!$notificationStmt) {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
        exit;
    }

    $notificationStmt->bind_param("i", $userId);

    if (!$notificationStmt->execute()) {
        echo "Error executing statement: " . htmlspecialchars($notificationStmt->error);
        exit;
    }

    $notifications = $notificationStmt->get_result();

    if ($notifications->num_rows > 0) {
        while ($notification = $notifications->fetch_assoc()) {
            echo '<a href="job-details.php?job_id=' . htmlspecialchars($notification['job_id']) . '" class="p-2 border rounded hover:bg-gray-100 block">
                    ' . htmlspecialchars($notification['message']) . ' (Job: ' . htmlspecialchars($notification['job_title']) .')  (CREATED AT: ' . htmlspecialchars($notification['created_at']) . ') 
                  </a>';
        }
    } else {
        echo '<div class="text-gray-500">No new notifications.</div>';
    }

    $notificationStmt->close();
} else {
    echo '<div class="text-red-500">User ID or role not provided. Debugging Information:</div>';
    echo '<div>POST Data: ' . htmlspecialchars(json_encode($_POST)) . '</div>';
    echo '<div>Session Data: ' . htmlspecialchars(json_encode($_SESSION)) . '</div>';
}
?>
