<?php
//session_start(); // Start the session
require 'connect.php'; // Database connection

// Use user ID from POST or fallback to session
$userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : (isset($_SESSION['id']) ? intval($_SESSION['id']) : null);

if ($userId) {
    // SQL query to fetch notifications for the user
    $notificationSql = "SELECT notifications.*, jobs.job_id, jobs.job_title AS job_title 
                         FROM notifications
                         JOIN workers ON notifications.worker_id = workers.worker_id
                         JOIN users ON workers.user_id = users.id
                         JOIN jobs ON notifications.job_id = jobs.job_id
                         WHERE workers.user_id = ? AND notifications.is_read = FALSE 
                        ORDER BY notifications.created_at DESC";

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

//     echo '<a href="../notification-mark-as-read.php?job_id=' . htmlspecialchars($notification['job_id']) . '" class="p-2 border rounded hover:bg-gray-100 block">
//     ' . htmlspecialchars($notification['message']) . ' (Job: ' . htmlspecialchars($notification['job_title']) .')  (CREATED AT: ' . htmlspecialchars($notification['created_at']) . ')
//   </a>';

    $notificationStmt->close();
} else {
    echo '<div class="text-red-500">User  ID not provided. Debugging Information:</div>';
    echo '<div>POST Data: ' . htmlspecialchars(json_encode($_POST)) . '</div>';
    echo '<div>Session Data: ' . htmlspecialchars(json_encode($_SESSION)) . '</div>';
}
?>